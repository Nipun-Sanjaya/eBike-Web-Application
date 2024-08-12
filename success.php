<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>success</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");

        .success-container {
            width: 50%;
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #bdc3c7;
            font-weight: bold;
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>

<body>
    <div class="success-container">
        <?php

        if (isset($_GET["pid"]) && isset($_GET["qty"]) && !empty($_GET["pid"])) {

            $qty = $_GET["qty"];
            $pid = $_GET["pid"];

            $_SESSION["p"] = $pid;

        ?>
            <h3>Your Transaction has been Successfully Completed</h3>
            <button class="btn btn-info" onclick="buynow(<?php echo  $qty  ?>);">Create Your Invoice</button>
        <?php
        } else {
        ?>

            <h3>Your Transaction has been Successfully Completed</h3>
            <button class="btn btn-info" onclick="allProductbuynow();">Create Your Invoice</button>

        <?php
        }
        ?>
    </div>

    <script src="script.js"></script>
</body>

</html>