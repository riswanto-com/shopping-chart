$(".btn-simpan-produk").on('click',()=>{
    if ($('[name="nama_produk"]').val().trim() == '') {
        warning('Nama Produk Masih Kosong');

    }else if($('[name="harga_produk"]').val().trim() == ''){
        warning('Harga Produk Masih Kosong');
    } else if($('[name="stock_produk"]').val().trim() == ''){
        warning('Stock Produk Masih Kosong');
    } else {
        if ($('[name="keyId"]').val().trim() == '') {
            var url = urlBase + 'product/action-product/add';
        } else {
            var url = urlBase + 'product/action-product/update/' + $('[name="keyId"]').val().trim();
        }
        // success(url);
        $('.btn-simpan-produk').text('procesing..');
        $('.btn-simpan-produk').attr('disabled', true);
        var formData = new FormData($('#formData')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.data.type == 0) {
                    success(data.data.msg);
                    $(function () {
                        setTimeout(function () {
                            location.replace(urlBase + "product");
                        }, 1000);
                    });
                } else {
                    errors(data.data.msg);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                errors('Sistem Bermasalah');
                $('.btn-simpan-produk').text('Simpan');
                $('.btn-simpan-produk').attr('disabled', false);
            }
        });
    }
});
function editProduct(id) {
    $('.modal-title').text('Form Edit Data ');
    $('#formData')[0].reset();

    $.ajax({
        url: urlBase + 'product/action-product/edit/' + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if (data.type == 0) {
                $('[name="nama_produk"]').val(data.data.name);
                $('[name="harga_produk"]').val(data.data.price);
                $('[name="stock_produk"]').val(data.data.stock);
                $('[name="keyId"]').val(data.data.pcode);
                $('#tambahForm').modal('show');
            } else {
                errors(data.msg)
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            errors('Sistem Bermasalah');
        }
    });
}
function deleteProduct(id) {
    Swal.fire({
        text: 'Yakin Ingin Hapus?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlBase+'product/action-product/delete/' + id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    if (data.type == 0) {
                        success(data.msg);
                        $(function () {
                            setTimeout(function () {
                                location.replace(urlBase + "product");
                            }, 1000);
                        });
                    } else {
                        errors(data.msg);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    errors('Sistem Error')
                }
            });
        }
    })
}
// for promo 
$(".btn-simpan-promo").on('click',()=>{
    if($('[name="nama_promo"]').val().trim() == ''){
        warning('Nama Promo Masih Kosong');
    } else if($('[name="nominal_promo"]').val().trim() == ''){
        warning('Nonimal Masih Kosong');
    } else {
        if ($('[name="keyId"]').val().trim() == '') {
            var url = urlBase + 'promo/action/add';
        } else {
            var url = urlBase + 'promo/action/update/' + $('[name="keyId"]').val().trim();
        }
        // success(url);
        $('.btn-simpan-promo').text('procesing..');
        $('.btn-simpan-promo').attr('disabled', true);
        var formData = new FormData($('#formData')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.data.type == 0) {
                    success(data.data.msg);
                    $(function () {
                        setTimeout(function () {
                            location.replace(urlBase + "promo");
                        }, 1000);
                    });
                } else {
                    errors(data.data.msg);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                errors('Sistem Bermasalah');
                $('.btn-simpan-promo').text('Simpan');
                $('.btn-simpan-promo').attr('disabled', false);
            }
        });
    }
});
function editPromo(id) {
    $('.modal-title').text('Form Edit Data ');
    $('#formData')[0].reset();

    $.ajax({
        url: urlBase + 'promo/action/edit/' + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if (data.type == 0) {         
                $('[name="nama_promo"]').val(data.data.namePromo);
                $('[name="nominal_promo"]').val(data.data.nomPromo);
                $('[name="keyId"]').val(data.data.keyId);
                $('#tambahFormSelect2').modal('show');
            } else {
                errors(data.msg)
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            errors('Sistem Bermasalah');
        }
    });
}
function deletePromo(id) {
    Swal.fire({
        text: 'Yakin Ingin Hapus?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlBase+'promo/action/delete/' + id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    if (data.type == 0) {
                        success(data.msg);
                        $(function () {
                            setTimeout(function () {
                                location.replace(urlBase + "Promo");
                            }, 1000);
                        });
                    } else {
                        errors(data.msg);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    errors('Sistem Error')
                }
            });
        }
    })
}