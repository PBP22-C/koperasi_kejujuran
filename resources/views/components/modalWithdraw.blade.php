<!-- Modal -->
<div class="modal fade" id="modalWithdraw" tabindex="-1" aria-labelledby="modalBarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-light border-bottom-0" style="background: #1B1A1D;">
                <h5 id="modalWithdrawTitle" class="modal-title" id="modalBarangLabel"></h5>
                <button type="button" class="bg-light btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="box-price">
                <i class="fa-solid fa-cash-register fs-1 mb-3"></i>
                <h5 class="text-white">Total Saldo</h5>
                <h4 id="saldoModal" class="text-white">
                    </h3>
            </div>
            <form id="formWithdraw" class="bg-dark text-light" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <input type="hidden" name="id_siswa" id="id_siswa" value="{{ Auth::user()->id_siswa }}">
                        <input type="hidden" name="id_transaksi" id="id_transaksi" value="0">
                        <input type="hidden" name="withdraw_awal" id="withdraw_awal" value="0">
                        <label for="withdraw" class="form-label">Jumlah Uang <span class="text-danger">*</span></label>
                        <input name="withdraw" type="number" class="form-control" id="withdraw" min="0"
                            required>
                    </div>
                    <div id="errorModalWithdraw" class="text-danger"></div>
                </div>
                <div class="modal-footer border-top-0">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal" type="button">
                        Kembali
                    </button>
                    <button id="submitWithdraw" type="submit" value="" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#formWithdraw").bind('submit', function(e) {
        $('#submitButton').html('Loading...');
        $('#submitButton').attr('disabled', true);
        const form = new FormData(this);
        form.append('withdraw', $('#withdraw').val());
        const url = `/dashboard/withdraw${$('#submitWithdraw').val()}`;
        $.ajax({
            type: "POST",
            url: url,
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            cache: false,
            data: form,
            dataType: 'json',
            success: function(res) {
                $('#saldoSiswa').html(`Saldo: ${res.data.saldoSiswa}`);
                $('#saldoModal').html(res.data.saldoAkhir);
                $('#saldo').html(res.data.saldoAkhir);
                $('#modalWithdraw').modal('hide');
                showToast(res.message);

                // Tampilkan ulang data bila mengedit transaksi
                loadData()
            },
            error: function(err) {
                console.log(err);
                $('#errorModalWithdraw').html(err.responseJSON.message);
            }
        });
        e.preventDefault();
        return false
    });
</script>
