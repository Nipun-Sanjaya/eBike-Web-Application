<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {
    $email = $_SESSION["a"]["email"];


    $resultset = Database::search("SELECT * FROM `users` INNER JOIN `profile_image` ON users.email = profile_image.users_email INNER JOIN `user_has_address` ON users.email = user_has_address.users_email INNER JOIN `city` ON user_has_address.city_id = city.id INNER JOIN `district` ON city.district_id =district.id INNER JOIN `province` ON district.province_id = province.id INNER JOIN `gender` ON gender.id = users.gender_id WHERE users.`email` = '" . $email . "' ");


    $n = $resultset->num_rows;

    if ($n == 1) {

        $d = $resultset->fetch_assoc();
    }

?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>eShop | Admin Panel</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

    </head>

    <body class="main-body">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 card border-white">
                    <div class="row">

                        <div class="align-items-start main-body col-12">
                            <div class="row g-1 text-center">

                                <div class="col-12"><?php

                                                    if ($d["path"] == null) {
                                                    ?>

                                        <img id="viewimg" src="resources/profile_img/default.svg" class="rounded mt-5" style="width: 150px;" />

                                    <?php
                                                    } else {
                                    ?>
                                        <img id="viewimg" src="<?php echo $d["path"]; ?>" class="rounded mt-5" style="width: 150px;" />
                                    <?php
                                                    }

                                    ?>
                                </div>

                                <?php
                                $view_user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $_SESSION["a"]["email"] . "' ");
                                $view_result_data = $view_user_rs->fetch_assoc();
                                ?>

                                <div class="col-12 mt-5">
                                    <h4 class="text-white"><?php echo $view_result_data["fname"] . " " . $view_result_data["lname"] ?></h4>
                                    <hr class="border border-1 border-white" />
                                </div>


                                <div class="nav flex-column nav-pills me-3 mt-3">
                                    <nav class="nav flex-column">
                                        <a class="nav-link fs-5 active bg-warning" href="#">Dashboard</a>
                                        <hr class="border border-1 border-white" />
                                        <a class="nav-link fs-5 bg-warning text-white" href="manageusers.php">Manage Users</a>
                                        <hr class="border border-1 border-white" />
                                        <a class="nav-link fs-5 bg-warning text-white" href="manageProducts.php">Manage Product</a>
                                        <br/>
                                    </nav>
                                </div>
                                <br />
                                <hr class="border border-1 border-white" />

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-lg-6 ">
                    <div class="row">

                        <div class="col-12 main-body card border-white">
                            <div class="col-12 mt-3">
                                <div class="card border-white" style="width: 11rem; background-color: rgb(5, 65, 80);">

                                    <img src="resources/jjj.gif" class="card-img-top" alt="...">
                                    
                                </div>
                                
                                <hr class="border border-1 border-white" />
                                <h4 class="text-white">Selling History</h4>
                                <hr class="border border-1 border-white" />
                            </div>

                            <div class="col-12 mt-3 d-grid">
                                <h5 class="text-white fw-bold">From Date</h5>
                                <input type="date" class="form-control" />
                                <hr class="border border-1 border-white" />
                                <h5 class="text-white fw-bold">To Date</h5>
                                <input type="date" class="form-control" />
                                <hr class="border border-1 border-white" />
                                <a class="btn btn-warning fw-bold mt-2 text-white" href="sellHistory.php">View Selling</a>
                                
                                <hr class="border border-1 border-white" />
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <div class="row">



                <div class="col-12 col-lg-12 main-body">
                    <div class="row">

                        <div class="col-12 text-white fw-bold mb-3 mt-2">
                            <h2 class="fw-bold">Dashboard</h2>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-white" />
                        </div>

                        <div class="col-12">
                            <div class="row g-1">

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">

                                        <div class="col-12 text-white text-center rounded" style="height: 100px; background-color: rgb(248, 128, 128);">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily Ernings</span>
                                            <br />

                                            <?php

                                            $today = date("Y-m-d");
                                            $this_month = date("m");
                                            $this_year = date("y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $d = "0";
                                            $e = "0";

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {

                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $e = $e + $invoice_data["qty"];

                                                $f = $invoice_data["date"];
                                                $split_date = explode(" ", $f);
                                                $pdate = $split_date[0];

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }

                                                $split_result = explode("-", $pdate);
                                                $pyear = $split_result[0];
                                                $pmonth = $split_result[1];

                                                if ($pyear == $this_year) {
                                                    if ($pmonth == $this_month) {
                                                        $b = $b + $invoice_data["total"];
                                                        $d = $d + $invoice_data["qty"];
                                                    }
                                                }
                                            }


                                            ?>

                                            <span class="fs-5">Rs. <?php echo $a ?>.00</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12  text-white text-center rounded" style="height: 100px; background-color: rgb(248, 196, 128);">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />
                                            <span class="fs-5">Rs. <?php echo $b ?>.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12  text-white text-center rounded" style="height: 100px; background-color: rgb(95, 250, 160);">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $c ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12  text-white text-center rounded" style="height: 100px; background-color: rgb(45, 203, 220);">
                                            <br />
                                            <span class="fs-4 fw-bold text-white">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $d ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12  text-white text-center rounded" style="height: 100px; background-color: rgb(133, 122, 248);">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $e ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12  text-white text-center rounded" style="height: 100px;background-color: rgb(248, 122, 233);">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagements</span>
                                            <br />

                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `users`");
                                            $user_num = $user_rs->num_rows;
                                            ?>

                                            <span class="fs-5"><?php echo $user_num ?> Members</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12 bg-dark">
                            <div class="row">

                                <div class="col-12 col-lg-2 text-center mt-3 mb-3">
                                    <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>
                                </div>

                                <?php

                                $start_date = new DateTime("2022-07-01 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);

                                $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                $difference = $end_date->diff($start_date);

                                ?>

                                <div class="col-12 col-lg-10 text-end mt-3 mb-3">
                                    <label class="form-label fs-4 fw-bold text-white">
                                        <?php

                                        echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";

                                        ?>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <!-- a -->
                        <div class="offset-1 col-10 col-lg-4 mt-3  mb-3 rounded bg-warning ">
                            <div class="row g-1">

                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold text-white">Mostly Sold Ithem</label>
                                </div>
                                <?php



                                $freq_rs = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` 
FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;

                                if ($freq_num > 0) {

                                    $freq_data = $freq_rs->fetch_assoc();

                                    $proimg = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $freq_data["product_id"] . "'");
                                    $code = $proimg->fetch_assoc();

                                    $product_Details = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                    $pdetails = $product_Details->fetch_assoc();

                                    $qtyrs = Database::search("SELECT SUM(`qty`) AS `total` FROM `invoice` WHERE `product_id`='" . $freq_data["product_id"] . "'
AND `date` LIKE '%" . $today . "%'");
                                    $qtytotal = $qtyrs->fetch_assoc();

                                ?>

                                    <div class="col-12 text-center">
                                        <img src="<?php echo $code["code"]; ?>" class="img-fluid rounded-top" style="height: 250px" />
                                        <hr />
                                    </div>

                                    <div class="col-12 text-center">
                                        <span class="fs-6"><?php echo $pdetails["title"]; ?></span>
                                        <br />
                                        <span class="fs-6"><?php echo $qtytotal["total"]; ?></span>
                                        <br />
                                        <span class="fs-6">Rs.<?php echo $pdetails["price"]; ?>.00</span>
                                        <br />
                                    </div>



                                    <div class="col-12 mb-2">
                                        <div class="first_place"></div>
                                    </div>

                            </div>
                        </div>


                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-warning">
                            <div class="row g-1">

                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold text-white">Most Famouse Seller</label>
                                </div>
                                <?php

                                    $profileimg = Database::search("SELECT * FROM `profile_image` 
                            WHERE `users_email`='" . $pdetails["users_email"] . "'");
                                    $pcode = $profileimg->fetch_assoc();

                                    $userDetails = Database::search("SELECT * FROM `users` 
                            WHERE `email`='" . $pdetails["users_email"] . "'");
                                    $udetails = $userDetails->fetch_assoc();

                                ?>
                                <div class="col-12 text-center">
                                    <img src="<?php echo $pcode["path"]; ?>" class="img-fluid rounded-top" style="height: 250px" />
                                    <hr />
                                </div>


                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold">
                                        <?php echo $udetails["fname"] . " " . $udetails["lname"] ?>
                                    </span>
                                    <br />
                                    <span class="fs-6"><?php echo $pdetails["users_email"]; ?></span>
                                    <br />
                                    <span class="fs-6"><?php echo $udetails["mobile"]; ?></span>
                                    <br />
                                </div>

                                <div class="col-12 mb-2">
                                    <div class="first_place"></div>
                                </div>

                            </div>
                        </div>
                    <?php
                                }
                    ?>

                    </div>

                </div>

            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
?>

    <script>
        alert("Please Sign In First");
        window.location = "adminSignin.php";
    </script>

<?php
}
?>