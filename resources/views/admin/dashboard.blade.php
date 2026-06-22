<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - CurhatKampus</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* --- UTILITY & BASE SYSTEM --- */
        body {
            background-color: #f1f5f9; /* Background abu-abu lembut agar card putih lebih kontras */
        }

        /* --- NEO-BRUTALISM ALERTS --- */
        .alert-box {
            border: 2px solid #0f172a;
            border-radius: 12px;
            padding: 14px 20px;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 25px;
            box-shadow: 4px 4px 0px 0px #0f172a;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* --- INTERACTIVE CURHAT CARD --- */
        .curhat-card {
            background: white;
            border: 2px solid #0f172a;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 28px;
            box-shadow: 5px 5px 0px 0px #0f172a;
            display: flex;
            gap: 28px;
            justify-content: space-between;
            align-items: flex-start;
            text-align: left;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        /* Efek pop-out membal saat card disorot kursor */
        .curhat-card:hover {
            transform: translate(-3px, -3px);
            box-shadow: 8px 8px 0px 0px #0f172a;
        }
        .card-left {
            flex: 1;
        }
        .card-right {
            width: 300px;
            background: #f8fafc;
            border: 2px solid #0f172a;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 3px 3px 0px 0px #cbd5e1;
        }

        /* --- MODERN NEO BADGES --- */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            border: 2px solid #0f172a;
            margin-right: 8px;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        /* --- STYLISH CONTENT BOX --- */
        .detail-box {
            font-size: 14px;
            color: #1e293b;
            line-height: 1.7;
            background: #f8fafc;
            padding: 18px;
            border-radius: 12px;
            border: 2px solid #0f172a;
            white-space: pre-line;
            margin-top: 14px;
            box-shadow: inset 2px 2px 0px rgba(0,0,0,0.05);
        }
        .info-mhs {
            margin-top: 20px;
            padding-top: 14px;
            border-top: 2px dashed #0f172a;
            font-size: 13px;
            color: #334155;
            line-height: 1.6;
        }

        /* --- STYLISH FORMS & INPUTS --- */
        input[type="text"], select, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #0f172a;
            border-radius: 10px;
            font-size: 14px;
            background: white;
            box-shadow: 2px 2px 0px 0px #0f172a;
            transition: all 0.15s ease;
            box-sizing: border-box;
        }
        /* Efek fokus estetik berwarna cyan lembut saat diklik */
        input[type="text"]:focus, select:focus, textarea:focus {
            outline: none;
            background: #f0f9ff;
            border-color: #00a3ff;
            transform: translate(-1px, -1px);
            box-shadow: 3px 3px 0px 0px #0f172a;
        }

        /* --- NEO BUTTON SYSTEM --- */
        .btn-neo {
            font-weight: 800;
            cursor: pointer;
            border: 2px solid #0f172a;
            box-shadow: 3px 3px 0px 0px #0f172a;
            transition: all 0.1s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        .btn-neo:hover {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0px 0px #0f172a;
        }
        .btn-neo:active {
            transform: translate(3px, 3px);
            box-shadow: none;
        }
        .btn-update {
            width: 100%;
            background: #00a3ff;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-size: 14px;
        }

        /* --- TAB FILTER SYSTEM --- */
        .tab-container {
            display: flex;
            gap: 12px;
            margin-bottom: 35px;
            flex-wrap: wrap;
        }
        .tab-btn {
            background: white;
            color: #0f172a;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 13px;
        }
        .tab-btn.active {
            background: #0f172a;
            color: white;
            box-shadow: 3px 3px 0px 0px #00a3ff;
        }

        @media (max-width: 768px) {
            .curhat-card { flex-direction: column; gap: 20px; }
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
                    <button type="submit" class="nav-logout-btn">Logout</button>
                </form>
            </div>
        </nav>
    </header>

    <section class="hero-section">
        <div class="main-container" style="display:block; max-width:1100px; margin:0 auto; padding:40px 20px;">
            <div class="form-card font-opensans" style="width:100%; box-sizing: border-box; background: #ffffff; border: 3px solid #0f172a; border-radius: 20px; box-shadow: 6px 6px 0px 0px #0f172a; padding: 35px;">
                
                <h2 class="form-header-title" style="margin-bottom: 30px; font-size: 28px; font-weight: 900;">Dashboard Admin</h2>

                {{-- Alert Pesan Sukses --}}
                @if(session('success'))
                    <div class="alert-box" style="background:#dcfce7; color: #166534;">
                        <span>✅</span> {{ session('success') }}
                    </div>
                @endif

                {{-- Alert Pesan Eror --}}
                @if($errors->any())
                    <div class="alert-box" style="background:#fee2e2; color: #991b1b;">
                        <span>❌</span> {{ $errors->first() }}
                    </div>
                @endif

                {{-- Form Pencarian --}}
                <form action="{{ route('admin.dashboard') }}" method="GET" style="display: flex; gap: 12px; margin-bottom: 35px; width: 100%;">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif

                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari berdasarkan kode, nama, NIM, atau judul laporan...">
                    
                    <button type="submit" class="btn-neo" style="background: #00a3ff; color: white; padding: 0 30px; border-radius: 10px; font-weight: bold;">
                        Cari
                    </button>

                    @if(request('search'))
                        <a href="{{ route('admin.dashboard', request()->except('search')) }}" class="btn-neo" style="background: #e2e8f0; color: #334155; padding: 0 20px; border-radius: 10px; font-weight: bold;">
                            Reset
                        </a>
                    @endif
                </form>

                {{-- Navigasi Tab Filter Status --}}
                <div class="tab-container">
                    <a href="{{ route('admin.dashboard', ['status' => 'Semua', 'search' => request('search')]) }}" 
                       class="btn-neo tab-btn {{ request('status') == 'Semua' || !request('status') ? 'active' : '' }}">
                       🌐 Semua ({{ \App\Models\Curhat::count() }})
                    </a>
                    <a href="{{ route('admin.dashboard', ['status' => 'Menunggu', 'search' => request('search')]) }}" 
                       class="btn-neo tab-btn {{ request('status') == 'Menunggu' ? 'active' : '' }}">
                       ⏳ Menunggu ({{ \App\Models\Curhat::where('status', 'Menunggu')->count() }})
                    </a>
                    <a href="{{ route('admin.dashboard', ['status' => 'Diproses', 'search' => request('search')]) }}" 
                       class="btn-neo tab-btn {{ request('status') == 'Diproses' ? 'active' : '' }}">
                       🔧 Diproses ({{ \App\Models\Curhat::where('status', 'Diproses')->count() }})
                    </a>
                    <a href="{{ route('admin.dashboard', ['status' => 'Selesai', 'search' => request('search')]) }}" 
                       class="btn-neo tab-btn {{ request('status') == 'Selesai' ? 'active' : '' }}">
                       ✅ Selesai ({{ \App\Models\Curhat::where('status', 'Selesai')->count() }})
                    </a>
                    <a href="{{ route('admin.dashboard', ['status' => 'Ditolak', 'search' => request('search')]) }}" 
                       class="btn-neo tab-btn {{ request('status') == 'Ditolak' ? 'active' : '' }}">
                       ❌ Ditolak ({{ \App\Models\Curhat::where('status', 'Ditolak')->count() }})
                    </a>
                </div>

                {{-- List Data Curhat --}}
                <div class="card-list">
                    @forelse($curhats as $curhat)
                        <div class="curhat-card">
                            
                            <div class="card-left">
                                <div style="margin-bottom: 12px;">
                                    <span class="badge" style="background: #f1f5f9; color: #334155;">{{ $curhat->kode_curhat }}</span>
                                    <span class="badge" style="background: #fef3c7; color: #92400e;">📍 {{ $curhat->kategori }} • {{ $curhat->lokasi }}</span>
                                    
                                    @php
                                        $bgStatus = '#e2e8f0'; $coStatus = '#334155';
                                        if($curhat->status === 'Menunggu') { $bgStatus = '#fef9c3'; $coStatus = '#854d0e'; }
                                        elseif($curhat->status === 'Diproses') { $bgStatus = '#dbeafe'; $coStatus = '#1e40af'; }
                                        elseif($curhat->status === 'Selesai') { $bgStatus = '#dcfce7'; $coStatus = '#166534'; }
                                        elseif($curhat->status === 'Ditolak') { $bgStatus = '#fee2e2'; $coStatus = '#991b1b'; }
                                    @endphp
                                    <span class="badge" style="background: {{ $bgStatus }}; color: {{ $coStatus }};">
                                        {{ $curhat->status }}
                                    </span>
                                </div>

                                <h3 style="font-size: 22px; font-weight: 900; color: #0f172a; margin: 5px 0;">{{ $curhat->judul }}</h3>
                                
                                <div class="detail-box">
                                    {{ $curhat->detail }}
                                </div>

                                <div class="info-mhs">
                                    <p>🙋‍♂️ <b>Pengirim:</b> {{ $curhat->nama_lengkap }} (NIM: {{ $curhat->nim }})</p>
                                    <p>📧 <b>Email:</b> {{ $curhat->email }} | 📞 <b>HP:</b> {{ $curhat->nomor_hp }}</p>
                                    <p style="font-size: 11px; color: #64748b; margin-top: 8px; font-weight: 600;">🗓️ Waktu Masuk: {{ $curhat->created_at->format('d M Y H:i') }} WIB</p>
                                </div>
                            </div>

                            <div class="card-right">
                                <div style="margin-bottom: 18px; text-align: left;">
                                    <label style="font-size: 11px; font-weight: 800; color: #475569; display: block; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Lampiran Berkas</label>
                                    @if($curhat->lampiran_path)
                                        <a href="{{ asset('storage/' . $curhat->lampiran_path) }}" target="_blank" style="font-size: 13px; color: #00a3ff; font-weight: 800; text-decoration: underline;">
                                            📂 Buka Lampiran File
                                        </a>
                                    @else
                                        <span style="font-size: 13px; color: #94a3b8; font-style: italic;">Tidak ada berkas</span>
                                    @endif
                                </div>

                                <form action="{{ route('admin.curhat.updateStatus', $curhat) }}" method="POST" style="text-align: left;">
                                    @csrf
                                    @method('PATCH')

                                    <div style="margin-bottom: 16px;">
                                        <label style="font-size: 11px; font-weight: 800; color: #475569; display: block; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Ubah Status</label>
                                        <select name="status" required style="font-weight: 700; color: #0f172a;">
                                            <option value="Menunggu" {{ $curhat->status === 'Menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                                            <option value="Diproses" {{ $curhat->status === 'Diproses' ? 'selected' : '' }}>🔧 Diproses</option>
                                            <option value="Selesai" {{ $curhat->status === 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                            <option value="Ditolak" {{ $curhat->status === 'Ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                                        </select>
                                    </div>

                                    <div style="margin-bottom: 20px;">
                                        <label style="font-size: 11px; font-weight: 800; color: #475569; display: block; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Tanggapan Admin</label>
                                        <textarea name="catatan_admin" rows="3" placeholder="Tulis pesan tindakan..." style="font-weight: 600;"></textarea>
                                    </div>

                                    <button type="submit" class="btn-neo btn-update">Simpan Perubahan</button>
                                </form>
                            </div>

                        </div>
                    @empty
                        <div style="background: white; border: 2px solid #0f172a; border-radius: 16px; padding: 50px 20px; text-align: center; color: #64748b; box-shadow: 4px 4px 0px 0px #0f172a;">
                            <p style="font-size: 18px; font-weight: 900; color: #0f172a; margin: 0;">📭 Belum ada curhatan masuk</p>
                            <p style="font-size: 13px; color: #94a3b8; margin-top: 6px; font-weight: 600;">Antrean laporan kosong atau data pencarian tidak ditemukan.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </section>
</body>
</html>