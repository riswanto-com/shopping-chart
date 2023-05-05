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
            <div class="row">
                <div class="col-lg-12 mt-2 text-center" id="spiner-page">
                    <div class="spinner-border m-5" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="row hidden" id="content-page">
                <div class="col-lg-12 text-left">
                    <h3>Detail Pembelian</h3>
                </div>
                <div class="col-lg-8 mb-3 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <form id="formHeader">
                                <table class="table text-left">
                                    <tbody>
                                        <tr>
                                            <th width="150"> No Order</th>
                                            <td width="5">:</td>
                                            <td id="no-order">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Tanggal Order</th>
                                            <td>:</td>
                                            <td id="date-order">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Nama Customer</th>
                                            <td>:</td>
                                            <td id="nama-customer">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Kode Promo</th>
                                            <td>:</td>
                                            <td id="kode-promo">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Amount Discount</th>
                                            <td>:</td>
                                            <td id="discount">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Nett</th>
                                            <td>:</td>
                                            <td id="nett">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> PPN</th>
                                            <td>:</td>
                                            <td id="ppn">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Total</th>
                                            <td>:</td>
                                            <td id="total-order">

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-lg-12 table-responsive">
                            <table class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="detailList">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-2 offset-lg-10 mb-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('inc/file-footer'); ?>

    </main>


    <?php $this->load->view('inc/file-js'); ?>
    <script src="<?= base_url(); ?>assets/js/order-jquery.js"></script>
    <script>
        $(document).ready(function () {
            listOrder('<?= $keyId; ?>');
        });
    </script>
</body>

</html>