<?php

namespace App\Http\Controllers;

use App\Models\Curhat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    // Tambahkan parameter Request $request di sini untuk menangkap input pencarian
    public function dashboard(Request $request): View
    {
        $this->ensureAdmin();

        // 1. Inisialisasi query dasar beserta relasi user-nya
        $query = Curhat::with('user');

        // 2. Logika penyaringan (jika tombol cari diklik dan input tidak kosong)
        if ($request->filled('search')) {
            $keyword = $request->search;

            // Cari kata kunci yang cocok di beberapa kolom sekaligus sesuai kolom database kelompokmu
            $query->where(function($q) use ($keyword) {
                $q->where('kode_curhat', 'LIKE', "%{$keyword}%")
                  ->orWhere('nama_lengkap', 'LIKE', "%{$keyword}%")
                  ->orWhere('nim', 'LIKE', "%{$keyword}%")
                  ->orWhere('judul', 'LIKE', "%{$keyword}%")
                  ->orWhere('detail', 'LIKE', "%{$keyword}%");
            });
        }

        // 3. Eksekusi query dengan urutan data terbaru
        $curhats = $query->latest()->get();

        return view('admin.dashboard', compact('curhats'));
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