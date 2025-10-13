<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-6 mt-10">
    <h1 class="text-xl font-semibold text-gray-700 mb-6">Edit Data Kerawanan</h1>

    <form action="<?= site_url('histori/update') ?>" method="post" class="space-y-5">
        <input type="hidden" name="id_hasil" value="<?= $hasil->id_hasil ?>">

        <div>
            <label class="block text-gray-600 mb-2">Nilai Akhir</label>
            <input type="number" name="nilai_akhir" value="<?= htmlspecialchars($hasil->nilai_akhir) ?>"
                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-red-300">
        </div>

        <div>
            <label class="block text-gray-600 mb-2">Antisipasi</label>
            <select name="id_antisipasi"
                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-red-300">
                <option value="">-- Pilih Antisipasi --</option>
                <?php foreach ($this->db->get('tbl_antisipasi')->result() as $opt): ?>
                    <option value="<?= $opt->id_antisipasi ?>" <?= $opt->id_antisipasi == $hasil->id_antisipasi ? 'selected' : '' ?>>
                        <?= htmlspecialchars($opt->nama_antisipasi) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="pt-4 flex justify-end gap-3">
            <a href="<?= site_url('histori') ?>"
                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-gray-700">Batal</a>
            <button type="submit"
                class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-white font-medium">Simpan Perubahan</button>
        </div>
    </form>
</div>