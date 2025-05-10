// document.addEventListener('DOMContentLoaded', function () {
//     const user = JSON.parse(localStorage.getItem('user'));

//     // Auto fill form dengan data user dari localStorage
//     if (user) {
//         document.getElementById('firstName').value = user.firstName || '';
//         document.getElementById('lastName').value = user.lastName || '';
//         document.getElementById('email').value = user.email || '';
//     }

//     // Toggle show/hide password
//     const togglePassword = document.getElementById('togglePassword');
//     const passwordInput = document.getElementById('password');
//     const eyeIcon = togglePassword.querySelector('img');

//     togglePassword.addEventListener('click', function () {
//         const isPassword = passwordInput.type === 'password';
//         passwordInput.type = isPassword ? 'text' : 'password';
//         eyeIcon.src = isPassword 
//             ? '/img/eye-open.svg' 
//             : '/img/eye-closed.svg';
//     });

//     // Change profile picture preview with transition
//     const fileInput = document.getElementById('fileInput');
//     const profileImage = document.getElementById('profileImage');
//     const changePictureBtn = document.getElementById('changePictureBtn');

//     changePictureBtn.addEventListener('click', () => {
//         fileInput.click();
//     });

//     fileInput.addEventListener('change', function () {
//         const file = this.files[0];
//         if (file) {
//             profileImage.classList.add('fade-out');
//             const reader = new FileReader();
//             reader.onload = function (e) {
//                 setTimeout(() => {
//                     profileImage.src = e.target.result;
//                     profileImage.classList.remove('fade-out');
//                     profileImage.classList.add('fade-in');
//                     setTimeout(() => profileImage.classList.remove('fade-in'), 300);
//                 }, 300);
//             };
//             reader.readAsDataURL(file);
//         }
//     });

//     // Save updated user info to localStorage
//     const saveBtn = document.getElementById('saveBtn');
//     saveBtn.addEventListener('click', function () {
//         let user = JSON.parse(localStorage.getItem('user')) || {};

//         const newFirstName = document.getElementById('firstName').value.trim();
//         const newLastName = document.getElementById('lastName').value.trim();
//         const newPassword = document.getElementById('password').value;

//         user.firstName = newFirstName;
//         user.lastName = newLastName;

//         if (newPassword) {
//             user.password = newPassword;
//         }

//         localStorage.setItem('user', JSON.stringify(user));

//         // Optional: Update header info
//         const userFullName = document.getElementById('userFullName');
//         if (userFullName) {
//             userFullName.textContent = `${newFirstName} ${newLastName}`;
//         }

//         showToast('Profile updated!');
//     });

//     // Toast notification
//     function showToast(message) {
//         const toast = document.getElementById('toast');
//         toast.textContent = message;
//         toast.classList.remove('hidden');
//         setTimeout(() => {
//             toast.classList.add('show');
//             setTimeout(() => {
//                 toast.classList.remove('show');
//                 setTimeout(() => toast.classList.add('hidden'), 300);
//             }, 2000);
//         }, 10);
//     }

//     // Simulasi logout
//     const logoutBtn = document.getElementById('logoutBtn');
//     logoutBtn.addEventListener('click', function () {
//         localStorage.removeItem('user');
//         window.location.href = '/';
//     });
// });
