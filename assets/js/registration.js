const regForm = document.getElementById('regForm');
const profilePic = document.getElementById('profilePic');
const imagePreview = document.getElementById('imagePreview');
const profilePicError = document.getElementById('profilePicError');

function validateName(name) {
    if (name.length === 0) return false;
    for (let i = 0; i < name.length; i++) {
        let code = name.charCodeAt(i);
        if (!(code === 32 || (code >= 65 && code <= 90) || (code >= 97 && code <= 122))) {
            return false;
        }
    }
    return true;
}

function validateEmail(email) {
    if (email.length < 5) return false;
    for (let i = 0; i < email.length; i++) {
        let c = email.charCodeAt(i);
        if (c < 32 || c > 126) return false;
    }
    let at = email.indexOf('@');
    if (at < 1) return false;
    let dot = email.indexOf('.', at);
    if (dot <= at + 1) return false;
    if (email.includes(' ')) return false;
    return true;
}

function validatePhone(phone) {
    if (phone.length < 10 || phone.length > 15) return false;
    for (let i = 0; i < phone.length; i++) {
        let c = phone.charCodeAt(i);
        if (c < 48 || c > 57) return false;
    }
    return true;
}

function validateNID(nid) {
    if (nid.length < 8) return false;
    for (let i = 0; i < nid.length; i++) {
        let c = nid.charCodeAt(i);
        if (c < 48 || c > 57) return false;
    }
    return true;
}

profilePic.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        if (!file.type.startsWith('image/')) {
            profilePicError.textContent = 'Please upload a valid image file.';
            profilePicError.style.display = 'block';
            imagePreview.style.display = 'none';
            this.value = '';
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            profilePicError.textContent = 'Image size must be less than 2MB.';
            profilePicError.style.display = 'block';
            imagePreview.style.display = 'none';
            this.value = '';
            return;
        }
        profilePicError.style.display = 'none';
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        imagePreview.style.display = 'none';
        profilePicError.style.display = 'none';
    }
});

regForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const fullName = document.getElementById('fullName');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const nid = document.getElementById('nid');
    const address = document.getElementById('address');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const phoneError = document.getElementById('phoneError');
    const nidError = document.getElementById('nidError');
    const addressError = document.getElementById('addressError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');

    let valid = true;

    if (fullName.value.trim() === '' || !validateName(fullName.value.trim())) {
        nameError.style.display = 'block';
        valid = false;
    } else { nameError.style.display = 'none'; }

    if (!validateEmail(email.value.trim())) { emailError.style.display = 'block'; valid = false; }
    else { emailError.style.display = 'none'; }

    if (!validatePhone(phone.value.trim())) { phoneError.style.display = 'block'; valid = false; }
    else { phoneError.style.display = 'none'; }

    if (!validateNID(nid.value.trim())) { nidError.style.display = 'block'; valid = false; }
    else { nidError.style.display = 'none'; }

    if (address.value.trim() === '') { addressError.style.display = 'block'; valid = false; }
    else { addressError.style.display = 'none'; }

    if (!profilePic.files[0]) { profilePicError.style.display = 'block'; valid = false; }
    else { profilePicError.style.display = 'none'; }

    if (password.value.trim().length < 6) { passwordError.style.display = 'block'; valid = false; }
    else { passwordError.style.display = 'none'; }

    if (password.value.trim() !== confirmPassword.value.trim()) { confirmPasswordError.style.display = 'block'; valid = false; }
    else { confirmPasswordError.style.display = 'none'; }

    if (valid) {
        alert('Registration successful!');
        regForm.reset();
        imagePreview.style.display = 'none';
    }
});
