<x-layout>
    {{-- form bootstrap --}}
    <form method="POST" action="/register">
        {{-- show all errors --}}
        @if ($errors->any() || session('errorId'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <li>
                        {{ session('errorId') }}
                    </li>
                </ul>
            </div>
        @endif

        @csrf
        <div class="form-group mb-2">
            <label for="nama_siswa">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa') }}"
                required autocomplete="nama_siswa" autofocus>
        </div>
        <div class="form-group mb-2">
            <label for="id_siswa">ID Siswa</label>
            <input type="text" class="form-control" id="id_siswa" name="id_siswa" value="{{ old('id_siswa') }}"
                required autocomplete="id_siswa">
        </div>
        <div class="form-group mb-2">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required
                autocomplete="new-password">
        </div>
        <div class="form-group mb-2">
            <label for="password-confirm">Confirm Password</label>
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required
                autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</x-layout>
