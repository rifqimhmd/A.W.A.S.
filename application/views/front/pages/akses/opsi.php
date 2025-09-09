<main class="w-full min-h-screen p-4 sm:p-6 bg-gray-100">

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-4 rounded text-sm sm:text-base">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php elseif ($this->session->flashdata('error')): ?>
        <div class="bg-red-50 border-l-4 border-red-600 text-red-800 p-4 mb-4 rounded text-sm sm:text-base">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b pb-3 space-y-3 sm:space-y-0">
        <h2 class="text-2xl sm:text-3xl font-semibold text-red-700">⚙️ Manajemen Opsi</h2>
        <button onclick="document.getElementById('modal-add').checked = true"
            class="bg-red-600 hover:bg-red-700 text-white px-4 sm:px-5 py-2 rounded-xl shadow transition text-sm sm:text-base">
            ➕ Tambah Opsi
        </button>
    </div>

    <!-- Pilihan Tabs -->
    <div class="flex space-x-4 mb-6">
        <button onclick="toggleTable('skrining')" id="btn-skrining"
            class="bg-red-600 text-white px-4 py-2 rounded-lg shadow">Skrining</button>
        <button onclick="toggleTable('faktor')" id="btn-faktor"
            class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg shadow">Faktor</button>
    </div>

    <!-- Pilihan Limit -->
    <div class="mb-4 flex justify-end items-center space-x-2">
        <label for="limit-select" class="font-medium text-gray-700">Tampilkan:</label>
        <select id="limit-select" onchange="changeLimit()" class="border border-gray-300 rounded-lg px-2 py-1 focus:ring-2 focus:ring-red-500 focus:outline-none">
            <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
            <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
            <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
        </select>
    </div>

    <!-- Tabel Skrining -->
    <div id="table-skrining" class="overflow-x-auto">
        <table class="text-center min-w-full border border-gray-200 rounded-xl overflow-hidden shadow-sm bg-white">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Indikator</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Instrument</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($skrining)): ?>
                    <?php $no = 1 + (isset($_GET['page_skrining']) ? $_GET['page_skrining'] : 0);
                    foreach ($skrining as $s): ?>
                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-2"><?= $no++ ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($s->indikator_skrining) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($s->jenis_skrining) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($s->nama_instrument) ?></td>
                            <td class="px-4 py-2 flex justify-center space-x-2">
                                <label for="modal-edit-skrining-<?= $s->id_skrining ?>"
                                    class="inline-flex items-center justify-center w-9 h-9 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow cursor-pointer">
                                    ✏️
                                </label>
                                <a href="<?= site_url('opsi/delete_skrining/' . $s->id_skrining) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="inline-flex items-center justify-center w-9 h-9 bg-red-500 hover:bg-red-600 text-white rounded-full shadow">
                                    🗑️
                                </a>
                            </td>
                        </tr>

                        <!-- Modal Edit Skrining -->
                        <input type="checkbox" id="modal-edit-skrining-<?= $s->id_skrining ?>" class="modal-toggle hidden" />
                        <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                            <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
                                <h3 class="text-xl font-semibold text-red-700 mb-4">✏️ Edit Skrining</h3>
                                <form method="post" action="<?= site_url('opsi/update_skrining/' . $s->id_skrining) ?>" class="space-y-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Indikator Skrining</label>
                                        <input type="text" name="indikator_skrining" value="<?= htmlspecialchars($s->indikator_skrining) ?>"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Jenis Skrining</label>
                                        <select name="jenis_skrining"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                            <?php $options = ['Pengguna', 'Pengedar', 'Pengendali', 'Ideolog', 'Pengikut'];
                                            foreach ($options as $opt): ?>
                                                <option value="<?= $opt ?>" <?= $s->jenis_skrining == $opt ? 'selected' : '' ?>><?= $opt ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="flex justify-end space-x-4 mt-4">
                                        <label for="modal-edit-skrining-<?= $s->id_skrining ?>" class="px-4 py-2 bg-gray-300 rounded-lg cursor-pointer">Batal</label>
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
                        <td colspan="5" class="text-center py-6 text-gray-500 italic">Belum ada data Skrining.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination Skrining -->
        <div class="mt-3"><?= $pagination_skrining ?></div>
    </div>

    <!-- Tabel Faktor -->
    <div id="table-faktor" class="overflow-x-auto hidden mt-6">
        <table class="text-center min-w-full border border-gray-200 rounded-xl overflow-hidden shadow-sm bg-white">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Indikator</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Instrument</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($faktor)): ?>
                    <?php $no = 1 + (isset($_GET['page_faktor']) ? $_GET['page_faktor'] : 0);
                    foreach ($faktor as $f): ?>
                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-2"><?= $no++ ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($f->indikator_faktor) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($f->jenis_faktor) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($f->nama_instrument) ?></td>
                            <td class="px-4 py-2 flex justify-center space-x-2">
                                <label for="modal-edit-faktor-<?= $f->id_faktor ?>"
                                    class="inline-flex items-center justify-center w-9 h-9 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow cursor-pointer">✏️</label>
                                <a href="<?= site_url('opsi/delete_faktor/' . $f->id_faktor) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="inline-flex items-center justify-center w-9 h-9 bg-red-500 hover:bg-red-600 text-white rounded-full shadow">🗑️</a>
                            </td>
                        </tr>

                        <!-- Modal Edit Faktor -->
                        <input type="checkbox" id="modal-edit-faktor-<?= $f->id_faktor ?>" class="modal-toggle hidden" />
                        <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                            <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
                                <h3 class="text-xl font-semibold text-red-700 mb-4">✏️ Edit Faktor</h3>
                                <form method="post" action="<?= site_url('opsi/update_faktor/' . $f->id_faktor) ?>" class="space-y-6">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Indikator Faktor</label>
                                        <input type="text" name="indikator_faktor" value="<?= htmlspecialchars($f->indikator_faktor) ?>"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Jenis Faktor</label>
                                        <select name="jenis_faktor" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                            <option value="Bahaya" <?= $f->jenis_faktor == 'Bahaya' ? 'selected' : '' ?>>Bahaya</option>
                                            <option value="Kerentanan" <?= $f->jenis_faktor == 'Kerentanan' ? 'selected' : '' ?>>Kerentanan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Instrument</label>
                                        <select name="id_instrument" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                            <?php foreach ($instrument as $i): ?>
                                                <option value="<?= $i->id_instrument ?>" <?= $f->id_instrument == $i->id_instrument ? 'selected' : '' ?>><?= htmlspecialchars($i->nama_instrument) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="flex justify-end space-x-4 mt-4">
                                        <label for="modal-edit-faktor-<?= $f->id_faktor ?>" class="px-4 py-2 bg-gray-300 rounded-lg cursor-pointer">Batal</label>
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
                        <td colspan="5" class="text-center py-6 text-gray-500 italic">Belum ada data Faktor.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination Faktor -->
        <div class="mt-3"><?= $pagination_faktor ?></div>
    </div>

    <!-- Modal Tambah Opsi -->
    <input type="checkbox" id="modal-add" class="modal-toggle hidden" />
    <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
            <h3 class="text-xl font-semibold text-red-700 mb-4">➕ Tambah Opsi</h3>
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

                <div class="flex justify-end space-x-4 mt-4">
                    <label for="modal-add" class="px-4 py-2 bg-gray-300 rounded-lg cursor-pointer">Batal</label>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Simpan</button>
                </div>
            </form>
            <label for="modal-add" class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</label>
        </div>
    </div>
    <style>
        #modal-add:checked+.modal {
            opacity: 1;
            pointer-events: auto;
        }
    </style>

    <script>
        function toggleTable(type) {
            document.getElementById('table-skrining').classList.add('hidden');
            document.getElementById('table-faktor').classList.add('hidden');
            document.getElementById('btn-skrining').classList.remove('bg-red-600', 'text-white');
            document.getElementById('btn-skrining').classList.add('bg-gray-200', 'text-gray-800');
            document.getElementById('btn-faktor').classList.remove('bg-red-600', 'text-white');
            document.getElementById('btn-faktor').classList.add('bg-gray-200', 'text-gray-800');
            if (type === 'skrining') {
                document.getElementById('table-skrining').classList.remove('hidden');
                document.getElementById('btn-skrining').classList.add('bg-red-600', 'text-white');
                document.getElementById('btn-skrining').classList.remove('bg-gray-200', 'text-gray-800');
            } else {
                document.getElementById('table-faktor').classList.remove('hidden');
                document.getElementById('btn-faktor').classList.add('bg-red-600', 'text-white');
                document.getElementById('btn-faktor').classList.remove('bg-gray-200', 'text-gray-800');
            }
        }

        function toggleForm() {
            let val = document.getElementById('opsi_type').value;
            document.getElementById('form-skrining').classList.add('hidden');
            document.getElementById('form-faktor').classList.add('hidden');
            if (val === 'skrining') document.getElementById('form-skrining').classList.remove('hidden');
            if (val === 'faktor') document.getElementById('form-faktor').classList.remove('hidden');
        }

        function changeLimit() {
            const limit = document.getElementById('limit-select').value;
            const url = new URL(window.location.href);
            url.searchParams.set('limit', limit);
            window.location.href = url.toString();
        }
    </script>
</main>