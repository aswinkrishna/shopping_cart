<?php 
include('includes/__header.php'); 

use App\Controllers\CommonController;
use App\Libraries\Cart;

$cart = new Cart();
$cart_data = $cart->getCart();
?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="empty-cart-show text-center" style="<?=(empty((array) $cart_data->cart_items )) ? '':'display:none'; ?>">
				<img src="assets/images/empty-cart.png"  height="300"/>
				<h3>Cart is empty</h3>
			</div>
			<div class="table-responsive cart_info empty-cart-hide" style="<?=(!empty((array) $cart_data->cart_items )) ? '':'display:none'; ?>">				
				<table class="table table-condensed" id="cart_list">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php
					if (!empty( (array) $cart_data->cart_items )) { 
						foreach($cart_data->cart_items as $item) { ?>
						<tr>
							<td class="cart_product">
								<a href="#"><img src="<?=PRODUCT_IMAGE_PATH.$item->product_image; ?>" alt="<?=$item->product_name?>" height="100"></a>
							</td>
							<td class="cart_description">
								<h4><a href="#"><?=$item->product_name?></a></h4>
								<p>Code: <?=$item->product_code?></p>
							</td>
							<td class="cart_price">
								<p><?=CURRENCY.$item->product_sale_price?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_down" href="javascript:" data-product-id="<?=$item->product_id?>" data-cart-id="<?=$item->cart_id?>" data-quantity="1"> - </a>
									<input class="cart_quantity_input no-border" type="text" name="quantity" value="<?=$item->product_quantity?>" autocomplete="off" size="2" readonly>
									<a class="cart_quantity_up" href="javascript:" data-product-id="<?=$item->product_id?>" data-cart-id="<?=$item->cart_id?>" data-quantity="1"> + </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?=CURRENCY.$item->product_total?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="javascript:" data-product-id="<?=$item->product_id?>" data-cart-id="<?=$item->cart_id?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
					<?php 
						}
					} else {
						?>
						<tr>
							<td colspan="5" align="center">Cart is Empty</td>
						</tr>
						<?php
					} 
					?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action" class="empty-cart-hide" style="<?=(!empty((array) $cart_data->cart_items )) ? '':'display:none'; ?>">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
					<h2>Cart Summary</h2>
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span class="cart_sub_total"><?=CURRENCY.number_format($cart_data->sub_total,2)?></span></li>
							<li>Shipping Cost <span class="cart_shipping_charge"><?=CURRENCY.number_format($cart_data->shipping_charge,2)?></span></li>
							<li>Total <span class="cart_grand_total"><?=CURRENCY.number_format($cart_data->grand_total,2)?></span></li>
						</ul>
						<?php if(CommonController::isLoggedIn()){
							?><a class="btn btn-default check_out" href="checkout">Check Out</a><?php
						} else {
							?><a class="btn btn-default check_out" href="login?redirect=checkout">Check Out</a><?php
						}
						?>						
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
<?php include('includes/__footer.php');?>