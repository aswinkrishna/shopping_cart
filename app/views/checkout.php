<?php
include('includes/__header.php'); 
if (!isset($_SESSION['user_id'])) {
	header('Location:login');
}

use App\Controllers\CommonController;
use App\Libraries\Cart;
use App\Controllers\UserController;

$contries = CommonController::getCountries();
$states = CommonController::getStates();

$cart = new Cart();
$cart_data = $cart->getCart();
$user = new UserController();
$shipping_addresses = $user->getAllShippingAddresses();
?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="register-req">
				<p>Shipping Address</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-6 clearfix">
						<div class="bill-to">
							<div class="form-two">
								<form method="POST" id="shipping_address_form" action="./user_action.php">
									<input type="hidden" name="form_action" value="add_address" />
									<input type="text" name="shipping_full_name" placeholder="Full Name *">
									<input type="text" name="shipping_address_line1" placeholder="Address 1 *">
									<input type="text" name="shipping_address_line2" placeholder="Address 2">
									<select name="shipping_country">
										<option value="">-- Country --</option>
										<?php
										foreach($contries as $country){
											?><option value="<?=$country->id?>"><?=$country->country_name?></option><?php
										}
										?>
									</select>
									<select name="shipping_state">
										<option value="">-- State / Province / Region --</option>
										<?php
										foreach($states as $state){
											?><option value="<?=$state->id?>"><?=$state->state_name?></option><?php
										}
										?>
									</select>
									<input type="text" name="shipping_city" placeholder="City">
									<input type="text" name="shipping_zipcode" placeholder="Zip / Postal Code *">
									<button type="submit" class="btn btn-default pull-right">Add Address</button>
								</form>
							</div>
						</div>
					</div>	
					<div class="col-sm-6 clearfix">
						<div class="row" id="shipping_address_area">
						<?php foreach ($shipping_addresses as $address):?>
							<div class="col-sm-4 address-box">
								<label>
									<input type="radio" name="shiiping_address" value="<?=$address->id?>" <?=($address->is_default == 1) ? 'checked' : '' ?> />
									<p><?=$address->full_name?><br>
									<?=$address->address_line_1?><br>
									<?=($address->address_line_2 != "") ? $address->address_line_2."<br>":'' ?>
									<?=$address->city.", ".$address->state_name.", ".$address->country_name?>
								</label>
							</div>
						<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
						</tr>
					</thead>
					<tbody>
					<?php foreach($cart_data->cart_items as $item): ?>
						<tr>
							<td class="cart_product">
								<a href="#"><img src="<?=PRODUCT_IMAGE_PATH.$item->product_image; ?>" alt="<?=$item->product_name?>" height="100"></a>
							</td>
							<td class="cart_description">
								<h4><a href="#"><?=$item->product_name?></a></h4>
								<p>Code: <?=$item->product_code?></p>
								<?=($item->product_stock <= 0) ? '<span class="error">Out of Stock</span>' : '' ?>
							</td>
							<td class="cart_price">
								<p><?=CURRENCY.$item->product_sale_price?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input class="cart_quantity_input no-border" type="text" name="quantity" value="<?=$item->product_quantity?>" autocomplete="off" size="2" readonly>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?=CURRENCY.$item->product_total?></p>
							</td>
						</tr>
					<?php endforeach; ?>						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
					<h2>Cart Summary</h2>
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span><?=CURRENCY.number_format($cart_data->sub_total,2)?></span></li>
							<li>Shipping Cost <span><?=CURRENCY.number_format($cart_data->shipping_charge,2)?></span></li>
							<li>Total <span><?=CURRENCY.number_format($cart_data->grand_total,2)?></span></li>
						</ul>
						<div class="payment-type">
							<input type="radio" name="payment_type" id="payment_type_card" value="1" checked />
							<label for="payment_type_card">Card Payment</label>
							<input type="radio" name="payment_type" id="payment_type_cash" value="2" />
							<label for="payment_type_cash">Cash on Delivery</label>
						</div>
						<?php if(CommonController::isLoggedIn()){
							?><button id="place_order" class="btn btn-default check_out" href="checkout">Place Order</button><?php
						}
						?>						
					</div>	
				</div>
			</div>
		</div>
	</section>
<?php include('includes/__footer.php');?>