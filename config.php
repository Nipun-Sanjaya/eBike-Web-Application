<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "Key",
        "publishableKey" => "key"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>
