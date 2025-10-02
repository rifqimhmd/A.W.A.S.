<?php if ($this->session->userdata("username")): ?>
    <footer id="footer"
        class="bg-gradient-to-r from-black via-gray-900 to-black text-white py-4 shadow-inner transition-all duration-300 w-full">
        <div class="mx-auto max-w-7xl px-4 flex flex-row items-center gap-3">
            <img src="<?= base_url("assets/img/logo-ditjenpas.png") ?>" alt="Logo Ditjenpas" class="h-6 w-auto">
            <p class="text-white text-sm">
                © <span id="year"></span> Direktorat Jenderal Pemasyarakatan. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        // Script untuk otomatis update tahun
        document.addEventListener("DOMContentLoaded", function() {
            const yearEl = document.getElementById("year");
            if (yearEl) {
                yearEl.textContent = new Date().getFullYear();
            }
        });
    </script>
<?php endif; ?>