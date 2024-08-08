<?php

require "connection.php";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["co"];
$colour = $_POST["col"];
$qty = (int)$_POST["qty"];
$price = (int)$_POST["p"];
$dwc = (int)$_POST["dwc"];
$doc = (int)$_POST["doc"];
$description = $_POST["desc"];
$img1 = $_FILES["i1"];
$img2 = $_FILES["i2"];
$img3 = $_FILES["i3"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$state = 2;
$useremail = "dilrangalakshan890@gmail.com";

if ($category == "Select Category") {
    echo "Please select a category";
} elseif ($brand == "Select Brand") {
    echo "Please select a brand";
} elseif ($model == "Select Model") {
    echo "Please select a model";
} elseif (empty($title)) {
    echo "Please add a title";
} elseif (strlen($title) > 100) {
    echo "Title must contain 100 or less than 100 characters";
} elseif ($qty == "0" || $qty == "e") {
    echo "Please add the quantity of your product";
} elseif (!is_int($qty)) { //is_numeric To identify numbr or a numaric string
    echo "Please add a valid quantity";
} elseif (empty($qty)) {
    echo "Please add the quantity of your product";
} elseif ($qty < 0) {
    echo "Please add a valid quantity";
} elseif (empty($price)) {
    echo "Please add the price of your product";
} elseif (!is_int($price)) {
    echo "Please insert a valid price";
} elseif (empty($dwc)) {
    echo "Please add the delevery cost";
} elseif (!is_int($dwc)) {
    echo "Please insert a valid price";
} elseif (empty($doc)) {
    echo "Please add the delevery cost";
} elseif (!is_int($doc)) {
    echo "Please insert a valid price";
} elseif (empty($description)) {
    echo "Please enter the description of your product";
} else {


    $modelHasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' AND `model_id`='" . $model . "'; ");

    $n = $modelHasBrand->num_rows;
    if ($n == 0) {
        echo "The Product Doesn't Exists";
    } else {
        $f = $modelHasBrand->fetch_assoc();
        $modelHasBrand = $f["id"];

        Database::iud("INSERT INTO `product` (`category`,`model_has_brand_id`,`color_id`,`price`,`qty`,`description`,
        `title`,`condition_id`,`status_id`,`user_email`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,`status`) 
        VALUES ('" . $category . "','" . $modelHasBrand . "','" . $colour . "','" . $price . "','" . $qty . "','" . $description . "',
        '" . $title . "','" . $condition . "','" . $state . "','" . $useremail . "','" . $date . "','" . $dwc . "','" . $doc . "','1');");

        echo "Product Added Successfully";

        $last_id = Database::$connection->insert_id;

        if (isset($_FILES["i1"])) {
            $allowed_image_extention = array("image/jpeg", "image/jpg", "image/png", "image/svg");
            $fileex = $img1["type"];
            $fileex = $img2["type"];
            $fileex = $img3["type"];

            if (!in_array($fileex, $allowed_image_extention)) {
                echo "Please Select a valid image";
            } else {

                // $newimgextension;

                // if ($fileex = "image/jpeg") {
                //     $newimgextension = ".jpeg";
                // } elseif ($fileex = "image/jpg") {
                //     $newimgextension = ".jpg";
                // } elseif ($fileex = "image/png") {
                //     $newimgextension = ".png";
                // } elseif ($fileex = "image/svg") {
                //     $newimgextension = ".svg";
                // }

                $file_name1 = "resources//product_imgs//" . uniqid() . ".png";
                $file_name2 = "resources//product_imgs//" . uniqid() . ".png";
                $file_name3 = "resources//product_imgs//" . uniqid() . ".png";

                // echo $file_name1;
                // echo $file_name2;
                // echo $file_name3;

                move_uploaded_file($img1["tmp_name"], $file_name1);
                move_uploaded_file($img2["tmp_name"], $file_name2);
                move_uploaded_file($img3["tmp_name"], $file_name3);

                Database::iud("INSERT INTO `images` (`code`,`code2`,`code3`,`product_id`) 
                VALUES ('" . $file_name1 . "','" . $file_name2 . "','" . $file_name3 . "','" . $last_id . "')");
            }
        } else {
            echo "Please Select an Image";
        }
    }
}

// echo "<br/>";
// echo $imageFile;
