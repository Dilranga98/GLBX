<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/logo.svg">
    <title>eShop | Admin</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%); min-height: 100vh;">

    <div class="container-fluid">
        <div class="row">

            <div class="offset-3 col-6 col-md-2 offset-md-5 mt-5">
                <div class="row">
                    <div class="col-6 offset-3">
                        <img src="resources/logo.svg">
                    </div>
                </div>
            </div>

            <div class="col-12 text-center mt-2">
                <h2>Hi, Welcome to eShop Admins</h2>
            </div>

            <div class="col-12 mt-5">
                <div class="row">

                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <img src="resources/background.svg">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="row p-2">
                            <div class="col-12">
                                <h4>Sign In To Your Account</h4>
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label">Email</label>
                                <input class="form-control shadow-none" type="text" id="e">
                            </div>
                            <div class="col-12">
                                <div class="row g-2 mt-1">
                                    <div class="col-lg-6 d-grid">
                                        <button class="btn btn-primary shadow-none" onclick="adminVerification();">Send Verification Code To Login</button>
                                    </div>
                                    <div class="col-lg-6 d-grid">
                                        <button class="btn btn-danger shadow-none">Back To User's Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="verificationmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter the verification code you gt by an Email</label>
                            <input type="text" class="form-control" id="v">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->

            <div class="col-12 d-none d-lg-block fixed-bottom">
                <p class="text-center">&copy; 2021 eShop.lk All Right Reserved</p>
            </div>

        </div>
    </div>

    <script src="bootstrap.js"></script>
    <script src="script.js"></script>

</body>

</html>