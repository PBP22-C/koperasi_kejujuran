<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">

                <div class="container d-flex flex-column align-items-center justify-content-center gap-2">
                    <img src="https://github.com/mdo.png" alt="hugenerd" width="90" height="90"
                        class="rounded-circle">
                    <h3 class="">Admin</h3>
                </div>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                    id="menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link align-middle px-0">
                            <i class="fa-solid fa-house-user fs-4 me-1"></i><span
                                class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/menu-penjual" class="nav-link px-0 align-middle">
                            <i class="fa-solid fa-sack-xmark fs-4 me-1"></i> <span class="ms-1 d-none d-sm-inline">My
                                Items</span> </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fa-solid fa-cart-shopping me-1 fs-4"></i><span
                                class="ms-1 d-none d-sm-inline">Orders</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" class="nav-link px-0 align-middle ">
                            <i class="fa-solid fa-tag fs-4 me-1"></i> <span class="ms-1 d-none d-sm-inline">My
                                Transactions</span></a>

                    </li>
                </ul>
                <div class="box-price">
                    <i class="fa-solid fa-cash-register fs-1 mb-3"></i>
                    <h5 class="text-white">Total Price</h5>
                    <h4 class="text-white">Rp1.000.000.000</h3>
                </div>
                <hr>


            </div>
        </div>
        <div class="col py-3">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</div>
