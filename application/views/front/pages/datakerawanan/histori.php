<main class="w-full p-6 bg-white rounded-2xl shadow-lg space-y-8">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-gray-200 pb-4">
        <h2 class="text-2xl sm:text-3xl font-bold text-red-700">📋 Data Riwayat</h2>
        <a href="<?= site_url('input') ?>"
            class="mt-3 sm:mt-0 bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl shadow text-sm sm:text-base transition">
            ➕ Input Data
        </a>
    </div>


    <!-- Flash Message -->
    <?php if ($this->session->flashdata('success')): ?>
        <div id="flash-message"
            class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm transition-opacity duration-500">
            ✅ <?= $this->session->flashdata('success') ?>
        </div>

        <script>
            setTimeout(() => {
                const flash = document.getElementById('flash-message');
                if (flash) {
                    flash.style.opacity = '0'; // animasi fade out
                    setTimeout(() => flash.remove(), 500); // hapus dari DOM setelah fade
                }
            }, 10000); // 10 detik
        </script>
    <?php endif; ?>

    <!-- Dropdown Sort -->
    <form method="get" class="flex justify-end mb-4">
        <div class="relative">
            <select name="order" onchange="this.form.submit()"
                class="appearance-none px-4 py-2 rounded-xl text-sm text-gray-700 bg-white 
             border border-gray-200 shadow-sm cursor-pointer transition
             focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent
             hover:shadow-md pr-10">
                <!-- Ganti ▼ dengan ↓ -->
                <option value="DESC" <?= ($order === 'DESC' && $this->input->get('order')) ? 'selected' : '' ?>>↓ Nilai Terbesar</option>
                <!-- Ganti ▲ dengan ↑ -->
                <option value="ASC" <?= ($order === 'ASC') ? 'selected' : '' ?>>↑ Nilai Terkecil</option>
            </select>

            <!-- Icon dropdown -->
            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
    </form>

    <script>
        document.querySelector('select[name="sort"]').addEventListener('change', function() {
            if (this.value === "nilai_akhir_DESC") {
                window.location = "?sort=nilai_akhir&order=DESC";
            } else if (this.value === "nilai_akhir_ASC") {
                window.location = "?sort=nilai_akhir&order=ASC";
            } else {
                window.location = "?sort=h.created_at&order=DESC";
            }
        });
    </script>

    <!-- Tabel -->
    <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-sm w-full">
        <table class="w-full border-collapse text-sm sm:text-base">
            <!-- Header -->
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3 text-center">Nama Kanwil</th>
                    <th class="px-4 py-3 text-center">Nama UPT</th>
                    <th class="px-4 py-3 text-center">Nama WBP</th>
                    <th class="px-4 py-3 text-center">Kategori</th>
                    <th class="px-4 py-3 text-center">Nilai Akhir</th>
                    <th class="px-4 py-3 text-center">Level</th>
                    <th class="px-4 py-3 text-center">Antisipasi</th>
                    <th class="px-4 py-3 text-center">Solusi</th>
                    <th class="px-4 py-3 text-center">Created At</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($hasil)): ?>
                    <?php $no = 1;
                    foreach ($hasil as $row): ?>
                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-3 text-gray-800 text-center"><?= $no++ ?></td>
                            <td class="px-4 py-3 text-gray-700 text-center"><?= $row->nama_kanwil ?></td>
                            <td class="px-4 py-3 text-gray-700 text-center"><?= $row->nama_upt ?></td>
                            <td class="px-4 py-3 font-medium text-gray-900 text-center"><?= htmlspecialchars($row->nama_wbp) ?></td>
                            <td class="px-4 py-3 text-gray-700 text-center"><?= $row->nama_kategori ?></td>
                            <td class="px-4 py-3 font-semibold text-gray-800 text-center"><?= $row->nilai_akhir ?><b>%</b></td>

                            <!-- Level -->
                            <td class="px-4 py-3 text-center 
                                <?php
                                if ($row->warna_antisipasi == 'Merah') echo 'text-red-600';
                                elseif ($row->warna_antisipasi == 'Kuning') echo 'text-yellow-500';
                                elseif ($row->warna_antisipasi == 'Hijau') echo 'text-green-600';
                                else echo 'text-gray-700';
                                ?>">
                                <b><?= $row->warna_antisipasi ?></b>
                            </td>
                            <td class="px-4 py-3 text-gray-700 text-center"><?= $row->nama_antisipasi ?></td>
                            <td class="px-4 py-3 text-gray-900 text-center">
                                <?php
                                if ($row->warna_antisipasi == 'Merah') echo 'Pembatasan gerak dan pemindahan dengan isolasi';
                                elseif ($row->warna_antisipasi == 'Kuning') echo 'Pembatasan gerak atau isolasi';
                                elseif ($row->warna_antisipasi == 'Hijau') echo 'Peningkatan kepatuhan, Reward & Punishment';
                                else echo '-';
                                ?>
                            </td>
                            <td class="px-4 py-3 text-gray-500 text-center"><?= date('d M Y', strtotime($row->created_at)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center py-6 text-gray-500 italic">Tidak ada data hasil.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>