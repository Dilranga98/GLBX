<?php

require "connection.php";

$searchText = $_GET["t"];
$searchSelect = $_GET["s"];

$aray;

if (!empty($searchText) && $searchSelect == 0) {

    $textSearch = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $searchText . "%' ");
    $n = $textSearch->num_rows;

    if ($n >= 1) {

        for ($i = 0; $i < $n; $i++) {
            $row = $textSearch->fetch_assoc();
            $img = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $row["id"] . "' ");
            $n1 = $img->num_rows;
            if ($n1 >= 1) {
               $row1 = $img->fetch_assoc();
               $row["img"] = $row1["code"];
            }

            $aray[$i] = $row;

        }

        echo json_encode($aray);

    }
} elseif ($searchSelect != 0 && empty($searchText)) {
} elseif (!empty($searchText) && $searchSelect != 0) {
} else {
}

?>
