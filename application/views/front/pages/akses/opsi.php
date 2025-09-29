<main class="w-full min-h-screen">

    <!-- Flash Message -->
    <?php if ($this->session->flashdata("success")): ?>
        <div class="bg-green-50 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base">
            <div class="flex items-start gap-3">
                <div class="text-xl">✅</div>
                <div><?= $this->session->flashdata("success") ?></div>
            </div>
        </div>
    <?php elseif ($this->session->flashdata("error")): ?>
        <div class="bg-red-50 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base">
            <div class="flex items-start gap-3">
                <div class="text-xl">❌</div>
                <div><?= $this->session->flashdata("error") ?></div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center  mb-4 sm:mb-5 border-b pb-0 sm:pb-4 gap-3">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-red-700 tracking-tight">⚙️ Manajemen Opsi</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data Skrining dan Faktor — tambahkan, edit, atau hapus.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="hidden sm:flex items-center gap-2">
                <label for="limit-select" class="text-sm text-gray-700">Tampilkan:</label>
                <select id="limit-select" onchange="changeLimit()"
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm">
                    <option value="25" <?= $limit == 25
                    	? "selected"
                    	: "" ?>>25</option>
                    <option value="50" <?= $limit == 50
                    	? "selected"
                    	: "" ?>>50</option>
                    <option value="100" <?= $limit == 100
                    	? "selected"
                    	: "" ?>>100</option>
                </select>
            </div>

            <!-- Tombol Tambah Opsi -->
            <!-- Desktop -->
            <button onclick="document.getElementById('modal-add').checked = true"
                class="cursor-pointer hidden sm:inline-flex bg-red-600 hover:bg-red-700 text-white font-medium px-4 sm:px-5 py-2 rounded-xl shadow-md transition transform hover:scale-105 text-sm sm:text-base">
                ➕ Tambah Opsi
            </button>

            <!-- Mobile (FAB) -->
            <button onclick="document.getElementById('modal-add').checked = true"
                class="cursor-pointer sm:hidden fixed bottom-5 right-5 w-14 h-14 flex items-center justify-center rounded-full bg-red-600 hover:bg-red-700 text-white shadow-lg transition transform hover:scale-110">
                ➕
            </button>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <button onclick="toggleTable('skrining')" id="btn-skrining"
                class="px-4 py-2 rounded-lg shadow font-medium bg-red-600 text-white transition cursor-pointer">Skrining</button>
            <button onclick="toggleTable('faktor')" id="btn-faktor"
                class="px-4 py-2 rounded-lg shadow font-medium bg-gray-200 text-gray-800 transition hover:bg-gray-300 cursor-pointer">Faktor</button>
        </div>

        <!-- FILTER: Desktop & Mobile -->
        <div class="flex items-center gap-4">
            <!-- Desktop filters -->
            <div class="hidden sm:flex items-center gap-4" id="filters-desktop">
                <div class="flex items-center gap-2">
                    <label for="filter-jenis" class="text-sm text-gray-700">Jenis:</label>
                    <select id="filter-jenis" onchange="onFilterChange('filter-jenis')"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm">
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <label for="filter-instrument" class="text-sm text-gray-700">Instrument:</label>
                    <select id="filter-instrument" onchange="onFilterChange('filter-instrument')"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm">
                        <option value="all">Semua</option>
                        <option value="Narkotika">Narkotika</option>
                        <option value="Teroris">Teroris</option>
                    </select>
                </div>
            </div>

            <!-- Mobile filters -->
            <div class="sm:hidden flex flex-col gap-3 w-full" id="filters-mobile">
                <div class="flex items-center gap-2 w-full">
                    <label for="filter-jenis-mobile" class="text-sm text-gray-700">Jenis:</label>
                    <select id="filter-jenis-mobile" onchange="onFilterChange('filter-jenis-mobile')"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm w-full">
                    </select>
                </div>

                <div class="flex items-center gap-2 w-full">
                    <label for="filter-instrument-mobile" class="text-sm text-gray-700">Instrument:</label>
                    <select id="filter-instrument-mobile" onchange="onFilterChange('filter-instrument-mobile')"
                        class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm w-full">
                        <option value="all">Semua</option>
                        <option value="Narkotika">Narkotika</option>
                        <option value="Teroris">Teroris</option>
                    </select>
                </div>
            </div>

        </div>

        <!-- Mobile limit control -->
        <div class="sm:hidden">
            <label for="limit-select-mobile" class="text-sm text-gray-700 mr-2">Tampilkan:</label>
            <select id="limit-select-mobile" onchange="changeLimitFromMobile()" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm">
                <option value="25" <?= $limit == 25
                	? "selected"
                	: "" ?>>25</option>
                <option value="50" <?= $limit == 50
                	? "selected"
                	: "" ?>>50</option>
                <option value="100" <?= $limit == 100
                	? "selected"
                	: "" ?>>100</option>
            </select>
        </div>
    </div>


    <!-- CONTENT CARD: Skrining -->
    <div id="table-skrining" class="overflow-x-auto">
        <div class="overflow-hidden bg-white shadow-md rounded-lg border border-gray-200">
            <!-- Table untuk Desktop -->
            <table class="min-w-full text-center border-collapse hidden sm:table">
                <thead class="bg-red-600 text-white text-sm sm:text-base">
                    <tr>
                        <th class="px-2 sm:px-4 py-3 font-semibold">No</th>
                        <th class="px-2 sm:px-4 py-3 font-semibold">Indikator</th>
                        <th class="px-2 sm:px-4 py-3 font-semibold">Jenis</th>
                        <th class="px-2 sm:px-4 py-3 font-semibold">Instrument</th>
                        <th class="px-2 sm:px-4 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm sm:text-base">
                    <?php if (!empty($skrining)): ?>
                        <?php
                        $no = $start_skrining + 1;
                        foreach ($skrining as $s): ?>
                            <tr class="hover:bg-red-100 transition">
                                <td class="px-2 sm:px-4 py-3"><?= $no++ ?></td>
                                <td class="px-2 sm:px-4 py-3 text-left indikator"><?= htmlspecialchars(
                                	$s->indikator_skrining,
                                ) ?></td>
                                <td class="px-2 sm:px-4 py-3 jenis"><?= htmlspecialchars(
                                	$s->jenis_skrining,
                                ) ?></td>
                                <td class="px-2 sm:px-4 py-3 instrument"><?= htmlspecialchars(
                                	$s->nama_instrument,
                                ) ?></td>
                                <td class="px-2 sm:px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <label for="modal-edit-skrining-<?= $s->id_skrining ?>"
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow cursor-pointer"
                                            title="Edit">✏️</label>
                                        <a href="<?= site_url(
                                        	"opsi/delete_skrining/" .
                                        		$s->id_skrining,
                                        ) ?>"
                                            onclick="return confirm('Yakin hapus data ini?')" title="Hapus"
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow">🗑️</a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit Skrining -->
                            <input type="checkbox" id="modal-edit-skrining-<?= $s->id_skrining ?>" class="modal-toggle hidden" />
                            <div class="modal fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                                <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative mx-4">
                                    <h3 class="text-xl font-semibold text-red-700 mb-3">✏️ Edit Skrining</h3>
                                    <form method="post" action="<?= site_url(
                                    	"opsi/update_skrining/" .
                                    		$s->id_skrining,
                                    ) ?>" class="space-y-4">
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Indikator Skrining</label>
                                            <input type="text" name="indikator_skrining" value="<?= htmlspecialchars(
                                            	$s->indikator_skrining,
                                            ) ?>"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Jenis Skrining</label>
                                            <select name="jenis_skrining" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none" required>
                                                <?php
                                                $options = [
                                                	"Pengguna",
                                                	"Pengedar",
                                                	"Pengendali",
                                                	"Ideolog",
                                                	"Pengikut",
                                                ];
                                                foreach ($options as $opt): ?>
                                                    <option value="<?= $opt ?>" <?= $s->jenis_skrining ==
