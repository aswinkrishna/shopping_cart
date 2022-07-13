<?php
namespace App\Controllers;

use App\Controllers\Payment;
use App\Models\OrderModel;

class Stripe implements Payment
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();    
    }

    public function init()
    {
        \Stripe\Stripe::setApiKey('sk_test_51LIql9SJhBIxnYC6rrM2yvmlTM3yH4tWv3fQAJL04G49c0uXjS2gDX1ap6w9LtOPVfvEOv8CoVMrM3tnlnLp2a2y00nD6AZlh0');
    }
    
    public function charge()
    {
       // retrieve JSON from POST body
        $jsonStr = file_get_contents('php://input');
        $jsonObj = json_decode($jsonStr);
        $transactionNo = decrypt($jsonObj->transaction_no);
        
        // get order Data
        $orderData = $this->orderModel->getTempOrder(["transaction_no" => $transactionNo]);
        $amount = (float) $orderData->total_price;
        try {
            // Alternatively, set up a webhook to listen for the payment_intent.succeeded event
            // and attach the PaymentMethod to a new Customer
            $customer = \Stripe\Customer::create();
            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                'customer' => $customer->id,
                'setup_future_usage' => 'off_session',
                'amount' => $amount * 100,
                'currency' => 'inr',
                "metadata" => ["transaction_no" => $transactionNo],
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
                "transaction_no" => encrypt($transactionNo),
                "payment_response" => $paymentIntent,
                'amount' => $amount,
            ];            
            return $output;
        } catch (\Error $e) {
            return ['error' => $e->getMessage()];
        }
    }
}