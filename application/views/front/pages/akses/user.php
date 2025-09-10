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
        <h2 class="text-2xl sm:text-3xl font-semibold text-red-700">👥 Manajemen User</h2>
        <button onclick="document.getElementById('modal-add').checked = true"
            class="bg-red-600 hover:bg-red-700 text-white px-4 sm:px-5 py-2 rounded-xl shadow transition text-sm sm:text-base">
            ➕ Tambah User
        </button>
    </div>

    <!-- Pilihan Limit -->
    <div class="mb-4 flex justify-end items-center space-x-2">
        <label for="limit-select" class="font-medium text-gray-700">Tampilkan:</label>
        <select id="limit-select" onchange="changeLimit()" class="border border-gray-300 rounded-lg px-2 py-1 focus:ring-2 focus:ring-red-500 focus:outline-none">
            <option value="25" <?= isset($limit) && $limit == 25 ? 'selected' : '' ?>>25</option>
            <option value="50" <?= isset($limit) && $limit == 50 ? 'selected' : '' ?>>50</option>
            <option value="100" <?= isset($limit) && $limit == 100 ? 'selected' : '' ?>>100</option>
        </select>
    </div>

    <!-- Tabel User -->
    <div class="overflow-x-auto">
        <table class="text-center min-w-full border border-gray-200 rounded-xl overflow-hidden shadow-sm bg-white">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Username</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Kanwil</th>
                    <th class="px-4 py-3">UPT</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($users)): ?>
                    <?php $no = 1 + (isset($_GET['page_user']) ? (($_GET['page_user'] - 1) * $limit) : 0);
                    foreach ($users as $u): ?>
                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-2"><?= $no++ ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($u->username ?? '') ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($u->role ?? '') ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($u->nama_kanwil ?? '') ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($u->nama_upt ?? '') ?></td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-xs <?= ($u->status ?? '') == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' ?>">
                                    <?= ucfirst($u->status ?? '') ?>
                                </span>
                            </td>
                            <td class="px-4 py-2 flex justify-center space-x-2">
                                <!-- Edit modal toggle -->
                                <label for="modal-edit-<?= $u->id_user ?? '' ?>"
                                    class="inline-flex items-center justify-center w-9 h-9 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow cursor-pointer">
                                    ✏️
                                </label>

                                <!-- Delete only visible to admin -->
                                <?php if ($this->session->userdata('role') === 'admin'): ?>
                                    <a href="<?= site_url('user/delete/' . ($u->id_user ?? '')) ?>"
                                        onclick="return confirm('Yakin hapus user ini?')"
                                        class="inline-flex items-center justify-center w-9 h-9 bg-red-500 hover:bg-red-600 text-white rounded-full shadow">
                                        🗑️
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <!-- Modal Edit User -->
                        <input type="checkbox" id="modal-edit-<?= $u->id_user ?? '' ?>" class="modal-toggle hidden" />
                        <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                            <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
                                <h3 class="text-xl font-semibold text-red-700 mb-4">✏️ Edit User</h3>
                                <form method="post" action="<?= site_url('user/update') ?>" class="space-y-6">
                                    <!-- important: controller update() expects POST id_user -->
                                    <input type="hidden" name="id_user" value="<?= htmlspecialchars($u->id_user ?? '') ?>">
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Username</label>
                                        <input type="text" value="<?= htmlspecialchars($u->username ?? '') ?>" readonly
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Password Baru</label>
                                        <input type="password" name="password"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none"
                                            placeholder="Kosongkan jika tidak ingin mengubah">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 font-medium mb-1">Status</label>
                                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                            <option value="aktif" <?= ($u->status ?? '') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                            <option value="nonaktif" <?= ($u->status ?? '') == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-end space-x-4 mt-4">
                                        <label for="modal-edit-<?= $u->id_user ?? '' ?>" class="px-4 py-2 bg-gray-300 rounded-lg cursor-pointer">Batal</label>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
                                    </div>
                                </form>
                                <label for="modal-edit-<?= $u->id_user ?? '' ?>" class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</label>
                            </div>
                        </div>
                        <style>
                            #modal-edit-<?= $u->id_user ?? '' ?>:checked+.modal {
                                opacity: 1;
                                pointer-events: auto;
                            }
                        </style>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500 italic">Belum ada user.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-3"><?= isset($pagination) ? $pagination : '' ?></div>
    </div>

    <!-- Modal Tambah User (checkbox pattern) -->
    <input type="checkbox" id="modal-add" class="modal-toggle hidden" />
    <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg max-w-lg w-full p-6 relative">
            <h3 class="text-xl font-semibold text-red-700 mb-4">➕ Tambah User</h3>
            <form method="post" action="<?= site_url('user/store') ?>" class="space-y-4" id="form-add-user">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Username</label>
                    <input type="text" name="username" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <?php $session_role = $this->session->userdata('role'); ?>
                <?php $session_kanwil = $this->session->userdata('id_kanwil') ?? ''; ?>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Role</label>

                    <?php if ($session_role === 'kanwil'): ?>
                        <!-- if logged as kanwil: force upt -->
                        <input type="hidden" name="role" value="upt">
                        <div class="px-3 py-2 bg-gray-100 rounded text-sm text-gray-700">UPT (diisi oleh Kanwil)</div>
                    <?php else: ?>
                        <select name="role" id="role" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="">-- Pilih Role --</option>
                            <option value="kanwil">Kanwil</option>
                            <option value="upt">UPT</option>
                        </select>
                    <?php endif; ?>
                </div>

                <!-- Pilih Kanwil (for role=kanwil) -->
                <div id="kanwil-field" style="display:none;">
                    <label class="block text-gray-700 font-medium mb-1">Pilih Kanwil</label>
                    <select name="id_kanwil" id="id_kanwil" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">--Pilih Kanwil--</option>
                        <?php foreach ($kanwil as $k): ?>
                            <option value="<?= htmlspecialchars($k->id_kanwil ?? '') ?>"><?= htmlspecialchars($k->nama_kanwil ?? '') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Pilih Kanwil untuk UPT -->
                <div id="upt-kanwil-field" style="display:none;">
                    <label class="block text-gray-700 font-medium mb-1">Pilih Kanwil</label>

                    <?php if ($session_role === 'kanwil'): ?>
                        <!-- hidden input that JS can read -->
                        <input type="hidden" id="id_kanwil_upt_hidden" name="id_kanwil_upt" value="<?= htmlspecialchars($session_kanwil ?? '') ?>">
                        <div class="px-3 py-2 bg-gray-100 rounded text-sm text-gray-700">
                            <?php
                            $kanwil_name = '-';
                            foreach ($all_kanwil as $a) {
                                if (($a->id_kanwil ?? '') == $session_kanwil) {
                                    $kanwil_name = $a->nama_kanwil ?? '-';
                                    break;
                                }
                            }
                            echo htmlspecialchars($kanwil_name ?? '');
                            ?>
                        </div>
                    <?php else: ?>
                        <select name="id_kanwil_upt" id="id_kanwil_upt" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="">--Pilih Kanwil--</option>
                            <?php foreach ($all_kanwil as $k): ?>
                                <option value="<?= htmlspecialchars($k->id_kanwil ?? '') ?>"><?= htmlspecialchars($k->nama_kanwil ?? '') ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>

                <!-- Dropdown UPT -->
                <div id="upt-field" style="display:none;">
                    <label class="block text-gray-700 font-medium mb-1">Pilih UPT</label>
                    <select name="id_upt" id="id_upt" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">--Pilih UPT--</option>
                    </select>
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
        (function() {
            const sessionRole = <?= json_encode($this->session->userdata("role")) ?>;
            const sessionKanwil = <?= json_encode($this->session->userdata("id_kanwil") ?? '') ?>;
            const roleSelect = document.getElementById('role');
            const kanwilField = document.getElementById('kanwil-field');
            const uptKanwilField = document.getElementById('upt-kanwil-field');
            const uptField = document.getElementById('upt-field');
            const idKanwilUptSelect = document.getElementById('id_kanwil_upt');
            const idKanwilUptHidden = document.getElementById('id_kanwil_upt_hidden');
            const uptSelect = document.getElementById('id_upt');

            function showHideForRole(val) {
                if (val === 'kanwil') {
                    if (kanwilField) kanwilField.style.display = 'block';
                    if (uptKanwilField) uptKanwilField.style.display = 'none';
                    if (uptField) uptField.style.display = 'none';
                } else if (val === 'upt') {
                    if (kanwilField) kanwilField.style.display = 'none';
                    if (uptKanwilField) uptKanwilField.style.display = 'block';
                    if (uptField) uptField.style.display = 'block';
                } else {
                    if (kanwilField) kanwilField.style.display = 'none';
                    if (uptKanwilField) uptKanwilField.style.display = 'none';
                    if (uptField) uptField.style.display = 'none';
                }
            }

            // If current session is kanwil, show UPT flow and auto-load UPTs for that kanwil
            if (sessionRole === 'kanwil' && sessionKanwil) {
                showHideForRole('upt');

                if (uptSelect) {
                    uptSelect.innerHTML = '<option value="">--Memuat UPT...--</option>';
                    fetch("<?= base_url('user/get_upt_by_kanwil/') ?>" + sessionKanwil)
                        .then(res => res.json())
                        .then(data => {
                            uptSelect.innerHTML = '<option value="">--Pilih UPT--</option>';
                            if (Array.isArray(data) && data.length) {
                                data.forEach(u => {
                                    const opt = document.createElement('option');
                                    opt.value = u.id_upt;
                                    opt.textContent = u.nama_upt;
                                    uptSelect.appendChild(opt);
                                });
                            } else {
                                const opt = document.createElement('option');
                                opt.value = '';
                                opt.textContent = '--Tidak ada UPT tersedia--';
                                uptSelect.appendChild(opt);
                            }
                        })
                        .catch(err => {
                            uptSelect.innerHTML = '<option value="">--Gagal memuat UPT--</option>';
                            console.error('Failed fetching UPT:', err);
                        });
                }
            } else {
                // Normal behavior: listen for role select and kanwil select changes
                if (roleSelect) {
                    roleSelect.addEventListener('change', function() {
                        showHideForRole(this.value);
                    });
                }
                if (idKanwilUptSelect) {
                    idKanwilUptSelect.addEventListener('change', function() {
                        const val = this.value;
                        if (!uptSelect) return;
                        uptSelect.innerHTML = '<option value="">--Pilih UPT--</option>';
                        if (!val) return;
                        fetch("<?= base_url('user/get_upt_by_kanwil/') ?>" + val)
                            .then(res => res.json())
                            .then(data => {
                                data.forEach(u => {
                                    const opt = document.createElement('option');
                                    opt.value = u.id_upt;
                                    opt.textContent = u.nama_upt;
                                    uptSelect.appendChild(opt);
                                });
                            })
                            .catch(err => console.error(err));
                    });
                }
            }
        })();

        function changeLimit() {
            const limit = document.getElementById('limit-select').value;
            const url = new URL(window.location.href);
            url.searchParams.set('limit', limit);
            window.location.href = url.toString();
        }
    </script>
</main>
