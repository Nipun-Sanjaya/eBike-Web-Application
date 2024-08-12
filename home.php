<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>eBike | Home</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

</head>

<body class="main-body">

    <div class="container-fluid">
        <div class="row">

            <?php

            require "header.php";

            ?>

            <hr class="hr-break-1 text-light" />

            <div class="col-12 justify-content-center">
                <div class="row mb-3">

                    <div class="col-4 col-lg-1 offset-4 offset-lg-1 logo-img">
                        <br /><br /><br />
                        <p class="text-light fw-bold text-center">Welcome To eBike</p>
                    </div>

                    <div class="col-8 col-lg-6">
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt" />

                            <select class="btn btn-outline-light" id="basic_search_select">
                                <option value="0" readonly>Select Category</option>

                                <?php

                                $categoryrs = Database::search("SELECT * FROM `category`");
                                $num = $categoryrs->num_rows;

                                for ($x = 0; $x < $num; $x++) {

                                    $cd = $categoryrs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $cd["id"] ?>"><?php echo $cd["name"]; ?></option>

                                <?php

                                }

                                ?>




                            </select>

                        </div>
                    </div>

                    <div class="col-2 d-grid gap-2">
                        <button class="btn btn-secondary mt-3 search-btn" onclick="basicSearch(0);">Search</button>
                    </div>

                    <div class="col-2 mt-4">
                        <a href="advancedSearch.php" class="link-secondary link-1 text-light">Advanced</a>
                    </div>

                </div>
            </div>

            <hr class="hr-break-1 text-white" />
            <div class="col-12 col-lg-12">

                <div class="row justify-content-center gap-2">
                    <span class="text-center text-white fs-2">Where do you want to ride?</span>
                    <div class="card border-white" style="width: 18rem; background-color: rgb(5, 65, 80);">

                        <img src="resources/road.gif" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text text-white fs-4 text-center">Open Roads</p>
                        </div>
                    </div>
                    <div class="card border-white" style="width: 18rem; background-color: rgb(5, 65, 80);">

                        <img src="resources/city.gif" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text text-white fs-4 text-center">Cities,Towns,neighbourhoods</p>
                        </div>
                    </div>
                    <div class="card border-white" style="width: 18rem; background-color: rgb(5, 65, 80);">

                        <img src="resources/Racing2.gif" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text text-white fs-4 text-center">Racing</p>
                        </div>
                    </div>
                    <div class="card border-white" style="width: 18rem; background-color: rgb(5, 65, 80);">

                        <img src="resources/mountain.gif" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text text-white fs-4 text-center">Gravel roads & trails or cyclocross</p>
                        </div>
                    </div>
                    <div class="card border-white" style="width: 18rem; background-color: rgb(5, 65, 80);">

                        <img src="resources/elect.gif" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text text-white fs-4 text-center">Electric-Bike</p>
                        </div>
                    </div>
                    <div class="card border-white" style="width: 18rem; background-color: rgb(5, 65, 80);">

                        <img src="resources/kid-riding-bike.gif" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text text-white fs-4 text-center">Kids Bike</p>
                        </div>
                    </div>
                    <span class="text-center text-white fs-2">You Can Get Any Bike With Us...</span>
                </div>
            </div>
            <br />
            <hr class="text-white" />
            <div class="col-12" id="basicSearchResult">

                <div id="carouselExampleDark" class="col-8 offset-2 carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="resources/slider images/Slider1 (3).jpg" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block poster-caption">
                                <h5 class="poster-title fw-bold text-white ">Welcome to eBike...</h5>
                                <p class="poster-text fw-bold text-white ">The World's Best Online Bicycle By One Click </p>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="resources/slider images/slider2 .jpg" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block poster-caption">
                                <h4 class="poster-title fw-bold text-white">life is free</h4>
                                <p class="poster-text fw-bold text-black text-white">The best offers and discounts are now available from us</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="resources/slider images/slider3.jpg" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block poster-caption">
                                <h5 class="poster-title fw-bold">Any Time Get your Bicycle... </h5>
                                <p class="poster-text fw-bold text-black">xperience the Lowest Delivery Costs With Us.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <?php
                $categoryrs = Database::search("SELECT * FROM `category`");
                $num = $categoryrs->num_rows;

                for ($y = 0; $y < $num; $y++) {

                    $d = $categoryrs->fetch_assoc();

                ?>

                    <!-- Category name -->
                    <div class="col-12">
                        <a href="#" class="link-dark link2 text-light"><?php echo $d["name"]; ?></a>&nbsp;&nbsp;
                        <a href="#" class="link-dark link3 text-light">See All&nbsp; &rarr;</a>
                    </div>
                    <!-- Category name -->

                    <!-- Products -->

                    <div class="col-12 mb-3">

                        <div class="row border border-primary">

                            <div class="col-12 col-lg-12">

                                <div class="row justify-content-center gap-2">

                                    <?php

                                    $productrs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $d["id"] . "' AND `status_id`= '1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                                    $pn = $productrs->num_rows;

                                    for ($z = 0; $z < $pn; $z++) {

                                        $pd = $productrs->fetch_assoc();

                                    ?>

                                        <div class="card col-6 col-lg-2 mt-2 mb-2 border-light border-3 rounded" style="width: 18rem; background-color: rgb(5, 65, 80);"><br />

                                            <?php

                                            $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pd["id"] . "'");
                                            $image = $imagers->fetch_assoc();

                                            ?>




                                            <img src="<?php echo $image["code"];  ?>" class="card-img-top card-img-top img-thumbnail border-primary border-3 rounded" style="width:200px ;" />
                                            <div class="card-body ms-0 m-0">
                                                <h5 class="card-title fw-bold text-lg-end text-info">Title:- <?php echo $pd["title"];  ?></h5>

                                                <hr class="text-white hr" />
                                                <span class="badge bg-danger fs-6">New</span><br />
                                                <span class="card-text text-white">Rs. <?php echo $pd["price"];  ?></span>
                                                <br />


                                                <?php

                                                if ($pd["qty"] > 0) {

                                                ?>

                                                    <span class="card-text text-warning"><b>Out of Stock</b></span>
                                                    <br />
                                                    <span class="card-text text-primary fw-bold "><?php echo $pd["qty"];  ?> Items Available</span>
                                                    <a href='<?php echo "singleProductView.php?id=" . ($pd["id"]) ?>' class="btn btn-outline-success fw-bold col-12 ">Buy Now</a>
                                                    <a href="#" onclick="addToCart(<?php echo $pd['id']; ?>);" class="btn btn-outline-danger col-12 mt-1 fw-bold">Add to Cart</a>




                                                <?php



                                                } else {
                                                ?>

                                                    <span class="card-text text-danger"><b>Out of Stock</b></span>
                                                    <br />
                                                    <span class="card-text text-success fw-bold">00 Items Available</span>
                                                    <a href="#" class="btn btn-outline-success fw-bold col-12 disabled ">Buy Now</a>
                                                    <a href="#" class="btn btn-outline-danger fw-bold col-12 mt-1 disabled ">Add to Cart</a>


                                                <?php
                                                }

                                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE
                                                `product_id` = '" . $pd["id"] . "' AND `users_email` = '" . $_SESSION["u"]["email"] . "'");
                                                $watchlist_num = $watchlist_rs->num_rows;

                                                if ($watchlist_num == 1) {
                                                ?>
                                                    <a class="btn btn-outline-warning col-12 mt-1  rounded" onclick='addToWatchlist(<?php echo $pd["id"]; ?>);'>
                                                        <i class="bi bi-heart-fill fs-5 text-danger" id="heart<?php echo $pd["id"]; ?>"></i></a>
                                                <?php

                                                } else {
                                                ?>
                                                    <a class="btn btn-outline-warning col-12 mt-1  rounded" onclick='addToWatchlist(<?php echo $pd["id"]; ?>);'>
                                                        <i class="bi bi-heart-fill fs-5 text-white " id="heart<?php echo $pd["id"]; ?>"></i></a>
                                                <?php

                                                }

                                                ?>

                                            </div>
                                        </div>


                                    <?php



                                    }

                                    ?>

                                    

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Products -->


                <?php

                }

                ?>


            </div>

            <?php

            require "footer.php";

            ?>
            
            
        </div>
    </div>

    <script src="script.js"></script>

    <div class="barra-redes">
                                        <ul class="ul">
                                            <li>
                                                <a href="http://www.facebook.com/" target="_blank" title="Facebook" class="links fa fa-facebook"></a>
                                            </li>

                                            <li>
                                                <a href="https://www.twitter.com/" target="_blank" title="Twitter" class="links fa fa-twitter"></a>
                                            </li>

                                            <li>
                                                <a href="https://www.instagram.com/" target="_blank" title="Instagram" class="links fa fa-instagram"></a>
                                            </li>

                                            <li>
                                                <a href="https://www.google.com/" target="_blank" title="Google +" class="links fa fa-google"></a>
                                            </li>

                                            <li>
                                                <a href="https://www.gmail.com/" target="_blank" title="Email" class="links fa fa-envelope"></a>
                                            </li>
                                        </ul>
                                    </div>


</body>


</html>