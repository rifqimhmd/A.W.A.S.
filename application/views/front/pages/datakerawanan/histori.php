<main class="w-full min-h-screen">

    <!-- Flash Message -->
    <?php if ($this->session->flashdata("success")): ?>
        <div id="flash-message" class="bg-green-50 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base">
            <div class="flex items-start gap-3">
                <div class="text-xl">✅</div>
                <div><?= $this->session->flashdata("success") ?></div>
            </div>
        </div>
    <?php elseif ($this->session->flashdata("error")): ?>
        <div id="flash-message" class="bg-red-50 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base">
            <div class="flex items-start gap-3">
                <div class="text-xl">❌</div>
                <div><?= $this->session->flashdata("error") ?></div>
            </div>
        </div>
    <?php endif; ?>

    <script>
        // Auto hide flash message after 5 seconds
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.classList.add('opacity-0'); // fade out
                setTimeout(() => flash.remove(), 500); // remove from DOM after fade
            }
        }, 5000); // 5000ms = 5 detik
    </script>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-5 border-b pb-4 gap-3">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight flex items-center gap-3 text-red-700">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-lg bg-red-100 text-red-600 shadow-sm">
                    <i class="ri-bar-chart-box-line text-2xl"></i>
                </span>
                <span class="hover:text-red-800 transition-colors duration-200">Riwayat Kerawanan</span>
            </h2>
            <p class="text-sm text-gray-600 mt-2 ml-0.5">Detail riwayat skrining dan faktor kerawanan</p>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex flex-row items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <button onclick="toggleTable('narkotika')" id="btn-narkotika"
                class="px-4 py-2 rounded-lg shadow font-medium bg-red-600 text-white transition cursor-pointer">
                Narkotika
            </button>
            <button onclick="toggleTable('teroris')" id="btn-teroris"
                class="px-4 py-2 rounded-lg shadow font-medium bg-gray-200 text-gray-800 transition hover:bg-gray-300 cursor-pointer">
                Teroris
            </button>
        </div>
        <!-- Tombol Filter -->
        <div class="flex items-center gap-3">
            <button id="open-filter-btn"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 cursor-pointer transition">
                <i class="ri-filter-3-line text-lg"></i>
                Filter
            </button>
        </div>

        <!-- Modal Filter -->
        <div id="filter-modal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg p-6 w-11/12 max-w-md">
                <h2 class="text-lg font-semibold mb-4 flex items-center gap-2 text-gray-800">
                    <i class="ri-filter-3-line text-lg text-red-600"></i>
                    Filter
                </h2>

                <!-- Isi Filter -->
                <div class="flex flex-col gap-3">

                    <!-- Filter Tipe -->
                    <div class="flex items-center gap-2">
                        <label for="filter-tipe" class="w-28 text-sm text-gray-700">Tipe:</label>
                        <select id="filter-tipe"
                            class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="all">Semua</option>
                            <option value="Pegawai">Pegawai</option>
                            <option value="Narapidana">Narapidana</option>
                        </select>
                    </div>

                    <!-- Filter Level -->
                    <div class="flex items-center gap-2">
                        <label for="filter-level" class="w-28 text-sm text-gray-700">Level:</label>
                        <select id="filter-level"
                            class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="all">Semua</option>
                            <option value="Merah">Merah</option>
                            <option value="Kuning">Kuning</option>
                            <option value="Hijau">Hijau</option>
                        </select>
                    </div>

                    <!-- Filter UPT -->
                    <div class="flex items-center gap-2">
                        <label for="filter-upt" class="w-28 text-sm text-gray-700">UPT:</label>
                        <?php if ($this->session->userdata("role") === "upt"): ?>
                            <?php foreach ($list_upt as $upt): ?>
                                <input type="text"
                                    class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm"
                                    value="<?= $upt["nama_upt"] ?>" readonly>
                                <input type="hidden" name="upt" value="<?= $upt["id_upt"] ?>">
                            <?php endforeach; ?>
                        <?php else: ?>
                            <select id="filter-upt" name="upt"
                                class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                                <option value="all">Semua</option>
                                <?php foreach ($list_upt as $upt): ?>
                                    <option value="<?= htmlspecialchars($upt["nama_upt"]) ?>">
                                        <?= htmlspecialchars($upt["nama_upt"]) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </div>

                    <!-- Filter Kanwil -->
                    <div class="flex items-center gap-2">
                        <label for="filter-kanwil" class="w-28 text-sm text-gray-700">Kanwil:</label>
                        <?php if (
                            $this->session->userdata("role") === "kanwil" ||
                            $this->session->userdata("role") === "upt"
                        ): ?>
                            <?php foreach ($list_kanwil as $kanwil): ?>
                                <input type="text"
                                    class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm"
                                    value="<?= $kanwil["nama_kanwil"] ?>" readonly>
                                <input type="hidden" name="kanwil" value="<?= $kanwil["id_kanwil"] ?>">
                            <?php endforeach; ?>
                        <?php else: ?>
                            <select id="filter-kanwil" name="kanwil"
                                class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                                <option value="all">Semua</option>
                                <?php foreach ($list_kanwil as $kanwil): ?>
                                    <option value="<?= htmlspecialchars($kanwil["nama_kanwil"]) ?>">
                                        <?= htmlspecialchars($kanwil["nama_kanwil"]) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </div>

                    <!-- Filter Tindak Lanjut -->
                    <div class="flex items-center gap-2">
                        <label for="filter-tindaklanjut" class="w-28 text-sm text-gray-700">Tindak Lanjut:</label>
                        <select id="filter-tindaklanjut"
                            class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="all">Semua</option>
                            <option value="Belum ditindaklanjuti">Belum ditindaklanjuti</option>
                            <option value="Pemindahan">Pemindahan</option>
                            <option value="Pembinaan">Pembinaan</option>
                        </select>
                    </div>

                </div>

                <!-- Tombol Modal -->
                <div class="flex justify-end gap-2 mt-4">
                    <button id="close-filter-btn"
                        class="bg-gray-300 px-4 py-2 rounded-lg cursor-pointer">Batal</button>
                    <button id="apply-filter-btn"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg cursor-pointer">Terapkan</button>
                </div>
            </div>
        </div>

        <!-- Script Modal -->
        <script>
            const openBtn = document.getElementById("open-filter-btn");
            const closeBtn = document.getElementById("close-filter-btn");
            const modal = document.getElementById("filter-modal");

            openBtn.addEventListener("click", () => modal.classList.remove("hidden"));
            closeBtn.addEventListener("click", () => modal.classList.add("hidden"));

            modal.addEventListener("click", (e) => {
                if (e.target === modal) modal.classList.add("hidden");
            });

            // Tombol Terapkan (trigger filter)
            document.getElementById("apply-filter-btn").addEventListener("click", () => {
                applyFilters();
                modal.classList.add("hidden");
            });

            function applyFilters() {
                const tipe = document.getElementById("filter-tipe").value;
                const level = document.getElementById("filter-level").value;
                const upt = document.getElementById("filter-upt")?.value || null;
                const kanwil = document.getElementById("filter-kanwil")?.value || null;
                const tindakLanjut = document.getElementById("filter-tindaklanjut").value;

                console.log("Filter diterapkan:", {
                    tipe,
                    level,
                    upt,
                    kanwil,
                    tindakLanjut
                });

                // TODO: panggil AJAX / reload tabel sesuai kebutuhan
            }
        </script>

    </div>

    <!-- Table Narkotika -->
    <div id="table-narkotika" class="overflow-x-auto mt-6">

        <!-- Table Narkotika -->
        <div class="hidden sm:block overflow-x-auto mt-6">
            <div class="overflow-hidden min-w-[900px] bg-white shadow-md rounded-lg border border-gray-200">
                <table class="min-w-full border-collapse text-center">
                    <thead class="bg-gradient-to-r from-red-600 to-red-500 text-white text-sm sm:text-base">
                        <tr>
                            <th class="px-3 sm:px-5 py-3 font-semibold tracking-wide">No</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">No Register/NIP</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Nama</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Kanwil</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">UPT</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Level</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Tipe</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Tindak Lanjut</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-sm sm:text-base text-gray-700">
                        <?php if (!empty($narkotika)):
                            $no = 1;
                            foreach ($narkotika as $row): ?>
                                <tr class="hover:bg-gray-50 transition-all duration-200"
                                    data-tipe="<?= strtolower($row->tipe_object ?? '-') ?>"
                                    data-level="<?= strtolower($row->level ?? '-') ?>"
                                    data-upt="<?= strtolower($row->nama_upt ?? '-') ?>"
                                    data-kanwil="<?= strtolower($row->nama_kanwil ?? '-') ?>"
                                    data-tindak="<?= strtolower($row->tindak_lanjut ?? '-') ?>">

                                    <td class="px-3 sm:px-5 py-3 font-medium text-gray-800"><?= $no++ ?></td>
                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars(
                                                                        $row->tipe_object === 'Pegawai'
                                                                            ? ($row->nip ?? '-')
                                                                            : ($row->no_register ?? '-')
                                                                    ) ?></td>
                                    <td class="px-3 sm:px-5 py-3 font-medium text-left"><?= htmlspecialchars(
                                                                                            $row->nama_pegawai ?? ($row->nama_narapidana ?? '-')
                                                                                        ) ?></td>
                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($row->nama_kanwil ?? '-') ?></td>
                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($row->nama_upt ?? '-') ?></td>
                                    <td class="px-3 sm:px-5 py-3">
                                        <?php
                                        $levelColor = [
                                            "Merah" => "bg-red-100 text-red-700",
                                            "Kuning" => "bg-yellow-100 text-yellow-700",
                                            "Hijau" => "bg-green-100 text-green-700",
                                        ];
                                        $color = $levelColor[$row->level] ?? "bg-gray-100 text-gray-600";
                                        ?>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                            <?= htmlspecialchars($row->level ?? '-') ?>
                                        </span>
                                    </td>
                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($row->tipe_object ?? '-') ?></td>
                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($row->tindak_lanjut ?? '-') ?></td>
                                    <td class="px-3 sm:px-5 py-3">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick='showDetail(<?= json_encode($row) ?>)'
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-500 hover:bg-blue-600 text-white shadow-sm transition"
                                                title="Detail">
                                                <i class="ri-search-line text-lg"></i>
                                            </button>
                                            <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')"
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-indigo-500 hover:bg-indigo-600 text-white shadow-sm transition"
                                                title="Jawaban">
                                                <i class="ri-file-list-2-line text-lg"></i>
                                            </button>
                                            <?php if ($row->level !== 'Hijau'): ?>
                                                <a href="<?= site_url('histori/edit/' . $row->id_hasil) ?>"
                                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-amber-500 hover:bg-amber-600 text-white shadow-sm transition"
                                                    title="Edit">
                                                    <i class="ri-edit-2-line text-lg"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($this->session->userdata('role') === 'admin'): ?>
                                                <a href="<?= site_url('histori/delete/' . $row->id_hasil) ?>"
                                                    onclick="return confirm('Yakin hapus data ini?')"
                                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-500 hover:bg-red-600 text-white shadow-sm transition"
                                                    title="Hapus">
                                                    <i class="ri-delete-bin-6-line text-lg"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else: ?>
                            <tr>
                                <td colspan="9" class="py-10 text-gray-500 italic">Belum ada data narkotika</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Cards Narkotika -->
        <div class="block sm:hidden space-y-3">
            <?php if (!empty($narkotika)):
                $no = 1;
                foreach ($narkotika as $row): ?>
                    <div class="p-4 bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg hover:bg-red-50 transition-all duration-200"
                        data-tipe="<?= strtolower($row->tipe_object ?? "-") ?>"
                        data-level="<?= strtolower($row->level ?? "-") ?>"
                        data-upt="<?= strtolower($row->nama_upt ?? "-") ?>"
                        data-kanwil="<?= strtolower(
                                            $row->nama_kanwil ?? "-",
                                        ) ?>"
                        data-tindak="<?= strtolower($row->tindak_lanjut ?? '-') ?>">

                        <!-- Header -->
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-red-600">#<?= $no++ ?></span>
                        </div>

                        <!-- Body -->
                        <div class="text-gray-700 text-sm space-y-1">
                            <div><span class="font-medium text-gray-900">No Register/NIP:</span>
                                <?= htmlspecialchars(
                                    $row->tipe_object === "Pegawai"
                                        ? $row->nip ?? "-"
                                        : $row->no_register ?? "-",
                                ) ?>
                            </div>
                            <div><span class="font-medium text-gray-900">Nama:</span>
                                <?= htmlspecialchars(
                                    $row->nama_pegawai ??
                                        ($row->nama_narapidana ?? "-"),
                                ) ?>
                            </div>
                            <div><span class="font-medium text-gray-900">Kanwil:</span>
                                <?= htmlspecialchars(
                                    $row->nama_kanwil ?? "-",
                                ) ?>
                            </div>
                            <div><span class="font-medium text-gray-900">UPT:</span>
                                <?= htmlspecialchars($row->nama_upt ?? "-") ?>
                            </div>
                            <div><span class="font-medium text-gray-900">Level:</span>
                                <?php $color =
                                    $levelColor[$row->level] ??
                                    "bg-gray-100 text-gray-600"; ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                    <?= htmlspecialchars($row->level ?? "-") ?>
                                </span>
                            </div>
                            <div><span class="font-medium text-gray-900">Tindak Lanjut:</span>
                                <?= htmlspecialchars($row->tindak_lanjut ?? "-") ?>
                            </div>
                            <div><span class="font-medium text-gray-900">Tipe:</span>
                                <?= htmlspecialchars(
                                    $row->tipe_object ?? "-",
                                ) ?>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-2 mt-4">
                            <button onclick='showDetail(<?= json_encode(
                                                            $row,
                                                        ) ?>)'
                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-500 hover:bg-blue-600 text-white shadow-sm transition"
                                title="Detail">
                                <i class="ri-search-line text-lg"></i>
                            </button>
                            <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')"
                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-indigo-500 hover:bg-indigo-600 text-white shadow-sm transition"
                                title="Jawaban">
                                <i class="ri-file-text-line text-lg"></i>
                            </button>
                            <?php if ($row->level !== "Hijau"): ?>
                                <a href="<?= site_url('histori/edit/' . $row->id_hasil) ?>"
                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-amber-500 hover:bg-amber-600 text-white shadow-sm transition"
                                    title="Edit">
                                    <i class="ri-edit-2-line text-lg"></i>
                                </a>
                            <?php endif; ?>
                            <?php
                            $role = $this->session->userdata("role");
                            if ($role === "admin"): ?>
                                <a href="<?= site_url("histori/delete/" . $row->id_hasil) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-500 hover:bg-red-600 text-white shadow-sm transition"
                                    title="Hapus">
                                    <i class="ri-delete-bin-6-line text-lg"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;
            else:
                ?>
                <div class="p-4 text-center text-gray-500 italic">Belum ada data narkotika</div>
            <?php
            endif; ?>
        </div>
    </div>

    <!-- Table Teroris -->
    <div id="table-teroris" class="overflow-x-auto hidden mt-6">

        <!-- Table Teroris -->
        <div class="hidden sm:block overflow-x-auto mt-6">
            <div class="bg-white shadow-md rounded-lg border border-gray-200 overflow-hidden min-w-[900px]">
                <table class="min-w-full border-collapse text-center">
                    <thead class="bg-gradient-to-r from-red-600 to-red-500 text-white text-sm sm:text-base">
                        <tr>
                            <th class="px-3 sm:px-5 py-3 font-semibold tracking-wide">No</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">No Register/NIP</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Nama</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Kanwil</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">UPT</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Level</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Tipe</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Tindak Lanjut</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-sm sm:text-base text-gray-700">
                        <?php if (!empty($teroris)):
                            $no = 1;
                            foreach ($teroris as $row): ?>
                                <tr class="hover:bg-gray-50 transition-all duration-200"
                                    data-tipe="<?= strtolower($row->tipe_object ?? '-') ?>"
                                    data-level="<?= strtolower($row->level ?? '-') ?>"
                                    data-upt="<?= strtolower($row->nama_upt ?? '-') ?>"
                                    data-kanwil="<?= strtolower($row->nama_kanwil ?? '-') ?>"
                                    data-tindak="<?= strtolower($row->tindak_lanjut ?? '-') ?>">


                                    <td class="px-3 sm:px-5 py-3 font-medium text-gray-800"><?= $no++ ?></td>

                                    <td class="px-3 sm:px-5 py-3">
                                        <?= htmlspecialchars(
                                            $row->tipe_object === 'Pegawai'
                                                ? ($row->nip ?? '-')
                                                : ($row->no_register ?? '-')
                                        ) ?>
                                    </td>

                                    <td class="px-3 sm:px-5 py-3 text-left font-medium">
                                        <?= htmlspecialchars(
                                            $row->nama_pegawai ?? ($row->nama_narapidana ?? '-')
                                        ) ?>
                                    </td>

                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($row->nama_kanwil ?? '-') ?></td>
                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($row->nama_upt ?? '-') ?></td>

                                    <td class="px-3 sm:px-5 py-3">
                                        <?php
                                        $levelColor = [
                                            "Merah"  => "bg-red-100 text-red-700",
                                            "Kuning" => "bg-yellow-100 text-yellow-700",
                                            "Hijau"  => "bg-green-100 text-green-700",
                                        ];
                                        $color = $levelColor[$row->level] ?? "bg-gray-100 text-gray-600";
                                        ?>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                            <?= htmlspecialchars($row->level ?? '-') ?>
                                        </span>
                                    </td>

                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($row->tipe_object ?? '-') ?></td>
                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($row->tindak_lanjut ?? '-') ?></td>

                                    <td class="px-3 sm:px-5 py-3">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick='showDetail(<?= json_encode($row) ?>)'
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-500 hover:bg-blue-600 text-white shadow-sm transition"
                                                title="Detail">
                                                <i class="ri-search-line text-lg"></i>
                                            </button>

                                            <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')"
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-indigo-500 hover:bg-indigo-600 text-white shadow-sm transition"
                                                title="Jawaban">
                                                <i class="ri-file-list-2-line text-lg"></i>
                                            </button>

                                            <?php if ($row->level !== 'Hijau'): ?>
                                                <a href="<?= site_url('histori/edit/' . $row->id_hasil) ?>"
                                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-amber-500 hover:bg-amber-600 text-white shadow-sm transition"
                                                    title="Edit">
                                                    <i class="ri-edit-2-line text-lg"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if ($this->session->userdata('role') === 'admin'): ?>
                                                <a href="<?= site_url('histori/delete/' . $row->id_hasil) ?>"
                                                    onclick="return confirm('Yakin hapus data ini?')"
                                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-500 hover:bg-red-600 text-white shadow-sm transition"
                                                    title="Hapus">
                                                    <i class="ri-delete-bin-6-line text-lg"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else: ?>
                            <tr>
                                <td colspan="9" class="py-10 text-gray-500 italic">Belum ada data teroris</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Cards Teroris -->
        <div class="block sm:hidden space-y-3">
            <?php if (!empty($teroris)):
                $no = 1;
                foreach ($teroris as $row): ?>
                    <div class="p-4 bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg hover:bg-red-50 transition-all duration-200"
                        data-tipe="<?= strtolower($row->tipe_object ?? "-") ?>"
                        data-level="<?= strtolower($row->level ?? "-") ?>"
                        data-upt="<?= strtolower($row->nama_upt ?? "-") ?>"
                        data-kanwil="<?= strtolower(
                                            $row->nama_kanwil ?? "-",
                                        ) ?>"
                        data-tindak="<?= strtolower($row->tindak_lanjut ?? '-') ?>">

                        <!-- Header -->
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-red-600">#<?= $no++ ?></span>
                        </div>

                        <!-- Body -->
                        <div class="text-gray-700 text-sm space-y-1">
                            <div><span class="font-medium text-gray-900">No Register/NIP:</span>
                                <?= htmlspecialchars(
                                    $row->tipe_object === "Pegawai"
                                        ? $row->nip ?? "-"
                                        : $row->no_register ?? "-",
                                ) ?>
                            </div>
                            <div><span class="font-medium text-gray-900">Nama:</span>
                                <?= htmlspecialchars(
                                    $row->nama_pegawai ??
                                        ($row->nama_narapidana ?? "-"),
                                ) ?>
                            </div>
                            <div><span class="font-medium text-gray-900">Kanwil:</span>
                                <?= htmlspecialchars(
                                    $row->nama_kanwil ?? "-",
                                ) ?>
                            </div>
                            <div><span class="font-medium text-gray-900">UPT:</span>
                                <?= htmlspecialchars($row->nama_upt ?? "-") ?>
                            </div>
                            <div><span class="font-medium text-gray-900">Level:</span>
                                <?php $color =
                                    $levelColor[$row->level] ??
                                    "bg-gray-100 text-gray-600"; ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                    <?= htmlspecialchars($row->level ?? "-") ?>
                                </span>
                            </div>
                            <div><span class="font-medium text-gray-900">Tindak Lanjut:</span>
                                <?= htmlspecialchars(
                                    $row->tindak_lanjut ?? "-",
                                ) ?>
                            </div>
                            <div><span class="font-medium text-gray-900">Tipe:</span>
                                <?= htmlspecialchars(
                                    $row->tipe_object ?? "-",
                                ) ?>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-2 mt-4">
                            <!-- Detail -->
                            <button onclick='showDetail(<?= json_encode(
                                                            $row,
                                                        ) ?>)'
                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-500 hover:bg-blue-600 text-white shadow-sm transition"
                                title="Detail">
                                <i class="ri-search-line text-lg"></i>
                            </button>

                            <!-- Jawaban -->
                            <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')"
                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-indigo-500 hover:bg-indigo-600 text-white shadow-sm transition"
                                title="Jawaban">
                                <i class="ri-file-text-line text-lg"></i>
                            </button>
                            <?php if ($row->level !== "Hijau"): ?>
                                <a href="<?= site_url('histori/edit/' . $row->id_hasil) ?>"
                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-amber-500 hover:bg-amber-600 text-white shadow-sm transition"
                                    title="Edit">
                                    <i class="ri-edit-2-line text-lg"></i>
                                </a>
                            <?php endif; ?>
                            <?php
                            $role = $this->session->userdata("role");
                            if ($role === "admin"): ?>
                                <a href="<?= site_url("histori/delete/" . $row->id_hasil) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-500 hover:bg-red-600 text-white shadow-sm transition"
                                    title="Hapus">
                                    <i class="ri-delete-bin-6-line text-lg"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;
            else:
                ?>
                <div class="p-4 text-center text-gray-500 italic">Belum ada data teroris</div>
            <?php
            endif; ?>
        </div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal"
        class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full relative mx-4">
            <h3 class="text-xl font-semibold text-blue-700 p-6 pb-3 flex items-center gap-2">
                <i class="ri-file-list-3-line text-2xl"></i>
                Detail Data
            </h3>
            <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto" id="detailContent">
                <p><strong>No Register/NIP:</strong> <span id="detailNoReg">-</span></p>
                <p><strong>Nama:</strong> <span id="detailNama">-</span></p>
                <p><strong>Kanwil:</strong> <span id="detailKanwil">-</span></p>
                <p><strong>UPT:</strong> <span id="detailUPT">-</span></p>
                <p><strong>Kategori:</strong> <span id="detailKategori">-</span></p>
                <p><strong>Nilai Akhir:</strong> <span id="detailNilai">-</span></p>
                <p><strong>Level:</strong> <span id="detailLevel">-</span></p>
                <p><strong>Tipe:</strong> <span id="detailTipe">-</span></p>
                <p><strong>Perkara:</strong> <span id="detailPerkara">-</span></p>
                <p><strong>Antisipasi:</strong> <span id="detailAntisipasi">-</span></p>
                <p><strong>Solusi:</strong> <span id="detailSolusi">-</span></p>
                <p><strong>Tindak Lanjut:</strong> <span id="tindaklanjut">-</span></p>
                <p><strong>Dokumen:</strong>
                    <a id="fileLink" href="#" target="_blank" class="text-blue-600 underline">
                        <span id="filedokumen">-</span>
                    </a>
                </p>
                <p><strong>Created At:</strong> <span id="detailCreated">-</span></p>
            </div>
            <div class="flex justify-end space-x-3 p-6 pt-0">
                <button onclick="closeDetail()"
                    class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer hover:bg-gray-300">Tutup</button>
            </div>
            <button onclick="closeDetail()"
                class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>
    </div>

    <!-- Modal Jawaban -->
    <div id="jawabanModal"
        class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-lg max-w-3xl w-full relative mx-4">
            <h3 class="text-xl font-semibold text-red-700 p-6 pb-3 flex items-center gap-2">
                <i class="ri-file-list-line text-2xl"></i>
                Detail Jawaban
            </h3>
            <div class="flex border-b border-gray-200 px-6">
                <button onclick="switchTab('skrining')" id="tab-skrining"
                    class="px-4 py-2 font-medium text-red-600 border-b-2 border-red-600">Skrining</button>
                <button onclick="switchTab('bahaya')" id="tab-bahaya"
                    class="px-4 py-2 font-medium text-gray-600 hover:text-red-600">Faktor Bahaya</button>
                <button onclick="switchTab('kerentanan')" id="tab-kerentanan"
                    class="px-4 py-2 font-medium text-gray-600 hover:text-red-600">Faktor Kerentanan</button>
            </div>
            <div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto">
                <div id="content-skrining">
                    <table class="table-auto w-full border border-gray-300 rounded-lg text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-4 py-2">Indikator Skrining</th>
                                <th class="border px-4 py-2">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody id="skriningTable" class="divide-y divide-gray-200 text-gray-600"></tbody>
                    </table>
                </div>
                <div id="content-bahaya" class="hidden">
                    <table class="table-auto w-full border border-gray-300 rounded-lg text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-4 py-2">Indikator Faktor</th>
                                <th class="border px-4 py-2">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody id="bahayaTable" class="divide-y divide-gray-200 text-gray-600"></tbody>
                    </table>
                </div>
                <div id="content-kerentanan" class="hidden">
                    <table class="table-auto w-full border border-gray-300 rounded-lg text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-4 py-2">Indikator Faktor</th>
                                <th class="border px-4 py-2">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody id="kerentananTable" class="divide-y divide-gray-200 text-gray-600"></tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-end space-x-3 p-6 pt-0">
                <button onclick="closeJawaban()"
                    class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer hover:bg-gray-300">Tutup</button>
            </div>
            <button onclick="closeJawaban()"
                class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>
    </div>

    <script>
        function toggleTable(type) {
            const narkotika = document.getElementById('table-narkotika');
            const teroris = document.getElementById('table-teroris');
            const btnN = document.getElementById('btn-narkotika');
            const btnT = document.getElementById('btn-teroris');

            // sembunyikan semua tabel
            narkotika.classList.add('hidden');
            teroris.classList.add('hidden');

            // reset style tombol
            [btnN, btnT].forEach(btn => {
                btn.classList.remove('bg-red-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
            });

            if (type === 'narkotika') {
                narkotika.classList.remove('hidden');
                btnN.classList.add('bg-red-600', 'text-white');
                btnN.classList.remove('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
            } else {
                teroris.classList.remove('hidden');
                btnT.classList.add('bg-red-600', 'text-white');
                btnT.classList.remove('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
            }

            // simpan tab aktif
            localStorage.setItem("activeTab", type);
        }

        // Saat halaman dimuat, cek localStorage
        window.addEventListener('DOMContentLoaded', function() {
            let activeTab = localStorage.getItem('activeTab');
            if (activeTab !== "narkotika" && activeTab !== "teroris") {
                activeTab = "narkotika"; // default
                localStorage.setItem("activeTab", "narkotika");
            }
            toggleTable(activeTab);
        });

        function showDetail(rowData) {
            document.getElementById("detailNoReg").textContent = rowData.nip || rowData.no_register || "-";
            document.getElementById("detailNama").textContent = rowData.nama_pegawai || rowData.nama_narapidana || "-";
            document.getElementById("detailKanwil").textContent = rowData.nama_kanwil || "-";
            document.getElementById("detailUPT").textContent = rowData.nama_upt || "-";
            document.getElementById("detailKategori").textContent = rowData.jenis_skrining || "-";
            document.getElementById("detailNilai").textContent = rowData.nilai_akhir || "-";
            const levelEl = document.getElementById("detailLevel");
            const levelVal = rowData.level ? rowData.level.toString() : "-";
            // Set teks tetap dulu
            levelEl.textContent = levelVal;
            if (levelVal.toLowerCase() === "merah") {
                levelEl.classList.add("text-red-600");
            } else if (levelVal.toLowerCase() === "kuning") {
                levelEl.classList.add("text-yellow-600");
            } else if (levelVal.toLowerCase() === "hijau") {
                levelEl.classList.add("text-green-600");
            } else {
                levelEl.classList.add("text-gray-600");
            }
            document.getElementById("detailTipe").textContent = rowData.tipe_object || "-";
            document.getElementById("detailPerkara").textContent = rowData.perkara || "-";
            document.getElementById("detailAntisipasi").textContent = rowData.nama_antisipasi || "-";
            document.getElementById("detailSolusi").textContent = rowData.solusi || "-";
            document.getElementById("detailCreated").textContent = rowData.created_at || "-";
            document.getElementById("tindaklanjut").textContent = rowData.tindak_lanjut || "-";
            document.getElementById("filedokumen").textContent = rowData.nama_file || "-";

            const fileLink = document.getElementById("fileLink");
            if (rowData.nama_file) {
                fileLink.href = "<?= base_url(
                                        "uploads/",
                                    ) ?>" + rowData.nama_file;
                fileLink.classList.remove("pointer-events-none", "text-gray-400");
            } else {
                fileLink.href = "#";
                fileLink.classList.add("pointer-events-none", "text-gray-400");
            }

            const modal = document.getElementById("detailModal");
            modal.classList.remove("opacity-0", "pointer-events-none", "hidden");
        }

        function closeDetail() {
            const modal = document.getElementById("detailModal");
            modal.classList.add("opacity-0", "pointer-events-none");
            setTimeout(() => modal.classList.add("hidden"), 300);
        }

        function showJawaban(id_hasil) {
            fetch("<?= base_url("histori/get_jawaban/") ?>" + id_hasil)
                .then(res => res.json())
                .then(data => {
                    let skriningHtml = "";
                    data.skrining.forEach(item => {
                        if (item.indikator_skrining && item.jawaban !== null) {
                            skriningHtml += `<tr>
                        <td class="border px-4 py-2">${item.indikator_skrining}</td>
                        <td class="border px-4 py-2 text-center">${item.jawaban}</td>
                    </tr>`;
                        }
                    });
                    document.getElementById("skriningTable").innerHTML =
                        skriningHtml || '<tr><td colspan="2" class="text-center py-2">Tidak ada jawaban</td></tr>';

                    let bahayaHtml = "";
                    data.bahaya.forEach(item => {
                        bahayaHtml += `<tr>
                    <td class="border px-4 py-2">${item.indikator_faktor}</td>
                    <td class="border px-4 py-2 text-center">${item.jawaban}</td>
                </tr>`;
                    });
                    document.getElementById("bahayaTable").innerHTML =
                        bahayaHtml || '<tr><td colspan="2" class="text-center py-2">Tidak ada jawaban</td></tr>';

                    let kerentananHtml = "";
                    data.kerentanan.forEach(item => {
                        kerentananHtml += `<tr>
                    <td class="border px-4 py-2">${item.indikator_faktor}</td>
                    <td class="border px-4 py-2 text-center">${item.jawaban}</td>
                </tr>`;
                    });
                    document.getElementById("kerentananTable").innerHTML =
                        kerentananHtml || '<tr><td colspan="2" class="text-center py-2">Tidak ada jawaban</td></tr>';

                    const modal = document.getElementById("jawabanModal");
                    modal.classList.remove("opacity-0", "pointer-events-none", "hidden");
                    switchTab("skrining");
                })
                .catch(err => {
                    console.error("Gagal ambil data:", err);
                    alert("Terjadi kesalahan saat mengambil data.");
                });
        }

        function closeJawaban() {
            const modal = document.getElementById("jawabanModal");
            modal.classList.add("opacity-0", "pointer-events-none");
            setTimeout(() => modal.classList.add("hidden"), 300);
        }

        function switchTab(tab) {
            const tabs = ["skrining", "bahaya", "kerentanan"];
            tabs.forEach(t => {
                document.getElementById("content-" + t).classList.add("hidden");
                document.getElementById("tab-" + t).classList.remove("text-red-600", "border-b-2", "border-red-600");
                document.getElementById("tab-" + t).classList.add("text-gray-600");
            });
            document.getElementById("content-" + tab).classList.remove("hidden");
            document.getElementById("tab-" + tab).classList.add("text-red-600", "border-b-2", "border-red-600");
        }

        let initialLoad = true; // flag load pertama

        // ===== Ambil filter dari URL hash =====
        function getFiltersFromURL() {
            const params = new URLSearchParams(location.hash.slice(1)); // hash setelah #
            const filters = {};

            for (const [key, value] of params.entries()) {
                filters[key.toLowerCase()] = value;
            }

            return {
                tipe: filters.tipe || "all",
                level: filters.level || "all",
                upt: filters.upt || "all",
                kanwil: filters.kanwil || "all",
                tindak: filters.tindak || "all" // 🔹 tambahkan tindak lanjut
            };
        }

        function applyFilters() {
            const tipe = document.getElementById("filter-tipe")?.value || "all";
            const level = document.getElementById("filter-level")?.value || "all";
            const upt = document.getElementById("filter-upt")?.value || "all";
            const kanwil = document.getElementById("filter-kanwil")?.value || "all";
            const tindak = document.getElementById("filter-tindaklanjut")?.value || "all"; // ✅ ambil dari dropdown

            // ===== Update hash hanya jika bukan load pertama =====
            if (!initialLoad) {
                const params = new URLSearchParams();
                if (tipe !== "all") params.set("tipe", tipe);
                if (level !== "all") params.set("level", level);
                if (upt !== "all") params.set("upt", upt);
                if (kanwil !== "all") params.set("kanwil", kanwil);
                if (tindak !== "all") params.set("tindak", tindak);
                window.location.hash = params.toString();
            }

            const tables = ["narkotika", "teroris"];

            tables.forEach(tableId => {
                // ===== Desktop rows =====
                let visibleCount = 0; // Nomor dinamis
                document.querySelectorAll(`#table-${tableId} tbody tr[data-tipe]`).forEach(row => {
                    const rowTipe = row.dataset.tipe;
                    const rowLevel = row.dataset.level;
                    const rowUpt = row.dataset.upt;
                    const rowKanwil = row.dataset.kanwil;
                    const rowTindak = row.dataset.tindak;

                    const showRow =
                        (tipe === "all" || rowTipe === tipe.toLowerCase()) &&
                        (level === "all" || rowLevel === level.toLowerCase()) &&
                        (upt === "all" || rowUpt === upt.toLowerCase()) &&
                        (kanwil === "all" || rowKanwil === kanwil.toLowerCase()) &&
                        (tindak === "all" || rowTindak === tindak.toLowerCase());

                    if (showRow) {
                        row.style.display = "table-row";
                        visibleCount++;
                        // Update nomor dinamis
                        row.querySelector("td:first-child").textContent = visibleCount;
                    } else {
                        row.style.display = "none";
                    }
                });

                // ===== Mobile cards =====
                let mobileCount = 0;
                document.querySelectorAll(`#table-${tableId} .block.sm\\:hidden > div[data-tipe]`).forEach(card => {
                    const cardTipe = card.dataset.tipe;
                    const cardLevel = card.dataset.level;
                    const cardUpt = card.dataset.upt;
                    const cardKanwil = card.dataset.kanwil;
                    const cardTindak = card.dataset.tindak;

                    const showCard =
                        (tipe === "all" || cardTipe === tipe.toLowerCase()) &&
                        (level === "all" || cardLevel === level.toLowerCase()) &&
                        (upt === "all" || cardUpt === upt.toLowerCase()) &&
                        (kanwil === "all" || cardKanwil === kanwil.toLowerCase()) &&
                        (tindak === "all" || cardTindak === tindak.toLowerCase());

                    if (showCard) {
                        card.style.display = "block";
                        mobileCount++;
                        // Update nomor dinamis di header card
                        card.querySelector("span.font-semibold.text-red-600").textContent = "#" + mobileCount;
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        }

        // ===== Set filter dropdown dari URL hash saat load =====
        function setFiltersFromURL() {
            const filters = getFiltersFromURL();

            Object.keys(filters).forEach(f => {
                const el = document.getElementById(`filter-${f}`);
                if (el) el.value = filters[f];
            });

            applyFilters();
            initialLoad = false; // setelah load pertama, hash boleh diupdate
        }

        window.addEventListener("DOMContentLoaded", () => {
            setFiltersFromURL();

            // ===== Desktop dropdown listener =====
            ["filter-tipe", "filter-level", "filter-upt", "filter-kanwil", "filter-tindaklanjut"].forEach(id => { // 🔹 tambah tindaklanjut
                const el = document.getElementById(id);
                if (el) el.addEventListener("change", applyFilters);
            });

            // ===== Sinkronisasi modal mobile =====
            function syncMobileOptions() {
                ['tipe', 'level', 'upt', 'kanwil', 'tindaklanjut'].forEach(f => { // 🔹 tambah tindaklanjut
                    const desktop = document.getElementById(`filter-${f}`);
                    const mobile = document.getElementById(`filter-${f}-mobile`);
                    if (desktop && mobile) {
                        mobile.innerHTML = desktop.innerHTML;
                        mobile.value = desktop.value;
                    }
                });
            }

            document.getElementById('open-filter-btn').addEventListener('click', () => {
                syncMobileOptions();
                document.getElementById('filter-modal').classList.remove('hidden');
            });

            document.getElementById('close-filter-btn').addEventListener('click', () => {
                document.getElementById('filter-modal').classList.add('hidden');
            });

            document.getElementById('apply-filter-btn').addEventListener('click', () => {
                ['tipe', 'level', 'upt', 'kanwil', 'tindaklanjut'].forEach(f => { // 🔹 tambah tindaklanjut
                    const desktop = document.getElementById(`filter-${f}`);
                    const mobile = document.getElementById(`filter-${f}-mobile`);
                    if (desktop && mobile) desktop.value = mobile.value;
                });
                applyFilters();
                document.getElementById('filter-modal').classList.add('hidden');
            });
        });
    </script>
</main>