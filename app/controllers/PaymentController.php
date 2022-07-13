<?php
namespace App\Controllers;

use App\Controllers\CommonController;
use App\Libraries\Stripe;
use App\Models\PaymentModel;

class PaymentController
{
    private $payment;
    private $user;
    private $paymentModel;

    public function __construct()
    {
        $this->payment = new Stripe();
        $this->paymentModel =  new PaymentModel();
        $this->user = (object) CommonController::getUserData();
    }
 
    public function make()
    {
        $this->payment->init();
        $resposne = $this->payment->charge();
        if (in_array("error",$resposne)) {
            http_response_code(500);
            return $resposne;
        }
        $paymentData = [
            "user_id" => $this->user->userId,
            "transaction_no" => decrypt($resposne['transaction_no']),
            "payment_response" => json_encode($resposne['payment_response']),
            "pay_amount" => $resposne['amount'],
            "created_at" => date('Y-m-d H:i:s'),
        ];
        $this->paymentModel->add($paymentData);
        return $resposne;
    }
}
?>