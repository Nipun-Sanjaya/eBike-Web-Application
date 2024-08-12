<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51LiNEgCP1QPZNR9H8JWZvLepboW6PWFNCXvpVeCCPFlobOmV65I1GiqzJEY5rbjMpJZ0bhFjzwS0ziwbHCMTZMk500epsJRBAm",
        "publishableKey" => "pk_test_51LiNEgCP1QPZNR9HW73D0q0RS9IYeRlfjaDLfHQDOXkDWoJsH53B91JJ4CbOSMh9N66h72jYhJa1X5DBcTN9hcpF00ICkYd1nX"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>