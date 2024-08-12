<?php
require "connection.php";
session_start();
?>

<!DOCTYPE html>
<html>

<head>

    <title>eShop | Admin| Manage Users</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body class="main-body">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-light text-center ">
                <h2 class="text-warning fw-bold">Manage All Users</h2>
            </div>

          

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-secondary py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2  bg-light py-2 d-none  d-lg-block">
                        <span class="fs-4 fw-bold ">Profile Image</span>
                    </div>
                    <div class="col-4 col-lg-2 bg-secondary py-2 ">
                        <span class="fs-4 fw-bold text-white">User Name</span>
                    </div>
                    <div class="col-4 col-lg-2 bg-light py-2 d-lg-block">
                        <span class="fs-4 fw-bold ">Email</span>
                    </div>
                    <div class="col-2  bg-secondary py-2 d-none d-lg-block ">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>
                    <div class="col-2  bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-2 col-lg-1 bg-white"></div>


                </div>
            </div>

            <!--  -->

            <?php

            $page_no;
            if (isset($_GET["page"])) {
                $page_no = $_GET["page"];
            } else {
                $page_no = 1;
            }

            $user_rs = Database::search("SELECT * FROM `users` ");
            $user_num = $user_rs->num_rows;
            $result_per_page = 10;
            $number_of_page = ceil($user_num / $result_per_page);
            $page_first_result = ((int)$page_no - 1) * $result_per_page;

            $view_user_rs = Database::search("SELECT * FROM `users` LIMIT  " . $result_per_page . " OFFSET " . $page_first_result);
            $view_result_num = $view_user_rs->num_rows;
            $c = 0;

          

           

            ?>

            <?php
            while ($user_data = $view_user_rs->fetch_assoc()) {
                $c = $c + 1;
                
            ?>





                <?php
                $images_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $user_data["email"] . "' ");
                $images_num = $images_rs->num_rows;
                $image_data = $images_rs->fetch_assoc();
                $userEmail = $image_data["users_email"];

                
                ?>


                <div class="col-12 mb-3">
                    <div class="row">

                        <div class="col-2 col-lg-1 bg-secondary py-2 text-end">
                            <span class="fs-5 fw-bold text-white"><?php echo $user_data["id"];  ?></span>
                        </div>



                        <div class="col-2  bg-light py-2 d-none  d-lg-block" onclick="ViewAdminMessage('<?php echo $userEmail  ?>')" >
                            
                            <?php
                            if ($images_num == 1) {
                            ?>
                                <img src="<?php echo $image_data["path"] ?>" style="height: 40px; margin-left: 80px;" />
                            <?php
                            } else {
                            ?>
                                <img src="resources/profile_img/62eaa573359cd.png" style="height: 40px; margin-left: 80px;" />
                            <?php
                            }
                            ?>


                        </div>

                        <div class="col-4 col-lg-2 bg-secondary py-2 ">
                            <span class="fs-5 fw-bold text-white"><?php echo $user_data["fname"] . " " . $user_data["lname"];  ?></span>
                        </div>

                        <div class="col-4 col-lg-2 bg-light py-2 d-lg-block">
                            <span class="fs-5 fw-bold " ><?php echo $user_data["email"];  ?></span>
                        </div>

                        <div class="col-2  bg-secondary py-2 d-none d-lg-block ">
                            <span class="fs-5 fw-bold text-white"><?php echo $user_data["mobile"];  ?></span>
                        </div>

                        <div class="col-2  bg-light py-2 d-none d-lg-block">
                            <span class="fs-5 fw-bold"><?php echo $user_data["joined_date"]; ?></span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white py-2  d-grid">

                            <?php

                            $s = $user_data["status_id"];
                            if ($s == "1") {
                            ?>
                                <button class="btn btn-warning" onclick="blockuser(<?php echo $user_data['id']; ?>);" id="blockuser<?php echo $user_data['id']; ?>">Unblock</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-warning" onclick="blockuser(<?php echo $user_data['id']; ?>);" id="blockuser<?php echo $user_data['id']; ?>">Block</button>
                            <?php
                            }
                            ?>

                        </div>



                    </div>
                </div>
                <!--  -->

            <?php

            }
            ?>
            <a href="<?php

                        if ($page_no >= $number_of_page) {
                            echo "#";
                        } else {
                            echo "?page=" . ($page_no + 1);
                        }

                        ?>">


                &raquo;</a>
            <!-- pagination -->
            <div class="col-12 text-center">
                <div class="pagination">
                    <a href="<?php if ($page_no <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no - 1);
                                } ?>">&laquo;</a>

                    <?php
                    for ($page = 1; $page <= $number_of_page; $page++) {

                        if ($page == $page_no) {

                    ?>

                            <a href="<?php echo "?page=" . ($page); ?>" class="active"><?php echo $page ?></a>

                        <?php
                        } else {
                        ?>

                            <a href="<?php echo "?page=" . ($page); ?>"><?php echo $page ?></a>

                    <?php
                        }
                    }
                    ?>

                    <a href="<?php
                                if ($page_no >= $number_of_page) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no + 1);
                                }

                                ?>">

                        &raquo;</a>
                </div>
            </div>
            <!-- pagination -->

            <!-- modal -->
           
            <!-- modal -->
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>