<?php

require "connection.php";

if (isset($_POST["k"])) {

    $k = $_POST["k"];
    $c = $_POST["c"];
    $b = $_POST["b"];
    $m = $_POST["m"];
    $con = $_POST["con"];
    $clr = $_POST["clr"];
    $pf = $_POST["pf"];
    $pt = $_POST["pt"];

    if (isset($_GET["page"])) {
        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

    $productrs = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%' ");
    $n = $productrs->num_rows;

    $results_per_page = 10;

    $number_of_pages = ceil($n / $results_per_page);

    $page_first_result = ((int)$pageno - 1) * $results_per_page;

    $product = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%' LIMIT " . $results_per_page . "  
    OFFSET " . $page_first_result . "  ");

    $productnum = $product->num_rows;

    for ($i = 0; $i < $productnum; $i++) {
        $productrow  = $productrs->fetch_assoc();
?>

        <!-- card -->
        <div class="card mb-3 col-12 col-lg-5 mt-3 ms-lg-5" style="max-width: 540px;">
            <div class="row g-0">

                <div class="col-md-4 mt-4">
                    <?php
                    $imgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $productrow["id"] . "' ");
                    $in = $imgrs->num_rows;

                    for ($z = 0; $z < $in; $z++) {
                        $ir = $imgrs->fetch_assoc();
                        $arr[$z] = $ir["code"];
                    }

                    ?>
                    <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start">
                    <?php

                    ?>

                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo $productrow["title"]; ?>.00</h5>
                        <span class="text-primary fw-bold">Rs.<?php echo $productrow["price"]; ?></span><br>
                        <span class="text-success fw-bold"><?php echo $productrow["qty"]; ?> Items Left</span>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6 d-grid g-1">
                                        <a href="#" class="btn btn-success shadow-none">Buy Now</a>
                                    </div>
                                    <div class="col-md-6 d-grid g-1">
                                        <a href="#" class="btn btn-danger shadow-none">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- card -->

        <?php

        if (!empty($k) && $c != 0) {

            $a = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%' AND `category`= '" . $c . "' ");
            $an = $a->num_rows;

            for ($i = 0; $i < $an; $i++) {
                $ad = $a->fetch_assoc();
        ?>

                <!-- card -->
                <div class="card mb-3 col-12 col-lg-5 mt-3 ms-lg-5" style="max-width: 540px;">
                    <div class="row g-0">

                        <div class="col-md-4 mt-4">
                            <?php
                            $imgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $ad["id"] . "' ");
                            $in = $imgrs->num_rows;

                            for ($z = 0; $z < $in; $z++) {
                                $ir = $imgrs->fetch_assoc();
                                $arr[$z] = $ir["code"];
                            }

                            ?>
                            <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start">
                            <?php

                            ?>

                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $ad["title"]; ?>.00</h5>
                                <span class="text-primary fw-bold">Rs.<?php echo $ad["price"]; ?></span><br>
                                <span class="text-success fw-bold"><?php echo $ad["qty"]; ?> Items Left</span>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6 d-grid g-1">
                                                <a href="#" class="btn btn-success shadow-none">Buy Now</a>
                                            </div>
                                            <div class="col-md-6 d-grid g-1">
                                                <a href="#" class="btn btn-danger shadow-none">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card -->
    <?php

            }
        } elseif (!empty($k) && $b != 0) {

            $brs = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%' AND 
            `model_has_brand_id` IN (SELECT `id` FROM `model_has_brand` WHERE `brand_id` = '" . $b . "' ) ");

            $num = $brs->num_rows;

            for ($v = 0; $v < $num; $v++) {
                $row = $brs->fetch_assoc();

                echo $row["title"];
            }
        } elseif (!empty($k) && $m != 0) {

            $brs = Database::search("SELECT * FROM `product` WHERE `description` LIKE '%" . $k . "%' AND 
            `model_has_brand_id` IN (SELECT `id` FROM `model_has_brand` WHERE `model_id` = '" . $m . "' ) ");
        }
    }

    ?>

    <div class="col-12 mt-3 mb-3">
        <div class="row">
            <div class="text-center">
                <div class="pagination">
                    <a href="<?php

                                if ($pageno <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($pageno - 1);
                                }

                                ?>">&laquo;</a>

                    <?php

                    for ($page = 1; $page <= $number_of_pages; $page++) {
                        if ($page == $pageno) {
                    ?>
                            <a class="ms-1 active" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                        <?php
                        } else {
                        ?>
                            <a class="ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                    <?php
                        }
                    }

                    ?>

                    <a href="<?php

                                if ($pageno >= $number_of_pages) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($pageno + 1);
                                }


                                ?>">&raquo;</a>
                </div>
            </div>
        </div>
    </div>

<?php
} else {
    echo "You must enter a keyword to search";
}
