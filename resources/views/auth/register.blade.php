@extends('layouts.login')

@section('content')
<div class="container-fluid p-0" style="height: 100vh;">
    <div class="row no-gutters" style="height: 100vh;">
        <!-- Kolom kiri -->
        <div class="col-md-6 p-0">
            <div style="background-image: url('{{ asset('images/telkom-bg.png') }}');
                        background-size: cover;
                        background-position: center;
                        height: 100%;">
            </div>
        </div>

        <!-- Kolom kanan -->
        <div class="col-md-6 d-flex justify-content-center align-items-center bg-white p-0">
            <div class="p0 w-100">
                <!-- Logo -->
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('images/logo-telkom.png') }}" alt="Logo 1" class="mx-2" style="height: 40px;">
                    <img src="{{ asset('images/logo-hireme-new.png') }}" alt="Logo 2" class="mx-2" style="height: 40px;">
                </div>

                <div class="p-5 w-100">
                    <h3 class="mb-5 fw-bold text-center">Register</h3>


                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        <!-- Row: Nama dan Email -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" placeholder="Masukkan nama" required>

                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>

                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username') }}" placeholder="Masukkan username" required>

                            @error('username')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- Row: Password dan Konfirmasi Password -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Masukkan password" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <!-- Tombol Register (buka modal) -->
                        <div class="d-grid">
                            <button type="button" class="btn btn-login btn-block py-2" data-bs-toggle="modal" data-bs-target="#agreementModal">
                                Register
                            </button>
                        </div>

                        <!-- Link ke login -->
                        <div class="text-center mt-3">
                            <span class="text-muted">Sudah punya akun?</span>
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Persetujuan -->
<div class="modal fade" id="agreementModal" tabindex="-1" aria-labelledby="agreementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="font-size: 0.9rem;">
        <div class="modal-header py-2 px-8">
          <h5 class="modal-title fw-bold" id="agreementModalLabel" style="font-size: 1.1rem;">Persetujuan Penggunaan Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body px-10" style="max-height: 65vh; overflow-y: auto;">
          <p>Kami menghargai privasi dan keamanan data pribadi Anda. Untuk memberikan pengalaman terbaik dalam mencari pekerjaan, HireMe memerlukan persetujuan Anda dalam mengumpulkan, menyimpan, dan memproses data pribadi
              yang Anda berikan saat registrasi. Data ini akan digunakan untuk membantu Anda terhubung dengan peluang kerja yang sesuai serta memfasilitasi interaksi dengan perusahaan mitra.
              Dengan mendaftar di HireMe, saya menyetujui hal-hal berikut:</p>
          <ul class="ps-3">
            <li><strong>Pengumpulan Data</strong> – Data pribadi yang saya berikan, termasuk informasi profil, CV, dan riwayat lamaran, akan dikumpulkan dan disimpan oleh HireMe.</li>
            <li><strong>Pemrosesan Data</strong> – Data saya dapat digunakan untuk memproses lamaran kerja, menyaring kandidat, serta menyesuaikan rekomendasi pekerjaan sesuai dengan keahlian dan minat saya.</li>
            <li><strong>Pembagian Data dengan Mitra</strong> – Data saya dapat dibagikan kepada perusahaan mitra yang sedang mencari kandidat sesuai dengan kualifikasi yang saya miliki.</li>
            <li><strong>Hak Pengelolaan Data</strong> – Saya berhak memperbarui, mengubah, atau menarik persetujuan penggunaan data pribadi saya kapan saja melalui pengaturan akun.</li>
            <li><strong>Kesediaan Dihubungi</strong> – Saya menyetujui bahwa HireMe dan perusahaan mitra dapat menghubungi saya melalui email atau telepon untuk memberikan informasi.</li>
          </ul>
          <p>Dengan melanjutkan proses registrasi, saya menyatakan telah membaca, memahami, dan menyetujui kebijakan pengumpulan dan pemrosesan data pribadi di HireMe.</p>

          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="agreementCheckbox">
            <label class="form-check-label" for="agreementCheckbox">
              Saya menyetujui persyaratan di atas
            </label>
          </div>
        </div>
        <div class="modal-footer py-2 px-8">
          <button type="button" class="btn btn-login" id="submitRegister" style="font-size: 0.9rem;">Kirim</button>
        </div>
      </div>
    </div>
  </div>


<!-- Script -->
<script>
    document.getElementById('submitRegister').addEventListener('click', function () {
        const checkbox = document.getElementById('agreementCheckbox');
        if (checkbox.checked) {
            document.getElementById('registerForm').submit();
        } else {
            alert('Anda harus menyetujui persyaratan terlebih dahulu.');
        }
    });
</script>
@endsection
