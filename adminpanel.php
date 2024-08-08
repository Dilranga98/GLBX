<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    $admin = $_SESSION["a"];

?>

    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="resources/logo.svg">
        <title>eShop | Dashboard</title>

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">

    </head>

    <body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%); min-height: 100vh;">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-2">
                    <div class="row">

                        <div class="d-flex align-items-start bg-dark">
                            <div class="col-12 text-center">

                                <label class="form-label text-white mt-5 fw-bold"><?php echo $admin["fname"] . " " . $admin["lname"]; ?></label>
                                <hr class="text-white">
                                <nav class="nav flex-column">
                                    <a class="nav-link active btn btn-primary" aria-current="page" href="#">Dashboard</a>
                                    <a class="nav-link" href="manageusers.php">Manage Users</a>
                                    <a class="nav-link" href="manageproducts.php">Manage Products</a>
                                </nav>
                                <hr class="text-white">
                                <a href="sellinghistory.php" class="form-label text-white fw-bold text-decoration-none">Selling History</a>
                                <hr class="text-white">
                                <span class="text-white">From date</span>
                                <input class="form-control" type="date" placeholder="Search From..." id="fromdate">
                                <span class="text-white">To date</span>
                                <input class="form-control mt-1" type="date" placeholder="Search To..." id="todate">

                                <div class="row">
                                    <div class="col-12  d-grid">
                                        <a href="" id="historylink" class="btn btn-primary mt-1" onclick="dailySellings();">View Selling</a>
                                    </div>
                                </div>

                                <!-- <hr class="text-white">
                                <a href="#" class="form-label text-white fw-bold text-decoration-none" onclick="dailySellings();">Daily Selling</a> -->
                                <hr class="text-white">
                                <hr class="text-white">

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-lg-10">
                    <div class="row">

                        <div class="col-12">
                            <label class="form-label text-white fw-bold fs-3 mt-2">Dashboard</label>
                        </div>

                        <hr>

                        <div class="col-12">
                            <div class="row row-cols-1 row-cols-md-3 g-1">

                                <div class="col">
                                    <div class="card h-100 bg-primary">
                                        <div class="card-body text-white text-center">
                                            <h5 class="card-title fw-bold">Daily Earnings</h5>

                                            <?php

                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";

                                            $invoicers = Database::search("SELECT * FROM `invoice` ");
                                            $in = $invoicers->num_rows;

                                            for ($x = 0; $x < $in; $x++) {
                                                $ir = $invoicers->fetch_assoc();

                                                $f = $f + $ir["qty"];

                                                $d = $ir["date"];
                                                $splitdate = explode(" ", $d);
                                                $pdate = $splitdate[0];

                                                if ($pdate == $today) {
                                                    $a = $a + $ir["total"];

                                                    $c = $c + $ir["qty"];
                                                }

                                                $spiltmonth = explode("-", $d);
                                                $pyear = $spiltmonth[0];
                                                $pmonth = $spiltmonth[1];

                                                // if ($pyear == $thisyear) {
                                                if ($pmonth == $thismonth && $pyear == $thisyear) {
                                                    $b = $b + $ir["total"];
                                                    $e = $e + $ir["qty"];
                                                }
                                                // }


                                            }

                                            ?>

                                            <p class="card-text">Rs.<?php echo $a; ?>.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 bg-white">
                                        <div class="card-body text-datk text-center">
                                            <h5 class="card-title fw-bold">Mothly Earnings</h5>
                                            <p class="card-text">Rs.<?php echo $b; ?>.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 bg-dark">
                                        <div class="card-body text-white text-center">
                                            <h5 class="card-title fw-bold">Today Selling</h5>
                                            <p class="card-text"><?php echo $c; ?> Items</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 bg-secondary">
                                        <div class="card-body text-white text-center">
                                            <h5 class="card-title fw-bold">Mothly Selling</h5>
                                            <p class="card-text"><?php echo $e; ?> Items</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 bg-success">
                                        <div class="card-body text-white text-center">
                                            <h5 class="card-title fw-bold">Total Selling</h5>
                                            <p class="card-text"><?php echo $f; ?> Items</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card h-100 bg-danger">
                                        <div class="card-body text-white text-center">
                                            <h5 class="card-title fw-bold">Total Engagements</h5>

                                            <?php

                                            $usersrs = Database::search("SELECT * FROM `users` ");
                                            $un = $usersrs->num_rows;

                                            ?>

                                            <p class="card-text"><?php echo $un; ?> Members</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr class="mt-3">

                        <div class="col-12 p-3 bg-dark">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center">
                                    <span class="text-white fw-bold">Total Active Time</span>
                                </div>

                                <?php

                                $startdate = new DateTime("2021-10-01 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);
                                $endDate = new DateTime($tdate->format("Y-m-d H:I:s"));

                                $difference = $endDate->diff($startdate);

                                ?>

                                <div class="col-12 col-lg-10 text-end">
                                    <span class="text-success fw-bold">
                                        <?php
                                        echo $difference->format('%Y') . " Years " . $difference->format('%M') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%I') . " Minutes " . $difference->format('%s') . " Seconds ";
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3 mb-5">
                            <div class="row g-4">

                                <div class="offset-1 col-10 col-lg-4 mt-3 rounded bg-light">
                                    <div class="row g-1">

                                        <?php

                                        $freq = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` 
                                        FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence` 
                                        DESC LIMIT 1");

                                        $freqnum = $freq->num_rows;

                                        for ($z = 0; $z < $freqnum; $z++) {
                                            $freqrow = $freq->fetch_assoc();

                                            $msp = $freqrow["product_id"];
                                            echo $msp;

                                            $prs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $msp . "' ");
                                            $pd = $prs->fetch_assoc();
                                        }

                                        ?>

                                        <div class="col-12 text-center">
                                            <label class="form-label fs-4 fw-bold">Mostly Sold Item</label>
                                        </div>
                                        <div class="col-12">
                                            <img src="resources/mobile images/iphone12.jpg" class="img-fluid">
                                        </div>
                                        <div class="col-12 text-center">
                                            <span class="fs-5 fw-bold"><?php echo $pd["title"]; ?></span><br>
                                            <span class="fs-6"><?php echo $e; ?> Items</span><br>
                                            <span class="fs-6">Rs.<?php echo $pd["price"]; ?>.00</span>
                                        </div>
                                        <div class="col-4 offset-4">
                                            <img src="resources/batch.svg" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="offset-1 col-10 col-lg-4 mt-3 rounded bg-light">
                                    <div class="row g-1">

                                        <div class="col-12 text-center">
                                            <label class="form-label fs-4 fw-bold">Mostly Famous Seller</label>
                                        </div>
                                        <div class="col-6 offset-3">
                                            <img src="resources/demoProfileImg.jpg" class="img-fluid">
                                        </div>

                                        <?php

                                        $selleremail = $pd["user_email"];

                                        $sellerrs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $selleremail . "' ");
                                        $sellerd = $sellerrs->fetch_assoc();

                                        ?>

                                        <div class="col-12 text-center">
                                            <span class="fs-5 fw-bold"><?php echo $sellerd["fname"] . " " . $sellerd["lname"]; ?></span><br>
                                            <span class="fs-6"><?php echo $sellerd["email"]; ?></span><br>
                                            <span class="fs-6"><?php echo $sellerd["mobile"]; ?></span>
                                        </div>
                                        <div class="col-4 offset-4">
                                            <img src="resources/batch.svg" class="img-fluid">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- footer -->
                <?php require "footer.php"; ?>
                <!-- footer -->

            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>

<?php
}

?>