let queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
let userID = urlParams.get('user_id');
let userCardID = urlParams.get('user_card_id');
function validatePin() {
    const currentPin = document.getElementById("currentPin").value.trim();
    const newPin = document.getElementById("newPin").value.trim();
    const confirmPin = document.getElementById("confirmPin").value.trim();
    const errorMsg = document.getElementById("errorMsg");

    errorMsg.innerHTML = "";

    if (currentPin.length === 0 || newPin.length === 0 || confirmPin.length === 0) {
        errorMsg.innerHTML = "All fields are required.";
        return;
    }

    if (newPin.length !== 4 || isNaN(newPin)) {
        errorMsg.innerHTML = "New PIN must be exactly 4 digits and number.";
        return;
    }

    if (newPin !== confirmPin) {
        errorMsg.innerHTML = "New PIN and Confirm PIN do not match.";
        return;
    }

    let pins = {
        userCardID,
        userID,
        currentPin,
        newPin,
        confirmPin
    };
    console.log(pins);
    let data = JSON.stringify(pins);

    // console.log( data);
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../controller/cardPinManagement.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("pinData=" + data);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            console.log(this.responseText);
            let data = JSON.parse(this.responseText);
            if (data.errors) {
                errors = data.errors.join(',');
                errorMsg.innerHTML = errors;
                return;
            }

            if (data.success) {
                window.location.href = "./UserCards.php?id=" + userID +"&success="+data.success;
            }
        }
    };


}