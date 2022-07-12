<?php

function encrypt($string)
{
    return base64_encode($string);
}

function decrypt($string)
{
    return base64_decode($string);
}

function passwordEncrypt($password)
{
    return md5(trim($password));
}
?>