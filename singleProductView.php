<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];
    $product_rs = Database::search("SELECT product.id,product.category_id,product.model_has_brand_id,product.title,product.price,product.qty
    ,product.description,product.condition_id,product.status_id,product.users_email,model.name AS mname ,brand.name AS bname FROM product INNER JOIN
    model_has_brand ON model_has_brand.id = product.model_has_brand_id INNER JOIN  brand ON brand.id = model_has_brand.brand_id 
    INNER JOIN model ON model.id = model_has_brand.model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();





?>








        <!DOCTYPE html>
        <html>

        <head>

            <title>eBike | Single Product View</title>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="icon" href="resources/logo.svg" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />
        </head>

        <body>


            <div class="container-fluid">
                <div class="row">
                    <?php require "header.php" ?>

                    <div class="col-12 mt-0 bg-white singleproduct" style=" background-color: rgb(5, 65, 80)">
                        <div class="row">
                            <div class="col-10 offset-1 " style="padding: 11px;  background-color: rgb(5, 65, 80)">
                                <div class="row">



                                    <div class="col-12 col-lg-3 order-2 order-lg-1 bg-secondary">
                                        <ul>
                                            <?php

                                            $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");

                                            $product_img_num = $product_img_rs->num_rows;
                                            $img = array();


                                            if ($product_img_num != 0) {
                                                for ($x = 0; $x < $product_img_num; $x++) {
                                                    $product_img_data = $product_img_rs->fetch_assoc();

                                                    $img[$x] = $product_img_data["code"];
                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                        <img src="<?php echo $img["$x"] ?>" class="img-thumbnail mt-1 mb-1" style="height: 200px;" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x;  ?>);" />
                                                    </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>

                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>

                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>

                                            <?php

                                            }


                                            ?>


                                        </ul>
                                    </div>
                                    <div class="col-lg-9 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="row">
                                            <div class="col-12 align-items-center border border-1 border-secondary">
                                                <div class="mainImg" id="mainImg"></div>
                                            </div>
                                        </div>

                                    </div>



                                </div>
                            </div>
                            <div class="col-10 offset-1">
                                <div class="row">
                                    <div class="col-12 col-lg-12 order-3" style=" background-color: rgb(5, 65, 80)">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row  border-bottom border-dark">
                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                            <li class="breadcrumb-item active text-white" aria-current="page">
                                                                Single Product View
                                                            </li>
                                                        </ol>
                                                    </nav>
                                                </div>
                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 fw-bold  text-info "><?php echo $product_data["title"] ?></span>
                                                    </div>
                                                </div>
                                                <div class="row border-bottom  border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill  text-warning fs-5"></i>
                                                            <i class="bi bi-star-half  text-warning fs-5"></i>
                                                            &nbsp;&nbsp;&nbsp;

                                                            <label class="fs-5 text-white fw-bold">4.5 Stars | 35 Ratings And Reviews</label>

                                                        </span>
                                                    </div>
                                                </div>

                                                <div class=" row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <?php
                                                        $price = $product_data["price"];
                                                        $addingPrice = ($price / 100) * 5;
                                                        $newprice = $price + $addingPrice;
                                                        $difference = $newprice - $price;
                                                        $percentage = ($difference / $price) * 100;
                                                        ?>
                                                        <span id="unitPrice" class="fs-4 fw-bold text-white">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                                        <br />
                                                        <span class="fs-4 fw-bold text-danger"><del>Rs.<?php echo $newprice; ?> .00</del></span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-white">Save Rs.<?php echo $difference; ?>.00 (<?php echo $percentage; ?>%)</span>
                                                    </div>
                                                </div>

                                                <div class="row  border-bottom border-dark">
                                                    <div class="col-12">
                                                        <span class="fs-5 text-primary"><b>Warenty :</b> 6 Months warrenty</span>
                                                        <br />
                                                        <span class="fs-5 text-primary"><b>Return Policy :</b> 1 Months return policy</span>
                                                        <br />
                                                        <span class="fs-5 text-primary"><b>In-stock :</b> <?php echo $product_data["qty"]; ?> Items Available</span>
                                                        <br />

                                                    </div>
                                                </div>
                                                <div class="row border-bottom border-dark">
                                                    <div class=" col-12 my-2">
                                                        <div class="row g-2">
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-4 text-info "><b>Seller :</b> Nipun</span>
                                                            </div>
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-4 text-danger "><b>Sold :</b>10 Items</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 ">
                                                        <div class="row">
                                                            <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-1 border-danger rounded">
                                                                <div class="row ">
                                                                    <div class="col-3 col-lg-2 border-end border-1 border-danger">
                                                                        <img src="resources/discount.jpg " class="img-thumbnail mt-1 mb-1">
                                                                        <p class="text-warning fs-2">Special a chance to get <?php echo $percentage; ?>% discount by using VISA or MASTER</p>
                                                                        <img src="resources/bunny-hop-nigel-sylvester.gif " class="img-thumbnail mt-1 mb-1">
                                                                    </div>
                                                                    <div class="col-9 col-lg-10">
                                                                        <img src="resources/bikediscount.jpg " class="img-thumbnail mt-1 mb-1">


                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 ">
                                                        <div class="row">
                                                            <div class="col-12 my-3">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-primary bg-white rounded overflow-hidden float-start mt-1 position-relative product_qty">
                                                                        <div class="col-12">
                                                                            <span>Quantity : </span>
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start " style="outline: none;" pattern="[0-9]" value="1" onkeyup='check_value(<?php echo $product_data["qty"] ?>);' id="qtyInput" />

                                                                            <div class="position-absolute qty_buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty_inc ">
                                                                                    <i class="bi bi-caret-up text-info fs-5" onclick='qty_inc(<?php echo $product_data["qty"] ?>)'></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1 border-secondary qty_dec">
                                                                                    <i class="bi bi-caret-down text-info fs-5" onclick="qty_dec();"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12 mt-5 bg-white">
                                                                            <div class="row">

                                                                                <?php
                                                                                if ($product_data["qty"] == 0) {
                                                                                ?>
                                                                                    <div class="col-4 d-grid">
                                                                                        <button  class="btn btn-outline-success" disabled>Buy Now(No Product Available )</button>
                                                                                    </div>
                                                                                <?php
                                                                                } else{
                                                                                ?>
                                                                                    <div class="col-4 d-grid">
                                                                                        <button onclick="a(<?php echo $pid ?>);" class="btn btn-outline-success">Buy Now</button>
                                                                                    </div>
                                                                                <?php
                                                                                }
                                                                                ?>


                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn btn-outline-primary" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to Cart</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <?php

                                                                                    $watchlist_rs = Database::search("SELECT *  FROM `watchlist` WHERE 
                                                                                    `product_id`='" . $product_data["id"] . "' AND `users_email`='" . $_SESSION["u"]["email"] . "'");
                                                                                    $watchlist_num = $watchlist_rs->num_rows;

                                                                                    if ($watchlist_num == 1) {
                                                                                    ?>
                                                                                        <a class="btn btn-outline-warning col-12 mt-1" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);"><i class="bi bi-heart-fill fs-5 text-danger" id="heart<?php echo $product_data['id'];  ?>"></i></a>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                        <a class="btn btn-outline-secondary col-12 mt-1" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);"><i class="bi bi-heart-fill fs-5 text-primary" id="heart<?php echo $product_data['id'];  ?>"></i></a>

                                                                                    <?php
                                                                                    }
                                                                                    ?>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-2 offset-6">
                                        <span class="fs-3 fw-bold text-info">Related Items </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 main-body ">
                                <div class="row g-2">


                                    <?php
                                    $related_rs = Database::search("SELECT * FROM `product` WHERE
                                     `model_has_brand_id`='" . $product_data["model_has_brand_id"] . "' LIMIT 6 ");

                                    $brand_rs = Database::search("SELECT `brand`.`name` AS 'bname', `model`.`name`AS 'mname'  FROM `brand` INNER JOIN `model_has_brand` ON  `brand`.`id`=`model_has_brand`.`brand_id` INNER JOIN `model` ON 
                                    `model`.`id`=`model_has_brand`.`model_id` INNER JOIN `product` ON `product`.`model_has_brand_id`=`model_has_brand`.`id` WHERE `product`.`id`='" . $pid . "'");
                                    $brand_data = $brand_rs->fetch_assoc();

                                    $related_num = $related_rs->num_rows;
                                    for ($y = 0; $y < $related_num; $y++) {
                                        $related_data = $related_rs->fetch_assoc();
                                    ?>

                                        <div class=" offset-1 offset-lg-0 col-4 col-lg-2">
                                            <div class="card" style="width: 18rem;background-color: rgb(5, 65, 80)">
                                                <img src="<?php echo $product_img_data["code"] ?>" class="card-img-top" />
                                                <div class="card-body">
                                                    <h4 class="card-title text-info"><?php echo $related_data["title"] ?></h4>
                                                    <span class="fs-5 fw-bold text-white">Rs.<?php echo $related_data["price"] ?>.00</span>
                                                    <div class="col-12">
                                                        <div class="row  g-1">
                                                            <div class="col-12 d-grid">
                                                                <button onclick="a(<?php echo $pid ?>);" class="btn btn-warning">Buy Now</button>
                                                            </div>
                                                            <div class="col-12 d-grid">
                                                                <button onclick="addToCart(<?php echo $product_data['id']; ?>);" class="btn btn-warning">Add to Cart</button>
                                                            </div>
                                                            <div class="col-12 d-grid">
                                                                <button class="btn btn-warning">
                                                                    <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }


                                    ?>


                                </div>
                            </div>

                            <hr class="text-dark">

                            <div class="col-12 main-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="col-12">
                                            <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark ">
                                                <div class="col-12">
                                                    <span class="fs-4 fw-bold text-white">Product Details</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 bg-white">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="form-label fs-4 fw-bold ">Brand :</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <label class="form-label fs-4"> <?php echo $brand_data["bname"] ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="form-label fs-4 fw-bold ">Model :</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <label class="form-label fs-4"><?php echo $brand_data["mname"] ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label class="form-label fs-4 fw-bold ">Description :</label>
                                                        </div>
                                                        <div class="col-12">
                                                            <textarea cols="60" rows="10" class="form-control " disabled><?php echo $product_data["description"] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 main-body">
                                        <div class="col-12 bg-white ">
                                            <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                                <div class="col-12">
                                                    <span class="fs-3 fw-bold">Feedbacks...</span>
                                                </div>
                                            </div>
                                            <?php

                                            $feedbackrs = Database::search("SELECT * FROM `feedback` WHERE `product_id` ='" . $product_data["id"] . "' ");
                                            $fn = $feedbackrs->num_rows;
                                            if ($fn == 0) {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label ">There are no Feedbacks to View...</label>
                                                </div>

                                                <?php

                                            } else {

                                                for ($i = 0; $i < $fn; $i++) {
                                                    $fd = $feedbackrs->fetch_assoc();
                                                ?>

                                                    <div class="col-12 bg-white">
                                                        <div class="row g-1 ">
                                                            <div class="col-12 col-lg-4  m-2 border border-1 border-danger rounded">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <span class="fs-6 fw-bold text-primary"><?php echo $_SESSION["u"]["fname"];  ?></span>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-6 text-dark"><?php echo $fd["feed"];  ?></span>
                                                                    </div>
                                                                    <div class="col-12 text-end">
                                                                        <span class="text-black-50"><?php echo $fd["date"]; ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }


                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <?php require "footer.php" ?>

                </div>
            </div>


            <script src="script.js"></script>
        </body>

        </html>

<?php

    } else {
        echo "Sorry for the inconvenient.";
    }
} else {
    echo "Something went wrong. ";
}


?>