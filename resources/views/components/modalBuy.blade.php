<!-- Modal -->
<div class="modal fade" id="modalBuy" tabindex="-1" aria-labelledby="modalBarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-light border-bottom-0" style="background: #1B1A1D;">
                <h5 id="modalBuyTitle" class="modal-title" id="modalBarangLabel"></h5>
                <button type="button" class="bg-light btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="box-price">
                <img src="" id="modalFotoBarang" height="100" width="100" style="object-fit:cover";>
                <h5 id="modalNamaBarang" class="p-0 m-0 text-white fw-bold"></h5>
                <p id="modalStokBarang" class="p-0 m-0 text-white"></p>
                <h4  id="modalHargaBarang" class="p-0 m-0 text-white"></h4>
            </div>
            <form id="formBeli" class="bg-dark text-light">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <input type="hidden" name="modalIdBarang" id="modalIdBarang" />
                        <label for="kuantitas" class="form-label">Jumlah Barang <span class="text-danger">*</span></label>
                        <input name="kuantitas" type="number" class="form-control" id="kuantitas" min="1"
                            required />
                        <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                        <input name="harga" type="number" class="form-control" id="harga" min="0"
                            required />
                    </div>
                    <div id="errorModalBuy" class="text-danger"></div>
                </div>
                <div class="modal-footer border-top-0">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal" type="button">
                        Kembali
                    </button>
                    <button id="submitBuyButton" type="submit" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
     $('#formBeli').on('submit', function(e) {
        e.preventDefault();
        const hargaTotal = $('#harga').val();
        const kuantitas = $('#kuantitas').val();
        const idBarang = $('#modalIdBarang').val();
        console.log(idBarang);
        const url = `{{ url('/dashboard/buy') }}`;
        $.ajax({
            type: "POST",
            url: url,
            data: {
                harga_total: hargaTotal,
                kuantitas,
                id_barang: idBarang,
            },
            dataType: 'json',
            success: function(res) {
                loadData();
                showListBarang();
                getSaldo();
                $('#modalBuy').modal('hide');
            },
            error: function(err) {
                console.log(err);
                $('#errorModalBuy').html(err.responseJSON.message);
            }
        });
    });
</script>
