<?php

session_start();
require "connection.php";

$text = $_GET["s"];

if ($text == "") {
    $userrs = Database::search("SELECT * FROM `users` ");
} else {
    $userrs = Database::search("SELECT * FROM `users` WHERE `email` LIKE '%" . $text . "%' ");
}

$row = $userrs->num_rows;
$c = "0";
for ($i = 0; $i < $row; $i++) {
    $u = $userrs->fetch_assoc();
    $c = $c + 1;

    $user_image = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '".$u["email"]."' ");
    $uin = $user_image->num_rows;

?>

    <div class="row mt-1">
        <div class="col-lg-1 col-2 bg-primary text-white fw-bold pt-2" onclick="viewmsgmodal();">
            <span><?php echo $c; ?></span>
        </div>
        <div class="col-lg-2 bg-light fw-bold d-none d-lg-block">
            <div class="row">
                <div class="col-4">

                    <?php
                    if ($uin > 0) {
                        $uid = $user_image->fetch_assoc();
                    ?>
                        <img src="<?php echo $uid["code"] ?>" class="img-fluid">
                    <?php
                    } else {
                    ?>
                        <img src="resources/emptyPofileImage.png" class="img-fluid">
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="col-lg-2 bg-primary text-white fw-bold pt-2 d-none d-lg-block">
            <span><?php echo $u["email"]; ?></span>
        </div>
        <div class="col-lg-2 col-10 bg-light fw-bold pt-2">
            <span><?php echo $u["fname"] . " " . $u["lname"]; ?></span>
        </div>
        <div class="col-lg-2 bg-primary text-white fw-bold pt-2 d-none d-lg-block">
            <span><?php echo $u["mobile"]; ?></span>
        </div>
        <div class="col-lg-3 bg-light fw-bold pt-2 d-none d-lg-block">
            <div class="row">
                <div class="col-8">
                    <span>
                        <?php
                        $rd = $u["register_date"];
                        $splitrd = explode(" ", $rd);
                        echo $splitrd[0];
                        ?>
                    </span>
                </div>
                <div class="col-4 d-grid text-end">
                    <?php

                    $s = $u["status"];

                    if ($s == "1") {
                    ?>
                        <button id="blockbtn<?php echo $u['email']; ?>" class="btn btn-danger" onclick="blockuser('<?php echo $u['email']; ?>');">Block</button>
                    <?php
                    } else {
                    ?>
                        <button class="btn btn-success" onclick="blockuser('<?php echo $u['email']; ?>');">Unblock</button>
                    <?php
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>

<?php

}
