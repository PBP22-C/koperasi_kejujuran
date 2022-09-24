@include('layouts.header')
<div class="card container">
    <h3 class="card-header">Tambah Barang</h3>
    @if ($errors->any())
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card-body">
        <form action="/barang/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_barang" value="{{ $barang->id_barang }}"> <br />
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang<span class="text-danger">*</span></label>
                <input value="{{ $barang->nama_barang }}" name="nama_barang" type="text" class="form-control"
                    id="nama_barang" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori<span class="text-danger">*</span></label>
                <select name="id_kategori" class="form-select" aria-label="pilih kategori" required>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id_kategori }}"
                            {{ $item->id_kategori == $barang->id_kategori ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Barang</label>
                <textarea value="{{ $barang->deskripsi }}" name="deskripsi" class="form-control" id="deskripsi" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Harga <span class="text-danger">*</span></label>
                <input value="{{ $barang->harga }}" name="harga" type="number" class="form-control" id="nama_barang"
                    min="0" required>
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Stock <span class="text-danger">*</span></label>
                <input value="{{ $barang->stok }}" name="stok" type="number" class="form-control" id="nama_barang"
                    min="1" required>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Foto Barang</label>
                <div class="image">
                    <img src="{{ asset('/images/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}"
                        class="img-thumbnail" width="200">
                </div>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="/">
                Kembali
            </a>
        </form>
    </div>
</div>

@include('layouts.footer')
