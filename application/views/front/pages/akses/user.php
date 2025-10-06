<main class="w-full min-h-screen">

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('success')): ?>
        <div id="flash-message" class="bg-green-50 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base transition-opacity duration-500">
            <div class="flex items-start gap-3">
                <div class="text-xl">✅</div>
                <div><?= $this->session->flashdata('success') ?></div>
            </div>
        </div>
    <?php elseif ($this->session->flashdata('error')): ?>
        <div id="flash-message" class="bg-red-50 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base transition-opacity duration-500">
            <div class="flex items-start gap-3">
                <div class="text-xl">❌</div>
                <div><?= $this->session->flashdata('error') ?></div>
            </div>
        </div>
    <?php endif; ?>

    <script>
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500); // hapus setelah 0.5 detik
            }
        }, 5000);
    </script>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-5 border-b pb-0 sm:pb-4 gap-3">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight flex items-center gap-3 text-red-700">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-lg bg-red-100 text-red-600 shadow-sm">
                    <i class="ri-user-settings-line text-2xl"></i>
                </span>
                <span class="hover:text-red-800 transition-colors duration-200">Manajemen User</span>
            </h2>
            <p class="text-sm text-gray-600 mt-2 ml-0.5">Kelola data user — tambahkan, edit, atau hapus.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="hidden sm:flex items-center gap-2">
                <label for="limit-select" class="text-sm text-gray-700">Tampilkan:</label>
                <select id="limit-select" onchange="changeLimit()"
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm">
                    <option value="25" <?= isset($limit) && $limit == 25 ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= isset($limit) && $limit == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= isset($limit) && $limit == 100 ? 'selected' : '' ?>>100</option>
                </select>
            </div>

            <!-- Tombol Tambah User -->
            <!-- Desktop: tombol normal -->
            <button onclick="document.getElementById('modal-add').checked = true"
                class="hidden sm:inline-flex items-center gap-2 cursor-pointer bg-red-600 hover:bg-red-700 text-white font-medium px-4 sm:px-5 py-2 rounded-xl shadow-md transition transform hover:scale-105 text-sm sm:text-base">
                <i class="ri-user-add-line text-lg"></i>
                Tambah User
            </button>

            <!-- Mobile: FAB bulat kanan bawah -->
            <button onclick="document.getElementById('modal-add').checked = true"
                class="sm:hidden fixed bottom-5 right-5 bg-red-600 hover:bg-red-700 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg transition transform hover:scale-110 cursor-pointer text-2xl">
                <i class="ri-user-add-line"></i>
            </button>

        </div>
    </div>

    <!-- Mobile limit control -->
    <div class="sm:hidden mb-4 flex items-center gap-2">
        <label for="limit-select-mobile" class="text-sm text-gray-700">Tampilkan:</label>
        <select id="limit-select-mobile" onchange="changeLimitFromMobile()"
            class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm">
            <option value="25" <?= isset($limit) && $limit == 25 ? 'selected' : '' ?>>25</option>
            <option value="50" <?= isset($limit) && $limit == 50 ? 'selected' : '' ?>>50</option>
            <option value="100" <?= isset($limit) && $limit == 100 ? 'selected' : '' ?>>100</option>
        </select>
    </div>
    <!-- Search & Filter -->
    <div class="mb-4">
        <form method="get" action=""
            class="flex flex-wrap items-center gap-2 w-full">

            <!-- Input dengan ikon -->
            <div class="relative flex-1 sm:flex-none sm:w-64">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                    placeholder="Cari Username..."
                    class="pl-9 border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm w-full">
            </div>

            <!-- Tombol Cari -->
            <button type="submit"
                class="cursor-pointer bg-black hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm shadow w-auto">
                Cari
            </button>
        </form>
    </div>

    <!-- Table User -->
    <div class="overflow-x-auto">
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <!-- Wrapper -->
            <div class="overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-200">
                <table class="min-w-full text-center border-collapse hidden sm:table">
                    <thead class="bg-gradient-to-r from-red-600 to-red-500 text-white text-sm sm:text-base">
                        <tr>
                            <th class="px-3 sm:px-5 py-3 font-semibold tracking-wide">No</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Username</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Role</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Kanwil</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">UPT</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Status</th>
                            <th class="px-3 sm:px-5 py-3 font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 text-sm sm:text-base text-gray-700">
                        <?php if (!empty($users)): ?>
                            <?php
                            $no = 1 + (isset($_GET['page_user']) ? (($_GET['page_user'] - 1) * $limit) : 0);
                            foreach ($users as $u): ?>
                                <tr class="hover:bg-gray-50 transition-all duration-200">
                                    <td class="px-3 sm:px-5 py-3 font-medium text-gray-800"><?= $no++ ?></td>
                                    <td class="px-3 sm:px-5 py-3 font-medium"><?= htmlspecialchars($u->username ?? '') ?></td>
                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($u->role ?? '') ?></td>
                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($u->nama_kanwil ?? '-') ?></td>
                                    <td class="px-3 sm:px-5 py-3"><?= htmlspecialchars($u->nama_upt ?? '-') ?></td>
                                    <td class="px-3 sm:px-5 py-3">
                                        <?php
                                        $status = strtolower($u->status ?? '');
                                        $color = $status === 'aktif'
                                            ? 'bg-green-100 text-green-700 border border-green-200'
                                            : 'bg-red-100 text-red-700 border border-red-200';
                                        $text = $status === 'aktif' ? 'Aktif' : 'Tidak Aktif';
                                        ?>
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                            <?= $text ?>
                                        </span>
                                    </td>
                                    <td class="px-3 sm:px-5 py-3">
                                        <div class="flex justify-center gap-2">
                                            <!-- Tombol Edit -->
                                            <label for="modal-edit-<?= $u->id_user ?? '' ?>"
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-500 hover:bg-blue-600 text-white shadow-sm transition"
                                                title="Edit">
                                                <i class="ri-edit-2-line text-lg"></i>
                                            </label>

                                            <!-- Tombol Hapus -->
                                            <?php if ($this->session->userdata('role') === 'admin'): ?>
                                                <a href="<?= site_url('user/delete/' . ($u->id_user ?? '')) ?>"
                                                    onclick="return confirm('Yakin hapus user ini?')"
                                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-500 hover:bg-red-600 text-white shadow-sm transition"
                                                    title="Hapus">
                                                    <i class="ri-delete-bin-6-line text-lg"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Edit User -->
                                <input type="checkbox" id="modal-edit-<?= $u->id_user ?? '' ?>" class="modal-toggle hidden" />
                                <div class="modal fixed inset-0 z-50 bg-black/40 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
                                    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 mx-3 relative transform transition-all scale-95">
                                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                            <i class="ri-edit-2-line text-red-600"></i> Edit User
                                        </h3>
                                        <form method="post" action="<?= site_url('user/update') ?>" class="space-y-4">
                                            <input type="hidden" name="id_user" value="<?= htmlspecialchars($u->id_user ?? '') ?>">

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                                <input type="text" value="<?= htmlspecialchars($u->username ?? '') ?>" readonly
                                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 text-gray-600 cursor-not-allowed">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                                <input type="password" name="password"
                                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none"
                                                    placeholder="Kosongkan jika tidak ingin mengubah">
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                <select name="status"
                                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                                                    <option value="aktif" <?= ($u->status ?? '') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                                    <option value="tidak aktif" <?= ($u->status ?? '') == 'tidak aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                                                </select>
                                            </div>

                                            <div class="flex justify-end gap-3 mt-5">
                                                <label for="modal-edit-<?= $u->id_user ?? '' ?>"
                                                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg cursor-pointer transition">Batal</label>
                                                <button type="submit"
                                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">Simpan</button>
                                            </div>
                                        </form>

                                        <label for="modal-edit-<?= $u->id_user ?? '' ?>" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl cursor-pointer">&times;</label>
                                    </div>
                                </div>

                                <style>
                                    #modal-edit-<?= $u->id_user ?? '' ?>:checked+.modal {
                                        opacity: 1;
                                        pointer-events: auto;
                                        transform: scale(1);
                                    }
                                </style>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-10 text-gray-500 italic">Belum ada user.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- CARD: tampil di mobile -->
            <div class="block sm:hidden space-y-3">
                <?php if (!empty($users)): ?>
                    <?php
                    $no = 1 + (isset($_GET['page_user']) ? (($_GET['page_user'] - 1) * $limit) : 0);
                    foreach ($users as $u): ?>
                        <div class="p-4 bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg hover:bg-gray-50 transition-all duration-200">
                            <!-- Header -->
                            <div class="flex justify-between items-center mb-3">
                                <span class="font-semibold text-red-600">#<?= $no++ ?></span>
                                <?php
                                $status = strtolower($u->status ?? '');
                                $color = $status === 'aktif'
                                    ? 'bg-green-100 text-green-700 border border-green-200'
                                    : 'bg-red-100 text-red-700 border border-red-200';
                                $text = $status === 'aktif' ? 'Aktif' : 'Tidak Aktif';
                                ?>
                                <span class="text-xs font-semibold px-3 py-1 rounded-full <?= $color ?>">
                                    <?= $text ?>
                                </span>
                            </div>

                            <!-- Body -->
                            <div class="text-gray-700 text-sm space-y-1">
                                <div><span class="font-medium text-gray-900">Username:</span> <?= htmlspecialchars($u->username ?? '') ?></div>
                                <div><span class="font-medium text-gray-900">Role:</span> <?= htmlspecialchars($u->role ?? '') ?></div>
                                <div><span class="font-medium text-gray-900">Kanwil:</span> <?= htmlspecialchars($u->nama_kanwil ?? '-') ?></div>
                                <div><span class="font-medium text-gray-900">UPT:</span> <?= htmlspecialchars($u->nama_upt ?? '-') ?></div>
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end gap-2 mt-4">
                                <!-- Tombol Edit -->
                                <label for="modal-edit-<?= $u->id_user ?? '' ?>"
                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-500 hover:bg-blue-600 text-white shadow-sm transition"
                                    title="Edit">
                                    <i class="ri-edit-2-line text-lg"></i>
                                </label>

                                <!-- Tombol Hapus -->
                                <?php if ($this->session->userdata('role') === 'admin'): ?>
                                    <a href="<?= site_url('user/delete/' . ($u->id_user ?? '')) ?>"
                                        onclick="return confirm('Yakin hapus user ini?')"
                                        class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-500 hover:bg-red-600 text-white shadow-sm transition"
                                        title="Hapus">
                                        <i class="ri-delete-bin-6-line text-lg"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="p-4 text-center text-gray-500 italic">Belum ada user.</div>
                <?php endif; ?>
            </div>

            <div class="px-4 py-4 border-t flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                <div class="text-sm text-gray-600">Menampilkan <?= count($users ?? []) ?> entri</div>
                <div class="text-sm"><?= $pagination ?? '' ?></div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah User (FULL) -->
    <input type="checkbox" id="modal-add" class="modal-toggle hidden" />
    <div class="modal fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-lg max-w-lg w-full max-h-[90vh] overflow-y-auto p-6 relative mx-2 sm:mx-4">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="ri-user-add-line text-red-600"></i> Tambah User
            </h3>
            <form method="post" action="<?= site_url('user/store') ?>" class="space-y-4" id="form-add-user">
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

                <?php $session_role = $this->session->userdata('role'); ?>
                <?php $session_kanwil = $this->session->userdata('id_kanwil') ?? ''; ?>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Role</label>
                    <?php if ($session_role === 'kanwil'): ?>
                        <input type="hidden" name="role" value="upt">
                        <div class="px-3 py-2 bg-gray-100 rounded text-sm text-gray-700">UPT (diisi oleh Kanwil)</div>
                    <?php else: ?>
                        <select name="role" id="role" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="">-- Pilih Role --</option>
                            <option value="kanwil">Kanwil</option>
                            <option value="upt">UPT</option>
                        </select>
                    <?php endif; ?>
                </div>

                <div id="kanwil-field" style="display:none;">
                    <label class="block text-gray-700 font-medium mb-1">Pilih Kanwil</label>
                    <select name="id_kanwil" id="id_kanwil" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">--Pilih Kanwil--</option>
                        <?php foreach ($kanwil as $k): ?>
                            <option value="<?= htmlspecialchars($k->id_kanwil ?? '') ?>"><?= htmlspecialchars($k->nama_kanwil ?? '') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div id="upt-kanwil-field" style="display:none;">
                    <label class="block text-gray-700 font-medium mb-1">Pilih Kanwil</label>
                    <?php if ($session_role === 'kanwil'): ?>
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

                <div id="upt-field" style="display:none;">
                    <label class="block text-gray-700 font-medium mb-1">Pilih UPT</label>
                    <select name="id_upt" id="id_upt" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">--Pilih UPT--</option>
                    </select>
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
        #modal-add:checked+.modal {
            opacity: 1;
            pointer-events: auto;
        }
    </style>


    <style>
        #modal-add:checked+.modal,
        .modal-toggle:checked+.modal {
            opacity: 1;
            pointer-events: auto;
        }
    </style>

    <script>
        function changeLimit() {
            const limit = document.getElementById('limit-select').value;
            const url = new URL(window.location.href);
            url.searchParams.set('limit', limit);
            window.location.href = url.toString();
        }

        function changeLimitFromMobile() {
            const limit = document.getElementById('limit-select-mobile').value;
            const url = new URL(window.location.href);
            url.searchParams.set('limit', limit);
            window.location.href = url.toString();
        }

        // Role & UPT handling
        (function() {
            const sessionRole = <?= json_encode($this->session->userdata("role")) ?>;
            const sessionKanwil = <?= json_encode($this->session->userdata("id_kanwil") ?? '') ?>;
            const roleSelect = document.getElementById('role');
            const kanwilField = document.getElementById('kanwil-field');
            const uptKanwilField = document.getElementById('upt-kanwil-field');
            const uptField = document.getElementById('upt-field');
            const idKanwilUptSelect = document.getElementById('id_kanwil_upt');
            const uptSelect = document.getElementById('id_upt');

            function showHideForRole(val) {
                kanwilField && (kanwilField.style.display = val === 'kanwil' ? 'block' : 'none');
                uptKanwilField && (uptKanwilField.style.display = val === 'upt' ? 'block' : 'none');
                uptField && (uptField.style.display = val === 'upt' ? 'block' : 'none');
            }

            if (sessionRole === 'kanwil' && sessionKanwil) {
                showHideForRole('upt');
                if (uptSelect) {
                    fetch("<?= base_url('user/get_upt_by_kanwil/') ?>" + sessionKanwil)
                        .then(res => res.json())
                        .then(data => {
                            uptSelect.innerHTML = '<option value="">--Pilih UPT--</option>';
                            data.forEach(u => {
                                const opt = document.createElement('option');
                                opt.value = u.id_upt;
                                opt.textContent = u.nama_upt;
                                uptSelect.appendChild(opt);
                            });
                        });
                }
            }

            roleSelect && roleSelect.addEventListener('change', e => {
                const val = e.target.value;
                showHideForRole(val);
                if (val === 'upt' && idKanwilUptSelect) {
                    idKanwilUptSelect.addEventListener('change', function() {
                        const kanwilId = this.value;
                        fetch("<?= base_url('user/get_upt_by_kanwil/') ?>" + kanwilId)
                            .then(res => res.json())
                            .then(data => {
                                uptSelect.innerHTML = '<option value="">--Pilih UPT--</option>';
                                data.forEach(u => {
                                    const opt = document.createElement('option');
                                    opt.value = u.id_upt;
                                    opt.textContent = u.nama_upt;
                                    uptSelect.appendChild(opt);
                                });
                            });
                    });
                }
            });
        })();
    </script>

</main>