document.addEventListener('DOMContentLoaded', function () {
    const toggleIcons = document.querySelectorAll('.toggle-password-icon');

    toggleIcons.forEach(function (icon) {
        icon.addEventListener('click', function () {
            const input = this.previousElementSibling;
            if (!input || input.tagName.toLowerCase() !== 'input') return;

            const type = input.getAttribute('type');
            if (type === 'password') {
                input.setAttribute('type', 'text');
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.setAttribute('type', 'password');
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });
});
