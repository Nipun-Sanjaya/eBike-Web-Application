<?php
require "connection.php";

?>

<!DOCTYPE html>
<html lang>

<head>

    <title> eShop | Manage Products</title>
</head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />

<link rel="icon" href="resources/logo.svg" />
<link rel="stylesheet" href="bootstrap.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="style.css" />

<body class="main-body">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-12 bg-light text-center">
                <h2 class="text-warning fw-bold">Manage All Products</h2>
            </div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-secondary  py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold ">Product Image</span>
                    </div>
                    <div class="col-4  col-lg-2 bg-secondary py-2 ">
                        <span class="fs-4 fw-bold  text-white ">Title</span>
                    </div>
                    <div class="col-4  col-lg-2 bg-light py-2 ">
                        <span class="fs-4 fw-bold ">Price</span>
                    </div>
                    <div class="col-2   bg-secondary py-2  d-none d-lg-block">
                        <span class="fs-4 fw-bold  text-white ">Quantity</span>
                    </div>
                    <div class="col-2  bg-light py-2  d-none d-lg-block ">
                        <span class="fs-4 fw-bold ">Registerd Datas</span>
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

            $product_rs =  Database::search("SELECT * FROM `product`");
            $product_num = $product_rs->num_rows;
            $result_per_page = 10;
            $number_of_page = ceil($product_num / $result_per_page);
            $page_first_result = ((int)$page_no - 1) * $result_per_page;

            $view_product_rs =      Database::search("SELECT * FROM `product` LIMIT  " . $result_per_page . " OFFSET " . $page_first_result);
            $view_result_num = $view_product_rs->num_rows;
            $c = 0;

            ?>

            <?php
            while ($product_data = $view_product_rs->fetch_assoc()) {
                $c = $c + 1;

            ?>
                <!--  -->
                <div class="col-12 mb-3">
                    <div class="row">

                        <div class="col-2 col-lg-1 bg-secondary py-2 text-end">
                            <span class="fs-5 fw-bold text-white"><?php echo $product_data["id"]; ?></span>
                        </div>
                        <?php
                        $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                        $image_data = $images_rs->fetch_assoc();
                        ?>

                        <div class="col-2  bg-light py-2 d-none  d-lg-block" onclick="viewProductModal(<?php echo $product_data['id']; ?>);">
                            <img src="<?php echo $image_data["code"]; ?>" style="height: 40px; margin-left: 80px;" onclick="viewprodcutsinglemodal(<?php echo $product_data['id'];  ?>);" />
                        </div>

                        <div class="col-4 col-lg-2 bg-secondary py-2 ">
                            <span class="fs-5 fw-bold text-white"><?php echo $product_data["title"]  ?></span>
                        </div>

                        <div class="col-4 col-lg-2 bg-light py-2 d-lg-block">
                            <span class="fs-5 fw-bold ">Rs. <?php echo $product_data["price"]  ?>.00</span>
                        </div>

                        <div class="col-2  bg-secondary py-2 d-none d-lg-block ">
                            <span class="fs-5 fw-bold text-white"><?php echo $product_data["qty"]  ?></span>
                        </div>

                        <div class="col-2  bg-light py-2 d-none d-lg-block">
                            <span class="fs-6 fw-bold">
                                <?php
                                $row = $product_data["datetime_added"];
                                $splited = explode(" ", $row);
                                echo $splited["0"];
                                ?>
                            </span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white py-2  d-grid">

                            <?php
                            $s = $product_data["status_id"];
                            if ($s == "1") {
                            ?>
                                <button class="btn btn-warning" onclick="block(<?php echo $product_data['id']; ?>);" id="block<?php $product_data['id']; ?>">Unblock</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-warning" onclick="block(<?php echo $product_data['id']; ?>);" id="block<?php $product_data['id']; ?>">Block</button>
                            <?php
                            }
                            ?>


                        </div>
                    </div>
                </div>
                <!--  -->
                <!-- single product -->
                <div class="modal" tabindex="-1" id="viewpModal<?php echo $product_data['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $product_data["title"] ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="text-center">

                                    <img src="<?php echo $image_data["code"] ?>  " class="img-fluid" style="height: 250px;" /><br />
                                    <span class="fs-5 fw-bold">Price</span>&nbsp;
                                    <span class="fs-5">Rs. <?php echo $product_data["price"] ?> .00</span> <br />
                                    <span class="fs-5 fw-bold">Quantity</span>&nbsp;
                                    <span class="fs-5"> <?php echo $product_data["qty"] ?></span> <br />
                                </div>
                            </div>
                            <div class="modal-footer">

                                <div class="col-12">
                                    <div class="row">


                                        <div class="offset-8 col-4 d-grid">
                                            <button class="btn btn-primary" onclick="closepModel();">Close</button>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- single product -->
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


            <hr />

            <div class="col-12  text-center bg-black ">
                <h3 class="text-warning fw-bold ">Manage Category</h3>
            </div>
            <hr/>
            <br />
            <div class="col-12 mb-3 ">
                <div class="row g-2">

                    <?php

                    $category_rs = Database::search("SELECT * FROM `category`");
                    $category_num = $category_rs->num_rows;

                    for ($i = 0; $i < $category_num; $i++) {
                        $category_data = $category_rs->fetch_assoc();

                    ?>

                        <div class="col-12 col-lg-3 border border-danger bg-info" style="height: 50px;">
                            <div class="row">

                                <div class="col-8 mt-2">
                                    <label class="form-label fw-bold fs-5"><?php echo $category_data["name"]; ?></label>
                                </div>
                                <div class="col-4 border-start border-secondary text-center mt-2">
                                    <label  for="form-label fs-4" onclick="deleteFromCategory(<?php echo $category_data['id']; ?>);"><span id="boot-icon" class="bi bi-trash" style="font-size: 2rem; color: rgb(255, 0, 0);"></span></label>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                    <div class="col-12 col-lg-3 border border-danger" onclick="addNewCategory();" style="height: 50px; background-color: rgb(248, 196, 128);">
                        <div class="row">
                            <div class="col-8 mt-2">
                                <label class="form-label fw-bold fs-5">Add New Category</label>
                            </div>
                            <div class="col-4 border-start border-secondary text-center mt-2">
                                <label class="form-label fs-4 "><span id="boot-icon" class="bi bi-shield-fill-plus" style="font-size: 2rem; color: rgb(0, 0, 255);"></span></label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- modal 2 -->
            <div class="modal" tabindex="-1" id="addCategoryModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label>New Category Name : </label>
                                <input type="text" class="form-control" id="n" />
                            </div>
                            <div class="col-12">
                                <label>Your Email Address : </label>
                                <input type="text" class="form-control" id="e" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="categroyVerifyModal();">Add Category</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 2 -->

            <!-- modal 3 -->
            <div class="modal" tabindex="-1" id="addCategoryModelVerification">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label class="form-label">Verification Code : </label>
                                <input type="text" class="form-control" id="vtxt" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                            <button type="button" class="btn btn-primary" onclick="saveCategory();">Verify & Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 3 -->

            <hr>

            <div class="col-12  text-center  bg-black">
                <h3 class="text-warning fw-bold ">Manage Brand</h3>
            </div>
            <hr/>
            <br />
            <div class="col-12 mb-3 ">
                <div class="row g-2">

                    <?php

                    $brand_rs = Database::search("SELECT * FROM `brand`");
                    $brand_num = $brand_rs->num_rows;

                    for ($i = 0; $i < $brand_num; $i++) {
                        $brand_data = $brand_rs->fetch_assoc();

                    ?>

                        <div class="col-12 col-lg-3 border border-danger " style="height: 50px; background-color: rgb(95, 250, 160);">
                            <div class="row">

                                <div class="col-8 mt-2">
                                    <label class="form-label fw-bold fs-5"><?php echo $brand_data["name"]; ?></label>
                                </div>
                                <div class="col-4 border-start border-secondary text-center mt-2">
                                    <label  for="form-label fs-4" onclick="deleteFromBrand(<?php echo $brand_data['id']; ?>);"><span id="boot-icon" class="bi bi-trash" style="font-size: 2rem; color: rgb(255, 0, 0);"></span></label>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                    <div class="col-12 col-lg-3 border border-danger" onclick="addNewbrand();" style="height: 50px; background-color: rgb(248, 196, 128);">
                        <div class="row">
                            <div class="col-8 mt-2">
                                <label class="form-label fw-bold fs-5">Add New Brand</label>
                            </div>
                            <div class="col-4 border-start border-secondary text-center mt-2">
                                <label class="form-label fs-4 "><span id="boot-icon" class="bi bi-shield-fill-plus" style="font-size: 2rem; color: rgb(0, 0, 255);"></span></label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- modal 2 -->
            <div class="modal" tabindex="-1" id="addBrandModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Add New Brand</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label>New Brand Name : </label>
                                <input type="text" class="form-control" id="nb" />
                            </div>
                            <div class="col-12">
                                <label>Your Email Address : </label>
                                <input type="text" class="form-control" id="eb" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="brandVerifyModal();">Add Brand</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 2 -->

            <!-- modal 3 -->
            <div class="modal" tabindex="-1" id="addBrandModelVerification">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label class="form-label">Verification Code : </label>
                                <input type="text" class="form-control" id="vtxtb" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                            <button type="button" class="btn btn-primary" onclick="saveBrand();">Verify & Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 3 -->

            <hr>

            <div class="col-12  text-center bg-black ">
                <h3 class="text-warning fw-bold ">Manage Model</h3>
            </div>
            <hr/>
            <br />
            <div class="col-12 mb-3 ">
                <div class="row g-2">

                    <?php

                    $model_rs = Database::search("SELECT * FROM `model`");
                    $model_num = $model_rs->num_rows;

                    for ($i = 0; $i < $model_num; $i++) {
                        $model_data = $model_rs->fetch_assoc();

                    ?>

                        <div class="col-12 col-lg-3 border border-danger" style="height: 50px;background-color: rgb(227, 195, 251);">
                            <div class="row">

                                <div class="col-8 mt-2">
                                    <label class="form-label fw-bold fs-5"><?php echo $model_data["name"]; ?></label>
                                </div>
                                <div class="col-4 border-start border-secondary text-center mt-2">
                                    <label  for="form-label fs-4" onclick="deleteFromModel(<?php echo $model_data['id']; ?>);"><span id="boot-icon" class="bi bi-trash" style="font-size: 2rem; color: rgb(255, 0, 0);"></span></label>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                    <div class="col-12 col-lg-3 border border-danger " onclick="addNewModel();" style="height: 50px; background-color: rgb(248, 196, 128);">
                        <div class="row">
                            <div class="col-8 mt-2">
                                <label class="form-label fw-bold fs-5">Add New Model</label>
                            </div>
                            <div class="col-4 border-start border-secondary text-center mt-2">
                                <label class="form-label fs-4 "><span id="boot-icon" class="bi bi-shield-fill-plus" style="font-size: 2rem; color: rgb(0, 0, 255);"></span></label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- modal 2 -->
            <div class="modal" tabindex="-1" id="addModelModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Add New Modal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label>New Modal Name : </label>
                                <input type="text" class="form-control" id="nm" />
                            </div>
                            <div class="col-12">
                                <label>Your Email Address : </label>
                                <input type="text" class="form-control" id="em" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="modelVerifyModal() ();">Add Model</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 2 -->

            <!-- modal 3 -->
            <div class="modal" tabindex="-1" id="addModelModelVerification">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label class="form-label">Verification Code : </label>
                                <input type="text" class="form-control" id="vtxtm" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                            <button type="button" class="btn btn-primary" onclick="saveModel();">Verify & Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 3 -->

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>