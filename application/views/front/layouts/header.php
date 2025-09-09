<!-- header.php -->
<header class="w-full bg-black shadow-md fixed top-0 left-0 z-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-4">
                <!-- Logo (hidden di mobile) -->
                <a href="<?= base_url('/') ?>" class="hidden sm:flex items-center gap-2">
                    <img src="<?= base_url('assets/img/logo-nobg.png') ?>" alt="Logo" class="w-[120px] sm:w-[150px] p-1">
                </a>

                <!-- Sidebar Toggle -->
                <button id="sidebar-toggle" class="text-white ml-0 sm:ml-10 p-2 rounded-md hover:bg-red-700 cursor-pointer flex items-center">
                    <!-- Mobile: panah -->
                    <svg id="sidebar-icon" class="w-6 h-6 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="sidebar-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <!-- Desktop: hamburger -->
                    <svg class="w-6 h-6 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Beranda (hidden di mobile) -->
                <a href="<?= base_url('/') ?>" class="hidden sm:inline-block px-3 py-2 text-white rounded-md transition hover:bg-red-700">
                    Beranda
                </a>
            </div>

            <!-- Notifikasi + User Dropdown -->
            <div class="flex items-center gap-4">
                <!-- Notifikasi -->
                <div class="relative">
                    <button id="notification-btn" class="text-white p-2 rounded-md hover:bg-red-700 cursor-pointer">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <span id="notification-badge"
                        class="absolute -top-0 -right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                        10
                    </span>
                    <div id="notification-dropdown"
                        class="hidden absolute right-0 mt-2 w-56 bg-black text-white shadow-lg rounded-md overflow-hidden z-50">
                        <a href="#" class="block px-4 py-2 hover:bg-red-700 text-sm">Notifikasi 1</a>
                        <a href="#" class="block px-4 py-2 hover:bg-red-700 text-sm">Notifikasi 2</a>
                        <a href="#" class="block px-4 py-2 hover:bg-red-700 text-sm">Notifikasi 3</a>
                        <a href="#" class="block px-4 py-2 hover:bg-red-700 text-sm">Notifikasi 4</a>
                        <a href="#" class="block px-4 py-2 hover:bg-red-700 text-sm">Notifikasi 5</a>
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="relative">
                    <?php $username = $this->session->userdata('username'); ?>
                    <button id="user-btn" class="text-white px-3 py-2 rounded-md hover:bg-red-700 cursor-pointer flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.33 0-6 2.67-6 6h12c0-3.33-2.67-6-6-6z" />
                        </svg>
                        <?= htmlspecialchars($username) ?>
                        <svg class="w-4 h-4 inline-block transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-40 bg-black text-white shadow-lg rounded-md overflow-hidden z-50">
                        <a href="<?= base_url('login/logout') ?>" class="flex items-center gap-2 px-4 py-2 hover:bg-red-700 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 17l5-5-5-5M15 12H3" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 19V5a2 2 0 00-2-2H10v2h9v14h-9v2h9a2 2 0 002-2z" />
                            </svg>
                            Keluar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-16 left-0 w-64 h-[calc(100vh-4rem)] bg-black text-white shadow-lg -ml-64 transition-all duration-300 overflow-y-auto z-40">
    <nav class="p-4 space-y-2">
        <!-- Beranda masuk ke sidebar di mobile -->
        <a href="<?= base_url('/') ?>" class="block sm:hidden px-3 py-2 hover:bg-red-700 rounded-md transition">Beranda</a>

        <!-- Data Kerawanan -->
        <div class="accordion">
            <button class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md transition">
                Data Kerawanan
                <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="accordion-panel hidden flex-col transition-all duration-300 overflow-hidden">
                <?php if ($this->session->userdata('role') === 'upt'): ?>
                    <a href="<?= base_url('input') ?>" class="block px-6 py-2 hover:bg-red-700">Input</a>
                <?php endif; ?>
                <a href="<?= base_url('histori') ?>" class="block px-6 py-2 hover:bg-red-700">Riwayat</a>
            </div>
        </div>

        <!-- Faktor -->
        <div class="accordion">
            <button class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md transition">
                Faktor
                <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="accordion-panel hidden flex-col transition-all duration-300 overflow-hidden">
                <a href="<?= base_url('opsi') ?>" class="block px-6 py-2 hover:bg-red-700">Pegawai</a>
                <a href="<?= base_url('user') ?>" class="block px-6 py-2 hover:bg-red-700">Narapidana</a>
            </div>
        </div>

        <!-- Sarana Prasarana -->
        <div class="accordion">
            <button class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md transition">
                Sarana Prasarana
                <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="accordion-panel hidden flex-col transition-all duration-300 overflow-hidden">
                <a href="#" class="block px-6 py-2 hover:bg-red-700">Sarana</a>
                <a href="#" class="block px-6 py-2 hover:bg-red-700">Prasarana</a>
                <a href="#" class="block px-6 py-2 hover:bg-red-700">Pegawai</a>
                <a href="#" class="block px-6 py-2 hover:bg-red-700">Narapidana</a>

                <!-- Nested Operasional -->
                <div class="accordion nested">
                    <button class="accordion-btn flex justify-between w-full px-6 py-2 hover:bg-red-700 rounded-md transition">
                        Operasional
                        <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="accordion-panel hidden flex-col transition-all duration-300 overflow-hidden">
                        <a href="#" class="block px-8 py-2 hover:bg-red-700">SOP</a>
                        <a href="#" class="block px-8 py-2 hover:bg-red-700">Test Urin</a>
                        <a href="#" class="block px-8 py-2 hover:bg-red-700">Penggeledahan</a>
                        <a href="#" class="block px-8 py-2 hover:bg-red-700">Jumlah Petugas</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pustaka -->
        <a href="#" class="block px-3 py-2 hover:bg-red-700 rounded-md transition">Pustaka</a>

        <!-- Akses: hanya admin -->
        <?php if (in_array($this->session->userdata('role'), ['admin', 'kanwil'])): ?>
            <div class="accordion">
                <button class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md transition">
                    Akses
                    <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="accordion-panel hidden flex-col transition-all duration-300 overflow-hidden">
                    <a href="<?= base_url('opsi') ?>" class="block px-6 py-2 hover:bg-red-700">Tambah Opsi</a>
                    <a href="<?= base_url('user') ?>" class="block px-6 py-2 hover:bg-red-700">Tambah User</a>
                </div>
            </div>
        <?php endif; ?>
    </nav>
