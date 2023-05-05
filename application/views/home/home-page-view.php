<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping-Chart</title>
    <?php $this->load->view('inc/file-css'); ?>
</head>

<body>
    <?php $this->load->view('inc/file-navbar'); ?>
    <main>
        <div class="container p-5 dash-content">
            <div class="row text-center">
                <div class="col-sm-4 mb-2">
                    <div class="card">
                        <div class="card-header text-white bg-success text-center">
                            Penjualan
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $order;?></h5>
                        </div>
                        <div class="card-footer bg-transparent border-success">
                            <a class="class-href" href="<?= base_url();?>order/list">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="card">
                        <div class="card-header text-white bg-info text-center">
                            Produk
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $product;?></h5>
                        </div>
                        <div class="card-footer bg-transparent border-success">
                            <a class="class-href" href="<?= base_url();?>product">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="card">
                        <div class="card-header text-white bg-warning text-center">
                            Customer
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $customer;?></h5>
                        </div>
                        <div class="card-footer bg-transparent border-success">
                            <a class="class-href" href="<?= base_url();?>customer">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('inc/file-footer'); ?>
    </main>
    <?php $this->load->view('inc/file-js'); ?>

</body>

</html>