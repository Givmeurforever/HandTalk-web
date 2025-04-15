document.addEventListener('DOMContentLoaded', function () {
    const user = JSON.parse(localStorage.getItem('user'));

    const authButtons = document.querySelector('.auth-buttons');
    const userInfo = document.getElementById('userInfo');
    const userFullName = document.getElementById('userFullName');
    const userProfileImg = document.getElementById('userProfileImg');

    // 🔹 Proteksi tombol "Mulai Belajar"
    const mulaiBtn = document.querySelector('.mulai-belajar');
    if (mulaiBtn) {
        mulaiBtn.addEventListener('click', function (e) {
            if (!user) {
                e.preventDefault();
                window.location.href = '/signup';
            }
        });
    }


    if (user) {
        userFullName.textContent = `${user.firstName} ${user.lastName}`;
        authButtons.style.display = 'none';
        userInfo.style.display = 'flex';

        userInfo.addEventListener('click', () => {
            window.location.href = '/settings';
        });
    } else {
        authButtons.style.display = 'flex';
        userInfo.style.display = 'none';
    }

    // 🔍 Proteksi search bar
    const searchInput = document.querySelector('.search-container input');
    const searchButton = document.querySelector('.search-container button');

    if (searchInput && searchButton) {
        const redirectIfNotLoggedIn = () => {
            if (!user) {
                // alert('Silakan login terlebih dahulu untuk menggunakan fitur pencarian.');
                window.location.href = '/signup';
            }
        };

        searchInput.addEventListener('focus', redirectIfNotLoggedIn);
        searchButton.addEventListener('click', (e) => {
            if (!user) {
                e.preventDefault();
                redirectIfNotLoggedIn();
            }
        });
    }
});
