<!-- Modal -->
<div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="tambahBarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBarangLabel">Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/barang/store" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang<span
                                class="text-danger">*</span></label>
                        <input name="nama_barang" type="text" class="form-control" id="nama_barang" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select name="id_kategori" class="form-select" aria-label="pilih kategori" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            {{ $slot }}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Barang</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Harga <span class="text-danger">*</span></label>
                        <input name="harga" type="number" class="form-control" id="nama_barang" min="0"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Stock <span class="text-danger">*</span></label>
                        <input name="stok" type="number" class="form-control" id="nama_barang" min="1"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto Barang</label>
                        <input class="form-control" type="file" id="formFile" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal" type="button">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
