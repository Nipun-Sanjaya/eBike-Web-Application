<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>eShop | Admins | Sign In</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="col-12 main-body">

    <div class="container-fluid justify-content-center" style="margin-top:100px;">
        <div class="row align-content-center">

            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01 text-light">Hi, Welcome to eShop Admins.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 p-5">
                <div class="row">

                    <div class="col-6 d-none d-lg-block background main-body"></div>

                    <div class="col-12 col-lg-6 d-block">
                        <div class="row g-3">

                            <div class="col-12 ">
                                <p class="title02 text-light">Sing In to your account.</p>
                            </div>

                            <div class="col-12">
                                <label class="form-label text-light">Email</label>
                                <input type="email" class="form-control" id="em"/>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-warning" onclick="adminVerification();">Send Verification Code to Login</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger">Back to Customer Login</button>
                            </div>
                            <hr/><hr/><hr/>
                            <div class="col-12 text-center d-none d-lg-block fixed-bottom main-body">
                                <p class="fw-bold text-black-50">&copy; 2022 eShop.lk All Rights Reserved.</p>
                            </div>

                            <!-- modal -->

                            <div class="modal" tabindex="-1" id="verificationModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Admin Verification</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label">Enter the ferification code you got by an email</label>
                                            <input type="text" class="form-control" id="vcode"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- modal -->

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>