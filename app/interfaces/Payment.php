<?php
namespace App\Interface;

interface Payment
{
    public function init();
    public function charge();
}
?>