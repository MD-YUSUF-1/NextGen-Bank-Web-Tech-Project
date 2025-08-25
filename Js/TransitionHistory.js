function validateForm() {
    let fromDate = document.getElementById("from-date").value;
    let toDate = document.getElementById("to-date").value;
    let searchInput = document.getElementById("search-input").value.trim();
    let err = document.getElementById("error");
    if (!(fromDate || toDate || searchInput)) {
        err.innerHTML = " Please select a filter type or write something in search box ";
        return false;
    }

    if (fromDate && toDate) {
        if (new Date(fromDate) > new Date(toDate)) {
            err.innerHTML = " To date must be after From date ";
            return false;
        }
    }

    if (searchInput) {
        if (searchInput.length < 4) {
            err.innerHTML = "Search input must be above 3 characters.";
            return false;
        }
    }
    return true;

}