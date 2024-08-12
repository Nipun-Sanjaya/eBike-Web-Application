<?php 
require "connection.php";

if(isset($_GET["id"])){

    $mid = $_GET["id"];
    



Database::iud("DELETE FROM `model` WHERE `id`='".$mid."'");

echo("Success");

}else{
    echo "Something went Wrong";
}
