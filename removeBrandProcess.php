<?php 
require "connection.php";

if(isset($_GET["id"])){

    $bid = $_GET["id"];




Database::iud("DELETE FROM `brand` WHERE `id`='".$bid."'");

echo("Success");

}else{
    echo "Something went Wrong";
}




?>
