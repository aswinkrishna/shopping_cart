<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Accept a payment</title>
    <meta name="description" content="A demo of a payment on Stripe" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/checkout.css" />
    <script src="assets/js/jquery.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="assets/js/checkout.js" defer></script>
  </head>
  <body>
    <!-- Display a payment form -->
    <form id="payment-form">
      <div id="payment-element">
        <!--Stripe.js injects the Payment Element-->
      </div>
      <button id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Pay now</span>
      </button>
      <input type="hidden" name="transaction_no" id="transaction_no" value="<?=$_GET['transaction_no']?>" />
      <div id="payment-message" class="hidden"></div>
    </form>
  </body>
</html>