<x-layout>
    <div class="container my-5">
        <h2 class="mb-4">
            Histori Transaksi Withdraw
        </h2>
        <div id="transaksiWithdraw" class="d-flex flex-wrap gap-3">
            <div class="table-responsive">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jumlah Penarikan</th>
                            <th scope="col">Waktu Penarikan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksiWithdraw as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->jumlah_withdraw }}</td>
                                <td>{{ $item->waktu_transaksi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-layout>
