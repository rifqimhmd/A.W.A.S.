<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="<?= base_url(
                                                "assets/img/iconlogin.png",
                                            ) ?>">
    <title><?= $title ?></title>
</head>

<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <?php $this->load->view("front/layouts/header"); ?>
    <!-- End of Header -->

    <div id="content-wrapper" style="margin-left:0; width:100%;" class="flex-1 bg-white pt-16 transition-all duration-300 flex flex-col">
        <main class="w-full min-h-screen flex-1 px-2 sm:px-4 sm:pt-4 lg:pt-8 pt-0 pb-2">
            <?php $this->load->view($page); ?>
        </main>
    </div>

    <!-- Footer -->
    <?php $this->load->view("front/layouts/footer"); ?>
    <!-- End of Footer -->

    <script>
        // Set tahun otomatis
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>

</body>

</html>