function togglePasswordVisibility() {
    var input = document.getElementById("login-password");
    input.type = input.type == "text" ? "password" : "text";
}