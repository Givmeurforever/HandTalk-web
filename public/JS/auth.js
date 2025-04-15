document.addEventListener('DOMContentLoaded', function () {
    // ===== Toggle Password Visibility =====
    const togglePassword = document.querySelector('.toggle-password img');
    const passwordInput = document.querySelector('#password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            togglePassword.src = isPassword
                ? 'img/eye-open.svg'
                : 'img/eye-closed.svg';
        });
    }

    // ===== Signup Form Logic =====
    const signupForm = document.querySelector('#signUpForm');
    if (signupForm) {
        signupForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const firstName = document.querySelector('#firstName').value.trim();
            const lastName = document.querySelector('#lastName').value.trim();
            const email = document.querySelector('#email').value.trim();
            const password = document.querySelector('#password').value;

            const user = {
                profilePic: 'img/profile-default.png',
                firstName,
                lastName,
                email,
                password
            };

            localStorage.setItem('user', JSON.stringify(user));

            alert('Akun berhasil dibuat!');
            window.location.href = '/';
        });
    }

    // ===== Login Form Logic =====
    const loginForm = document.querySelector('#loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const email = document.querySelector('#email').value.trim();
            const password = document.querySelector('#password').value;
            const storedUser = JSON.parse(localStorage.getItem('user'));

            if (
                storedUser &&
                storedUser.email === email &&
                storedUser.password === password
            ) {
                alert('Login berhasil!');
                window.location.href = '/';
            } else {
                alert('Email atau password salah!');
            }
        });
    }
});
