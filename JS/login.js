let switches = document.getElementsByClassName("switch-forms");
switches[1].addEventListener("click", swapFocus)
switches[0].addEventListener("click", swapFocus)

function swapFocus() {
    document.getElementById("login-form").classList.toggle("inactive");
    document.getElementById("signup-form").classList.toggle("inactive");
}