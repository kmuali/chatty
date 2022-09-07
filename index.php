<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatty</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/chatty.css">

</head>

<body>
    <?php
    require_once "assets/php/header.php";
    date_default_timezone_set('Africa/Egypt');
    ?>

    <div class="container mt-5 text-center">
        <div>
            <h1 class="display-2">
                <img class="col-md-2 col-3" src="assets/img/cat-walking.gif" alt="">
                <br>
                Welcome to Chatty!
            </h1>
            <p class="display-5 opacity-75">Try our services</p>
        </div>

        <div class="row justify-content-center gap-5 mt-5">
            <a href="things.php" class="col-lg-3 col-5 btn btn-lg btn-outline-primary card shadow p-xl-5 p-4
                                        justify-content-center align-items-center d-flex">
                <div class="display-6">
                    <i class="fa-solid fa-star"></i>
                    <br>
                    Things to Know
                </div>
            </a>
            <a href="chat.php" class="col-lg-3 col-5 btn btn-lg btn-outline-primary card shadow p-xl-5 p-4 
                                        justify-content-center align-items-center d-flex">
                <div class="display-6">
                    <i class="fa-solid fa-message"></i>
                    <br>
                    Chat Room
                </div>
            </a>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.min.js"></script>
</body>

</html>