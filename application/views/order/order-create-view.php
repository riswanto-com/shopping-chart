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
                <div class="col-lg-12 text-left">
                    <h3>Form Pembelian</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-3 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <form id="formHeader">
                                <table class="table text-left">
                                    <tbody>
                                        <tr>
                                            <th width="150"> No Order</th>
                                            <td width="5">:</td>
                                            <td>
                                                <?= $data['data']['order_id']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Tanggal Order</th>
                                            <td>:</td>
                                            <td>
                                                <?= $data['data']['order_date']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Nama Customer</th>
                                            <td>:</td>
                                            <td>
                                                <select class="form-select single-select-field2"
                                                    aria-label="Default select example" name="nama_customer">
                                                    <option value="">Pilih Produk</option>
                                                    <?php
                                                    foreach ($customer['data']->result_array() as $rrCustomer) {
                                                        echo '<option value="' . $rrCustomer['name'] . '">' . $rrCustomer['name'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Kode Promo</th>
                                            <td>:</td>
                                            <td>
                                                <div class="mb-0">
                                                    <input type="text" class="form-control" name="code_promo">
                                                </div>

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
                        <div class="col-lg-12 mb-3">
                            <button class="btn btn-success btn-tambah-data"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listProduk['data']->result_array() as $rrList) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a class="btn" href="#"
                                                    onclick="deleteList(<?= $rrList['order_detail_id']; ?>)">
                                                    <i class="fa fa-trash-alt text-danger" title="Hapus"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <?= $rrList['product_name']; ?>
                                            </td>
                                            <td width="150">
                                                <div class="input-group">
                                                    <span class="input-group-text bg-danger" id="cursol-list"><i
                                                            class="fa fa-minus" id="cursol-list"
                                                            onclick="kurang(<?= $rrList['order_detail_id']; ?>,<?= $rrList['qty']; ?>)"></i></span>
                                                    <input type="text" readonly class="form-control" name="qtyProduct"
                                                        onkeypress="return onlyNumberKey(event)"
                                                        value="<?= $rrList['qty']; ?>">
                                                    <span class="input-group-text bg-success" id="cursol-list"><i
                                                            class="fa fa-plus-circle"
                                                            onclick="tambah(<?= $rrList['order_detail_id']; ?>,<?= $rrList['qty']; ?>)"></i></span>
                                                </div>
                                            </td>
                                            <td>Rp
                                                <?= number_format($rrList['price'], 0, ',', '.'); ?>
                                            </td>
                                            <td>Rp
                                                <?= number_format($rrList['subtotal'], 0, ',', '.'); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-2 offset-lg-10 mb-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success btn-chekout-order"><i class="fa fa-shopping-cart"></i>
                                    CheckOut</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('inc/file-footer'); ?>
        <div id="tambahFormSelect2" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Produk ke List Pembelian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formData" enctype="multipart/form-data">
                            <input type="hidden" name="keyId" value="<?= $keyData; ?>">
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fa fa-tag"></i></span>
                                        <select class="form-select single-select-field"
                                            aria-label="Default select example" name="nama_produk">
                                            <option value="">Pilih Produk</option>
                                            <?php
                                            foreach ($product['data']->result_array() as $rrProduct) {
                                                echo '<option value="' . $rrProduct['pcode'] . '">' . $rrProduct['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 mb-2">
                                    <label for="exampleFormControlInput1" class="form-label">Qty</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fa fa-plus-circle"></i></span>
                                        <input type="number" class="form-control" name="qty"
                                            onkeypress="return onlyNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success btn-simpan-detail">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php $this->load->view('inc/file-js'); ?>
    <script src="<?= base_url(); ?>assets/js/order-jquery.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
        $('.btn-tambah-data').on('click', () => {
            $('#tambahFormSelect2').modal('show');
            $('#formData')[0].reset();
        })
    </script>
</body>

</html>