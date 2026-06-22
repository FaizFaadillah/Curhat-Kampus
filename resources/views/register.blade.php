<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - CurhatKampus</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
</head>
<body>
    @include('partials.navbar')

    <section class="hero-section">
        <div class="main-container">
            <!-- Karakter Gambar Mahasiswa (Sama Seperti Halaman Login) -->
            <img src="{{ asset('images/karakter.png') }}" alt="Karakter Mahasiswa" class="karakter-img">

            <!-- Kiri: Teks Hero Banner -->
            <div class="left-section">
                <div class="hero-text">
                    <h1 class="font-roboto">Jangan Dipendam,<br>Spill Aja Di Sini!</h1>
                    <p class="font-poppins">
                        Fasilitas ngadat atau ada masalah akademik yang bikin pusing?
                        Laporin keluh kesahmu dengan aman, gampang, dan pantau prosesnya secara real-time.
                    </p>

                    <div class="hero-buttons font-poppins">
                        <a href="{{ route('login') }}#login-card" class="btn-kirim">
                            Kirim Curhatan
                        </a>
                        <a href="#cara-curhat" class="btn-cara">
                            Cara Kirim Curhatan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kanan: Form Pendaftaran Mahasiswa (Menggunakan Class login-card Biar Identik) -->
            <div class="right-section font-opensans">
                <div class="login-card" id="register-card">
                    <div class="login-header">
                        <h2>Daftar Akun</h2>
                        <div class="login-role">
                            Mahasiswa
                        </div>
                    </div>

                    <!-- Alert Validasi Error -->
                    @if($errors->any())
                        <div class="alert-error">
                            <ul style="margin: 0; padding-left: 15px; list-style-type: square;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.process') }}" method="POST">
                        @csrf

                        <!-- Row 1: NIM & Nama (Berjejer ke Samping) -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nim">Nomor Induk Mahasiswa</label>
                                <input
                                    type="text"
                                    id="nim"
                                    name="nim"
                                    value="{{ old('nim') }}"
                                    placeholder="Masukkan NIM"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Row 2: Email (Full Width) -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="email@example.com"
                                required
                            >
                        </div>

                        <!-- Row 3: Password & Konfirmasi -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Minimal 8 karakter"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Ulangi password"
                                    required
                                >
                            </div>
                        </div>

                        <button type="submit" class="btn-login" style="margin-top: 15px;">
                            Daftar
                        </button>
                    </form>

                    <div class="register-link">
                        Sudah punya akun? <a href="{{ route('login') }}">Login Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KUNCI PERBAIKAN: Menggunakan Grid Sesuai Struktur Halaman Utama (Fix image_718849.png) -->
    <section class="home-lower-section">
        <div class="home-lower-container">
            <div class="cara-section" id="cara-curhat">
                <h2 class="cara-title">Cara Mengirim Curhatan</h2>
                <p class="cara-description">
                    Sampaikan keluhan atau pengaduan kampus dengan alur yang sederhana, aman, dan mudah dipantau.
                    Ikuti empat langkah berikut agar curhatanmu dapat diproses dengan baik.
                </p>

                <div class="cara-steps-grid">
                    <div class="cara-step-card">
                        <div class="step-number">1</div>
                        <h3>Login Akun</h3>
                        <p>Masuk menggunakan NIM dan password agar identitas pengaduan tercatat dengan jelas.</p>
                    </div>

                    <div class="cara-step-card">
                        <div class="step-number">2</div>
                        <h3>Isi Formulir</h3>
                        <p>Lengkapi kategori, lokasi, judul, dan detail kronologi pengaduan secara ringkas.</p>
                    </div>

                    <div class="cara-step-card">
                        <div class="step-number">3</div>
                        <h3>Unggah Bukti</h3>
                        <p>Tambahkan foto, video, atau dokumen pendukung agar pengaduan lebih kuat.</p>
                    </div>

                    <div class="cara-step-card">
                        <div class="step-number">4</div>
                        <h3>Kirim & Pantau</h3>
                        <p>Kirim curhatanmu, lalu cek perkembangan status melalui menu Cek Curhatan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>