<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["u"])) {
        $data = $_SESSION["u"];
    ?>
        <div class="col-12 main-body">
            <div class="row mt-1 mb-1">



                <nav class="navbar navbar-expand-lg navbar-light bg-light main-body">
                    <a class="navbar-brand text-warning" href="#">Ebike</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse col-10" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="home.php">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="userprofile.php">MyProfile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="watchlist.php">WishList</a>
                            </li>
                            <div class="col-2 col-lg-6 dropdown">
                                <button class="btn btn-light dropdown-toggle  bg-secondary text-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    My eBike
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                                    <li><a class="dropdown-item" href="sellingHistory.php">My Sellings</a></li>
                                    <li><a class="dropdown-item" href="myProducts.php">My Products</a></li>
                                    <li><a class="dropdown-item" href="watchlist.php">Wish List</a></li>
                                    <li><a class="dropdown-item" href="purchasehistory.php">Purchase History</a></li>
                                    <li><a class="dropdown-item" href="message.php?email=<?php echo $data["email"]; ?>">Messages</a></li>
                                    <li><a class="dropdown-item" href="#">Saved</a></li>
                                </ul>
                            </div>
                        </ul>
                        <div class="col-12 col-lg-7 offset-lg-2 align-self-start">

                            <span class="text-lg-start label1 text-white"><b>Welcome</b>



                                <?php echo $data["fname"]; ?>
                            </span>

                            <span class="text-lg-start label2 text-warning" onclick="Signout(); text-white">Sign Out</span>


                        <?php
                    } else {

                        ?>
                            <a href="index.php">Sign In or Register</a>
                        <?php

                    }

                        ?>

                        |
                        <span><a class=" text-lg-start label2 text-warning" href="message.php?email=<?php echo $data["email"]; ?>">Help and Contact</a></span> |



                        </div>

                    </div>
                    <div class="col-1 ">
                        <div class="col-1 col-lg-3  ms-5 ms-lg-0 mt-1 cart-icon text-light" onclick="cart();"><i class="bi bi-cart-fill"></i>
                        </div>

                    </div>
                </nav>

            </div>

        </div>


        <script src="bootstrap.bundle.js"></script>

</body>

</html>