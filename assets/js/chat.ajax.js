let cardBodyDiv = document.getElementById("cardBodyDiv");
let emojiButtonsDiv = document.getElementById("emojiButtonsDiv");
let msgInput = document.getElementById("msg");

for (const button of emojiButtonsDiv.getElementsByTagName("button")) {
    button.addEventListener("click", e => { msgInput.value += button.innerHTML; })
}

var isOn = false;
function toggleEmojis() {
    if (isOn = !isOn) {
        emojiButtonsDiv.classList.remove("d-none");
        cardBodyDiv.classList.add("d-none");
    } else {
        emojiButtonsDiv.classList.add("d-none");
        cardBodyDiv.classList.remove("d-none");
    }
}


function scrollChatBody() {
    setTimeout(() => {
        cardBodyDiv.scrollTo(0, cardBodyDiv.scrollHeight);
    }, 300);
}

function sendForm() {
    let http = new XMLHttpRequest();
    http.open("POST", "assets/php/db/chat.ajax.php", true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("chat.ajax.php ==>\n" + this.responseText)
        }
    }
    http.send(`msg=${encodeURI(msgInput.value)}`);
    refreshMessages();
    isOn = true;
    toggleEmojis();
    if (msgInput.value) {
        msgInput.value = "";
        setTimeout(() => {
            refreshMessages();
        }, 300);
    }
    return false;
}

function refreshMessages() {
    let http = new XMLHttpRequest();
    http.open("POST", "assets/php/db/chat.ajax.php", true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            cardBodyDiv.innerHTML = this.responseText;
        }
    }
    http.send(`q=getMessages`);
    scrollChatBody();
    return false;
}

refreshMessages();
setInterval(function () {
    refreshMessages();
}, 60_000);

scrollChatBody();