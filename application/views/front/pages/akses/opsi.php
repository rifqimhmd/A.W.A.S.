<main class="w-full min-h-screen p-4 sm:p-6 bg-gray-50">

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base">
            <div class="flex items-start gap-3">
                <div class="text-xl">✅</div>
                <div><?= $this->session->flashdata('success') ?></div>
            </div>
        </div>
    <?php elseif ($this->session->flashdata('error')): ?>
        <div class="bg-red-50 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base">
            <div class="flex items-start gap-3">
                <div class="text-xl">❌</div>
                <div><?= $this->session->flashdata('error') ?></div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b pb-4 gap-3">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-red-700 tracking-tight">⚙️ Manajemen Opsi</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola data Skrining dan Faktor — tambahkan, edit, atau hapus.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="hidden sm:flex items-center gap-2">
                <label for="limit-select" class="text-sm text-gray-700">Tampilkan:</label>
                <select id="limit-select" onchange="changeLimit()"
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm">
                    <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
                </select>
            </div>

            <button onclick="document.getElementById('modal-add').checked = true"
                class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 sm:px-5 py-2 rounded-xl shadow-md transition transform hover:scale-105 text-sm sm:text-base">
                ➕ Tambah Opsi
            </button>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <button onclick="toggleTable('skrining')" id="btn-skrining"
                class="px-4 py-2 rounded-lg shadow font-medium bg-red-600 text-white transition">Skrining</button>
            <button onclick="toggleTable('faktor')" id="btn-faktor"
                class="px-4 py-2 rounded-lg shadow font-medium bg-gray-200 text-gray-800 transition hover:bg-gray-300">Faktor</button>
        </div>
        <!-- Mobile limit control -->
        <div class="sm:hidden">
            <label for="limit-select-mobile" class="text-sm text-gray-700 mr-2">Tampilkan:</label>
            <select id="limit-select-mobile" onchange="changeLimitFromMobile()" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm">
                <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
                <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
            </select>
        </div>
    </div>

    <!-- CONTENT CARD: Skrining -->
    <div id="table-skrining" class="overflow-x-auto">
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="min-w-full text-center border-collapse">
                <thead class="bg-red-600 text-white text-sm sm:text-base">
                    <tr>
                        <th class="px-4 py-3 font-semibold">No</th>
                        <th class="px-4 py-3 font-semibold text-left">Indikator</th>
                        <th class="px-4 py-3 font-semibold">Jenis</th>
                        <th class="px-4 py-3 font-semibold">Instrument</th>
                        <th class="px-4 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm sm:text-base">
                    <?php if (!empty($skrining)): ?>
                        <?php $no = 1 + (isset($_GET['page_skrining']) ? $_GET['page_skrining'] : 0);
                        foreach ($skrining as $s): ?>
                            <tr class="hover:bg-red-50 transition">
                                <td class="px-4 py-3"><?= $no++ ?></td>
                                <td class="px-4 py-3 text-left"><?= htmlspecialchars($s->indikator_skrining) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($s->jenis_skrining) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($s->nama_instrument) ?></td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <label for="modal-edit-skrining-<?= $s->id_skrining ?>"
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow cursor-pointer"
                                            title="Edit">
                                            ✏️
                                        </label>
                                        <a href="<?= site_url('opsi/delete_skrining/' . $s->id_skrining) ?>"
                                            onclick="return confirm('Yakin hapus data ini?')" title="Hapus"
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow">
                                            🗑️
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit Skrining (per item) -->
                            <input type="checkbox" id="modal-edit-skrining-<?= $s->id_skrining ?>" class="modal-toggle hidden" />
                            <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                                <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative mx-4">
                                    <h3 class="text-xl font-semibold text-red-700 mb-3">✏️ Edit Skrining</h3>
                                    <form method="post" action="<?= site_url('opsi/update_skrining/' . $s->id_skrining) ?>" class="space-y-4">
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Indikator Skrining</label>
                                            <input type="text" name="indikator_skrining" value="<?= htmlspecialchars($s->indikator_skrining) ?>"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Jenis Skrining</label>
                                            <select name="jenis_skrining" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none" required>
                                                <?php $options = ['Pengguna', 'Pengedar', 'Pengendali', 'Ideolog', 'Pengikut'];
                                                foreach ($options as $opt): ?>
                                                    <option value="<?= $opt ?>" <?= $s->jenis_skrining == $opt ? 'selected' : '' ?>><?= $opt ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Instrument</label>
                                            <input type="text" value="<?= htmlspecialchars($s->nama_instrument) ?>" class="w-full border border-gray-200 rounded-lg px-3 py-2 bg-gray-50" readonly>
                                        </div>

                                        <div class="flex justify-end items-center gap-3 mt-3">
                                            <label for="modal-edit-skrining-<?= $s->id_skrining ?>" class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer">Batal</label>
                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
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
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-500 italic">Belum ada data Skrining.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="px-4 py-4 border-t flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                <div class="text-sm text-gray-600">Menampilkan <?= count($skrining ?? []) ?> entri</div>
                <div class="text-sm"><?= $pagination_skrining ?? '' ?></div>
            </div>
        </div>
    </div>

    <!-- CONTENT CARD: Faktor -->
    <div id="table-faktor" class="overflow-x-auto hidden mt-6">
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="min-w-full text-center border-collapse">
                <thead class="bg-red-600 text-white text-sm sm:text-base">
                    <tr>
                        <th class="px-4 py-3 font-semibold">No</th>
                        <th class="px-4 py-3 font-semibold text-center">Indikator</th>
                        <th class="px-4 py-3 font-semibold">Jenis</th>
                        <th class="px-4 py-3 font-semibold">Instrument</th>
                        <th class="px-4 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm sm:text-base">
                    <?php if (!empty($faktor)): ?>
                        <?php $no = 1 + (isset($_GET['page_faktor']) ? $_GET['page_faktor'] : 0);
                        foreach ($faktor as $f): ?>
                            <tr class="hover:bg-red-50 transition">
                                <td class="px-4 py-3"><?= $no++ ?></td>
                                <td class="px-4 py-3 text-left"><?= htmlspecialchars($f->indikator_faktor) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($f->jenis_faktor) ?></td>
                                <td class="px-4 py-3"><?= htmlspecialchars($f->nama_instrument) ?></td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <label for="modal-edit-faktor-<?= $f->id_faktor ?>"
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow cursor-pointer"
                                            title="Edit">
                                            ✏️
                                        </label>
                                        <a href="<?= site_url('opsi/delete_faktor/' . $f->id_faktor) ?>"
                                            onclick="return confirm('Yakin hapus data ini?')" title="Hapus"
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow">
                                            🗑️
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit Faktor -->
                            <input type="checkbox" id="modal-edit-faktor-<?= $f->id_faktor ?>" class="modal-toggle hidden" />
                            <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                                <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative mx-4">
                                    <h3 class="text-xl font-semibold text-red-700 mb-3">✏️ Edit Faktor</h3>
                                    <form method="post" action="<?= site_url('opsi/update_faktor/' . $f->id_faktor) ?>" class="space-y-4">
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Indikator Faktor</label>
                                            <input type="text" name="indikator_faktor" value="<?= htmlspecialchars($f->indikator_faktor) ?>"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Jenis Faktor</label>
                                            <select name="jenis_faktor" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none" required>
                                                <option value="Bahaya" <?= $f->jenis_faktor == 'Bahaya' ? 'selected' : '' ?>>Bahaya</option>
                                                <option value="Kerentanan" <?= $f->jenis_faktor == 'Kerentanan' ? 'selected' : '' ?>>Kerentanan</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-medium mb-1">Instrument</label>
                                            <select name="id_instrument" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none" required>
                                                <?php foreach ($instrument as $i): ?>
                                                    <option value="<?= $i->id_instrument ?>" <?= $f->id_instrument == $i->id_instrument ? 'selected' : '' ?>><?= htmlspecialchars($i->nama_instrument) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="flex justify-end items-center gap-3 mt-3">
                                            <label for="modal-edit-faktor-<?= $f->id_faktor ?>" class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer">Batal</label>
                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
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
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-500 italic">Belum ada data Faktor.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="px-4 py-4 border-t flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                <div class="text-sm text-gray-600">Menampilkan <?= count($faktor ?? []) ?> entri</div>
                <div class="text-sm"><?= $pagination_faktor ?? '' ?></div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Opsi -->
    <input type="checkbox" id="modal-add" class="modal-toggle hidden" />
    <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative mx-4">
            <h3 class="text-xl font-semibold text-red-700 mb-3">➕ Tambah Opsi</h3>
            <form method="post" action="<?= site_url('opsi/store') ?>" class="space-y-4" id="form-opsi">
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
                                <option value="<?= $i->id_instrument ?>"><?= htmlspecialchars($i->nama_instrument) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-4">
                    <label for="modal-add" class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer">Batal</label>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Simpan</button>
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
        // Toggle visible table (skrining | faktor)
        function toggleTable(type) {
            const skr = document.getElementById('table-skrining');
            const fak = document.getElementById('table-faktor');
            const btnS = document.getElementById('btn-skrining');
            const btnF = document.getElementById('btn-faktor');

            skr.classList.add('hidden');
            fak.classList.add('hidden');

            btnS.classList.remove('bg-red-600', 'text-white');
            btnS.classList.add('bg-gray-200', 'text-gray-800');
            btnF.classList.remove('bg-red-600', 'text-white');
            btnF.classList.add('bg-gray-200', 'text-gray-800');

            if (type === 'skrining') {
                skr.classList.remove('hidden');
                btnS.classList.add('bg-red-600', 'text-white');
                btnS.classList.remove('bg-gray-200', 'text-gray-800');
            } else {
                fak.classList.remove('hidden');
                btnF.classList.add('bg-red-600', 'text-white');
                btnF.classList.remove('bg-gray-200', 'text-gray-800');
            }
        }

        // Toggle form add skrining/faktor
        function toggleForm() {
            const type = document.getElementById('opsi_type').value;
            document.getElementById('form-skrining').classList.add('hidden');
            document.getElementById('form-faktor').classList.add('hidden');

            if (type === 'skrining') document.getElementById('form-skrining').classList.remove('hidden');
            if (type === 'faktor') document.getElementById('form-faktor').classList.remove('hidden');
        }

        // Change limit
        function changeLimit() {
            const val = document.getElementById('limit-select').value;
            window.location.href = '<?= site_url("opsi") ?>?limit=' + val;
        }

        function changeLimitFromMobile() {
            const val = document.getElementById('limit-select-mobile').value;
            window.location.href = '<?= site_url("opsi") ?>?limit=' + val;
        }
    </script>
</main>