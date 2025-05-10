// document.addEventListener('DOMContentLoaded', function () {
//     const user = JSON.parse(localStorage.getItem('user'));
//     const pathname = window.location.pathname;

//     const isAuthPage = pathname === '/login' || pathname === '/signup';
//     const isHomePage = pathname === '/';
//     const isProtectedPage = !isAuthPage && !isHomePage;

//     // Jika belum login dan buka halaman selain home/login/signup → redirect ke signup
//     if (!user && isProtectedPage) {
//         window.location.href = '/signup';
//     }

//     // Jika sudah login dan buka halaman login/signup → redirect ke home
//     if (user && isAuthPage) {
//         window.location.href = '/';
//     }
// });
