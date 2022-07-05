<?php 
include('includes/__header.php'); 

use App\Controllers\ProductController;

$product = new ProductController();
$all_products = $product->getAllProducts();
?>	
	<section>
		<div class="container">
			<div class="row">
				
				<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php foreach($all_products as $pr): ?>
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?=PRODUCT_IMAGE_PATH.$pr->product_image?>" alt="<?=$pr->product_name?>" />
										<h2><?=CURRENCY.$pr->product_sale_price?></h2>
										<p><?=$pr->product_name?></p>
										<a href="#" class="btn btn-default add-to-cart" data-product-id="<?=$pr->id?>" data-quantity="1"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2><?=CURRENCY.$pr->product_sale_price?></h2>
											<p><?=$pr->product_name?></p>
											<button class="btn btn-default add-to-cart" data-product-id="<?=$pr->id?>" data-quantity="1"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div><!--features_items-->
					
				</div>
			</div>
		</div>
	</section>
<?php include('includes/__footer.php');?>