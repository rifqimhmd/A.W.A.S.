<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login AWAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/iconlogin.png') ?>">
</head>

<body class="min-h-screen bg-gray-100 font-sans flex items-center justify-center">

    <main
        class="w-full max-w-md p-8 bg-white rounded-none md:rounded-2xl shadow-none md:shadow-xl min-h-screen md:min-h-0 flex flex-col justify-center">

        <!-- Header -->
        <div class="mb-6 text-center">
            <!-- Icon Gembok -->
            <div class="flex justify-center mb-2">
                <img src="<?= base_url('assets/img/iconlogin.png') ?>" alt="Logo AWAS" class="w-28 mx-auto mb-2">
            </div>

            <img src="<?= base_url('assets/img/logo-nobg-black.png') ?>" alt="Text AWAS" class="w-44 mx-auto mb-2">
            <h2 class="text-2xl font-bold text-red-700">Masuk ke Sistem</h2>
            <?php if ($this->session->flashdata('error')): ?>
                <p class="text-red-600"><?= $this->session->flashdata('error'); ?></p>
            <?php endif; ?>
        </div>

        <!-- Form -->
        <form action="<?= base_url('login/login') ?>" method="post" class="space-y-6 flex-1 flex flex-col justify-center">

            <!-- Username -->
            <div>
                <label for="username" class="block text-gray-800 font-medium mb-2">Nama pengguna</label>
                <input type="text" id="username" name="username" placeholder="Masukkan Nama pengguna" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition focus:ring-2 focus:ring-red-600 focus:border-red-600 focus:shadow-md focus:outline-none text-base">
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="block text-gray-800 font-medium mb-2">Kata sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition focus:ring-2 focus:ring-red-600 focus:border-red-600 focus:shadow-md focus:outline-none text-base pr-12">

                <!-- Tombol toggle password -->
                <button type="button" onclick="togglePassword()"
                    class="absolute right-3 text-gray-400 hover:text-red-600 transition duration-300"
                    style="top: 50%; transform: translateY(10%);">
                    <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <!-- Tombol Login -->
            <div>
                <button type="submit"
                    class="w-full px-6 py-3 bg-red-600 text-white font-semibold rounded-xl shadow-lg hover:bg-red-700 active:scale-95 transition transform duration-150">
                    Masuk
                </button>
            </div>
        </form>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Lupa kata sandi?
            <a href="https://wa.me/6282110822052" target="_blank" class="text-red-600 hover:underline font-medium">
                Hubungi Admin
            </a>
        </p>
    </main>

    <script>
        function togglePassword() {
            const pass = document.getElementById('password');
            const eye = document.getElementById('icon-eye');

            if (pass.type === "password") {
                pass.type = "text";
                eye.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.541-4.263M9.88 9.88a3 3 0 104.24 4.24M6.1 6.1l11.8 11.8" />
        `;
            } else {
                pass.type = "password";
                eye.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        `;
            }
        }
    </script>

</body>

</html>