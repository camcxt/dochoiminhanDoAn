$(document).ready(function() {

    $(document).on('click', '.btn-delete', function() {
        var url = $(this).attr('data-url');
        var itemName = $(this).data('name');
        var _this = $(this);
        var total = 0;
        var amount = 0;
        if (confirm('Do you want to delete item ' + itemName + '?')) {
            $.ajax({
                method: 'GET',
                url: url,
                type: 'delete',
                success: function(response) {
                    $.each(response.carts, function(key, item) {
                        amount += parseInt(item.qty);
                        total += item.price * item.qty;
                        totalCost = '$' + total.toLocaleString('en-US');
                        totalItem = item.price * item.qty;
                    });

                    if (jQuery.isEmptyObject(response.carts)) {
                        $('#totalCost').text("0");
                        $('.totalCart').text("0");
                        $('.total').text("0");
                    } else {
                        $('#totalCost').text(totalCost);
                        $('.totalCart').text(totalCost);
                        $('.total').text(amount);
                    }

                    _this.parent().parent().remove()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        }
    });

    $(document).on('click', '.quantityUpdate', function() {
        var status = $(this).attr('data-status');
        var rowId = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        var urlDelete = $(this).attr('data-urlDelete');
        var quantity = $('#quantity-' + rowId).val();
        var _this = $(this);
        var total = 0;
        var amount = 0;
        if (quantity == 1) {
            if (status == 'minusCart') {
                if (confirm('Do you want to delete item ' + '?')) {
                    $.ajax({
                        method: 'GET',
                        url: urlDelete,
                        type: 'delete',
                        success: function(response) {
                            $.each(response.carts, function(key, item) {
                                amount += parseInt(item.qty);
                                total += item.price * item.qty;
                                totalCost = '$' + total.toLocaleString('en-US');
                                totalItem = item.price * item.qty;
                            });

                            if (jQuery.isEmptyObject(response.carts)) {
                                $('#totalCost').text("0");
                                $('.totalCart').text("0");
                                $('.total').text("0");
                            } else {
                                $('#totalCost').text(totalCost);
                                $('.totalCart').text(totalCost);
                                $('.total').text(amount);
                            }

                            _this.parent().parent().parent().parent().remove()
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            //xử lý lỗi tại đây
                        }
                    })
                }
            } else {
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        status: status,
                        rowId: rowId,
                    },
                    success: function(response) {
                        $.each(response.carts, function(key, item) {
                            amount += parseInt(item.qty);
                            totalItem = '$' + (item.price * item.qty).toLocaleString('en-US');
                            total += item.price * item.qty;
                            totalCost = '$' + total.toLocaleString('en-US');
                            $('#cost-' + item.rowId).text(totalItem);
                            $('#quantity-' + item.rowId).val(item.qty);
                            $('#totalCost').text(totalCost);
                            $('.totalCart').text(totalCost);
                            $('.total').text(amount);
                        });
                        if (response.messError != "") {
                            $('#messError').html("<div class='alert alert-danger'>" + response.messError + "</div>");
                        }
                    }
                });
            }
        } else {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                data: {
                    status: status,
                    rowId: rowId,
                },
                success: function(response) {
                    $.each(response.carts, function(key, item) {
                        amount += parseInt(item.qty);
                        totalItem = '$' + (item.price * item.qty).toLocaleString('en-US');
                        total += item.price * item.qty;
                        totalCost = '$' + total.toLocaleString('en-US');
                        $('#cost-' + item.rowId).text(totalItem);
                        $('#quantity-' + item.rowId).val(item.qty);
                        $('#totalCost').text(totalCost);
                        $('.totalCart').text(totalCost);
                        $('.total').text(amount);
                    });
                    if (response.messError != "") {
                        $('#messError').html("<div class='alert alert-danger'>" + response.messError + "</div>");
                    }
                }
            });
        }
    })


    function update(_this) {
        carts = $('input.cart');
        var cartData = [];
        var cart_id = $(_this).data('cart');
        var totalNew = 0;

        carts.each(function() {
            cartData.push({
                product_id: $(this).data('id'),
                quantity: $(this).val(),
                name: $(this).data('name'),
                price: $(this).data('price'),
                options: {
                    image: $(this).data('image')
                },
                color: $(this).data('color'),
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: updateUrl,
            method: 'POST',
            data: {
                cart_id: cart_id,
                data: cartData,
            },
            success: function(response) {
                $.each(response.data.data, function(key, item) {
                    $("#cart-" + item.product_id + '-' + item.color).data("qty", parseInt(item.quantity));
                    $("#quantity-" + item.product_id).prop('value', parseInt(item.quantity));
                    totalNew = totalNew + (parseInt(item.quantity) * parseFloat(item.price));
                });
                $('#total').text(numeral(totalNew).format('0,0.00'));
                $('#sub_total').text(numeral(totalNew).format('0,0.00'));
            },
            error: function(xhr, text, err) {
                var responseData = JSON.parse(xhr.responseText);
                var errorMessage = responseData.message;
                setTimeout(function() {
                    toastr.error(errorMessage, 'Error');
                }, 2000);

                var inputElement = $("#cart-" + responseData.id + '-' + responseData.color);
                var previousQuantity = inputElement.data('qty');
                inputElement.val(previousQuantity);
            }
        });
    }


});