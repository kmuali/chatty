<?php

function htmlToPlainText($s)
{
    foreach (["<" => "&lt;", ">" => "&gt;", " " => "&nbsp;"] as $origin => $replacement)
        $s = str_replace($origin, $replacement, $s);
    return nl2br($s);
}

function randomColor($userId)
{
    $i = $userId * 83 % 360;
    return "hsl($i, 80%, 33%)";
}

if ($_POST["q"] == "getMessages") {
    require_once "ChattyPDO.php";
    $pdo = new ChattyPDO();
    $messagesRows = $pdo->getMessages();
    if (!count($messagesRows)) {
        echo "<div class='text-center mt-5'>No messages,<br>Be the first !</div>";
    } else {
        foreach ($messagesRows as $messageRow) {
            $message = $messageRow["message"];
            $messageDate = date("F j, Y, g:i a", strtotime($messageRow["date"]));
            $userRow = $pdo->getUserRowById($messageRow["userId"]);
            $username = $userRow["username"];
            $fullName = $userRow["firstName"] . " " . $userRow["familyName"];
            $color = randomColor($messageRow["userId"]);
            echo    "<div class='row py-2 ps-1 border-bottom'>
                        <span class='col-auto font-italic' style='color: $color' title='$fullName'><strong>@$username</strong></span>
                        <span class='col'>$message</span>
                        <span class='col-auto opacity-50 mt-1 d-flex align-items-end'>
                            $messageDate
                        </span>
                    </div>";
        }
    }
} else {
    $__msg = trim($_POST["msg"]);
    if ($__msg) {
        require_once "user.php";
        require_once "ChattyPDO.php";
        $pdo = new ChattyPDO();
        $pdo->insertMessage(isUserLoggedIn(), htmlToPlainText($_POST["msg"]));
    }
}
