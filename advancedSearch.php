<?php
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

    <title>eShop | Advanced Search</title>

</head>

<body class="bg-info">

    <div class="container-fluid">
        <div class="row">

            <!-- header -->
            <div class="col-12 bg-body border border-primary border-start-0 border-end-0 border-top-0">
                <div class="row">
                    <?php
                    require "header.php";
                    ?>
                </div>
            </div>
            <!-- header -->

            <div class="col-12 bg-white">
                <div class="row">
                    <div class="offset-0 offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2">
                                <div class="mb-3 logo"></div>
                            </div>
                            <div class="col-10 mt-2">
                                <label class="text-black-50 fw-bolder fs-4 mt-4">Advanced Search</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">
                    <div class="col-12 offset-0 col-lg-10 offset-lg-1">
                        <div class="row">

                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control shadow-none" type="search" placeholder="Type Keyword To Search..." id="k">
                                    </div>
                                    <div class="col-3 d-grid">
                                        <button class="btn btn-primary shadow-none" onclick="advancedSearch();">Search</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="border border-primary border-3">
                            </div>

                            <div class="col-12">
                                <div class="row g-2">

                                    <div class="col-md-4">
                                        <select class="form-select shadow-none" id="c">
                                            <option value="0">Select Category</option>
                                            <?php

                                            $category = Database::search("SELECT * FROM `category` ");
                                            $cn = $category->num_rows;

                                            for ($i = 0; $i < $cn; $i++) {
                                                $cd = $category->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $cd["id"] ?>"><?php echo $cd["name"]; ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select shadow-none" id="b">
                                            <option value="0">Select Brand</option>
                                            <?php

                                            $brand = Database::search("SELECT * FROM `brand` ");
                                            $bn = $brand->num_rows;

                                            for ($i = 0; $i < $bn; $i++) {
                                                $bd = $brand->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $bd["id"] ?>"><?php echo $bd["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select shadow-none" id="m">
                                            <option value="0">Select Model</option>
                                            <?php

                                            $model = Database::search("SELECT * FROM `model` ");
                                            $mn = $model->num_rows;

                                            for ($i = 0; $i < $mn; $i++) {
                                                $md = $model->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $md["id"] ?>"><?php echo $md["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="row g-2">

                                    <div class="col-md-6">
                                        <select class="form-select shadow-none" id="con">
                                            <option value="0">Select Condition</option>
                                            <?php

                                            $condition = Database::search("SELECT * FROM `condition` ");
                                            $con_n = $condition->num_rows;

                                            for ($i = 0; $i < $con_n; $i++) {
                                                $con_d = $condition->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $con_d["id"] ?>"><?php echo $con_d["name"]; ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select shadow-none" id="clr">
                                            <option value="0">Select Colour</option>
                                            <?php

                                            $color = Database::search("SELECT * FROM `color` ");
                                            $clr_n = $color->num_rows;

                                            for ($i = 0; $i < $clr_n; $i++) {
                                                $clr_d = $color->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $clr_d["id"] ?>"><?php echo $clr_d["name"]; ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="row g-2 mb-4">

                                    <div class="col-md-6">
                                        <input class="form-control shadow-none" type="text" placeholder="Price From" id="pf">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control shadow-none" type="text" placeholder="Price To" id="pt">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">
                    <div class="col-12 offset-0 col-lg-10 offset-lg-1 text-center">
                        <div class="row" id="viewResults">


                            <!-- pagination -->
                            <!-- <div class="col-12">
                                <div class="row">
                                    <div class="offset-4 col-4 text-center">
                                        <div class="offset-3 mb-5 pagination">
                                            <a href="#">&laquo;</a>
                                            <a href="#" class="active">1</a>
                                            <a href="#" class="">2</a>
                                            <a href="#">&raquo;</a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- pagination -->

                        </div>
                    </div>
                </div>
            </div>

            <?php
            require "footer.php";
            ?>

        </div>
    </div>



    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>