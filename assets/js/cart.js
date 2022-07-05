$(document).ready(function(){
    // add to cart
    $(".add-to-cart").click(function(){
        var product_id = $(this).data('product-id');
        var qty = $(this).data('quantity');
        $.ajax({
            method: "POST",
            url: "cart_action.php",
            data: {product_id:product_id,qty:qty,action:"add"},
            dataType: "json",
            success:function(response){
                
            }
        });
    });
});