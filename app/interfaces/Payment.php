<?php
namespace App\Controllers;

interface Payment
{
    public function init();
    public function charge();
}
?>