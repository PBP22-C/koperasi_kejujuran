<x-layout>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <h3 class="mb-4">Pendaftaran Akun Koperasi Kejujuran</h3>
                    @if ($errors->any() || session('errorId'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                @if (session('errorId'))
                                    <li>
                                        {{ session('errorId') }}
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="/register">
                        @csrf
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="nama_siswa" name="nama_siswa" class="form-control form-control-lg"
                                value="{{ old('nama_siswa') }}" placeholder="Masukkan Nama Lengkap" required />
                            <label class="form-label" for="nama_siswa">Nama Lengkap</label>
                        </div>

                        <!-- ID input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="id_siswa" name="id_siswa" class="form-control form-control-lg"
                                value="{{ old('id_siswa') }}" placeholder="Masukkan ID Siswa" required />
                            <label class="form-label" for="id_siswa">ID Siswa</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                placeholder="Masukkan password" required />
                            <label class="form-label" for="password">Password</label>
                        </div>

                        <!-- Password Confirmation input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control form-control-lg" placeholder="Konfirmasi password" required />
                            <label class="form-label" for="password">Konfirmasi Password</label>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Sudah punya akun? <a href="/login"
                                    class="link-danger">Login</a></p>
                        </div>
                    </form>
                </div>
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="/images/registration_illustration.png" class="img-fluid" alt="Register">
                </div>
            </div>
        </div>
    </section>
</x-layout>
