<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="col-12 offset-lg-1 col-lg-4 align-self-stat mt-1 mb-1">
        <span class="text-start label1"><b>Welcome</b>
            <?php

            if (isset($_SESSION["u"])) {

                $u = $_SESSION["u"];
            ?>
                <?php echo $u["fname"]; ?>
               
                <a class="text-start label2" onclick="signout();">Sign Out</a>
                
            <?php
            } else {

            ?>
                <a href="index.php">Sign in or register</a></span>
    <?php

            }


    ?> |
    <span class="text-start label2">Help and Contact</span> |

    </div>

    <div class="offset-lg-4 col-12 col-lg-2 align-self-end">
        <div class="row mt-1 mb-1">
            <div class="col-1 col-lg-2 mt-1">
                <a class="text-start label2" onclick="goToAddProduct();">Sell</a>
            </div>
            <div class="col-2 col-lg-6 dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    My eShop
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="watchlist.php">Wishlist</a></li>
                    <li><a class="dropdown-item" href="purchaseHistory.php">Purchase History</a></li>
                    <li><a class="dropdown-item" href="#">Message</a></li>
                    <li><a class="dropdown-item" href="sellerProductView.php">My Products</a></li>
                    <li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="#">My Selling</a></li>
                </ul>
            </div>
            <div class="col-1 col-lg-3 ms-5 ms-lg-0 carticon" style="cursor: pointer;" onclick="goToCart();"></div>
        </div>
    </div>

    <hr class="hrbreak1">

</body>

</html>