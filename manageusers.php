<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>

    <title>eShop | Manage Users</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body onload="searchUser();" style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%); min-height: 100vh;">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-primary">Manage All Users</label>
            </div>

            <div class="col-12 bg-light rounded">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" id="searchtxt" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-primary" onclick="searchUser();">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2">
                <div class="row">
                    <div class="col-lg-1 col-2 bg-primary text-white fw-bold p-2">
                        <span>#</span>
                    </div>
                    <div class="col-lg-2 bg-light fw-bold p-2 d-none d-lg-block">
                        <span>Profile Image</span>
                    </div>
                    <div class="col-lg-2 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                        <span>Email</span>
                    </div>
                    <div class="col-lg-2 col-10  bg-light fw-bold p-2">
                        <span>User Name</span>
                    </div>
                    <div class="col-lg-2 bg-primary text-white fw-bold p-2 d-none d-lg-block">
                        <span>Mobile</span>
                    </div>
                    <div class="col-lg-3 bg-light fw-bold p-2 d-none d-lg-block">
                        <span>Register Date</span>
                    </div>
                </div>
            </div>


            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $userrs = Database::search("SELECT * FROM `users` ");
            $d = $userrs->num_rows;

            $row = $userrs->fetch_assoc();

            $results_per_page = 20;

            $number_of_pages = ceil($d / $results_per_page);

            $page_first_result = ((int)$pageno - 1) * $results_per_page;

            $selectedrs = Database::search("SELECT * FROM `users` LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");

            $srn = $selectedrs->num_rows;

            // $c = "0";

            while ($srow = $selectedrs->fetch_assoc()) {

                // $c = $c + 1;
            ?>

                <div class="col-12 mt-2 mb-3" id="userView"></div>

            <?php
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

                            <!-- Modal -->
                            <div class="modal fade" id="msgmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">My Messages</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- message -->
                                            <div class="col-12 py-5 px-4">
                                                <div class="row rounded-lg overflow-hidden shadow">
                                                    <div class="col-5 px-0">
                                                        <div class="bg-white">

                                                            <div class="bg-gray px-4 py-2 bg-light">
                                                                <p class="h5 mb-0 py-1">Recent</p>
                                                            </div>

                                                            <div class="messages-box">
                                                                <div class="list-group rounded-0" id="rcv"></div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <!-- massage box -->
                                                    <div class="col-7 px-0">
                                                        <div class="row px-4 py-5 chat-box bg-white" id="chatrow">
                                                            <!-- massage load venne methana -->


                                                        </div>
                                                    </div>

                                                    <div class="offset-5 col-7">
                                                        <div class="row bg-white">

                                                            <!-- text -->
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="input-group">
                                                                        <input type="text" id="msgtxt" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                                                        <div class="input-group-append">
                                                                            <button id="button-addon2" class="btn btn-link fs-1" onclick="sendmessage('<?php echo $email; ?>');"> <i class="bi bi-cursor-fill"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- text -->

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- message-->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->

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
    <script src="bootstrap.js"></script>

</body>

</html>