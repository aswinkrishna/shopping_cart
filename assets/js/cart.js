$(document).ready(function(){
    // add to cart
    $(".add-to-cart").click(function() {
        var product_id = $(this).data('product-id');
        var qty = $(this).data('quantity');
        $.ajax({
            method: "POST",
            url: "action.php",
            data: {product_id:product_id, qty:qty, action_method:"add", class:"CartController"},
            dataType: "json",
            success:function(response){
                $.iaoAlert({msg: response.message, type: "success", mode: "light",});
            }
        });
    });

    // increase cart quantity
    $("body").delegate(".cart_quantity_up", "click", function() {
        var purchase_count = $(this).parent().find(".cart_quantity_input").val();
        purchase_count = parseInt(purchase_count) + 1;
        var product_id = $(this).data('product-id');
        var cart_id = $(this).data('cart-id');
        var quantity = $(this).data('quantity');
        $(this).parent().find(".cart_quantity_input").val(purchase_count);
        loadCart(cart_id, product_id, quantity, "update","plus");
    });

    // decrease cart quantity
    $("body").delegate(".cart_quantity_down", "click", function() {
        var purchase_count = $(this).parent().find(".cart_quantity_input").val();
        purchase_count = parseInt(purchase_count) - 1;
        var product_id = $(this).data('product-id');
        var cart_id = $(this).data('cart-id');
        var quantity = $(this).data('quantity');
        $(this).parent().find(".cart_quantity_input").val(purchase_count);
        loadCart(cart_id, product_id, quantity, "update","minus");
    });

    // remove product from cart
    $("body").delegate(".cart_quantity_delete", "click", function() {
        var product_id = $(this).data('product-id');
        var cart_id = $(this).data('cart-id');
        loadCart(cart_id, product_id, 0, "delete");
    });

    // load cart
    function loadCart(cart_id, product_id, quantity = 1, action,operatiion = "")
    {
        $.ajax({
            method: "POST",
            url: "action.php",
            data: {cart_id:cart_id, product_id:product_id, qty:quantity, action_method:action,  class:"CartController", operatiion:operatiion},
            dataType: "json",
            success:function(response) {
                var cart_html = "";
                if (response.status == 1) {
                    $.iaoAlert({msg: response.message, type: "success", mode: "light",});
                    if (Object.keys(response.data.cart_items).length > 0) {
                        $.each(response.data.cart_items, function( index, item ) {
                            cart_html += `<tr>
                                            <td class="cart_product">
                                                <a href="#"><img src="${PRODUCT_IMAGE_PATH}${item.product_image}" alt="${item.product_name}" height="100"></a>
                                            </td>
                                            <td class="cart_description">
                                                <h4><a href="#">${item.product_name}</a></h4>
                                                <p>Code: ${item.product_code}</p>
                                            </td>
                                            <td class="cart_price">
                                                <p>${CURRENCY}${item.product_sale_price}</p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    <a class="cart_quantity_down" href="javascript:" data-product-id="${item.product_id}" data-cart-id="${item.cart_id}" data-quantity="1"> - </a>
                                                    <input class="cart_quantity_input no-border" type="text" name="quantity" value="${item.product_quantity}" autocomplete="off" size="2" readonly>
                                                    <a class="cart_quantity_up" href="javascript:" data-product-id="${item.product_id}" data-cart-id="${item.cart_id}" data-quantity="1"> + </a>
                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">${CURRENCY}${item.product_total}</p>
                                            </td>
                                            <td class="cart_delete">
                                                <a class="cart_quantity_delete" href="javascript:" data-product-id="${item.product_id}" data-cart-id="${item.cart_id}"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>`;
                        });
                    } else {
                        $(".empty-cart-hide").hide();
                        $(".empty-cart-show").show();
                    }
                    $("#cart_list tbody").html(cart_html);
                    var cart_sub_total = response.data.sub_total.toFixed(2);
                    var cart_shipping_charge = response.data.shipping_charge.toFixed(2);
                    var cart_grand_total = response.data.grand_total.toFixed(2);
                    $(".cart_sub_total").html(CURRENCY+cart_sub_total);
                    $(".cart_shipping_charge").html(CURRENCY+cart_shipping_charge);
                    $(".cart_grand_total").html(CURRENCY+cart_grand_total);
                } else {
                    $.iaoAlert({msg: response.message, type: "error", mode: "dark",})
                }
            }
        });
    }

    // place order
    $("#place_order").click(function() {
        if ($("[name=shiiping_address]:checked").val() === undefined) {
            Swal.fire('Opps!',"Please add a Shipping Address",'warning');
        } else {
            var shipping_address_id = $("[name=shiiping_address]:checked").val();
            $.ajax({
                method: "POST",
                url: "action.php",
                data: {class:"OrderController", action_method: "placeOrder", payment_type: $("[name=payment_type]:checked").val(),shipping_address_id:shipping_address_id},
                dataType: "json",
                success:function(response){
                    if (response.status == 1) {
                        if (response.call_back == 1) {
                            window.location.assign(response.call_back_url + "?transaction_no=" + response.transaction_no);
                        } else {
                            Swal.fire('Opps!', response.message,'warning');
                        }
                    }
                }
            });
        }
    });
});