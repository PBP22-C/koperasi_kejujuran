<x-layout>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="/images/login_illustration.webp" class="img-fluid" alt="Login">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <h1 class="mb-4">Koperasi Kejujuran</h1>
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
                    <form method="POST" action="/login">
                        @csrf
                        <!-- ID input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="id_siswa" name="id_siswa" class="form-control form-control-lg"
                                value="{{ old('id_siswa') }}" placeholder="Masukkan ID Siswa" required />
                            <label class="form-label" for="id_siswa">ID Siswa</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                placeholder="Enter password" required />
                            <label class="form-label" for="password">Password</label>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Belum memiliki akun? <a href="/register"
                                    class="link-danger">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
