<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk A.W.A.S.</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="<?= base_url(
                                                "assets/img/iconlogin.png",
                                            ) ?>">
    <style>
        /* Animasi fade-in */
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Tombol merah gradient */
        .btn-red {
            background: linear-gradient(90deg, #dc2626, #b91c1c);
        }

        .btn-red:hover {
            filter: brightness(1.1);
        }

        .btn-red:active {
            transform: scale(0.97);
        }

        /* Input focus */
        input:focus {
            transition: all 0.3s ease;
        }

        /* Background pattern */
        .pattern-bg {
            background-image: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.05;
        }
    </style>
</head>

<!-- Modal Pengumuman -->
<div id="announcement-modal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-500">
    <div id="announcement-box"
        class="bg-white rounded-xl shadow-2xl p-6 max-w-md w-[90%] sm:w-full relative transform scale-90 opacity-0 transition-all duration-700 ease-out">

        <!-- Tombol X -->
        <button onclick="closeAnnouncement()"
            class="absolute -top-3 -right-3 bg-red-600 hover:bg-red-700 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-md">
            ✕
        </button>

        <h3 class="text-xl font-bold text-red-700 mb-3 text-center">📢 Pengumuman</h3>
        <p class="text-gray-700 text-sm sm:text-base text-center leading-relaxed">
            Penginputan hanya diperbolehkan pada tanggal <b>25 – 28</b> setiap bulan.
        </p>
    </div>
</div>

<script>
    function closeAnnouncement() {
        const modal = document.getElementById('announcement-modal');
        const box = document.getElementById('announcement-box');

        // efek keluar (fade + scale out)
        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-90', 'opacity-0');
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }

    window.onload = function() {
        const modal = document.getElementById('announcement-modal');
        const box = document.getElementById('announcement-box');

        setTimeout(function() {
            // tampilkan background
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');

            // animasi fade + scale in
            setTimeout(function() {
                box.classList.remove('scale-90', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');

                // auto-close setelah 7 detik
                setTimeout(function() {
                    closeAnnouncement();
                }, 4000);

            }, 100);
        }, 2000); // muncul 2 detik setelah halaman load
    };
</script>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 font-sans">

    <div class="w-full min-h-screen flex flex-col md:flex-row overflow-hidden">

        <!-- Panel Kiri (desktop only) -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-gray-50 to-gray-100 relative items-center justify-center p-10 flex-col border-r border-gray-200">
            <div class="absolute inset-0 pattern-bg"></div>
            <div class="relative z-10 flex flex-col items-center text-center">
                <img src="<?= base_url(
                                "assets/img/iconlogin.png",
                            ) ?>" alt="Logo AWAS" class="w-28 mb-4 fade-in">
                <img src="<?= base_url(
                                "assets/img/logo-nobg-black.png",
                            ) ?>" alt="Text AWAS" class="w-56 mb-6 fade-in">
                <p class="text-gray-500 max-w-xs fade-in">
                    Selamat datang di sistem A.W.A.S. Masuk untuk mengakses fitur dan data Anda dengan aman.
                </p>
            </div>
        </div>

        <!-- Panel Kanan (form login) -->
        <div class="flex w-full md:w-1/2 p-6 md:p-12 items-center justify-center min-h-screen">
            <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-10 md:p-12 fade-in">

                <!-- Logo mobile -->
                <div class="md:hidden text-center mb-6">
                    <img src="<?= base_url(
                                    "assets/img/iconlogin.png",
                                ) ?>" alt="Logo AWAS" class="w-20 mx-auto mb-2 fade-in">
                    <img src="<?= base_url(
                                    "assets/img/logo-nobg-black.png",
                                ) ?>" alt="Text AWAS" class="w-40 mx-auto fade-in">
                </div>

                <!-- Title -->
                <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center fade-in">Selamat Datang!</h2>
                <p class="text-sm text-gray-500 mb-6 text-center fade-in">Silakan masuk untuk melanjutkan</p>

                <?php if ($this->session->flashdata("error")): ?>
                    <p class="text-red-600 mb-4 text-sm text-center"><?= $this->session->flashdata(
                                                                            "error",
                                                                        ) ?></p>
                <?php endif; ?>

                <!-- Form -->
                <form action="<?= base_url(
                                    "login/login",
                                ) ?>" method="post" class="space-y-5 fade-in">

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nama pengguna</label>
                        <input type="text" id="username" name="username" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm
                            focus:border-red-600 focus:ring-2 focus:ring-red-200 outline-none text-sm transition">
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata sandi</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-2xl shadow-sm
                            focus:border-red-600 focus:ring-2 focus:ring-red-200 outline-none text-sm pr-12 transition">
                        <!-- Toggle Eye -->
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 bottom-3 text-gray-400 hover:text-red-600 transition">
                            <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478
                     0 8.268 2.943 9.542 7-1.274 4.057-5.064
                     7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full py-3 btn-red text-white font-semibold rounded-2xl shadow-lg transition">
                        Masuk
                    </button>
                </form>

                <!-- Footer -->
                <p class="text-xs text-gray-500 text-center mt-8">
                    &copy; <span id="year"></span> A.W.A.S. - Direktorat Jenderal Pemasyarakatan
                </p>

                <script>
                    document.getElementById('year').textContent = new Date().getFullYear();
                </script>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pass = document.getElementById('password');
            const eye = document.getElementById('icon-eye');

            if (pass.type === "password") {
                pass.type = "text";
                eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round"
                          d="M13.875 18.825A10.05 10.05 0 0112
                          19c-4.477 0-8.268-2.943-9.542-7
                          a9.956 9.956 0 012.541-4.263M9.88
                          9.88a3 3 0 104.24 4.24M6.1
                          6.1l11.8 11.8" />`;
            } else {
                pass.type = "password";
                eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 12a3 3 0 11-6 0 3 3
                          0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.458 12C3.732 7.943
                          7.523 5 12 5c4.478 0
                          8.268 2.943 9.542 7-1.274
                          4.057-5.064 7-9.542 7-4.477
                          0-8.268-2.943-9.542-7z" />`;
            }
        }
    </script>

</body>

</html>