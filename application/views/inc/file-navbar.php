<nav class="navbar fixed-top bg-blue-color">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url();?>">Shoping-Chart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Shopping-Chart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= base_url();?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url();?>order">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url();?>order/list">Order List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url();?>product">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url();?>promo">Promo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url();?>customer">Customer</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>