$opt
	? "selected"
	: "" ?>><?= $opt ?></option>
                                                <?php endforeach;
                                                ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Instrument</label>
                                            <input type="text" value="<?= htmlspecialchars(
                                            	$s->nama_instrument,
                                            ) ?>" class="w-full border border-gray-200 rounded-lg px-3 py-2 bg-gray-50" readonly>
                                        </div>

                                        <div class="flex justify-end items-center gap-3 mt-3">
                                            <label for="modal-edit-skrining-<?= $s->id_skrining ?>" class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer">Batal</label>
                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg cursor-pointer">Simpan</button>
                                        </div>
                                    </form>
                                    <label for="modal-edit-skrining-<?= $s->id_skrining ?>" class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</label>
                                </div>
                            </div>
                            <style>
                                #modal-edit-skrining-<?= $s->id_skrining ?>:checked+.modal {
                                    opacity: 1;
                                    pointer-events: auto;
                                }
                            </style>
                        <?php endforeach;
                        ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-500 italic">Belum ada data Skrining.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Card untuk Mobile -->
            <div class="block sm:hidden divide-y divide-gray-100">
                <?php if (!empty($skrining)): ?>
                    <?php
                    $no = $start_skrining + 1;
                    foreach ($skrining as $s): ?>
                        <div class="p-4 bg-white hover:bg-red-50 transition">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-red-600">#<?= $no++ ?></span>
                            </div>

                            <div class="text-gray-700 text-sm space-y-1">
                                <div><span class="font-medium">Indikator:</span> <?= htmlspecialchars(
                                	$s->indikator_skrining,
                                ) ?></div>
                                <div><span class="font-medium">Jenis:</span> <?= htmlspecialchars(
                                	$s->jenis_skrining,
                                ) ?></div>
                                <div><span class="font-medium">Instrument:</span> <?= htmlspecialchars(
                                	$s->nama_instrument,
                                ) ?></div>
                            </div>

                            <div class="flex justify-end gap-2 mt-3">
                                <label for="modal-edit-skrining-<?= $s->id_skrining ?>"
                                    class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow cursor-pointer"
                                    title="Edit">✏️</label>

                                <a href="<?= site_url(
                                	"opsi/delete_skrining/" . $s->id_skrining,
                                ) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')" title="Hapus"
                                    class="w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow">🗑️</a>
                            </div>
                        </div>
                    <?php endforeach;
                    ?>
                <?php else: ?>
                    <div class="p-4 text-center text-gray-500 italic">Belum ada data Skrining.</div>
                <?php endif; ?>
            </div>
        </div>

        <div class="px-4 py-4 border-t flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <div class="text-sm text-gray-600">Menampilkan <?= count(
            	$skrining ?? [],
            ) ?> entri</div>
            <div class="text-sm"><?= $pagination_skrining ?? "" ?></div>
        </div>
    </div>

    <!-- CONTENT CARD: Faktor -->
    <div id="table-faktor" class="overflow-x-auto hidden mt-6">

        <!-- Tampilan Desktop (Table) -->
        <div class="hidden sm:block overflow-hidden min-w-[600px] bg-white shadow-md rounded-lg border border-gray-200">
            <table class="min-w-full text-center border-collapse">
                <thead class="bg-red-600 text-white text-sm sm:text-base">
                    <tr>
                        <th class="px-2 sm:px-4 py-3 font-semibold">No</th>
                        <th class="px-2 sm:px-4 py-3 font-semibold">Indikator</th>
                        <th class="px-2 sm:px-4 py-3 font-semibold">Jenis</th>
                        <th class="px-2 sm:px-4 py-3 font-semibold">Instrument</th>
                        <th class="px-2 sm:px-4 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm sm:text-base">
                    <?php if (!empty($faktor)): ?>
                        <?php
                        $no = $start_faktor + 1;
                        foreach ($faktor as $f): ?>
                            <tr class="hover:bg-red-100 transition">
                                <td class="px-2 sm:px-4 py-3"><?= $no++ ?></td>
                                <td class="px-2 sm:px-4 py-3 text-left indikator"><?= htmlspecialchars(
                                	$f->indikator_faktor,
                                ) ?></td>
                                <td class="px-2 sm:px-4 py-3 jenis"><?= htmlspecialchars(
                                	$f->jenis_faktor,
                                ) ?></td>
                                <td class="px-2 sm:px-4 py-3 instrument"><?= htmlspecialchars(
                                	$f->nama_instrument,
                                ) ?></td>
                                <td class="px-2 sm:px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <label for="modal-edit-faktor-<?= $f->id_faktor ?>"
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow cursor-pointer"
                                            title="Edit">✏️</label>
                                        <a href="<?= site_url(
                                        	"opsi/delete_faktor/" .
                                        		$f->id_faktor,
                                        ) ?>"
                                            onclick="return confirm('Yakin hapus data ini?')" title="Hapus"
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow">🗑️</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;
                        ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-500 italic">Belum ada data Faktor.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Tampilan Mobile (Cards) -->
        <div class="block sm:hidden divide-y divide-gray-100">
            <?php if (!empty($faktor)): ?>
                <?php
                $no = $start_faktor + 1;
                foreach ($faktor as $f): ?>
                    <div class="p-4 bg-white hover:bg-red-50 transition">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-red-600">#<?= $no++ ?></span>
                        </div>

                        <div class="text-gray-700 text-sm space-y-1">
                            <div><span class="font-medium">Indikator:</span> <?= htmlspecialchars(
                            	$f->indikator_faktor,
                            ) ?></div>
                            <div><span class="font-medium">Jenis:</span> <?= htmlspecialchars(
                            	$f->jenis_faktor,
                            ) ?></div>
                            <div><span class="font-medium">Instrument:</span> <?= htmlspecialchars(
                            	$f->nama_instrument,
                            ) ?></div>
                        </div>

                        <div class="flex justify-end gap-2 mt-3">
                            <label for="modal-edit-faktor-<?= $f->id_faktor ?>"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow cursor-pointer"
                                title="Edit">✏️</label>
                            <a href="<?= site_url(
                            	"opsi/delete_faktor/" . $f->id_faktor,
                            ) ?>"
                                onclick="return confirm('Yakin hapus data ini?')" title="Hapus"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow">🗑️</a>
                        </div>
                    </div>
                <?php endforeach;
                ?>
            <?php else: ?>
                <div class="p-4 text-center text-gray-500 italic">Belum ada data Faktor.</div>
            <?php endif; ?>
        </div>

        <!-- Modal Edit Faktor (Diletakkan di luar agar bisa diakses desktop & mobile) -->
        <?php if (!empty($faktor)): ?>
            <?php foreach ($faktor as $f): ?>
                <input type="checkbox" id="modal-edit-faktor-<?= $f->id_faktor ?>" class="modal-toggle hidden" />
                <div class="modal fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                    <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative mx-4">
                        <h3 class="text-xl font-semibold text-red-700 mb-3">✏️ Edit Faktor</h3>
                        <form method="post" action="<?= site_url(
                        	"opsi/update_faktor/" . $f->id_faktor,
                        ) ?>" class="space-y-4">
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">Indikator Faktor</label>
                                <input type="text" name="indikator_faktor" value="<?= htmlspecialchars(
                                	$f->indikator_faktor,
                                ) ?>"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">Jenis Faktor</label>
                                <select name="jenis_faktor" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none" required>
                                    <option value="Bahaya" <?= $f->jenis_faktor ==
                                    "Bahaya"
                                    	? "selected"
                                    	: "" ?>>Bahaya</option>
                                    <option value="Kerentanan" <?= $f->jenis_faktor ==
                                    "Kerentanan"
                                    	? "selected"
                                    	: "" ?>>Kerentanan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">Instrument</label>
                                <select name="id_instrument" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none" required>
                                    <?php foreach ($instrument as $i): ?>
                                        <option value="<?= $i->id_instrument ?>" <?= $f->id_instrument ==
