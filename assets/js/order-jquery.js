$(".btn-simpan-detail").on('click', () => {
    if ($('[name="nama_produk"]').val().trim() == '') {
        warning('Nama Produk Masih Kosong');
    } else if ($('[name="qty"]').val().trim() == '') {
        warning('Jumlah Produk Masih Kosong');
    } else {
        var url = urlBase + 'order/action-detail/add';

        // success(url);
        $('.btn-simpan-detail').text('procesing..');
        $('.btn-simpan-detail').attr('disabled', true);
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
                            location.replace(urlBase + "order/create/" + $('[name="keyId"]').val());
                        }, 1000);
                    });
                } else {
                    errors(data.data.msg);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                errors('Sistem Bermasalah');
                $('.btn-simpan-detail').text('Simpan');
                $('.btn-simpan-detail').attr('disabled', false);
            }
        });
    }
});
$(".btn-chekout-order").on('click', () => {
    Swal.fire({
        text: 'Yakin Ingin CheckOut?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
    }).then((result) => {
        if (result.isConfirmed) {
            checkout();
        }
    })

});
function checkout() {
    if ($('[name="nama_customer"]').val().trim() == '') {
        warning('Nama Customer Masih Kosong');
    } else {
        var url = urlBase + 'order/action/update';
        $('.btn-chekout-order').attr('disabled', true);
        const dataParams = {
            keyId: $('[name="keyId"]').val(),
            customer: $('[name="nama_customer"]').val(),
            promo: $('[name="code_promo"]').val()
        }
        $.ajax({
            url: url,
            type: "POST",
            data: JSON.stringify(dataParams),
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.type == 0) {
                    success(data.msg);
                    $(function () {
                        setTimeout(function () {
                            location.replace(urlBase + "order/check-out/" + $('[name="keyId"]').val());
                        }, 1000);
                    });
                } else {
                    errors(data.msg);
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                errors('Sistem Bermasalah');
                $('.btn-chekout-order').attr('disabled', false);
            }
        });
    }
}
function deleteList(id) {
    Swal.fire({
        text: 'Yakin Ingin Hapus?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteDataList(id)
        }
    })
}
function deleteDataList(id) {
    $.ajax({
        url: urlBase + 'order/action-detail/delete/' + id,
        type: "POST",
        dataType: "JSON",
        success: function (data) {
            if (data.type == 0) {
                success(data.msg);
                $(function () {
                    setTimeout(function () {
                        location.replace(urlBase + "order/create/" + $('[name="keyId"]').val());
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
function tambah(id, qty) {
    $("#cursol-list").attr('disabled', true);
    const dataParams = {
        keyId: id,
        keyData: qty
    }
    $.ajax({
        url: urlBase + 'order/action-detail/tambah/' + id,
        type: "POST",
        data: JSON.stringify(dataParams),
        dataType: "JSON",
        success: function (data) {
            if (data.type == 0) {
                success(data.msg);
                $(function () {
                    setTimeout(function () {
                        location.replace(urlBase + "order/create/" + $('[name="keyId"]').val());
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
function kurang(id, qty) {
    if (qty == 1) {
        deleteDataList(id)
    } else {
        $("#cursol-list").attr('disabled', true);
        const dataParams = {
            keyId: id,
            keyData: qty
        }
        $.ajax({
            url: urlBase + 'order/action-detail/kurang/' + id,
            type: "POST",
            data: JSON.stringify(dataParams),
            dataType: "JSON",
            success: function (data) {
                if (data.type == 0) {
                    success(data.msg);
                    $(function () {
                        setTimeout(function () {
                            location.replace(urlBase + "order/create/" + $('[name="keyId"]').val());
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
}
function listOrder(id) {
    const spinerPage = document.getElementById('spiner-page');
    const ContentPage = document.getElementById('content-page');
    spinerPage.classList.replace('hidden', 'text-center');
    ContentPage.classList.add('hidden');
    $.ajax({
        url: urlBase + 'order/action/list/' + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if (data.type == 0) {
                $("#no-order").html(data.data.orderHd.order_id)
                $("#date-order").html(data.data.orderHd.order_date)
                $("#nama-customer").html(data.data.orderHd.customer_name)
                $("#kode-promo").html(data.data.orderHd.promo_code)
                $("#discount").html(toRp(data.data.orderHd.amount_discount));
                $("#nett").html(toRp(data.data.orderHd.net));
                $("#ppn").html(toRp(data.data.orderHd.ppn));
                $("#total-order").html(toRp(data.data.orderHd.total));
                $('#detailList').html('');
                {
                    data.data.orderDetail.forEach(res => {
                        var tr = ' <tr>';
                        tr += '<td>' + res.product_name + '</td>';
                        tr += '<td>' + res.qty + '</td>';
                        tr += '<td>' + toRp(res.price) + '</td>';
                        tr += '<td>' + toRp(res.subtotal) + '</td>';

                        $('#detailList').append(tr);
                    })
                }
                ContentPage.classList.remove("hidden");
                spinerPage.classList.replace('text-center', 'hidden')
            }else{
                warning(data.msg);
                $(function () {
                    setTimeout(function () {
                        location.replace(urlBase);
                    }, 1000);
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            errors("data Tidak ada");
            $(function () {
                setTimeout(function () {
                    location.replace(urlBase);
                }, 1000);
            });
        }
    });
}
function toRp(angka) {
    var rev = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2 = '';
    for (var i = 0; i < rev.length; i++) {
        rev2 += rev[i];
        if ((i + 1) % 3 === 0 && i !== (rev.length - 1)) {
            rev2 += '.';
        }
    }
    return 'Rp. ' + rev2.split('').reverse().join('') + ',-';
}