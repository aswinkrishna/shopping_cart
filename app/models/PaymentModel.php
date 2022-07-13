<?php
namespace App\Models;

use App\Core\CoreModel;

class PaymentModel extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add($paymentData)
    {
        $payment_query = $this->pdo->prepare('INSERT INTO `payments`(`user_id`, `transaction_no`, `payment_response`, `pay_amount`, `created_at`) VALUES (:user_id, :transaction_no, :payment_response, :pay_amount, :created_at)');
        $payment_query->execute($paymentData);
        return $this->pdo->lastInsertId();
    }
}