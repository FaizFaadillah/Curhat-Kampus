<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - CurhatKampus</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Tambahan style khusus biar admin card-nya mantap dan gak bentrok */
        .curhat-card {
            background: white;
            border: 2px solid #0f172a;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 4px 4px 0px 0px #0f172a;
            display: flex;
            gap: 24px;
            justify-content: space-between;
            align-items: flex-start;
            text-align: left;
        }
        .card-left {
            flex: 1;
        }
        .card-right {
            width: 280px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 16px;
            border-radius: 12px;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #333;
            margin-right: 6px;
            margin-bottom: 6px;
        }
        .info-mhs {
            margin-top: 15px;
            padding-top: 12px;
            border-top: 1px dashed #cbd5e1;
            font-size: 12px;
            color: #475569;
            line-height: 1.6;
        }
        .btn-update {
            width: 100%;
            background: #00a3ff;
            color: white;
            border: 2px solid #0f172a;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 2px 2px 0px 0px #0f172a;
            transition: all 0.1s;
        }
        .btn-update:active {
            transform: translate(2px, 2px);
            box-shadow: none;
        }
        @media (max-width: 768px) {
            .curhat-card { flex-direction: column; }
            .card-right { width: 100%; }
        }
    </style>
</head>
<body>
<header class="header-bar font-poppins">
        <nav class="navbar">
            <a href="{{ route('admin.dashboard') }}" class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <span class="logo-text"><b>Curhat</b>Kampus Admin</span>
            </a>

            <div class="nav-right">
                <form action="{{ route('logout') }}" method="POST" class="nav-logout-form">
                    @csrf
                    <button type="submit" class="nav-logout-btn">
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <section class="hero-section">
        <div class="main-container" style="display:block; max-width:1100px; margin:0 auto; padding:40px 20px;">
            <div class="form-card font-opensans" style="width:100%; box-sizing: border-box;">
                
                <h2 class="form-header-title" style="margin-bottom: 25px;">Dashboard Admin</h2>

                @if(session('success'))
                    <div style="color: #155724; background:#d4edda; border:1px solid #c3e6cb; padding:12px; border-radius:8px; font-size:13px; margin-bottom:20px; text-align:left;">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div style="color: #721c24; background:#f8d7da; border:1px solid #f5c6cb; padding:12px; border-radius:8px; font-size:13px; margin-bottom:20px; text-align:left;">
                        ❌ {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: 10px; margin-bottom: 30px; width: 100%;">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari berdasarkan kode, nama, NIM, atau judul laporan..." 
                           style="flex: 1; padding: 12px; border: 2px solid #0f172a; border-radius: 10px; font-size: 14px; box-shadow: 2px 2px 0px 0px #0f172a;">
                    
                    <button type="submit" class="btn-nav-kirim" style="background: #00a3ff; color: white; border: 2px solid #0f172a; padding: 0 25px; border-radius: 10px; font-weight: bold; cursor: pointer; box-shadow: 2px 2px 0px 0px #0f172a;">
                        Cari
                    </button>

                    @if(request('search'))
                        <a href="{{ route('admin.dashboard') }}" style="background: #e2e8f0; color: #334155; border: 2px solid #0f172a; padding: 12px 15px; border-radius: 10px; text-decoration: none; font-size: 14px; font-weight: bold; box-shadow: 2px 2px 0px 0px #0f172a; display: flex; align-items: center;">
                            Reset
                        </a>
                    @endif
                </form>

                <div class="card-list">
                    @forelse($curhats as $curhat)
                        <div class="curhat-card">
                            
                            <div class="card-left">
                                <div style="margin-bottom: 10px;">
                                    <span class="badge" style="background: #f1f5f9; color: #334155;">{{ $curhat->kode_curhat }}</span>
                                    <span class="badge" style="background: #fef3c7; color: #92400e;">📍 {{ $curhat->kategori }} • {{ $curhat->lokasi }}</span>
                                    
                                    @php
                                        $bgStatus = '#e2e8f0'; $coStatus = '#334155';
                                        if($curhat->status === 'Menunggu') { $bgStatus = '#fef9c3'; $coStatus = '#854d0e'; }
                                        elseif($curhat->status === 'Diproses') { $bgStatus = '#dbeafe'; $coStatus = '#1e40af'; }
                                        elseif($curhat->status === 'Selesai') { $bgStatus = '#dcfce7'; $coStatus = '#166534'; }
                                        elseif($curhat->status === 'Ditolak') { $bgStatus = '#fee2e2'; $coStatus = '#991b1b'; }
                                    @endphp
                                    <span class="badge" style="background: {{ $bgStatus }}; color: {{ $coStatus }}; border: 2px solid #0f172a;">
                                        {{ $curhat->status }}
                                    </span>
                                </div>

                                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 5px 0;">{{ $curhat->judul }}</h3>
                                <p style="font-size: 14px; color: #334155; line-height: 1.6; background: #f8fafc; padding: 15px; border-radius: 10px; border: 1px solid #e2e8f0; white-space: pre-line; margin-top: 10px;">
                                    {{ $curhat->detail }}
                                </p>

                                <div class="info-mhs">
                                    <p>🙋‍♂️ <b>Pengirim:</b> {{ $curhat->nama_lengkap }} (NIM: {{ $curhat->nim }})</p>
                                    <p>📧 <b>Email:</b> {{ $curhat->email }} | 📞 <b>HP:</b> {{ $curhat->nomor_hp }}</p>
                                    <p style="font-size: 10px; color: #94a3b8; margin-top: 5px;">Waktu Masuk: {{ $curhat->created_at->format('d M Y H:i') }} WIB</p>
                                </div>
                            </div>

                            <div class="card-right">
                                <div style="margin-bottom: 15px; text-align: left;">
                                    <label style="font-size: 11px; font-weight: bold; color: #64748b; display: block; margin-bottom: 5px; text-transform: uppercase;">Lampiran Berkas</label>
                                    @if($curhat->lampiran_path)
                                        <a href="{{ asset('storage/' . $curhat->lampiran_path) }}" target="_blank" style="font-size: 13px; color: #00a3ff; font-weight: bold; text-decoration: underline;">
                                            📂 Buka Lampiran File
                                        </a>
                                    @else
                                        <span style="font-size: 12px; color: #94a3b8; font-style: italic;">Tidak ada berkas</span>
                                    @endif
                                </div>

                                <form action="{{ route('admin.curhat.updateStatus', $curhat) }}" method="POST" style="text-align: left;">
                                    @csrf
                                    @method('PATCH')

                                    <div style="margin-bottom: 12px;">
                                        <label style="font-size: 11px; font-weight: bold; color: #64748b; display: block; margin-bottom: 5px; text-transform: uppercase;">Ubah Status</label>
                                        <select name="status" required style="width: 100%; padding: 8px; border: 2px solid #0f172a; border-radius: 6px; font-weight: bold; background: white;">
                                            <option value="Menunggu" {{ $curhat->status === 'Menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                                            <option value="Diproses" {{ $curhat->status === 'Diproses' ? 'selected' : '' }}>🔧 Diproses</option>
                                            <option value="Selesai" {{ $curhat->status === 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                            <option value="Ditolak" {{ $curhat->status === 'Ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                                        </select>
                                    </div>

                                    <div style="margin-bottom: 15px;">
                                        <label style="font-size: 11px; font-weight: bold; color: #64748b; display: block; margin-bottom: 5px; text-transform: uppercase;">Tanggapan Admin</label>
                                        <textarea name="catatan_admin" rows="3" placeholder="Tulis pesan tindakan..." style="width: 100%; padding: 8px; border: 2px solid #0f172a; border-radius: 6px; font-size: 12px; box-sizing: border-box;">{{ old('catatan_admin', $curhat->catatan_admin) }}</textarea>
                                    </div>

                                    <button type="submit" class="btn-update">Simpan Perubahan</button>
                                </form>
                            </div>

                        </div>
                    @empty
                        <div style="background: white; border: 2px solid #0f172a; border-radius: 16px; padding: 40px; text-align: center; color: #64748b; box-shadow: 4px 4px 0px 0px #0f172a;">
                            <p style="font-size: 16px; font-weight: bold; color: #0f172a; margin: 0;">📭 Belum ada curhatan masuk</p>
                            <p style="font-size: 12px; color: #94a3b8; margin-top: 5px;">Antrean laporan kosong atau data pencarian tidak ditemukan.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </section>
</body>
</html>