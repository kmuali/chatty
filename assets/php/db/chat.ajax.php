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
        echo "<div class='text-center opacity-25'><small>Start of chat</small></div>";
        $lastUsername = "";
        foreach ($messagesRows as $messageRow) {
            $message = $messageRow["message"];
            // SQL Date : Y-m-d H:i:s
            $messageTime = strtotime($messageRow["date"]);
            if (date("Y-m-d") == date("Y-m-d", $messageTime)) // same day then no need for date, hour and minute only
                $messageDate = date("g:i a", $messageTime);
            else
                $messageDate = date("Y-m-d, g:i A");
            $userRow = $pdo->getUserRowById($messageRow["userId"]);
            $username = $userRow["username"];
            $fullName = $userRow["firstName"] . " " . $userRow["familyName"];
            $hideUsername = $username == $lastUsername ? "invisible" : "";
            $lastUsername = $username;
            $color = randomColor($messageRow["userId"]);
            echo    "<div class='row py-2 ps-1 border-top'>
                        <span class='col-auto font-italic $hideUsername' style='color: $color' title='$fullName'><strong>@$username</strong></span>
                        <span class='col'>$message</span>
                        <small class='col-auto opacity-25 mt-1 d-flex align-items-end'>
                            $messageDate
                        </small>
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
