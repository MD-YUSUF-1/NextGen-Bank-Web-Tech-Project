function loadCards() {
    let queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    // console.log(urlParams);

    let id = urlParams.get('id');
    let success = urlParams.get('success') ? urlParams.get('success') : '';
    // console.log(id,'   ',success);
    let successMessage = document.getElementById('success-message');
    if (success) {
        successMessage.style.display = 'block'
        successMessage.innerHTML = 'PIN changed successfully'
        setTimeout(function () {
            successMessage.style.top = '-100px';
        }, 3000);
        setTimeout(function () {
            successMessage.style.display = 'none';
        }, 3800);
    }


    let cardsGrid = document.getElementById('cardsGrid');
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/userCardsCheck.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('id=' + id);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // console.log(this.responseText);

            let data = JSON.parse(this.responseText);
            let userCards = data.userCards;
            let count = 0;
            // console.log(userCards);

            cardsGrid.innerHTML = "";
            for (let i = 0; i < userCards.length; i++) {
                const card = userCards[i];
                if (card.card_status === 'active') {
                    count += 1;
                }
                cardsGrid.innerHTML +=
                    '<div class="card">' +
                    '<div class="card-image">' +
                    '<img src="' + card.card_img + '" alt="' + card.card_name + '">' +
                    '</div>' +

                    '<div class="card-body">' +
                    '<div class="card-title">' + card.card_name + '</div>' +
                    '<div id="status-btn-' + card.user_card_id + '" class="card-status status-' + card.card_status + '">' + card.card_status.toUpperCase() + '</div>' +

                    '<div class="card-details">' +
                    '<div class="detail-row"><span>Card Type:</span><span>' + card.card_type + '</span></div>' +
                    '<div class="detail-row"><span>Card Number:</span><span>' + card.card_number + '</span></div>' +
                    '<div class="detail-row"><span>Available Balance:</span><span>$' + card.available_balance + '</span></div>' +
                    '<div class="detail-row"><span>Daily Limit:</span><span>$' + card.daily_limit + '</span></div>' +
                    '<div class="detail-row"><span>Credit Limit:</span><span>$' + card.credit_limit + '</span></div>' +
                    '<div class="detail-row"><span>Expiry Date:</span><span>' + card.expiry_month + '/' + card.expiry_year + '</span></div>' +
                    '</div>' +

                    '<div class="card-btn-div">' +
                    '<a href="./CardDetails.php?id=' + card.card_id + '" class="btn-know">View Details</a>' +
                    '<a href="./cardPinManagement.php?user_card_id=' + card.user_card_id + '&user_id=' + id + '" class="apply-btn">Change PIN</a>' +
                    '<button ' +(card.card_status === "active" ? "" : "disabled") + ' ' +
                    'onclick="cardBlock(' + card.user_card_id + ')" ' +
                    'class="apply-btn" ' +
                    'id="block-btn-' + card.user_card_id + '" ' +
                    'style="opacity:' + (card.card_status === "active" ? "1" : "0.5") + '">' +(card.card_status === "active" ? "Block" : "Blocked") +'</button>'+
                '</div>' +
                    '</div>' +
                    '</div>';

            }
            document.getElementById('active-cards-count').innerHTML = count;
        }
    }
}


function cardBlock(userCardId) {
    let btn = document.getElementById('block-btn-' + userCardId);
    let sbtn = document.getElementById('status-btn-' + userCardId);
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/userCardsBlockCheck.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('user_card_id=' + userCardId);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            if (data.success) {
                btn.innerText = "Blocked";
                sbtn.innerText = "Blocked";
                btn.disabled = true;
                btn.style.opacity = '0.3';
            } else {
                alert("Failed to block card");
            }
        }
    }
}



loadCards();



