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
                    <h3>List Penjualan</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-striped" id="example" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No Order</th>
                                        <th>Date Order</th>
                                        <th>customer_name</th>
                                        <th>promo_code</th>
                                        <th>amount_discount</th>
                                        <th>net</th>
                                        <th>ppn</th>
                                        <th>total</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($data->result_array() as $rrData){
                                    
                                    ?>
                                <tr>
                                        <td>#</td>
                                        <td><?= $rrData['order_id'];?></td>
                                        <td><?= $rrData['order_date'];?></td>
                                        <td><?= $rrData['customer_name'];?></td>
                                        <td><?= $rrData['promo_code'];?></td>
                                        <td><?= $rrData['amount_discount'];?></td>
                                        <td><?= $rrData['net'];?></td>
                                        <td><?= $rrData['ppn'];?></td>
                                        <td><?= $rrData['total'];?></td> 
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
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
            $('#example').DataTable();
        });
        $('.btn-tambah-data').on('click', () => {
            $('#tambahFormSelect2').modal('show');
            $('#formData')[0].reset();
        })
    </script>
</body>

</html>