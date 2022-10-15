<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-2 px-sm-2 px-0 bg-dark position-fixed" style="max-width: 250px">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <div class="container d-flex flex-column align-items-center justify-content-center gap-2">
                    <img src="https://avatars.githubusercontent.com/u/114212348?s=200&v=4" alt="hugenerd" width="90"
                        height="90" class="rounded-circle">
                    <h3 class="fs-4 text-center" id="user-name"></h3>
                </div>
                <div id="saldoSiswa">Saldo: {{ Auth::user()->saldo }}</div>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                    id="menu">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link px-0 text-white d-flex align-items-center">
                            <i
                                class="icon-nav-link fa-solid fa-house-user fs-5 me-1 {{ Request::is('dashboard') ? 'active' : '' }}"></i><span
                                class="ms-1 d-none d-sm-inline {{ Request::is('dashboard') ? 'fw-bold' : '' }}">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/menu-penjual" class="nav-link px-0 text-white d-flex align-items-center">
                            <i
                                class="icon-nav-link fa-solid fa-sack-xmark fs-4 me-1 {{ Request::is('dashboard/menu-penjual') ? 'active' : '' }}"></i>
                            <span
                                class="ms-1 d-none d-sm-inline {{ Request::is('dashboard/menu-penjual') ? 'fw-bold' : '' }}">My
                                Items</span> </a>
                    </li>
                    <li>
                        <a href="/dashboard/transaksi" class="nav-link px-0 text-white d-flex align-items-center">
                            <i
                                class="icon-nav-link fa-solid fa-credit-card fs-4 me-1 {{ Request::is('dashboard/transaksi') ? 'active' : '' }}"></i>
                            <span
                                class="ms-1 d-none d-sm-inline {{ Request::is('dashboard/transaksi') ? 'fw-bold' : '' }}">My
                                Transactions</span> </a>
                    </li>
                </ul>
                <div class="box-price">
                    <i class="fa-solid fa-cash-register fs-1 mb-3"></i>
                    <h5 class="text-white">Total Saldo</h5>
                    <h4 id="saldo" class="text-white">
                        </h3>
                        <button class="btn btn-success" onclick="showWithdraw()" data-bs-toggle="modal"
                            data-bs-target="#">Withdraw</button>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <a href="/logout" class="btn btn-danger">Logout</a>
                </div>
                <hr>
            </div>
        </div>
        <div class="col py-3">
            <main class="main">
                {{ $slot }}
            </main>
        </div>
    </div>
    <x-modalWithdraw></x-modalWithdraw>
</div>

<script>
    $(document).ready(function() {
        getSaldo();
        getName();
    });

    function getSaldo() {
        $.ajax({
            type: "GET",
            url: `{{ url('/saldo') }}`,
            dataType: 'json',
            success: function(res) {
                const saldo = res.data;
                $('#saldo').html(saldo);
                $('#saldoModal').html(saldo);
            }
        });
    }

    function getName() {
        $.ajax({
            type: "GET",
            url: `{{ url('/name') }}`,
            dataType: 'json',
            success: function(res) {
                const name = res.data;
                $('#user-name').html(name);
            }
        });
    }

    function showWithdraw() {
        $('#withdraw').val('');
        $('#modalWithdraw').modal('show');
        $('#modalWithdrawTitle').html('Withdraw');
        $('#submitWitdraw').html('Tarik Uang');
    }
</script>
