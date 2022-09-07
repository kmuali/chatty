<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatty - Registration</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/chatty.css">
</head>

<body>
    <?php require_once "assets/php/header.php" ?>

    <div class="container-lg mt-5">
        <div class="row">
            <main class="col-xl-8 col card p-md-3 p-lg-5 p-2 mx-xl-0 mx-lg-0 mx-5">
                <div class="py-3 px-lg-5  text-center text-xl-start">
                    <h2><i class="fa-solid fa-user-plus me-2"></i>Create Account</h2>
                    <p class="lead">Already have account? <a href="login.php">Login</a></p>
                </div>


                <form class="px-lg-5 row" method="post" id="register" onsubmit="return postAll()">
                    <div class="col-sm-6 mb-3 form-group">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" name="firstName" placeholder="John" value="" autofocus>
                    </div>
                    <div class="col-sm-6 mb-3 form-group">
                        <label for="familyName" class="form-label">Family name</label>
                        <input type="text" class="form-control" name="familyName" placeholder="Doe" value="">
                    </div>
                    <div class="col-12 mb-3 form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="col-sm-6 mb-3 form-group">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pass" placeholder="Password" value="">
                    </div>
                    <div class="col-sm-6 mb-3 form-group">
                        <label for="rePass" class="form-label">Re-enter password</label>
                        <input type="password" class="form-control" name="rePass" placeholder="Password" value="">
                    </div>
                    <div class="col-12 mb-3 form-group">
                        <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" name="email" placeholder="john@example.org">
                    </div>
                    <div class="col mb-3 form-group">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control form-select" name="gender">
                            <option value="">Not selected</option>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                    </div>
                    <div class="col mb-5 form-group">
                        <label for="dob" class="form-label">Date of birth</label>
                        <input type="date" class="form-control" name="dob">
                    </div>
                    <button class="col-12 btn btn-primary btn-lg shadow" type="submit">Create Account</button>
                </form>

                <script src="assets/js/register.ajax.js"></script>

            </main>
            <div class="col d-xl-flex d-none justify-content-end align-items-center text-end opacity-75">
                <p class="display-1 font-italic text-primary">
                    <i class="fa-regular fa-message opacity-25"></i>
                    <br>
                    <i class="fa-regular fa-message opacity-50"></i>
                    <br>
                    <i class="fa-regular fa-message opacity-75"></i>
                    <br>
                    <strong>Chatty</strong>
                    <br>
                    <small class="display-4 opacity-75">A simple chat</small>
                </p>
            </div>
        </div>
    </div>



    <?php require_once "assets/php/footer.php" ?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.min.js"></script>
</body>

</html>