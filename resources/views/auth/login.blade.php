<x-layout>
    <form method="POST" action="/login">
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
            <label for="id_siswa">ID Siswa</label>
            <input type="text" class="form-control" id="id_siswa" name="id_siswa" value="{{ old('id_siswa') }}" required
                autocomplete="id_siswa">
        </div>
        <div class="form-group mb-2">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required
                autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</x-layout>
