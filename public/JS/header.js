// document.addEventListener('DOMContentLoaded', function () {
//     const user = JSON.parse(localStorage.getItem('user'));

//     const authButtons = document.querySelector('.auth-buttons');
//     const userInfo = document.getElementById('userInfo');
//     const userFullName = document.getElementById('userFullName');
//     const userProfileImg = document.getElementById('userProfileImg');

//     // Proteksi tombol mulai belajar
//     const mulaiBtn = document.querySelector('.mulai-belajar');
//     if (mulaiBtn && !user) {
//         mulaiBtn.addEventListener('click', (e) => {
//             e.preventDefault();
//             window.location.href = '/signup';
//         });
//     }

//     // Cek user login
//     if (user) {
//         userFullName.textContent = `${user.firstName} ${user.lastName}`;
//         authButtons.style.display = 'none';
//         userInfo.style.display = 'flex';
//     } else {
//         authButtons.style.display = 'flex';
//         userInfo.style.display = 'none';
//     }

//     // Proteksi search bar
//     const searchInput = document.querySelector('.search-container input');
//     const searchButton = document.querySelector('.search-container button');
//     const redirectIfNotLoggedIn = () => {
//         if (!user) window.location.href = '/signup';
//     };

//     if (searchInput && searchButton) {
//         searchInput.addEventListener('focus', redirectIfNotLoggedIn);
//         searchButton.addEventListener('click', (e) => {
//             if (!user) {
//                 e.preventDefault();
//                 redirectIfNotLoggedIn();
//             }
//         });
//     }

//     // Tooltip interaktif
//     const tooltipWrapper = document.querySelector('.user-name-tooltip');
//     const dropdown = document.querySelector('.user-dropdown');

//     if (tooltipWrapper && dropdown) {
//         let timeout;
//         const showDropdown = () => {
//             clearTimeout(timeout);
//             dropdown.style.display = 'block';
//             dropdown.style.opacity = '1';
//             dropdown.style.transform = 'translateY(0)';
//         };
//         const hideDropdown = () => {
//             timeout = setTimeout(() => {
//                 dropdown.style.display = 'none';
//                 dropdown.style.opacity = '0';
//             }, 200);
//         };

//         tooltipWrapper.addEventListener('mouseenter', showDropdown);
//         tooltipWrapper.addEventListener('mouseleave', hideDropdown);
//         dropdown.addEventListener('mouseenter', showDropdown);
//         dropdown.addEventListener('mouseleave', hideDropdown);
//     }

//     // Logout -> hapus localStorage
//     const logoutLink = document.getElementById('logoutLink');
//     if (logoutLink) {
//         logoutLink.addEventListener('click', function (e) {
//             e.preventDefault();
//             localStorage.removeItem('user');
//             window.location.href = '/';
//         });
//     }

// });
