<?php

session_start();
$user_email = $_SESSION["u"]["email"];

require "connection.php";

$Product_id = $_GET["id"];

$Product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '".$Product_id."' AND
`users_email` = '".$user_email."'");

$Product_num = $Product_rs->num_rows;

if($Product_num == 1){
     
     $Product_data = $Product_rs->fetch_assoc();
     $_SESSION["p"] = $Product_data;

     echo "success";

}else{

    echo "Somthing went wrong";

}

?>