<footer class="footer">
    <div class="footer-container">
        <!-- 🔹 Bagian Kiri -->
        <div class="footer-left">
            <img src="{{ asset('img/logo.png') }}" class="footer-logo" alt="HandTalk Logo">
            <div class="footer-contact">
                <div class="contact-item">
                    <img src="{{ asset('img/email.png') }}" alt="Email">
                    <span>HandTalk@gmail.com</span>
                </div>
                <div class="contact-item">
                    <img src="{{ asset('img/phone.png') }}" alt="Telepon">
                    <span>+62 895 3313 67034</span>
                </div>
                <div class="contact-item">
                    <img src="{{ asset('img/location.png') }}" alt="Lokasi">
                    <span>Jalan Bogor No.3</span>
                </div>
            </div>
        </div>

        <!-- 🔹 Bagian Tengah -->
        <div class="footer-middle">
            <h4>Beranda</h4>
            <ul>
                <li><a href="{{ route('home') }}#manfaat">Manfaat</a></li>
                <li><a href="{{ route('home') }}#apa-kamu-dapat">Apa yang kamu dapat</a></li>
                <li><a href="{{ route('home') }}#isi-materi">Isi materi</a></li>
            </ul>
        </div>
        

        <!-- 🔹 Bagian Kanan -->
        <div class="footer-right">
            <h4>Tentang Kami</h4>
            <ul>
                <li><a href="{{ route('tentang') }}#apa-itu-handtalk">Apa itu HandTalk</a></li>
                <li><a href="{{ route('tentang') }}#tujuan-kami">Tujuan Kami</a></li>
            </ul>
        </div>

        <!-- 🔹 Profil Sosial -->
        <div class="footer-social">
            <h4>Profil Sosial</h4>
            <div class="social-icons">
                <a href="https://instagram.com" class="social-box">
                    <img src="{{ asset('img/instagram.png') }}" alt="Instagram">
                </a>
                <a href="https://linkedin.com" class="social-box">
                    <img src="{{ asset('img/linkedin.png') }}" alt="LinkedIn">
                </a>
            </div>
        </div>
    </div>

    <!-- 🔹 Garis Pemisah -->
    <div class="footer-divider"></div>

    <!-- 🔹 Copyright -->
    <div class="footer-bottom">
        <p>© 2024 HandTalk. All rights reserved.</p>
    </div>
</footer>
  