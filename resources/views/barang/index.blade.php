<x-layout>
    <div class="container my-5">
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-3 mb-4">
            <h1>List Barang</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBarang">
                Tambah Barang
            </button>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            @foreach ($barang as $row)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('/images/' . $row->foto) }}" class="card-img-top" alt={{ $row->nama_barang }}
                        height="250" style="object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-0">{{ $row->nama_barang }}</h5>
                        <small class="text-secondary">{{ $row->kategori->nama_kategori }}</small>
                        <p class="card-text mt-3">{{ $row->deskripsi }}</p>
                        <div class="d-flex flex-wrap gap-3">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editBarang">
                                Edit Barang
                            </button>
                            <a href="/barang/delete/{{ $row->id_barang }}" class="btn btn-outline-danger">Hapus
                                Barang</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <x-modal_tambah_barang>
        @foreach ($kategori as $item)
            <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}
            </option>
        @endforeach
    </x-modal_tambah_barang>

    {{-- <x-modal_edit_barang>
        @foreach ($kategori as $item)
            <option value="{{ $item->id_kategori }}" {{ $item->id_kategori == $barang->id_kategori ? 'selected' : '' }}>
                {{ $item->nama_kategori }}
            </option>
        @endforeach
    </x-modal_edit_barang> --}}
</x-layout>
