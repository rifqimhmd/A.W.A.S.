<header class="w-full bg-black shadow-md overflow-visible">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Brand + Menu -->
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <a href="<?= base_url('/') ?>" class="mr-2">
                    <img src="<?= base_url('assets/img/logo-nobg.png') ?>" alt="Logo"
                        class="w-[120px] sm:w-[150px] p-1">
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex items-center gap-6 text-white text-lg">
                    <a href="<?= base_url('/') ?>"
                        class="px-3 py-2 rounded-md transition-colors duration-200 hover:bg-red-700 cursor-pointer">HOME</a>

                    <!-- Data Kerawanan -->
                    <div class="relative">
                        <button
                            class="dropdown-btn flex items-center gap-1 px-3 py-2 hover:bg-red-700 rounded-md transition cursor-pointer">
                            Data Kerawanan
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            class="dropdown-panel absolute left-0 mt-1 w-48 bg-black shadow-lg rounded-md hidden">
                            <a href="<?= base_url('input') ?>"
                                class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Input</a>
                            <a href="<?= base_url('histori') ?>"
                                class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Histori</a>
                        </div>
                    </div>

                    <!-- Sarana Prasarana -->
                    <div class="relative">
                        <button
                            class="dropdown-btn flex items-center gap-1 px-3 py-2 hover:bg-red-700 rounded-md transition cursor-pointer">
                            Sarana Prasarana
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            class="dropdown-panel absolute left-0 mt-1 w-56 bg-black shadow-lg rounded-md hidden">
                            <a href="#"
                                class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Faktor</a>
                            <a href="#"
                                class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Sarana</a>
                            <a href="#"
                                class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Prasarana</a>
                            <a href="#"
                                class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Pegawai</a>
                            <a href="#"
                                class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Narapidana</a>

                            <!-- Operasional (nested dropdown) -->
                            <div class="relative">
                                <button
                                    class="dropdown-btn flex items-center justify-between w-full px-4 py-2 text-white hover:bg-red-700 cursor-pointer">
                                    Operasional
                                    <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div
                                    class="dropdown-panel absolute left-full top-0 ml-1 w-56 bg-black shadow-lg rounded-md hidden">
                                    <a href="#"
                                        class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">SOP</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Test Urin</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Penggeledahan</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Jumlah Petugas</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pustaka -->
                    <a href="#"
                        class="px-3 py-2 rounded-md transition hover:bg-red-700 cursor-pointer">Pustaka</a>

                    <!-- Akses -->
                    <div class="relative">
                        <button
                            class="dropdown-btn flex items-center gap-1 px-3 py-2 hover:bg-red-700 rounded-md transition cursor-pointer">
                            Akses
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            class="dropdown-panel absolute left-0 mt-1 w-48 bg-black shadow-lg rounded-md hidden">
                            <a href="<?= base_url('opsi') ?>"
                                class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Tambah Opsi</a>
                            <a href="<?= base_url('user') ?>"
                                class="block px-4 py-2 text-white hover:bg-red-700 cursor-pointer">Tambah User</a>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Desktop Actions -->
            <div class="hidden md:flex items-center gap-3">
                <a href="<?= base_url('login/logout') ?>"
                    class="hidden sm:inline-flex items-center gap-2 px-4 py-2 text-white font-medium rounded-lg bg-red-600 hover:bg-red-700 transition shadow-md cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                    </svg>
                    Log out
                </a>
            </div>

            <!-- Hamburger -->
            <div class="md:hidden">
                <button id="menu-toggle"
                    class="flex items-center justify-center h-16 w-12 text-white cursor-pointer">
                    <svg class="size-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out md:hidden bg-black border-t border-white">
        <div class="px-4 pt-3 pb-4 space-y-2 text-white">

            <a href="<?= base_url('/') ?>"
                class="block px-3 py-2 hover:bg-red-700 rounded-md cursor-pointer">HOME</a>

            <!-- Accordion Data Kerawanan -->
            <div class="accordion">
                <button
                    class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md cursor-pointer">
                    Data Kerawanan
                    <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="accordion-panel max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <a href="<?= base_url('input') ?>"
                        class="block px-6 py-2 hover:bg-red-700 rounded-md cursor-pointer">Input</a>
                    <a href="<?= base_url('histori') ?>"
                        class="block px-6 py-2 hover:bg-red-700 rounded-md cursor-pointer">Histori</a>
                </div>
            </div>

            <!-- Accordion Sarana -->
            <div class="accordion">
                <button
                    class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md cursor-pointer">
                    Sarana Prasarana
                    <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="accordion-panel max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <a href="#" class="block px-6 py-2 hover:bg-red-700 rounded-md cursor-pointer">Faktor</a>
                    <a href="#" class="block px-6 py-2 hover:bg-red-700 rounded-md cursor-pointer">Sarana</a>
                    <a href="#" class="block px-6 py-2 hover:bg-red-700 rounded-md cursor-pointer">Prasarana</a>
                    <a href="#" class="block px-6 py-2 hover:bg-red-700 rounded-md cursor-pointer">Pegawai</a>
                    <a href="#" class="block px-6 py-2 hover:bg-red-700 rounded-md cursor-pointer">Narapidana</a>

                    <!-- Nested Operasional -->
                    <div class="accordion">
                        <button
                            class="accordion-btn flex justify-between w-full px-6 py-2 hover:bg-red-700 rounded-md cursor-pointer">
                            Operasional
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="accordion-panel max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <a href="#"
                                class="block px-8 py-2 hover:bg-red-700 rounded-md cursor-pointer">SOP</a>
                            <a href="#"
                                class="block px-8 py-2 hover:bg-red-700 rounded-md cursor-pointer">Test Urin</a>
                            <a href="#"
                                class="block px-8 py-2 hover:bg-red-700 rounded-md cursor-pointer">Penggeledahan</a>
                            <a href="#"
                                class="block px-8 py-2 hover:bg-red-700 rounded-md cursor-pointer">Jumlah Petugas</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pustaka -->
            <a href="#"
                class="block px-3 py-2 hover:bg-red-700 rounded-md cursor-pointer">Pustaka</a>

            <!-- Akses -->
            <div class="accordion">
                <button
                    class="accordion-btn flex justify-between w-full px-3 py-2 hover:bg-red-700 rounded-md cursor-pointer">
                    Akses
                    <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="accordion-panel max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <a href="<?= base_url('opsi') ?>"
                        class="block px-6 py-2 hover:bg-red-700 rounded-md cursor-pointer">Tambah Opsi</a>
                    <a href="<?= base_url('user') ?>"
                        class="block px-6 py-2 hover:bg-red-700 rounded-md cursor-pointer">Tambah User</a>
                </div>
            </div>

            <!-- Logout -->
            <a href="<?= base_url('login/logout') ?>"
                class="sm:hidden flex items-center justify-center gap-2 w-full px-4 py-2 text-white font-medium rounded-lg bg-red-600 hover:bg-red-700 transition shadow-md cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                </svg>
                Log out
            </a>
        </div>
    </div>