</aside>

<!-- Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarToggle = document.getElementById("sidebar-toggle");
        const sidebar = document.getElementById("sidebar");
        const contentWrapper = document.getElementById("content-wrapper");
        const footer = document.getElementById("footer");
        const sidebarPath = document.getElementById("sidebar-path");

        const notificationBtn = document.getElementById("notification-btn");
        const notificationDropdown = document.getElementById("notification-dropdown");
        const userBtn = document.getElementById("user-btn");
        const userDropdown = document.getElementById("user-dropdown");

        const isMobile = () => window.innerWidth < 640;

        const setSidebarArrow = () => {
            if (isMobile()) {
                if (sidebar.classList.contains("-ml-64")) {
                    sidebarPath.setAttribute("d", "M9 5l7 7-7 7");
                } else {
                    sidebarPath.setAttribute("d", "M15 5l-7 7 7 7");
                }
            } else {
                if (!sidebar.classList.contains("-ml-64")) {
                    sidebarPath.setAttribute("d", "M15 5l-7 7 7 7");
                } else {
                    sidebarPath.setAttribute("d", "M9 5l7 7-7 7");
                }
            }
        };

        const updateLayout = () => {
            if (isMobile()) {
                if (contentWrapper) {
                    contentWrapper.style.marginLeft = "0";
                    contentWrapper.style.width = "100%";
                }
                if (footer) {
                    footer.style.marginLeft = "0";
                    footer.style.width = "100%";
                }
            } else {
                if (!sidebar.classList.contains("-ml-64")) {
                    if (contentWrapper) {
                        contentWrapper.style.marginLeft = "16rem";
                        contentWrapper.style.width = "calc(100% - 16rem)";
                    }
                    if (footer) {
                        footer.style.marginLeft = "16rem";
                        footer.style.width = "calc(100% - 16rem)";
                    }
                } else {
                    if (contentWrapper) {
                        contentWrapper.style.marginLeft = "0";
                        contentWrapper.style.width = "100%";
                    }
                    if (footer) {
                        footer.style.marginLeft = "0";
                        footer.style.width = "100%";
                    }
                }
            }
            setSidebarArrow();
        };

        const closeSidebarMobile = () => {
            if (isMobile() && !sidebar.classList.contains("-ml-64")) {
                sidebar.classList.add("-ml-64");
                setSidebarArrow();
            }
        };

        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("-ml-64");
            updateLayout();
        });

        document.addEventListener("click", e => {
            if (isMobile() && !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.add("-ml-64");
                setSidebarArrow();
            }
        });

        document.querySelectorAll("#sidebar > nav > .accordion > .accordion-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                const panel = btn.nextElementSibling;
                document.querySelectorAll("#sidebar > nav > .accordion > .accordion-btn").forEach(otherBtn => {
                    const otherPanel = otherBtn.nextElementSibling;
                    if (otherBtn !== btn && otherPanel) {
                        otherPanel.classList.add("hidden");
                        otherBtn.querySelector("svg").classList.remove("rotate-180");
                    }
                });
                if (panel) {
                    panel.classList.toggle("hidden");
                    btn.querySelector("svg").classList.toggle("rotate-180");
                }
            });
        });

        document.querySelectorAll(".accordion.nested > .accordion-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                const panel = btn.nextElementSibling;
                if (panel) {
                    panel.classList.toggle("hidden");
                    btn.querySelector("svg").classList.toggle("rotate-180");
                }
            });
        });

        const toggleDropdown = (dropdown, otherDropdown = null) => {
            if (otherDropdown && !otherDropdown.classList.contains("hidden")) {
                otherDropdown.classList.add("hidden");
            }
            dropdown.classList.toggle("hidden");
        };

        notificationBtn.addEventListener("click", e => {
            e.stopPropagation();
            toggleDropdown(notificationDropdown, userDropdown);
            closeSidebarMobile();
        });

        userBtn.addEventListener("click", e => {
            e.stopPropagation();
            toggleDropdown(userDropdown, notificationDropdown);
            closeSidebarMobile();
        });

        document.addEventListener("click", e => {
            if (!notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
                notificationDropdown.classList.add("hidden");
            }
            if (!userBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.add("hidden");
            }
        });

        window.addEventListener("resize", updateLayout);

        updateLayout();
    });
</script>