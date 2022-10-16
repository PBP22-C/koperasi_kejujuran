<x-layout>
    <div class="container my-5">
        <h2 class="mb-4">
            Histori Transaksi Withdraw
        </h2>
        <div id="transaksiWithdraw" class="d-flex flex-wrap gap-3"></div>
    </div>
    {{-- <div class="container my-5">
        <h2 class="mb-4">
            Histori Transaksi Beli
        </h2>
        <div id="transaksiBeli" class="d-flex flex-wrap gap-3">
            <div class="table-responsive">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Waktu Beli</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Harga Total</th>    
                            <th scope="col" colspan="2">Action</th>    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksiBeli as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->waktu_transaksi }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>{{ $item->kuantitas }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->harga_total }}</td>
                                <td><button onclick="editTransaksiBeli({{$item->id_beli}})">Edit</button></td>
                                <td><button onclick="deleteTransaksiBeli({{$item->id_beli}})">Delete</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="container my-5">
        <h2 class="mb-4">
            Histori Barang Terjual
        </h2>
        <div id="barangTerjual" class="d-flex flex-wrap gap-3">
            <div class="table-responsive">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Waktu Terjual</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Harga Total</th>      
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangTerjual as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->waktu_transaksi }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>{{ $item->kuantitas }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->harga_total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
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
            <div class="table-responsive">
                <table class="table table-light">
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
    // function editTransaksiWithdraw(id_transaksi) {
        
    // }
</script>