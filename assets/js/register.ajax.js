
// creating a feedback div for each form-group 
var postResponse;
var form = document.getElementById("register");
var formGroups = form.getElementsByClassName("form-group");
for (let formGroup of formGroups) {
    let formControl = formGroup.getElementsByClassName("form-control")[0];
    formControl.setAttribute((["gender", "dob"].includes(formControl.getAttribute("name")) ? "onchange" : "onkeyup"), `post(this)`);
    let e = document.createElement("div");
    e.className = "text-danger";
    e.id = formControl.name;
    formGroup.appendChild(e);
}

function postAll() {
    let http = new XMLHttpRequest();
    http.open("POST", "assets/php/db/register.ajax.php", true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == 1) {
                window.location.replace("chat.php");
            }
            else {
                let a = document.getElementsByClassName("form-control");
                console.log("SUBMISSION FAILURE DUE: " + this.responseText);
                post(a[a.length - 1]);
            }
        }
    }
    let q = "q=1";
    for (const formControl of form.getElementsByClassName("form-control")) {
        q += "&" + encodeURI(formControl.name) + "=" + encodeURI(formControl.value);
    }
    http.send(q);
    return false;
}

// validates a form-group
function post(input) {
    let http = new XMLHttpRequest();
    http.open("POST", "assets/php/db/register.ajax.php", true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            [id, msg] = this.responseText.split('$');
            document.getElementById(id).innerHTML = msg;
            for (let i of document.getElementsByClassName("form-control")) {
                if (i.name == id) {
                    if (msg) {
                        i.classList.add("is-invalid");
                        i.classList.remove("is-valid");
                    } else {
                        i.classList.add("is-valid");
                        i.classList.remove("is-invalid");
                    }
                    break;
                } else {
                    post(i);
                }
            }
        }
    };
    let q = `${input.name}=${encodeURI(input.value)}`;
    if (input.name == "rePass")
        for (const i of document.getElementById("register").getElementsByClassName("form-control"))
            if (i.name == "pass") {
                q += "&z=" + encodeURI(i.value);
                break
            }
    // console.log(q);
    http.send(q);
}