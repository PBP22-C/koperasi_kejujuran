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
                <h4 id="modalHargaBarang" class="p-0 m-0 text-white"></h4>
            </div>
            <form id="formBeli" class="bg-dark text-light">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <input type="hidden" name="modalIdBarang" id="modalIdBarang" />
                        <label class="form-label">Jumlah Barang</label>
                        <div class="d-flex align-items-center gap-1">
                            <button onclick="decrement()" type="button" class="btn btn-outline-warning ">-</button>
                            <span id="kuantitas" class="text-white fw-bold fs-5">1</span>
                            <button onclick="increment()" type="button" class="btn btn-outline-warning ">+</button>
                        </div>
                        <label for="harga" class="form-label">Harga yang harus dibayar</label>
                        <input name="harga" type="number" class="form-control" id="harga" disabled required />
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
        const kuantitas = $('#kuantitas').text();
        const idBarang = $('#modalIdBarang').val();
        console.log(idBarang, kuantitas, hargaTotal);
        const url = `{{ url('/dashboard/buy') }}`;
        $.ajax({
            type: "POST",
            url: url,
            data: {
                harga_total: hargaTotal,
                kuantitas: parseInt(kuantitas),
                id_barang: idBarang,
            },
            dataType: 'json',
            success: function(res) {
                loadData();
                showListBarang();
                getSaldo();
                $('#modalBuy').modal('hide');
                showToast(res.message);
            },
            error: function(err) {
                console.log(err);
                $('#errorModalBuy').html(err.responseJSON.message);
            }
        });
    });

    function increment() {
        let kuantitas = $('#kuantitas').text();
        let stock = $('#modalStokBarang').text();
        stock = stock.split(':')[1].trim();
        if (parseInt(kuantitas) < parseInt(stock)) {
            let harga = $('#modalHargaBarang').text();
            harga = harga.substring(2);
            kuantitas = parseInt(kuantitas) + 1;
            const hargaTotal = parseInt(harga) * parseInt(kuantitas);
            $('#harga').val(hargaTotal);
            $('#kuantitas').html(kuantitas);
        }
    }

    function decrement() {
        let kuantitas = $('#kuantitas').text();
        if (kuantitas > 1) {
            let harga = $('#modalHargaBarang').text();
            harga = harga.substring(2);
            kuantitas = parseInt(kuantitas) - 1;
            const hargaTotal = parseInt(harga) * parseInt(kuantitas);
            $('#harga').val(hargaTotal);
            $('#kuantitas').html(kuantitas);
        }
    }
</script>
