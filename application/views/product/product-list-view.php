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
                <div class="col-lg-12 mb-3">
                    <button class="btn btn-success btn-tambah-data">Tambah</button>
                </div>
                <div class="col-lg-12 table-responsive">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data->result_array() as $rrData) {
                                ?>
                                <tr>
                                    <td width="90" class="text-center">
                                        <a class="btn" href="#" onclick="editProduct(<?= $rrData['pcode']; ?>)">
                                            <i class="fa fa-pencil-alt text-success" title="Edit"></i>
                                        </a>
                                        <a class="btn" href="#" onclick="deleteProduct(<?= $rrData['pcode']; ?>)">
                                            <i class="fa fa-trash-alt text-danger" title="Hapus"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?= $rrData['name']; ?>
                                    </td>
                                    <td>
                                        <?= $rrData['price']; ?>
                                    </td>
                                    <td>
                                        <?= $rrData['stock']; ?>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php $this->load->view('inc/file-footer'); ?>
    </main>
    <div class="modal fade" id="tambahForm" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formData" enctype="multipart/form-data">
                        <input type="hidden" name="keyId">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-tag"></i></span>
                                    <input type="text" class="form-control" name="nama_produk">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Harga Produk</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa fa-dollar-sign"></i></span>
                                    <input type="text" class="form-control" name="harga_produk"
                                        onkeypress="return onlyNumberKey(event)">
                                </div>
                            </div>
                            <div class="col-lg-2 mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Stock Produk</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-store"></i></span>
                                    <input type="text" class="form-control" name="stock_produk"
                                        onkeypress="return onlyNumberKey(event)">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btn-simpan-produk">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('inc/file-js'); ?>
    <script src="<?= base_url(); ?>assets/js/product-jquery.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
        $('.btn-tambah-data').on('click', () => {
            $('#tambahForm').modal('show');
            $('#formData')[0].reset();
        })
    </script>
</body>

</html>