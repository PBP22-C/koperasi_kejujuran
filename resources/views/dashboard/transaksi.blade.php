<x-layout>
    <div class="container my-5">
        <h2 class="mb-4">
            Histori Transaksi Withdraw
        </h2>
        <div id="transaksiWithdraw" class="gap-3"></div>
    </div>
    <div class="container my-5">
        <h2 class="mb-4">
            Histori Transaksi Beli
        </h2>
        <div id="transaksiBeli" class="gap-3"></div>
    </div>
    <div class="container my-5">
        <h2 class="mb-4">
            Histori Barang Terjual
        </h2>
        <div id="barangTerjual" class="gap-3"></div>
    </div>
</x-layout>

<script>
    let transaksiWithdraw = []
    let transaksiBeli = []
    let barangTerjual = []

    $(document).ready(function() {
        loadData()
    })

    function loadData() {
        $.ajax({
            type: "GET",
            url: "{{ url('dashboard/transaksi/getData') }}",
            dataType: 'json',
            success: function(res) {
                transaksiWithdraw = res.transaksiWithdraw;
                transaksiBeli = res.transaksiBeli;
                barangTerjual = res.barangTerjual;
                showData();
            }
        })
    }

    function showData() {
        // Load data transaksi withdraw
        let elementTransaksiWithdraw = `
            <div class="d-flex table-responsive">
                <table class="table table-dark text-white">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jumlah Penarikan</th>
                            <th scope="col">Waktu Penarikan</th>
                            <th scope="col" colspan="2">Action</th>    
                        </tr>
                    </thead>
                    <tbody>
        `
        for (let i = 0; i < transaksiWithdraw.length; i++) {
            let item = transaksiWithdraw[i]
            elementTransaksiWithdraw += `
                    <tr>
                        <th scope="row">${i+1}</th>
                        <td>${item.jumlah_withdraw}</td>
                        <td>${item.waktu_transaksi}</td>
                        <td><button onclick="editTransaksiWithdraw(${item.id_withdraw}, ${item.jumlah_withdraw})">Edit</button></td>
                        <td><button onclick="deleteTransaksiWithdraw(${item.id_withdraw})">Delete</button></td>
                    </tr>
            `
        }
                        
        elementTransaksiWithdraw += `
                    </tbody>
                </table>
            </div>
        `
        $('#transaksiWithdraw').html(elementTransaksiWithdraw) 

        // Load data transaksi beli
        elementTransaksiBeli = `
            <div class="table-responsive">
                <table class="table table-dark text-white">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Waktu Beli</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Harga Total</th>
                        </tr>
                    </thead>
                    <tbody>
        `

        for (let i = 0; i < transaksiBeli.length; i++) {  
            item = transaksiBeli[i];
            elementTransaksiBeli += `
                    <tr>
                        <th scope="row">${i}</th>
                        <td>${item.nama_barang}</td>
                        <td>${item.waktu_transaksi}</td>
                        <td>${item.nama_kategori}</td>
                        <td>${item.kuantitas}</td>
                        <td>${item.harga}</td>
                        <td>${item.harga_total}</td>
                    </tr>
            `
        }
        
        elementTransaksiBeli += `
                    </tbody>
                </table>
            </div>
        `
        $('#transaksiBeli').html(elementTransaksiBeli) 

        // Load data transaksi beli
        elementBarangTerjual = `
            <div class="table-responsive">
                <table class="table table-dark text-white">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Waktu Beli</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Harga Total</th>
                        </tr>
                    </thead>
                    <tbody>
        `

        for (let i = 0; i < barangTerjual.length; i++) {  
            item = barangTerjual[i];
            elementBarangTerjual += `
                    <tr>
                        <th scope="row">${i}</th>
                        <td>${item.nama_barang}</td>
                        <td>${item.waktu_transaksi}</td>
                        <td>${item.nama_kategori}</td>
                        <td>${item.kuantitas}</td>
                        <td>${item.harga}</td>
                        <td>${item.harga_total}</td>
                    </tr>
            `
        }
        
        elementBarangTerjual += `
                    </tbody>
                </table>
            </div>
        `
        $('#barangTerjual').html(elementBarangTerjual) 
    }

    function editTransaksiWithdraw(id_withdraw, jumlah_withdraw_awal) {
        $('#id_transaksi').val(id_withdraw);
        $('#withdraw').val(jumlah_withdraw_awal);
        $('#withdraw_awal').val(jumlah_withdraw_awal);
        $('#modalWithdraw').modal('show');
        $('#modalWithdrawTitle').html('Edit Withdraw');
        $('#submitWithdraw').html('Edit');
        $('#submitWithdraw').val(`/edit`);
    }

    function deleteTransaksiWithdraw(id_transaksi) {
        $.ajax({
            type: "DELETE",
            url: `{{ url('dashboard/withdraw/delete/${id_transaksi}') }}`,
            dataType: 'json',
            success: function(res) {
                $('#saldoSiswa').html(`Saldo: ${res.data.saldoSiswa}`);
                $('#saldoModal').html(res.data.saldoAkhir);
                $('#saldo').html(res.data.saldoAkhir);
                loadData()
            },
            error: function(err) {
                console.log(err);
                $('#errorModalWithdraw').html(err.responseJSON.message);
            }
        })
    }
</script>