$i->id_instrument
	? "selected"
	: "" ?>>
                                            <?= htmlspecialchars(
                                            	$i->nama_instrument,
                                            ) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="flex justify-end items-center gap-3 mt-3">
                                <label for="modal-edit-faktor-<?= $f->id_faktor ?>" class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer">Batal</label>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg cursor-pointer">Simpan</button>
                            </div>
                        </form>
                        <label for="modal-edit-faktor-<?= $f->id_faktor ?>" class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</label>
                    </div>
                </div>
                <style>
                    #modal-edit-faktor-<?= $f->id_faktor ?>:checked+.modal {
                        opacity: 1;
                        pointer-events: auto;
                    }
                </style>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Footer -->
        <div class="px-4 py-4 border-t flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <div class="text-sm text-gray-600">Menampilkan <?= count(
            	$faktor ?? [],
            ) ?> entri</div>
            <div class="text-sm"><?= $pagination_faktor ?? "" ?></div>
        </div>
    </div>

    <!-- Modal Tambah Opsi -->
    <input type="checkbox" id="modal-add" class="modal-toggle hidden" />
    <div class="modal fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative mx-4">
            <h3 class="text-xl font-semibold text-red-700 mb-3">➕ Tambah Opsi</h3>
            <form method="post" action="<?= site_url(
            	"opsi/store",
            ) ?>" class="space-y-4" id="form-opsi">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Pilih Opsi</label>
                    <select name="opsi_type" id="opsi_type" onchange="toggleForm()" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                        <option value="">-- Pilih Opsi --</option>
                        <option value="skrining">Skrining</option>
                        <option value="faktor">Faktor</option>
                    </select>
                </div>

                <!-- Form Skrining -->
                <div id="form-skrining" class="hidden space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Indikator Skrining</label>
                        <input type="text" name="indikator_skrining" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Jenis Skrining</label>
                        <select name="jenis_skrining" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="Pengguna">Pengguna</option>
                            <option value="Pengedar">Pengedar</option>
                            <option value="Pengendali">Pengendali</option>
                            <option value="Ideolog">Ideolog</option>
                            <option value="Pengikut">Pengikut</option>
                        </select>
                    </div>
                </div>

                <!-- Form Faktor -->
                <div id="form-faktor" class="hidden space-y-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Indikator Faktor</label>
                        <input type="text" name="indikator_faktor" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Jenis Faktor</label>
                        <select name="jenis_faktor" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="Bahaya">Bahaya</option>
                            <option value="Kerentanan">Kerentanan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Instrument</label>
                        <select name="id_instrument" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <?php foreach ($instrument as $i): ?>
                                <option value="<?= $i->id_instrument ?>"><?= htmlspecialchars(
	$i->nama_instrument,
) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-4">
                    <label for="modal-add" class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer">Batal</label>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg cursor-pointer">Simpan</button>
                </div>
            </form>
            <label for="modal-add" class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</label>
        </div>
    </div>

    <style>
        /* modal checkbox trick */
        #modal-add:checked+.modal,
        .modal-toggle:checked+.modal {
            opacity: 1;
            pointer-events: auto;
        }
    </style>

    <!-- SCRIPTS -->
    <script>
        // Toggle form add skrining/faktor
        function toggleForm() {
            const type = document.getElementById('opsi_type').value;
            document.getElementById('form-skrining').classList.add('hidden');
            document.getElementById('form-faktor').classList.add('hidden');

            if (type === 'skrining') document.getElementById('form-skrining').classList.remove('hidden');
            if (type === 'faktor') document.getElementById('form-faktor').classList.remove('hidden');
        }

        // Change limit (desktop)
        function changeLimit() {
            const val = document.getElementById('limit-select').value;
            window.location.href = '<?= site_url("opsi") ?>?limit=' + val;
        }

        // Change limit (mobile)
        function changeLimitFromMobile() {
            const val = document.getElementById('limit-select-mobile').value;
            window.location.href = '<?= site_url("opsi") ?>?limit=' + val;
        }

        // opsi jenis
        const jenisOptions = {
            skrining: ["Pengguna", "Pengedar", "Pengendali", "Ideolog", "Pengikut"],
            faktor: ["Bahaya", "Kerentanan"]
        };

        // populate pilihan Jenis untuk desktop & mobile
        function populateJenis(type) {
            const desktop = document.getElementById("filter-jenis");
            const mobile = document.getElementById("filter-jenis-mobile");
            if (!desktop || !mobile) return;

            // simpan current supaya kalau opsi sama tetap terpilih bila memungkinkan
            const current = desktop.value || "all";

            desktop.innerHTML = "";
            mobile.innerHTML = "";

            // opsi "Semua"
            const optAll = document.createElement("option");
            optAll.value = "all";
            optAll.textContent = "Semua";
            desktop.appendChild(optAll);
            mobile.appendChild(optAll.cloneNode(true));

            (jenisOptions[type] || []).forEach(j => {
                const opt = document.createElement("option");
                opt.value = j;
                opt.textContent = j;
                desktop.appendChild(opt);

                const opt2 = document.createElement("option");
                opt2.value = j;
                opt2.textContent = j;
                mobile.appendChild(opt2);
            });

            // try to restore previous selection if available
            if ([...desktop.options].some(o => o.value === current)) {
                desktop.value = current;
                mobile.value = current;
            } else {
                desktop.value = "all";
                mobile.value = "all";
            }
        }

        // toggle tab + simpan ke localStorage + update UI
        function toggleTable(type) {
            const skr = document.getElementById("table-skrining");
            const fak = document.getElementById("table-faktor");
            const btnS = document.getElementById("btn-skrining");
            const btnF = document.getElementById("btn-faktor");

            // hide both first
            skr.classList.add("hidden");
            fak.classList.add("hidden");
            btnS.classList.remove("bg-red-600", "text-white");
            btnS.classList.add("bg-gray-200", "text-gray-800");
            btnF.classList.remove("bg-red-600", "text-white");
            btnF.classList.add("bg-gray-200", "text-gray-800");

            if (type === "skrining") {
                skr.classList.remove("hidden");
                btnS.classList.add("bg-red-600", "text-white");
                btnS.classList.remove("bg-gray-200", "text-gray-800");
            } else {
                fak.classList.remove("hidden");
                btnF.classList.add("bg-red-600", "text-white");
                btnF.classList.remove("bg-gray-200", "text-gray-800");
            }

            // populate jenis sesuai tab aktif
            populateJenis(type);

            // simpan tab aktif
                localStorage.setItem("activeTab", type);

                // jalankan filter setelah tab diganti supaya tampilan sesuai
                if (typeof applyFilters === "function") applyFilters();
        }

        // Saat halaman dimuat, cek localStorage
        window.addEventListener('DOMContentLoaded', function() {
            let activeTab = localStorage.getItem('activeTab');
            if (activeTab !== "skrining" && activeTab !== "faktor") {
                activeTab = "skrining"; // default
                localStorage.setItem("activeTab", "skrining");
            }
            toggleTable(activeTab);
        });

        // helper untuk parsing card mobile (mencari "Jenis:" dan "Instrument:")
        function parseCardInfo(card) {
            // cari elemen yang biasanya memuat informasi
            const infoEl = card.querySelector('.text-gray-700') || card;
            const text = infoEl.innerText.replace(/\r/g, '').trim();
            const lines = text.split('\n').map(l => l.trim()).filter(Boolean);
            let jenis = '';
            let instrument = '';
            lines.forEach(line => {
                if (line.toLowerCase().startsWith('jenis:')) {
                    jenis = line.substring(6).trim();
                }
                if (line.toLowerCase().startsWith('instrument:')) {
                    instrument = line.substring(11).trim();
                }
            });
            return {
                jenis,
                instrument
            };
        }

        // applyFilters + simpan ke localStorage
        function applyFilters() {
            const jenis = document.getElementById("filter-jenis") ? document.getElementById("filter-jenis").value : "all";
            const instrument = document.getElementById("filter-instrument") ? document.getElementById("filter-instrument").value : "all";

            // simpan filter
            localStorage.setItem("filterJenis", jenis);
            localStorage.setItem("filterInstrument", instrument);

            // cek tab aktif (skrining atau faktor)
            const isSkrining = !document.getElementById("table-skrining").classList.contains("hidden");
            const activeTableId = isSkrining ? "table-skrining" : "table-faktor";

            // FILTER BARIS DESKTOP (jika ada)
            const desktopTable = document.querySelector(`#${activeTableId} table`);
            if (desktopTable) {
                desktopTable.querySelectorAll('tbody tr').forEach(row => {
                    // pastikan baris data (skip empty/placeholder)
                    const jenisCell = row.querySelector('td.jenis') ? row.querySelector('td.jenis').innerText.trim() : (row.cells[2] ? row.cells[2].innerText.trim() : '');
                    const instrCell = row.querySelector('td.instrument') ? row.querySelector('td.instrument').innerText.trim() : (row.cells[3] ? row.cells[3].innerText.trim() : '');

                    let visible = true;
                    if (jenis !== "all" && jenisCell !== jenis) visible = false;
                    if (instrument !== "all" && instrCell !== instrument) visible = false;

                    row.style.display = visible ? "" : "none";
                });
            }

            // FILTER CARD MOBILE
            // cari container yang memiliki kelas responsive 'sm:hidden' menggunakan attribute selector agar tidak perlu escape colon
            const mobileContainer = document.querySelector(`#${activeTableId} [class*="sm:hidden"]`);
            if (mobileContainer) {
                Array.from(mobileContainer.children).forEach(card => {
                    // card bisa berupa div modal/style (skip jika bukan card data) => anggap card yang memiliki teks "Indikator" / "Jenis"
                    const txt = card.innerText || '';
                    if (!txt.toLowerCase().includes('indikator') && !txt.toLowerCase().includes('jenis')) {
                        // kemungkinan bukan card data (mis. placeholder). tampilkan default.
                        card.style.display = "";
                        return;
                    }

                    const info = parseCardInfo(card);
                    let visible = true;
                    if (jenis !== "all" && info.jenis !== jenis) visible = false;
                    if (instrument !== "all" && info.instrument !== instrument) visible = false;

                    card.style.display = visible ? "" : "none";
                });
            }
        }

        // central handler untuk perubahan pada filter (desktop atau mobile)
        function onFilterChange(id) {
            // sync desktop <-> mobile
            if (id === 'filter-jenis') {
                const v = document.getElementById('filter-jenis').value;
                const mob = document.getElementById('filter-jenis-mobile');
                if (mob) mob.value = v;
            } else if (id === 'filter-jenis-mobile') {
                const v = document.getElementById('filter-jenis-mobile').value;
                const des = document.getElementById('filter-jenis');
                if (des) des.value = v;
            } else if (id === 'filter-instrument') {
                const v = document.getElementById('filter-instrument').value;
                const mob = document.getElementById('filter-instrument-mobile');
                if (mob) mob.value = v;
            } else if (id === 'filter-instrument-mobile') {
                const v = document.getElementById('filter-instrument-mobile').value;
                const des = document.getElementById('filter-instrument');
                if (des) des.value = v;
            }

            // apply
            applyFilters();
        }

        // inisialisasi saat load
        document.addEventListener("DOMContentLoaded", function() {
            const savedTab = localStorage.getItem("activeTab") || "skrining";
            const savedJenis = localStorage.getItem("filterJenis") || "all";
            const savedInstrument = localStorage.getItem("filterInstrument") || "all";

            // populate jenis sesuai savedTab
            populateJenis(savedTab);

            // set instrument selects (desktop & mobile)
            const instDesktop = document.getElementById('filter-instrument');
            const instMobile = document.getElementById('filter-instrument-mobile');
            if (instDesktop) instDesktop.value = savedInstrument;
            if (instMobile) instMobile.value = savedInstrument;

            // set jenis selects
            const jenisDesktop = document.getElementById('filter-jenis');
            const jenisMobile = document.getElementById('filter-jenis-mobile');
            if (jenisDesktop) jenisDesktop.value = savedJenis;
            if (jenisMobile) jenisMobile.value = savedJenis;

            // tampilkan tab tersimpan (ini juga memanggil populateJenis)
            toggleTable(savedTab);

            // jalankan filter otomatis berdasarkan nilai tersimpan
            applyFilters();
        });
    </script>
</main>
