<?php require "connection.php";  ?>

<!DOCTYPE html>
<html>

<head>
    <title>Cart | eBike</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid main-body">
        <div class="row">

            <?php

            require "header.php";

            if (isset($_SESSION["u"])) {
                $uemail = $_SESSION["u"]["email"];

                $total = 0;
                $subTotal = 0;
                $shipping = 0;

            ?>
                <div class="col-12 pt-2" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" arial-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12 border border-0 border-secondary rounded mb-3">
                    <div class="row">

                        <div class=" col-2 offset-5 bg-black" style="border-radius: 15px;">
                            <label class="form-label fs-1 fw-bold text-warning ">Basket <i class="bi bi-cart3 fs-2"></i></label>
                        </div>

                        <div class="col-12 ">
                            <hr class="hr-break-1 text-white" />
                        </div>

                        <?php
                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
                        $cart_num = $cart_rs->num_rows;

                        $cart_result = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "' AND `status`='1'");
                        $cart_number = $cart_result->num_rows;


                        if ($cart_num == 0) {
                        ?>

                            <!-- empty -->

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptycart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <img src="resources/emptycart.svg" style="width:200px ;" />
                                    </div>

                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1">You have no item your Basket</label>
                                    </div>

                                    <div class="col-12 col-lg-4 offset-0 offset-lg-4 d-grid mb-4">
                                        <a href="#" class="btn btn-primary fs-5">Start Shoping</a>
                                    </div>

                                </div>
                            </div>

                            <!-- empty -->


                        <?php
                        } else {
                            $cart_rst = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
                            $cart_status = $cart_rst->fetch_assoc();

                            $pid_result = Database::search("SELECT * FROM `product` INNER JOIN `cart` ON product.id = cart.product_id WHERE product.qty = 0 AND cart.product_id=product.id AND cart.user_email= '" . $uemail . "'
                            ");
                            $pnum = $pid_result->num_rows;


                        ?>
                            <?php
                            if ($pnum == 0) {
                            ?>
                                <div class=" col-lg-4 offset-lg-0 form-check">
                                    <input class="form-check-input"  type="checkbox" id="flexCheckDefault" <?php if ($cart_num == $cart_number) {
                                                                                                                        echo "checked";
                                                                                                                    } ?> onclick="changeAllCartStatus();">



                                    <label class="fw-bold text-danger fs-5" for="">
                                        Select All Product
                                    </label>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class=" col-lg-4 offset-lg-0 form-check">
                                    <input class="form-check-input" disabled type="checkbox" id="flexCheckDefault" <?php if ($cart_num == $cart_number) {
                                                                                                                echo "checked";
                                                                                                            } ?> onclick="changeAllCartStatus();">



                                    <label class="fw-bold text-danger fs-5" for="">
                                        Select All Product
                                    </label>
                                </div>
                            <?php
                            }
                            ?>


                            <?php

                            for ($x = 0; $x < $cart_num; $x++) {

                                $cart_data = $cart_rs->fetch_assoc();
                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $cart_data["product_id"] . "'");

                                $product_data = $product_rs->fetch_assoc();



                                if ($cart_data["status"] == 1) {
                                    $total = $total + ($product_data["price"] * $cart_data["qty"]);
                                }

                                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `users_email`='" . $uemail . "'");
                                $address_data = $address_rs->fetch_assoc();
                                $city_id = $address_data["city_id"];

                                $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
                                $district_data = $district_rs->fetch_assoc();
                                $district_id = $district_data["district_id"];

                                $ship = 0;
                                if ($district_id == 1) {
                                    $ship = $product_data["delivery_fee_colombo"];
                                    if ($cart_data["status"] == 1) {
                                        $shipping = $shipping + $product_data["delivery_fee_colombo"];
                                    }
                                } else {
                                    $ship = $product_data["delivery_fee_other"];
                                    if ($cart_data["status"] == 1) {
                                        $shipping = $shipping + $product_data["delivery_fee_other"];
                                    }
                                }
                                $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "'");

                                $user_data = $user_rs->fetch_assoc();

                            ?>
                                <!-- have product -->

                                <div class="col-12 col-lg-9">
                                    <div class="row">


                                        <div class="card mb-3 mx-0 col-12" style="background-color: rgb(5, 65, 80)">
                                            <div class="row g-0">

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold  fs-5 text-white">Seller :</span>
                                                            <span class="fw-bold text-info">
                                                                <?php echo $user_data["fname"] . "" . $user_data["lname"]; ?>
                                                            </span> &nbsp;
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-md-4">
                                                    <?php
                                                    $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                    $img_data = $img_rs->fetch_assoc();
                                                    ?>

                                                    <span class="d-inline-block " tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">
                                                        <img src="<?php echo $img_data["code"] ?>" class="img-fluid rounded-start" style="max-width: 200px;" />
                                                    </span>
                                                    <br /><br />
                                                    <!-- check box -->
                                                    <?php if ($product_data["qty"] == 0) {
                                                    ?>
                                                        <div class="form-check ">
                                                            <input class="form-check-input" disabled type="checkbox" id="flexCheckDefault<?php echo $cart_data["product_id"]; ?>" <?php if ($cart_data["status"] == 1) {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            } ?> onclick="changeCartStatus(<?php echo $cart_data['product_id']; ?>);">

                                                        </div>
                                                    <?php
                                                    } else {

                                                    ?><div class="form-check ">
                                                            <input class="form-check-input" type="checkbox" id="flexCheckDefault<?php echo $cart_data["product_id"]; ?>" <?php if ($cart_data["status"] == 1) {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                            } ?> onclick="changeCartStatus(<?php echo $cart_data['product_id']; ?>);">

                                                        </div>
                                                    <?php
                                                    } ?>



                                                    <!-- check box -->

                                                </div>

                                                <div class="col-md-5">
                                                    <div class="card-body">
                                                        <h3 class="card-title text-warning"><?php echo $product_data["title"];    ?></h3>
                                                        <span class="fw-bold text-white">Colour : <?php echo $product_data["color_id"]; ?></span>&nbsp;
                                                        &nbsp; <span class=" fw-bold text-primary"> Condition : <?php echo $product_data["condition_id"]; ?></span>

                                                        <br />

                                                        <span class=" fw-bold text-white fs-5"> Price : </span> &nbsp;
                                                        <span class=" fw-bold text-danger fs-5"> Rs. <?php echo $product_data["price"]; ?>.00</span>

                                                        <br /><br />

                                                        <span class=" fw-bold text-white fs-5"> Available Quantity : </span> &nbsp;

                                                        <input type="text" value="<?php echo $product_data["qty"]; ?>" id="av_qty<?php echo $product_data["id"] ?>" class="border border-white bg-white"  disabled  />
                                                        <br /><br />
                                                        <div class="col-12">
                                                            <span class=" fw-bold text-white fs-5" style="margin-left: 80px;">Quantity : </span>
                                                            <input type="number" class="border-1 fs-5 fw-bold text-start " style="outline: none;" pattern="[0-9]" value="<?php echo $cart_data["qty"] ?>" onkeyup='check_qty(<?php echo $product_data["id"] ?>);' onclick='check_qty(<?php echo $product_data["id"] ?>);' id="qtyvalue<?php echo $product_data["id"] ?>" />


                                                        </div>

                                                        <br /><br />

                                                        <span class=" fw-bold text-white fs-5">Delivery Fee : </span> &nbsp;
                                                        <span class=" fw-bold text-info fs-5"> Rs.<?php echo $ship; ?>.00</span>


                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="card-body d-grid bg-light" style="border-radius: 25px;">
                                                        <?php
                                                        if ($product_data["qty"] == 0) {
                                                        ?>
                                                            <div class="col-12 d-grid">
                                                                <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]) ?>' class="btn btn-outline-success  mb-2 fw-bold disabled">Product Not Available</a>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="col-12 d-grid">
                                                                <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]) ?>' class="btn btn-outline-success  mb-2 fw-bold">Buy Now</a>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                        <a href="#" class="btn btn-outline-danger mb-2 fw-bold" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <hr class="border border-1 border-white" />

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-white">Request Total <i class="bi bi-info-circle text-white"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-warning"> Rs. <?php echo ($product_data["price"] * $cart_data["qty"]) + $ship ?>.00</span>
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                    </div>


                                </div>

                                <!-- have product -->

                        <?php
                            }
                        }
                        ?>


                        <div class="col-12 col-lg-3">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fs-3 fw-bold text-warning">Summary</label>
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-6 mb-3">
                                    <span class="fs-6 fw-bold text-white">items (<?php echo $cart_number; ?>)</span>
                                </div>

                                <div class="col-6 text-end mb-3">
                                    <span class="fs-6 fw-bold text-white">Rs.<?php echo $total ?> .00</span>
                                </div>

                                <div class="col-6">
                                    <span class="fs-6 fw-bold text-white">Shipping</span>
                                </div>

                                <div class="col-6 text-end">
                                    <span class="fs-6 fw-bold text-white">Rs.<?php echo $shipping ?>.00</span>
                                </div>

                                <div class="col-12 mt-3">
                                    <hr />
                                </div>

                                <div class="col-6 mt-2">
                                    <span class="fs-4 fw-bold text-white">Total</span>
                                </div>

                                <div class="col-6 mt-2 text-end">
                                    <span class="fs-4 fw-bold text-white">Rs. <?php echo $total + $shipping ?>.00</span>
                                </div>

                                <div class="col-12 mt-3 mb-3 d-grid">
                                    <button class="btn btn-primary fs-5 fw-bold text-white" onclick="checkout();">CHECKOUT</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <?php require "footer.php"; ?>
        </div>
    </div>


    <script src="script.js" ;></script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
    <!-- <script src="bootstrap.bundle.js"></script> -->
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>

<?php
            } else {
                echo "Please Sign In first. ";
            }
?>