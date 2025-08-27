function checkValid() {
    const email = document.getElementById("email").value.trim();
    const pass = document.getElementById("password").value.trim();
    const emailErr = document.getElementById("email-err");
    const passErr = document.getElementById("pass-err");
    emailErr.innerHTML = "";
    passErr.innerHTML = "";

    if (email === "") {
        emailErr.innerHTML = "Email is required";
        return false;
    }
    if (pass === "") {
        passErr.innerHTML = "Password is required";
        return false;
    }

    return true;
}


