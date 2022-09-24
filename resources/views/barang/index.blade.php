@include('layouts.header')
<div class="container my-5">
    <div class="d-flex flex-wrap justify-content-center align-items-center gap-3 mb-4">
        <h1>List Barang</h1>
        <a href="/barang/create" class="btn btn-primary">Tambah Barang</a>
    </div>
    <div class="d-flex gap-3">
        @foreach ($barang as $row)
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('/images/' . $row->foto) }}" class="card-img-top" alt={{ $row->nama_barang }}
                    height="250" style="object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title mb-0">{{ $row->nama_barang }}</h5>
                    <small class="text-secondary">{{ $row->kategori->nama_kategori }}</small>
                    <p class="card-text mt-3">{{ $row->deskripsi }}</p>
                    <div>
                        <a href="/barang/edit/{{ $row->id_barang }}" class="btn btn-warning me-2">Edit Produk</a>
                        <a href="/barang/delete/{{ $row->id_barang }}" class="btn btn-outline-danger">Hapus Produk</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@include('layouts.footer')
