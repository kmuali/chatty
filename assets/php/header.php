<?php
require_once "db/user.php";
$_ = explode("/", $_SERVER["SCRIPT_FILENAME"]);
define("CURRENT_PAGE", $_[count($_) - 1]);
function echoActiveIf($pageName)
{
    echo constant("CURRENT_PAGE") == $pageName ?  "active" : "";
}
function echoDNoneIf($pageName)
{
    echo (constant("CURRENT_PAGE") == $pageName || isUserLoggedIn()) ? "d-none" : "";
}
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow" aria-label="Navbar">
        <div class="container-lg">
            <a class="navbar-brand text-primary navbar-chatty" href="index.php">
                <i class="fa-solid fa-message"></i>
                <strong>Chatty</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echoActiveIf("things.php") ?>" href="things.php">Things to Know</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echoActiveIf("chat.php") ?>" href="chat.php">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echoActiveIf("about.php") ?>" href="about.php">About</a>
                    </li>
                </ul>
                <a href="login.php" class="<?php echoDNoneIf("login.php") ?>">
                    <button class="btn btn-primary col-12 col-lg-auto mb-lg-0 mb-2 me-lg-2" type="submit">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Login
                    </button>
                </a>
                <a href="register.php" class="<?php echoDNoneIf("register.php") ?>">
                    <button class="btn btn-secondary col-12 col-lg-auto" type="submit">
                        <i class="fa-solid fa-user-plus"></i>
                        Register
                    </button>
                </a>

                <?php
                require_once "assets/php/db/ChattyPDO.php";
                require_once "assets/php/db/user.php";
                $pdo = new ChattyPDO();
                try {
                    $row = $pdo->getUserRowById(isUserLoggedIn());
                } catch (\Throwable $th) {
                    echo nl2br($th);
                }
                // echo isUserLoggedIn();
                ?>
                <div class="text-light col-12 col-lg-auto mb-lg-0 mb-2 me-lg-3 <?php echo isUserLoggedIn() ? "" : "d-none" ?>"
                title="<?php echo $row["firstName"] ." ". $row["familyName"] ?>">
                    <i class="fa-solid fa-at"></i>
                    <strong>
                        <?php echo $row["username"] ?>
                    </strong>
                </div>
                <a href="assets/php/db/user.php?logUserOut=<?php echo constant("CURRENT_PAGE") ?>" class="<?php echo isUserLoggedIn() ? "" : "d-none" ?>">
                    <button class="btn btn-secondary col-12 col-lg-auto" type="submit">
                        Logout
                    </button>
                </a>
            </div>
        </div>
    </nav>
</header>
<?php
// echo "<table>";
// foreach ($_SERVER as $key => $value) {
//     echo "<tr><td>$key</td><td>$value</td></tr>";
// }
// echo "</table>";
?>