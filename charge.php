<?php

require 'vendor/autoload.php';
// This is a public sample test API key.
// Don’t submit any personally identifiable information in requests made with this key.
// Sign in to see your own test API key embedded in code samples.
\Stripe\Stripe::setApiKey('sk_test_26PHem9AhJZvU623DfE1x4sd');

header('Content-Type: application/json');

try {
    // retrieve JSON from POST body
    $jsonStr = file_get_contents('php://input');
    $jsonObj = json_decode($jsonStr);

    // Lookup the payment methods available for the customer
    $paymentMethods = \Stripe\PaymentMethod::all([
        'customer' => $jsonObj->customer,
        'type' => 'card'
    ]);

    // Charge the customer and payment method immediately
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 1099,
        'currency' => 'eur',
        'customer' => $jsonObj->customer,
        'payment_method' => $paymentMethods->data[0]->id,
        'off_session' => true,
        'confirm' => true,
    ]);

    echo json_encode([
        'paymentIntent' => $paymentIntent,
    ]);
} catch (\Stripe\Exception\CardException $e) {
    // Error code will be authentication_required if authentication is needed
    echo 'Error code is:' . $e->getError()->code;
    $paymentIntentId = $e->getError()->payment_intent->id;
    $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}