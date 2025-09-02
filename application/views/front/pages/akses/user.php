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

    <!-- Header + Tambah User -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b pb-3 space-y-3 sm:space-y-0">
        <h2 class="text-2xl sm:text-3xl font-semibold text-red-700">👥 Manajemen User</h2>
        <button onclick="document.getElementById('modal-add').checked = true"
            class="bg-red-600 hover:bg-red-700 text-white px-4 sm:px-5 py-2 rounded-xl shadow transition text-sm sm:text-base cursor-pointer">
            ➕ Tambah User
        </button>
    </div>

    <!-- Tabel User -->
    <div class="overflow-x-auto">
        <table class="text-center min-w-full border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Kanwil</th>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($users)): ?>
                    <?php $no = 1;
                    foreach ($users as $u): ?>
                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-2"><?= $no++ ?></td>
                            <td class="px-4 py-2 font-medium text-gray-800"><?= htmlspecialchars($u->nama_kanwil) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($u->username) ?></td>
                            <td class="px-4 py-2 flex justify-center space-x-2">
                                <!-- Tombol Edit -->
                                <label for="modal-edit-<?= $u->id_user ?>"
                                    class="inline-flex items-center justify-center w-9 h-9 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow transition">
                                    ✏️
                                </label>

                                <!-- Tombol Hapus -->
                                <a href="<?= site_url('user/delete/' . $u->id_user) ?>"
                                    onclick="return confirm('Yakin hapus user ini?')"
                                    class="inline-flex items-center justify-center w-9 h-9 bg-red-500 hover:bg-red-600 text-white rounded-full shadow transition">
                                    🗑️
                                </a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <input type="checkbox" id="modal-edit-<?= $u->id_user ?>" class="modal-toggle hidden" />
                        <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                            <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
                                <h3 class="text-xl font-semibold text-red-700 mb-4">✏️ Edit User</h3>
                                <form method="post" action="<?= site_url('user/update/' . $u->id_user) ?>" class="space-y-4">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Nama Kanwil</label>
                                        <input type="text" name="nama_kanwil" value="<?= htmlspecialchars($u->nama_kanwil) ?>"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Username</label>
                                        <input type="text" name="username" value="<?= htmlspecialchars($u->username) ?>"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Password (kosongkan jika tidak diubah)</label>
                                        <input type="password" name="password"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none mb-4">
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <label for="modal-edit-<?= $u->id_user ?>"
                                            class="px-4 py-2 bg-gray-300 rounded-lg cursor-pointer">Batal</label>
                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg cursor-pointer">Simpan</button>
                                    </div>
                                </form>
                                <label for="modal-edit-<?= $u->id_user ?>" class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</label>
                            </div>
                        </div>
                        <style>
                            #modal-edit-<?= $u->id_user ?>:checked+.modal {
                                opacity: 1;
                                pointer-events: auto;
                            }
                        </style>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500 italic">
                            Belum ada user.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah User -->
    <input type="checkbox" id="modal-add" class="modal-toggle hidden" />
    <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
            <h3 class="text-xl font-semibold text-red-700 mb-4">➕ Tambah User</h3>
            <form method="post" action="<?= site_url('user/create') ?>" class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Nama Kanwil</label>
                    <input type="text" name="nama_kanwil" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Username</label>
                    <input type="text" name="username" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div class="flex justify-end space-x-2">
                    <label for="modal-add" class="px-4 py-2 bg-gray-300 rounded-lg cursor-pointer">Batal</label>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg cursor-pointer">Simpan</button>
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

        /* Fallback semua tombol */
        button,
        a,
        label {
            cursor: pointer !important;
        }
    </style>

</main>