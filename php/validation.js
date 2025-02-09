document.getElementById('registerForm').onsubmit = function(event) {
    let username = document.getElementById('username').value.trim();
    let email = document.getElementById('email').value.trim();
    let password = document.getElementById('password').value.trim();
    let confirmPassword = document.getElementById('confirm_password').value.trim();

    if (username === '' || email === '' || password === '' || confirmPassword === '') {
        alert('Please fill out all fields');
        event.preventDefault();
        return;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match');
        event.preventDefault();
        return;
    }

    if (!validateEmail(email)) {
        alert('Invalid email format');
        event.preventDefault();
        return;
    }
};

document.getElementById('loginForm').onsubmit = function(event) {
    let email = document.getElementById('email').value.trim();
    let password = document.getElementById('password').value.trim();

    if (email === '' || password === '') {
        alert('Please fill out all fields');
        event.preventDefault();
        return;
    }

    if (!validateEmail(email)) {
        alert('Invalid email format');
        event.preventDefault();
        return;
    }
};

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
