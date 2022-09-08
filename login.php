<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatty - Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/chatty.css">
</head>

<body>
    <?php require_once "assets/php/header.php"  ?>
    <div class="container-lg">
        <main class="row">
            <form class="form card mt-5 p-5 col-lg-6 col-md-8 col-10 mx-auto " method="POST" action="#">
                <div class="h3 mb-3 font-weight-normal text-center">
                    <h2>
                        <i class="fa-solid fa-user"></i>
                        Login
                    </h2>
                    <p class="lead">
                        Do not have account? <a href="register.php">Register</a>
                    </p>
                </div>
                <input type="text" class="form-control mb-2" id="username" placeholder="Username or email address" name="usernameOrEmail" value="<?php echo $_POST["usernameOrEmail"] ?>" required autofocus>
                <input type="password" id="inputPassword" class="form-control mb-4" placeholder="Password" name="pass" value="<?php echo $_POST["pass"] ?>" required>
                <label class="mb-2"> <input type="checkbox" name="remMe" value="remMe" <?php echo $_POST["remMe"] ? "checked" : "" ?>> Remember me </label>
                <button class="btn btn-lg btn-primary btn-block my-1 shadow" type="submit">Sign in</button>

                <div class="text-danger text-center mt-4">
                    <?php
                    $__username = trim($_POST["usernameOrEmail"]);
                    $__password = $_POST["pass"];
                    $__remMe = $_POST["remMe"];
                    $userId = $pdo->getUserIdByUsername($__username);
                    if ($userId) {
                        require_once "assets/php/db/ChattyPDO.php";
                        $pdo = new ChattyPDO();
                        if (password_verify($__password, $pdo->getUserRowById($userId)["password"])) {
                            require_once "assets/php/db/user.php";
                            logUserIn($userId,  $__remMe ? 7 : 0.5);
                            header("Location: chat.php");
                        } else {
                            echo "Username and password do not match";
                        }
                    } else {
                        echo "Username and password do not match";
                    }
                    ?>
                </div>
            </form>
        </main>
    </div>

    <script>
        if (<?php echo isUserLoggedIn() ?>)
            window.location.replace("chat.php");
    </script>

    <?php require_once "assets/php/footer.php" ?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>