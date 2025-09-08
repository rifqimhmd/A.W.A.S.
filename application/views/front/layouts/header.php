<header class="w-full bg-black shadow-md fixed top-0 left-0 z-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo + Beranda -->
            <div class="flex items-center gap-4">
                <!-- Logo -->
                <a href="<?= base_url('/') ?>" class="flex items-center gap-2">
                    <img src="<?= base_url('assets/img/logo-nobg.png') ?>" alt="Logo"
                        class="w-[120px] sm:w-[150px] p-1">
                </a>
                <!-- Button toggle sidebar -->
                <button id="sidebar-toggle"
                    class="text-white ml-10 p-2 rounded-md hover:bg-red-700 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <!-- Beranda -->
                <a href="<?= base_url('/') ?>"
                    class="hidden sm:inline-block px-3 py-2 text-white rounded-md transition hover:bg-red-700">
                    Beranda
                </a>
            </div>

            <!-- Notifikasi + Logout -->
            <div class="flex items-center gap-4">
                <!-- Icon Lonceng dengan Badge menempel & Dropdown -->
                <div class="relative" id="notification-wrapper">
                    <button id="notification-btn" class="text-white p-2 rounded-md hover:bg-red-700 cursor-pointer">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <!-- Badge menempel -->
                    <span id="notification-badge"
                        class="absolute -top-0 -right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                        10
                    </span>

                    <!-- Dummy Dropdown Notifikasi -->
                    <div id="notification-dropdown"
                        class="hidden absolute right-0 mt-2 w-56 bg-black text-white shadow-lg rounded-md overflow-hidden z-50">
                        <a href="#" class="block px-4 py-2 hover:bg-red-700 text-sm">Notifikasi 1</a>
                        <a href="#" class="block px-4 py-2 hover:bg-red-700 text-sm">Notifikasi 2</a>
                        <a href="#" class="block px-4 py-2 hover:bg-red-700 text-sm">Notifikasi 3</a>
                        <a href="#" class="block px-4 py-2 hover:bg-red-700 text-sm">Notifikasi 4</a>
                        <a href="#" class="block px-4 py-2 hover:bg-red-700 text-sm">Notifikasi 5</a>
                    </div>
                </div>

                <!-- Tombol Logout (Power Icon) -->
                <a href="<?= base_url('login/logout') ?>"
                    class="inline-flex items-center justify-center p-2 text-white rounded-md hover:bg-red-700 transition shadow-md">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 2v10m5.657-5.657a8 8 0 11-11.314 0" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Sidebar -->
<aside id="sidebar"
    class="fixed top-16 left-0 w-64 h-[calc(100vh-4rem)] bg-black text-white shadow-lg -ml-64 transition-all duration-300 overflow-y-auto z-40">
    <nav class="p-4 space-y-2">
        <!-- Data Kerawanan -->
        <div class="accordion">
            <button class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md">
                Data Kerawanan
                <svg class="w-4 h-4 transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="accordion-panel hidden flex-col">
                <?php if ($this->session->userdata('role') === 'upt'): ?>
                    <a href="<?= base_url('input') ?>" class="block px-6 py-2 hover:bg-red-700">Input</a>
                <?php endif; ?>
                <a href="<?= base_url('histori') ?>" class="block px-6 py-2 hover:bg-red-700">Riwayat</a>
            </div>
        </div>

        <!-- Faktor -->
        <div class="accordion">
            <button class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md">
                Faktor
                <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="accordion-panel hidden flex-col">
                <a href="<?= base_url('opsi') ?>" class="block px-6 py-2 hover:bg-red-700">Pegawai</a>
                <a href="<?= base_url('user') ?>" class="block px-6 py-2 hover:bg-red-700">Narapidana</a>
            </div>
        </div>

        <!-- Sarana Prasarana -->
        <div class="accordion">
            <button class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md">
                Sarana Prasarana
                <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="accordion-panel hidden flex-col">
                <a href="#" class="block px-6 py-2 hover:bg-red-700">Sarana</a>
                <a href="#" class="block px-6 py-2 hover:bg-red-700">Prasarana</a>
                <a href="#" class="block px-6 py-2 hover:bg-red-700">Pegawai</a>
                <a href="#" class="block px-6 py-2 hover:bg-red-700">Narapidana</a>

                <!-- Nested Operasional -->
                <div class="accordion">
                    <button class="accordion-btn flex justify-between w-full px-6 py-2 hover:bg-red-700 rounded-md">
                        Operasional
                        <svg class="w-4 h-4 transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="accordion-panel hidden flex-col">
                        <a href="#" class="block px-8 py-2 hover:bg-red-700">SOP</a>
                        <a href="#" class="block px-8 py-2 hover:bg-red-700">Test Urin</a>
                        <a href="#" class="block px-8 py-2 hover:bg-red-700">Penggeledahan</a>
                        <a href="#" class="block px-8 py-2 hover:bg-red-700">Jumlah Petugas</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pustaka -->
        <a href="#" class="block px-3 py-2 hover:bg-red-700 rounded-md">Pustaka</a>

        <!-- Akses -->
        <div class="accordion">
            <button class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md">
                Akses
                <svg class="w-4 h-4 transition-transform duration-300" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="accordion-panel hidden flex-col">
                <a href="<?= base_url('opsi') ?>" class="block px-6 py-2 hover:bg-red-700">Tambah Opsi</a>
                <a href="<?= base_url('user') ?>" class="block px-6 py-2 hover:bg-red-700">Tambah User</a>
            </div>
        </div>
    </nav>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarToggle = document.getElementById("sidebar-toggle");
        const sidebar = document.getElementById("sidebar");
        const contentWrapper = document.getElementById("content-wrapper");
        const footer = document.getElementById("footer");

        // Sidebar toggle
        sidebarToggle.addEventListener("click", () => {
            const isClosed = sidebar.classList.contains("-ml-64");

            if (isClosed) {
                sidebar.classList.remove("-ml-64");
                contentWrapper.style.marginLeft = "16rem";
                contentWrapper.style.width = "calc(100% - 16rem)";
                footer.style.marginLeft = "16rem";
                footer.style.width = "calc(100% - 16rem)";
            } else {
                sidebar.classList.add("-ml-64");
                contentWrapper.style.marginLeft = "0";
                contentWrapper.style.width = "100%";
                footer.style.marginLeft = "0";
                footer.style.width = "100%";
            }
        });

        // Accordion toggle
        document.querySelectorAll(".accordion-btn").forEach((btn) => {
            btn.addEventListener("click", () => {
                const panel = btn.nextElementSibling;
                const icon = btn.querySelector("svg");
                if (panel.classList.contains("hidden")) {
                    panel.classList.remove("hidden");
                    panel.classList.add("flex");
                    icon.classList.add("rotate-180");
                } else {
                    panel.classList.add("hidden");
                    panel.classList.remove("flex");
                    icon.classList.remove("rotate-180");
                }
            });
        });

        // Notification dropdown dummy
        const notificationBtn = document.getElementById("notification-btn");
        const notificationDropdown = document.getElementById("notification-dropdown");

        notificationBtn.addEventListener("click", () => {
            notificationDropdown.classList.toggle("hidden");
        });

        // Tutup dropdown saat klik di luar
        document.addEventListener("click", (e) => {
            if (!notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
                notificationDropdown.classList.add("hidden");
            }
        });
    });
</script>