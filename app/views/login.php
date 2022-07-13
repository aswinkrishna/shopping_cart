<?php 
include('includes/__header.php'); 

use App\Controllers\CommonController;

$commonController = new CommonController();
$contries = $commonController->getCountries();
?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="action.php" method="POST" id="login_form">
							<input type="hidden" name="action_method" value="login" />
							<input type="hidden" name="class" value="AuthController" />
							<input type="email" name="email_address" placeholder="Email Address" />
							<input type="password" name="user_password" placeholder="Password" />
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="action.php" method="POST" id="register_form">
							<input type="hidden" name="action_method" value="create" />
							<input type="hidden" name="class" value="UserController" />
							<input type="text" name="first_name" placeholder="First Name"/>
							<input type="text" name="last_name" placeholder="Last Name"/>
							<select class="form-control" name="country">
								<option value="">- - Select Country - -</option>
								<?php
								foreach ($contries as $country) {
									?><option value="<?=$country->id?>"><?=$country->country_name?></option><?php
								}
								?>
							</select>
							<br>
							<input type="text" name="mobile_number" placeholder="Mobile Number" maxlength="12"/>
							<input type="email" name="email_address" placeholder="Email Address"/>
							<input type="password" name="password" placeholder="Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
							<br>
							<span class="error_message error"></span>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
<?php include('includes/__footer.php');?>