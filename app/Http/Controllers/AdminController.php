<?php

namespace App\Http\Controllers;

use App\Models\Curhat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    // Mengoptimalkan dashboard dengan sistem counter tunggal biar anti-lemot
    public function dashboard(Request $request): View
    {
        $this->ensureAdmin();

        // KUNCI UTAMA: Hitung semua status SEKALIGUS dalam 1 query saja biar gak bolak-balik database
        $counts = Curhat::selectRaw("
            COUNT(*) as semua,
            SUM(CASE WHEN status = 'Menunggu' THEN 1 ELSE 0 END) as menunggu,
            SUM(CASE WHEN status = 'Diproses' THEN 1 ELSE 0 END) as diproses,
            SUM(CASE WHEN status = 'Selesai' THEN 1 ELSE 0 END) as selesai,
            SUM(CASE WHEN status = 'Ditolak' THEN 1 ELSE 0 END) as ditolak
        ")->first();

        // Inisialisasi query dasar beserta relasi user-nya
        $query = Curhat::with('user');

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }
        
        // Logika penyaringan pencarian kata kunci
        if ($request->filled('search')) {
            $keyword = $request->search;

            $query->where(function($q) use ($keyword) {
                $q->where('kode_curhat', 'LIKE', "%{$keyword}%")
                  ->orWhere('nama_lengkap', 'LIKE', "%{$keyword}%")
                  ->orWhere('nim', 'LIKE', "%{$keyword}%")
                  ->orWhere('judul', 'LIKE', "%{$keyword}%")
                  ->orWhere('detail', 'LIKE', "%{$keyword}%");
            });
        }

        // Eksekusi query dengan urutan data terbaru
        $curhats = $query->latest()->get();

        // Kirim $curhats dan $counts ke dalam view blade
        return view('admin.dashboard', compact('curhats', 'counts'));
    }

    public function updateStatus(Request $request, Curhat $curhat): RedirectResponse
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'status' => ['required', 'in:Menunggu,Diproses,Selesai,Ditolak'],
            'catatan_admin' => ['nullable', 'string', 'max:1000'],
        ]);

        $curhat->update([
            'status' => $validated['status'],
            'catatan_admin' => $validated['catatan_admin'] ?? null,
        ]);

        return back()->with('success', 'Status curhatan berhasil diperbarui.');
    }

    private function ensureAdmin(): void
    {
        abort_if(! Auth::check() || ! Auth::user()->isAdmin(), 403, 'Akses hanya untuk admin.');
    }
}