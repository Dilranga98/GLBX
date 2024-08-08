<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eShop Home</title>
    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- header -->

            <?php

            require "header.php";
            require "connection.php";

            ?>

            <!-- header -->

            <!-- search bar -->
            <div class="col-12 justify-content-center">
                <div class="row">
                    <div class="offset-lg-1 col-lg-1 offset-5 col-2 logoimg"></div>
                    <div class="col-6">
                        <div class="input-group mt-3 mb-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">

                            <select class="btn btn-outline-primary" id="basic_search_select">
                                <option value="0">Select Category</option>
                                <?php

                                $rs = Database::search("SELECT * FROM category;");

                                $n = $rs->num_rows;

                                for ($i = 0; $i < $n; $i++) {

                                    $cat = $rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $cat["id"]; ?>"><?php echo $cat["name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-2 d-grid gap-2">
                        <button class="btn btn-primary mt-3 searchbtn" onclick="basicSearch();">Search</button>
                    </div>
                    <div class="col-2 mt-4">
                        <a href="advancedSearch.php" class="link-secondary link1">Advanced</a>
                    </div>
                </div>
            </div>
            <!-- search bar -->

            <hr class="hrbreak1">

            <!-- slide -->
            <div class="col-8 offset-2 d-none d-lg-block">
                <div class="row">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/slider images/posterimg.jpg" class="d-block w-100">
                                <div class="carousel-caption d-none d-md-block postercaption">
                                    <h5 class="postertitle">Welcome to eShop</h5>
                                    <p class="postertxt">Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/posterimg2.jpg" class="d-block w-100">
                                <!-- <div class="carousel-caption d-none d-md-block postercaption">
                                    <h5 class="postertitle">First slide label</h5>
                                    <p class="postertxt">Some representative placeholder content for the first slide.</p>
                                </div> -->
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/posterimg3.jpg" class="d-block w-100">
                                <div class="carousel-caption d-none d-md-block postercaption1">
                                    <h5 class="postertitle">Be Free.....</h5>
                                    <p class="postertxt">Experiense the Lowest Costs with Us</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- slide -->

            <!-- product title view -->

            <?php

            $rs = Database::search("SELECT * FROM category;");

            $n = $rs->num_rows;

            for ($x = 0; $x < $n; $x++) {
                $c = $rs->fetch_assoc();
            ?>

                <div class="col-12">
                    <a class="link-dark link2" href="#"><?php echo $c["name"]; ?></a>&nbsp;&nbsp;
                    <a class="link-dark link3" href="#">See All &rarr;</a>
                </div>

                <?php

                $resultset = Database::search("SELECT * FROM `product` WHERE `category`='" . $c["id"] . "' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0;");
                ?>

                <!-- product view -->

                <div class="col-12">
                    <div class="row border border-primary">
                        <div class="col-10 offset-1">
                            <div class="row" id="pdetails">

                                <?php

                                $nr = $resultset->num_rows;
                                for ($y = 0; $y < $nr; $y++) {
                                    $prod = $resultset->fetch_assoc();

                                ?>

                                    <div class="col-6 col-md-3">
                                        <div class="card mt-1" style="width: 15rem;">

                                            <?php

                                            $pimage = Database::search("SELECT * FROM `images` WHERE product_id = '" . $prod["id"] . "'; ");
                                            $imgrow = $pimage->fetch_assoc();

                                            ?>
                                            <img src="<?php echo $imgrow["code"]; ?>" class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $prod["title"]; ?> <span class="badge bg-info">New</span></h5>
                                                <span class="card-text text-primary">Rs.<?php echo $prod["price"]; ?></span>
                                                <br>

                                                <?php

                                                if ((int)$prod["qty"] > 0) {
                                                ?>
                                                    <span class="card-text text-warning"><b>In Stock</b></span>
                                                    <input value="1" min="0" type="number" class="form-control mb-1" id="qtytxt<?php echo $prod['id']; ?>">
                                                    <a href="<?php echo "singleproductview.php?id=" . ($prod["id"]) ?>" class="btn btn-success">Buy Now</a>
                                                    <a href="#" class="btn btn-danger" onclick="addToCart(<?php echo $prod['id']; ?>);">Add to cart</a>
                                                    <a href="#" class="btn btn-secondary" onclick="addToWatchlist(<?php echo $prod['id'] ?>);"><i class="bi bi-heart-fill"></i></a>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="card-text text-danger"><b>Out of Stock</b></span>
                                                    <input value="1" type="number" class="form-control mb-1" disabled>
                                                    <a href="#" class="btn btn-success disabled">Buy Now</a>
                                                    <a href="#" class="btn btn-danger disabled">Add To Cart</a>
                                                <?php
                                                }

                                                ?>

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

                <!-- product view -->
            <?php
            }
            ?>
            <!-- product title view -->

            <!-- footer -->
            <?php

            require "footer.php";

            ?>
            <!-- footer -->

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>