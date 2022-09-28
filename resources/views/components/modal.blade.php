<!-- Modal -->
<div class="modal fade" id="modalBarang" tabindex="-1" aria-labelledby="modalBarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-light border-bottom-0" style="background: #1B1A1D;">
                <h5 id="modalTitle" class="modal-title" id="modalBarangLabel"></h5>
                <button type="button" class="bg-light btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formBarang" class="bg-dark text-light" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_barang" id="id_barang"> <br />
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_barang" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select id='id_kategori' name="id_kategori" class="form-select" aria-label="pilih kategori"
                            required>
                            <option value="" disabled>Pilih Kategori</option>
                            {{ $slot }}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Barang</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                        <input name="harga" type="number" class="form-control" id="harga" min="0"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stock <span class="text-danger">*</span></label>
                        <input name="stok" type="number" class="form-control" id="stok" min="1"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto Barang</label>
                        <div class="image">
                            <img id="foto" src="" alt="" class="img-thumbnail"
                                style="height:200px;">
                        </div>
                        <input class="form-control" type="file" id="formFile" name="image" accept="image/*">
                    </div>
                    <div id="errorField" class="text-danger"></div>
                </div>
                <div class="modal-footer border-top-0">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal" type="button">
                        Kembali
                    </button>
                    <button id="submitButton" type="submit" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div>
