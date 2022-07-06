$(document).ready(function(){
    // add to cart
    $(".add-to-cart").click(function(){
        var product_id = $(this).data('product-id');
        var qty = $(this).data('quantity');
        $.ajax({
            method: "POST",
            url: "cart_action.php",
            data: {product_id:product_id, qty:qty, action:"add"},
            dataType: "json",
            success:function(response){
                $.iaoAlert({msg: response.message, type: "success", mode: "light",});
            }
        });
    });

    // increase cart quantity
    $(".cart_quantity_up").click(function(){
        var purchase_count = $(this).parent().find(".cart_quantity_input").val();
        purchase_count = parseInt(purchase_count) + 1;
        var product_id = $(this).data('product-id');
        var cart_id = $(this).data('cart-id');
        var quantity = $(this).data('quantity');
        $(this).parent().find(".cart_quantity_input").val(purchase_count);
        loadCart(cart_id, product_id, quantity, "increase");
    });

    // decrease cart quantity
    $(".cart_quantity_down").click(function(){
        var purchase_count = $(this).parent().find(".cart_quantity_input").val();
        purchase_count = parseInt(purchase_count) - 1;
        var product_id = $(this).data('product-id');
        var cart_id = $(this).data('cart-id');
        var quantity = $(this).data('quantity');
        $(this).parent().find(".cart_quantity_input").val(purchase_count);
        loadCart(cart_id, product_id, quantity, "reduce");
    });

    // load cart
    function loadCart(cart_id, product_id, quantity = 1, action)
    {
        $.ajax({
            method: "POST",
            url: "cart_action.php",
            data: {cart_id:cart_id, product_id:product_id, qty:quantity, action:action},
            dataType: "json",
            success:function(response){
                $.iaoAlert({msg: response.message, type: "success", mode: "light",});
                setTimeout(() => {
                   window.location.reload(); 
                }, 1000);
            }
        });
    }

    // place order
    $("#place_order").click(function(){
        $.ajax({
            method: "POST",
            url: "cart_action.php",
            data: {action: "place_order", payment_type: $("[name=payment_type]:checked").val()},
            dataType: "json",
            processData: false,
            contentType: false,
            success:function(){
                s
            }
        });
    });
});