</header>

<script>
    // Toggle hamburger
    const menuToggle = document.getElementById("menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    menuToggle.addEventListener("click", () => {
        mobileMenu.classList.toggle("max-h-0");
        mobileMenu.classList.toggle("max-h-screen");
    });

    // Desktop dropdown toggle
    document.querySelectorAll(".dropdown-btn").forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.stopPropagation();
            const panel = this.nextElementSibling;

            document.querySelectorAll(".dropdown-panel").forEach(p => {
                if (p !== panel && !panel.contains(p) && !p.contains(panel)) {
                    p.classList.add("hidden");
                }
            });

            panel.classList.toggle("hidden");
        });
    });

    document.addEventListener("click", (e) => {
        if (e.target.closest(".dropdown-panel") || e.target.closest(".dropdown-btn")) {
            return;
        }
        document.querySelectorAll(".dropdown-panel").forEach(p => p.classList.add("hidden"));
    });

    // Mobile accordion
    document.querySelectorAll(".accordion-btn").forEach((btn) => {
        btn.addEventListener("click", function() {
            const panel = this.nextElementSibling;
            const svg = this.querySelector("svg");

            // Tutup semua panel lain dalam parent
            const parent = this.closest(".accordion").parentElement;
            parent.querySelectorAll(":scope > .accordion > .accordion-panel").forEach(p => {
                if (p !== panel) {
                    p.classList.add("max-h-0", "overflow-hidden");
                    p.classList.remove("max-h-screen");
                    p.previousElementSibling.querySelector("svg").classList.remove("rotate-180");
                }
            });

            // Toggle panel aktif
            panel.classList.toggle("max-h-0");
            panel.classList.toggle("max-h-screen");
            svg.classList.toggle("rotate-180");
        });
    });
</script>