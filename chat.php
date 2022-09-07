<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatty - Chat</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/chatty.css">
    <link rel="stylesheet" href="assets/css/chat.css">
</head>

<body>
    <?php require_once "assets/php/header.php"  ?>

    <div class="container mt-4">
        <div class="card bg-light">
            <div class="card-header lead text-center">
                <i class="fa-regular fa-comments"></i>
                Chatting Room <span class="opacity-50">(Refreshed automatically every 5 seconds)</span>
            </div>
            <div class="chat-body card-body lead overflow-auto" id="cardBodyDiv">
                <!-- Auto generated from AJAX requests -->
            </div>
            <div class="card-footer lead text-center">
                <div class="chat-body d-none" id="emojiButtonsDiv">
                    <div class="container h-100 pb-2 align-items-end d-flex overflow-auto">
                        <div class="row h-100">
                            <?php
                            for ($i = 128512; $i < 128512 + 80; $i++) {
                                echo "<button class=\"col-xl-1 col-lg-2 col-md-3 col-4 btn btn-light btn-lg border\">&#$i;</button>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <form class="row <?php echo isUserLoggedIn() ? "" : "d-none" ?>" onsubmit="return sendForm()">
                    <div class="input-group">
                        <textarea rows="1" cols="3" type="text" class="form-control w-50" id="msg" placeholder="Enter your message" autofocus></textarea>
                        <button class="input-group-prepend btn btn-outline-warning text-dark m-0 border" onclick="toggleEmojis()" type="button">
                            <span class="d-xl-inline d-none">Emoji</span>
                            <i class="fa-solid fa-smile"></i>
                        </button>
                        <!-- <button class="input-group-prepend btn  btn-outline-info text-dark m-0 border" type="button">
                            <span class="d-xl-inline d-none">Image</span>
                            <i class="fa-solid fa-image"></i>
                        </button> -->
                        <button class="input-group-prepend btn btn-primary m-0" type="submit">
                            <span class="d-lg-inline d-none">Send</span>
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
                <div class="lead <?php echo isUserLoggedIn() ? "d-none" : "" ?>">
                    <i class="fa-solid fa-lock"></i>
                    <h5 class="m-0 d-inline">The chat is available only for our users.</h5>
                    <br>
                    Want to join? <a href="register.php">Register</a> or <a href="login.php">login</a> if you already have an account.
                </div>
            </div>
        </div>
    </div>

    <?php require_once "assets/php/footer.php" ?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <script src="assets/js/chat.ajax.js"></script>

</body>

</html>