<main class="container mx-auto p-4 sm:p-6 max-w-6xl bg-white rounded-2xl shadow-lg">

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

    <!-- Header + Tambah Opsi -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b pb-3 space-y-3 sm:space-y-0">
        <h2 class="text-2xl sm:text-3xl font-semibold text-red-700">⚙️ Manajemen Opsi</h2>
        <button onclick="document.getElementById('modal-add-opsi').checked = true"
            class="bg-red-600 hover:bg-red-700 text-white px-4 sm:px-5 py-2 rounded-xl shadow transition text-sm sm:text-base cursor-pointer">
            ➕ Tambah Opsi
        </button>
    </div>

    <!-- Tabel Opsi -->
    <div class="overflow-x-auto">
        <table class="text-center min-w-full border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Opsi</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($opsi)): ?>
                    <?php $no = 1;
                    foreach ($opsi as $o): ?>
                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-2"><?= $no++ ?></td>
                            <td class="px-4 py-2 font-medium text-gray-800"><?= htmlspecialchars($o->nama_opsi) ?></td>
                            <td class="px-4 py-2">
                                <?php
                                if ($o->id_kategori == 1) echo "Pengguna";
                                elseif ($o->id_kategori == 2) echo "Pengedar";
                                elseif ($o->id_kategori == 3) echo "Pengendali";
                                else echo "-";
                                ?>
                            </td>
                            <td class="px-4 py-2 flex justify-center space-x-2">
                                <!-- Tombol Edit -->
                                <label for="modal-edit-<?= $o->id_opsi ?>"
                                    class="inline-flex items-center justify-center w-9 h-9 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow transition cursor-pointer">
                                    ✏️
                                </label>

                                <!-- Tombol Hapus -->
                                <a href="<?= site_url('opsi/delete_opsi/' . $o->id_opsi) ?>"
                                    onclick="return confirm('Yakin hapus opsi ini?')"
                                    class="inline-flex items-center justify-center w-9 h-9 bg-red-500 hover:bg-red-600 text-white rounded-full shadow transition">
                                    🗑️
                                </a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <input type="checkbox" id="modal-edit-<?= $o->id_opsi ?>" class="modal-toggle hidden" />
                        <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                            <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
                                <h3 class="text-xl font-semibold text-red-700 mb-4">✏️ Edit Opsi</h3>
                                <form method="post" action="<?= site_url('opsi/update_opsi/' . $o->id_opsi) ?>" class="space-y-4">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Nama Opsi</label>
                                        <input type="text" name="nama_opsi" value="<?= htmlspecialchars($o->nama_opsi) ?>"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-1">Kategori</label>
                                        <select name="id_kategori" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                            <option value="1" <?= $o->id_kategori == 1 ? 'selected' : '' ?>>Pengguna</option>
                                            <option value="2" <?= $o->id_kategori == 2 ? 'selected' : '' ?>>Pengedar</option>
                                            <option value="3" <?= $o->id_kategori == 3 ? 'selected' : '' ?>>Pengendali</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <label for="modal-edit-<?= $o->id_opsi ?>" class="px-4 py-2 bg-gray-300 rounded-lg cursor-pointer">Batal</label>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg cursor-pointer">Simpan</button>
                                    </div>
                                </form>
                                <label for="modal-edit-<?= $o->id_opsi ?>" class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</label>
                            </div>
                        </div>
                        <style>
                            #modal-edit-<?= $o->id_opsi ?>:checked+.modal {
                                opacity: 1;
                                pointer-events: auto;
                            }
                        </style>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500 italic">
                            Belum ada opsi.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Opsi -->
    <input type="checkbox" id="modal-add-opsi" class="modal-toggle hidden" />
    <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
            <h3 class="text-xl font-semibold text-red-700 mb-4">➕ Tambah Opsi</h3>
            <form method="post" action="<?= site_url('opsi/create_opsi') ?>" class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Nama Opsi</label>
                    <input type="text" name="nama_opsi" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Kategori</label>
                    <select name="id_kategori" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                        <option value="1">Pengguna</option>
                        <option value="2">Pengedar</option>
                        <option value="3">Pengendali</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <label for="modal-add-opsi" class="px-4 py-2 bg-gray-300 rounded-lg cursor-pointer">Batal</label>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg cursor-pointer">Simpan</button>
                </div>
            </form>
            <label for="modal-add-opsi" class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</label>
        </div>
    </div>

    <style>
        #modal-add-opsi:checked+.modal {
            opacity: 1;
            pointer-events: auto;
        }
    </style>

</main>