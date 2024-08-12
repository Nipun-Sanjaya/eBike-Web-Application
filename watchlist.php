<?php
require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cart | watchlist</title>

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



            <?php require "header.php";

            if (isset($_SESSION["u"])) {
                $u = $_SESSION["u"]["email"];
            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border-1 border-secondary rounded ">
                            <div class="row">
                                <div class="col-2 offset-5 bg-black">
                                    <label class="form-label fs-1 fw-bolder text-warning">watchlist &hearts;</label>
                                </div>
                               
                                <div class="col-12 ">
                                    <hr class="hr-break-1" />
                                </div>
                                <div class="col-11 col-lg-2 border-0 border-end border-4 border-primary ">
                                    <!-- breadcum & -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item "><a class="text-white fs-3" href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active text-white fs-3" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>

                                    <nav class=" nav  nav-pills flex-column">
                                        <a class="nav-link active text-white fs-3" aria-current="page" href="#"> My Watchlist</a>
                                        <a class="nav-link text-white fs-3" href="cart.php">My Cart</a>
                                       

                                    </nav>
                                    <!-- breadcum & -->
                                </div>
                                <?php
                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `users_email`='" . $u . "'");
                                $watchlist_num = $watchlist_rs->num_rows;

                                if ($watchlist_num == 0) {
                                ?>
                                    <!-- no items -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">
                                                    You have no items in your watchList yet.
                                                </label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3 ">
                                                <a href="home.php" class="btn btn-warning fs-3 fw-bold ">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- no items -->
                                <?php
                                } else {
                                ?>
                                    <!-- have products -->

                                    <div class="col-12 col-lg-9">

                                        <div class="row g-2">

                                            <?php
                                            for ($x = 0; $x < $watchlist_num; $x++) {
                                                $watchlist_data = $watchlist_rs->fetch_assoc();
                                                $product_id=$watchlist_data["product_id"];
                                                $product_rs=Database::search("SELECT * FROM `product` WHERE `id`='".$product_id."'");
                                                 $product_data = $product_rs->fetch_assoc();
                                                $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                                                $img_data = $img_rs->fetch_assoc();
                                            ?>


                                                <!-- card -->
                                                <div class="card mb-3 mx-0 mx-lg-2 col-12"style="background-color: rgb(5, 65, 80)">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <img src="<?php echo $img_data["code"] ?>" class="img-fluid rounded-start" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">
                                                                <h5 class="card-title fw-bold fs-2 text-success"><?php echo $product_data["title"]; ?></h5>
                                                                <span class="fs-5  fw-bold text-white">Colour : Blue</span>
                                                                &nbsp; &nbsp;| &nbsp;&nbsp;
                                                                <span class="fs-5  fw-bold text-white">Condition : Brand New</span>
                                                                <br />
                                                                <span class="fs-5  fw-bold text-white">Price :</span> &nbsp; &nbsp;
                                                                <span class="fs-5 fw-bold text-info">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                                                <br />
                                                                <span class="fs-5  fw-bold text-white">Quantity :</span> &nbsp; &nbsp;
                                                                <span class="fs-5 fw-bold text-warning"><?php echo $product_data["qty"]; ?> Items Available</span>
                                                                <br />
                                                                <span class="fs-5  fw-bold text-white">Seller :</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-white">Nipun</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-4">
                                                            <div class="card-body d-grid d-lg-grid">
                                                                <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]) ?>' class="btn btn-outline-success mb-2 fw-bold">Buy Now</a>
                                                                <a href="cart.php" class="btn btn-outline-secondary mb-2 fw-bold">Add to cart</a>
                                                                <a  class="btn btn-outline-danger fw-bold" onclick="removeFromWatchlist(<?php echo $watchlist_data['id']; ?>);">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card -->


                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>

                                    <!-- have products -->

                                <?php
                                }
                                ?>



                            </div>
                        </div>
                    </div>
                </div>
                <?php require "footer.php"; ?>

        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>
<?php
            } else {

                echo "Please Sign In OR Register.";
        }
?>

</html>

