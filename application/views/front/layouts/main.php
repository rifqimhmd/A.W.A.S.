<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicon 
        -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">
</head>

<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <?php $this->load->view('front/layouts/header'); ?>
    <!-- End of Header -->

    <main class="flex-1 bg-white">
        <?php $this->load->view($page); ?>
    </main>

    <!-- Footer -->
    <?php $this->load->view('front/layouts/footer'); ?>
    <!-- End of Footer -->


    <!-- Script -->
    <script>
        // Toggle mobile menu
        const toggleBtn = document.getElementById("menu-toggle");
        const mobileMenu = document.getElementById("mobile-menu");

        toggleBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("max-h-0");
            mobileMenu.classList.toggle("max-h-96");
        });

        // Set tahun otomatis
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>

</body>

</html>