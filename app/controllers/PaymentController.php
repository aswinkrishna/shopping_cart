<?php
namespace App\Controllers;

use App\Config\Connection;
use App\Controllers\CommonController;

class PaymentController
{
    private $pdo;
    private $user;

    public function __construct()
    {
        $this->pdo = Connection::make();
        $this->user = (object) CommonController::getUserData();
        \Stripe\Stripe::setApiKey('sk_test_51LIql9SJhBIxnYC6rrM2yvmlTM3yH4tWv3fQAJL04G49c0uXjS2gDX1ap6w9LtOPVfvEOv8CoVMrM3tnlnLp2a2y00nD6AZlh0');
    }
 
    public function stripePayment($jsonObj)
    {
        $transactionNo = decrypt($jsonObj->transaction_no);
        // get order Data
        $query = $this->pdo->prepare("SELECT * from temp_orders where transaction_no = :transaction_no");
        $query->execute(["transaction_no" => $transactionNo]);
        $order_data = $query->fetch($this->pdo::FETCH_OBJ);
        $amount = (float) $order_data->total_price;
        try {
            // retrieve JSON from POST body
            // $jsonStr = file_get_contents('php://input');
            // $jsonObj = json_decode($jsonStr);

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
                "transaction_no" => $jsonObj->transaction_no,
            ];
            $payment_data = [
                "user_id" => $this->user->userId,
                "transaction_no" => $transactionNo,
                "payment_response" => json_encode($paymentIntent),
                "pay_amount" => $amount,
                "created_at" => date('Y-m-d H:i:s'),
            ];
            $payment_query = $this->pdo->prepare('INSERT INTO `payments`(`user_id`, `transaction_no`, `payment_response`, `pay_amount`, `created_at`) VALUES (:user_id, :transaction_no, :payment_response, :pay_amount, :created_at)');
            $payment_query->execute($payment_data);
            return $output;
        } catch (\Error $e) {
            http_response_code(500);
            return ['error' => $e->getMessage()];
        }
    }
}
?>