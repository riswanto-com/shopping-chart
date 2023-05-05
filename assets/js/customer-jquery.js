$(".btn-simpan-customer").on('click',()=>{
    if ($('[name="nama_customer"]').val().trim() == '') {
        warning('Nama Customer Masih Kosong');

    }else if($('[name="alamat_customer"]').val().trim() == ''){
        warning('Alamat Customer Masih Kosong');
    }  else {
        if ($('[name="keyId"]').val().trim() == '') {
            var url = urlBase + 'customer/action/add';
        } else {
            var url = urlBase + 'customer/action/update/' + $('[name="keyId"]').val().trim();
        }
        // success(url);
        $('.btn-simpan-customer').text('procesing..');
        $('.btn-simpan-customer').attr('disabled', true);
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
                            location.replace(urlBase + "customer");
                        }, 1000);
                    });
                } else {
                    errors(data.data.msg);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                errors('Sistem Bermasalah');
                $('.btn-simpan-customer').text('Simpan');
                $('.btn-simpan-customer').attr('disabled', false);
            }
        });
    }
});
function editProduct(id) {
    $('.modal-title').text('Form Edit Data ');
    $('#formData')[0].reset();

    $.ajax({
        url: urlBase + 'customer/action/edit/' + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if (data.type == 0) {
                $('[name="nama_customer"]').val(data.data.name);
                $('[name="alamat_customer"]').val(data.data.address);
                $('[name="keyId"]').val(data.data.keyId);
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
                url: urlBase+'customer/action/delete/' + id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    if (data.type == 0) {
                        success(data.msg);
                        $(function () {
                            setTimeout(function () {
                                location.replace(urlBase + "customer");
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