<div class="p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah User</h2>

    <form method="post" action="<?= base_url('user/store') ?>" class="space-y-4">
        <div>
            <label class="block mb-1">Username</label>
            <input type="text" name="username" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Password</label>
            <input type="password" name="password" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Role</label>
            <select name="role" id="role" class="w-full border p-2 rounded" required>
                <option value="">--Pilih Role--</option>
                <option value="kanwil">Kanwil</option>
                <option value="upt">UPT</option>
            </select>
        </div>

        <!-- Role = Kanwil -->
        <div id="kanwil-field" style="display:none;">
            <label class="block mb-1">Pilih Kanwil</label>
            <select name="id_kanwil" class="w-full border p-2 rounded">
                <option value="">--Pilih Kanwil--</option>
                <?php foreach ($kanwil as $k): ?>
                    <option value="<?= $k->id_kanwil ?>"><?= $k->nama_kanwil ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Role = UPT (pilih kanwil dulu) -->
        <div id="upt-kanwil-field" style="display:none;">
            <label class="block mb-1">Pilih Kanwil</label>
            <select name="id_kanwil_upt" id="id_kanwil_upt" class="w-full border p-2 rounded">
                <option value="">--Pilih Kanwil--</option>
                <?php foreach ($all_kanwil as $k): ?>
                    <option value="<?= $k->id_kanwil ?>"><?= $k->nama_kanwil ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Dropdown UPT -->
        <div id="upt-field" style="display:none;">
            <label class="block mb-1">Pilih UPT</label>
            <select name="id_upt" id="id_upt" class="w-full border p-2 rounded">
                <option value="">--Pilih UPT--</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>

<script>
    const roleSelect = document.getElementById('role');
    const kanwilField = document.getElementById('kanwil-field');
    const uptKanwilField = document.getElementById('upt-kanwil-field');
    const uptField = document.getElementById('upt-field');
    const kanwilUptSelect = document.getElementById('id_kanwil_upt');
    const uptSelect = document.getElementById('id_upt');

    roleSelect.addEventListener('change', function() {
        if (this.value === 'kanwil') {
            kanwilField.style.display = 'block';
            uptKanwilField.style.display = 'none';
            uptField.style.display = 'none';
        } else if (this.value === 'upt') {
            kanwilField.style.display = 'none';
            uptKanwilField.style.display = 'block';
            uptField.style.display = 'block';
        } else {
            kanwilField.style.display = 'none';
            uptKanwilField.style.display = 'none';
            uptField.style.display = 'none';
        }
    });

    kanwilUptSelect.addEventListener('change', function() {
        if (this.value) {
            fetch("<?= base_url('user/get_upt_by_kanwil/') ?>" + this.value)
                .then(res => res.json())
                .then(data => {
                    uptSelect.innerHTML = '<option value="">--Pilih UPT--</option>';
                    data.forEach(u => {
                        uptSelect.innerHTML += `<option value="${u.id_upt}">${u.nama_upt}</option>`;
                    });
                });
        } else {
            uptSelect.innerHTML = '<option value="">--Pilih UPT--</option>';
        }
    });
</script>