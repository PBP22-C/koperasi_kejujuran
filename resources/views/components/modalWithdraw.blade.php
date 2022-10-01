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
                <h4  id="saldo" class="text-white"></h3>
            </div>
            <form id="formWithdraw" class="bg-dark text-light" enctype="multipart/form-data">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="withdraw" class="form-label">Jumlah Uang <span class="text-danger">*</span></label>
                        <input name="withdraw" type="number" class="form-control" id="withdraw" min="0"
                            required>
                    </div>
                    <div id="errorField" class="text-danger"></div>
                </div>
                <div class="modal-footer border-top-0">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal" type="button">
                        Kembali
                    </button>
                    <button id="submitWitdraw" type="submit" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).onload(function() {
        getSaldo();
    });
    function getSaldo() {
        $.ajax({
            type: "GET",
            url: `{{ url('/saldo') }}`,
            dataType: 'json',
            success: function(res) {
                const saldo = res.data;
                $('#saldo').html(saldo);
            }
        });
    }
    
    $("#formWithdraw").on('submit', function(e) {
        e.preventDefault();
        $('#submitButton').html('Loading...');
        $('#submitButton').attr('disabled', true);
        const form = new FormData(this);
        form.append('withdraw', $('#withdraw').val());
        const url = '/withdraw';
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
                console.log(res);
                $('#modalWithdraw').modal('hide');
                // resetModal();
            }
        });
    });
</script>