<?php
session_start();
require "connection.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Integartion (Stripe)</title>
    <link rel="stylesheet" href="./css/_style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <button type="button" onclick="goback()" class="back">Go Back</button>
    <?php

    if (isset($_GET["id"])) {
        $pid = $_GET["id"];
        $qty = $_GET["qty"];

        $product_rs = Database::search("SELECT * FROM `product` WHERE  `id`='" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();
        $p = $product_data["price"];
        $product_name = $product_data["title"];
        $price = $p * $qty;

        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");

        $product_img = $product_img_rs->fetch_assoc();
        $image = $product_img["code"];

    ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-container">
                    <form autocomplete="off" action="checkout-charge.php" method="POST">
                        <div>
                            <input type="text" name="c_name" required />
                            <label>Customer Name</label>
                        </div>
                        <div>
                            <input type="text" name="address" required />
                            <label>Address</label>
                        </div>
                        <div>
                            <input type="number" id="ph" name="phone" pattern="\d{10}" maxlength="10" required />
                            <label>Contact number</label>
                        </div>
                        <div>
                            <input type="text" name="product_name" value="<?php echo $product_name ?>" disabled required />
                            <label>Product name</label>
                        </div>
                        <div>
                            <input type="text" name="price" value="<?php echo $price ?>" disabled required />
                            <label>Price</label>
                        </div>

                        <input type="hidden" name="amount" value="<?php echo $price ?>">
                        <input type="hidden" name="pid" value="<?php echo $pid ?>">
                        <input type="hidden" name="qty" value="<?php echo $qty ?>">
                        <input type="hidden" name="product_name" value="<?php echo $product_name ?>">

                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="pk_test_51LiNEgCP1QPZNR9HW73D0q0RS9IYeRlfjaDLfHQDOXkDWoJsH53B91JJ4CbOSMh9N66h72jYhJa1X5DBcTN9hcpF00ICkYd1nX" data-amount=<?php echo str_replace(",", "", $price) * 100 ?> data-name="<?php echo $product_name ?>" data-description="<?php echo $product_name ?>" data-image="<?php echo $image ?>" data-currency="lkr" data-locale="auto">
                        </script>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="checkout-container">
                    <h4>Product Name&nbsp;:&nbsp;<?php echo $product_name ?></h4>
                    <img src="<?php echo $image ?>" />
                    <span>Price &nbsp;:&nbsp;<?php echo $price ?></span>
                </div>
            </div>
        </div>

    <?php
    } else {
    ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-container">
                    <form autocomplete="off" action="checkout-charge.php" method="POST">
                        <div>
                            <input type="text" name="c_name" required />
                            <label>Customer Name</label>
                        </div>
                        <div>
                            <input type="text" name="address" required />
                            <label>Address</label>
                        </div>
                        <div>
                            <input type="number" id="ph" name="phone" pattern="\d{10}" maxlength="10" required />
                            <label>Contact number</label>
                        </div>
                        <?php
                        $payment = $_SESSION["payment"];
                        ?>


                        <div>
                            <input type="text" name="price" value="<?php echo $payment ?>" disabled required />
                            <label>Price</label>
                        </div>

                        <input type="hidden" name="amount" value="<?php echo $payment ?>">

                        <input type="hidden" name="product_name" value="<?php echo $product_name ?>">

                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
                        data-key="pk_test_51LiNEgCP1QPZNR9HW73D0q0RS9IYeRlfjaDLfHQDOXkDWoJsH53B91JJ4CbOSMh9N66h72jYhJa1X5DBcTN9hcpF00ICkYd1nX" 
                        data-amount=<?php echo str_replace(",", "", $payment) * 100 ?> 
                        data-name="" 
                        data-description="" 
                        data-image=""
                         data-currency="lkr" 
                         data-locale="auto">
                        </script>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="checkout-container">

                    <img src="resources/Bike_Images/bend r2.jpg" />
                    <span>Price &nbsp;:&nbsp;<?php echo $payment ?></span>
                </div>
            </div>
        </div>




    <?php
    }
    ?>
    <script>
        function goback() {
            window.history.go(-1);
        }

        $('#ph').on('keypress', function() {
            var text = $(this).val().length;
            if (text > 9) {
                return false;
            } else {
                $('#ph').text($(this).val());
            }

        });
    </script>
</body>

</html>