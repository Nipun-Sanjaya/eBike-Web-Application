<?php
include("./config.php");

if (isset($_POST["pid"])) {
  $token = $_POST["stripeToken"];
  $contact_name = $_POST["c_name"];
  $token_card_type = $_POST["stripeTokenType"];
  $phone           = $_POST["phone"];
  $email           = $_POST["stripeEmail"];
  $address         = $_POST["address"];
  $amount          = $_POST["amount"];
  $pid          = $_POST["pid"];
  $qty         = $_POST["qty"];
  $desc            = $_POST["product_name"];
  $charge = \Stripe\Charge::create([
    "amount" => str_replace(",", "", $amount) * 100,
    "currency" => 'lkr',
    "description" => $desc,
    "source" => $token,
  ]);
?>
    

  <?php

  if ($charge) {
    header("Location:success.php?pid=$pid&qty=$qty");
  }
} else {
  $token = $_POST["stripeToken"];
  $contact_name = $_POST["c_name"];
  $token_card_type = $_POST["stripeTokenType"];
  $phone           = $_POST["phone"];
  $email           = $_POST["stripeEmail"];
  $address         = $_POST["address"];
  $amount          = $_POST["amount"];
  $desc            = $_POST["product_name"];
  $charge = \Stripe\Charge::create([
    "amount" => str_replace(",", "", $amount) * 100,
    "currency" => 'lkr',
    "description" => $desc,
    "source" => $token,
  ]);
  ?>
    

  <?php

  if ($charge) {
    header("Location:success.php");
  }
}
  ?>
