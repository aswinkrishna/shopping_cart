<?php
namespace App\Controllers;

use App\Models\AddressModel;

class AddressController
{
    private $user;
    private $addressModel;

    public function __construct()
    {
        $this->user = (object) CommonController::getUserData();
        $this->addressModel = new AddressModel();
    }

    public function create()
    {
        $post_data = $_POST;
        $addressData = [
            "user_id" => $_SESSION['user_id'],
            "full_name" => $post_data['shipping_full_name'],
            "address_line_1" => $post_data['shipping_address_line1'],
            "address_line_2" => $post_data['shipping_address_line2'],
            "country_id" => $post_data['shipping_country'],
            "state_id" => $post_data['shipping_state'],
            "city" => $post_data['shipping_city'],
            "zipcode" => $post_data['shipping_zipcode'],
            "created_at" => date('Y-m-d H:i:s'),
            "is_default" => 1,
            "is_deleted" => 0,
        ];
        return $this->addressModel->addNewAddress($addressData);
    }

    public function fetch()
    {
        $result = $this->addressModel->getAllAddress(["user_id" => $this->user->userId]);
        return $result;
    }
}