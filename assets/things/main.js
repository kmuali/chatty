let menu_btn = document.getElementById("manu_buttons");
let sideNav = document.getElementById("sideNav");
let menu = document.getElementById("menu");

sideNav.style.right = "-250px";

menu_btn.onclick = function () {
    if (sideNav.style.right == "-250px") {
        sideNav.style.right = "0";
        menu.src = "../Img/close.png";
    }
    else {
        sideNav.style.right = "-250px";
        menu.src = "../Img/menu.png";
    }
}