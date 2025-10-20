<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mt-0">
    <h1 class="flex items-center gap-2 text-2xl font-semibold text-gray-800 mb-6">
        <i class="ri-edit-line text-red-600"></i>
        Edit Data Kerawanan
    </h1>

    <form action="<?= site_url("histori/update") ?>" method="post" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="id_hasil" value="<?= $hasil->id_hasil ?>">

        <!-- No Register/NIP -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">No Register/NIP</label>
            <input type="text"
                name="no_register_nip"
                value="<?= $hasil->id_object ?>"
                readonly
                class="w-full border border-gray-300 bg-gray-50 rounded-lg px-4 py-2.5 text-gray-700 focus:ring-2 focus:ring-red-200 focus:border-red-400 cursor-not-allowed" />
        </div>

        <!-- Nama -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Nama</label>
            <input type="text"
                name="nama"
                value="<?= $hasil->nama_pegawai ?? $hasil->nama_narapidana ?>"
                readonly
                class="w-full border border-gray-300 bg-gray-50 rounded-lg px-4 py-2.5 text-gray-700 focus:ring-2 focus:ring-red-200 focus:border-red-400 cursor-not-allowed" />
        </div>

        <!-- Tindak Lanjut -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Tindak Lanjut</label>
            <select name="tindak_lanjut"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-red-300">
                <option value="">-- Pilih Tindak Lanjut --</option>
                <option value="<?= $hasil->tindak_lanjut ?>" selected><?= $hasil->tindak_lanjut ?></option>

                <?php if ($hasil->tindak_lanjut != 'Pemindahan'): ?>
                    <option value="Pemindahan">Pemindahan</option>
                <?php endif; ?>

                <?php if ($hasil->tindak_lanjut != 'Pembinaan'): ?>
                    <option value="Pembinaan">Pembinaan</option>
                <?php endif; ?>
            </select>
        </div>

        <!-- Upload File -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">Upload File</label>
            <input type="file"
                name="file_dokumen"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 focus:ring-2 focus:ring-red-200 focus:border-red-400 bg-gray-50">

            <?php if (!empty($hasil->file_dokumen)): ?>
                <p class="mt-3 text-sm text-gray-500">
                    📎 File saat ini:
                    <a href="<?= base_url('./uploads/' . $hasil->file_dokumen) ?>"
                        target="_blank"
                        class="text-blue-600 hover:text-blue-700 underline ml-1">
                        <?= $hasil->file_dokumen ?>
                    </a>
                </p>
            <?php endif; ?>
        </div>

        <!-- Tombol Aksi -->
        <div class="pt-4 flex justify-end gap-3">
            <a href="<?= site_url("histori") ?>"
                class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition">
                Batal
            </a>
            <button type="submit"
                class="px-5 py-2.5 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-medium rounded-lg shadow-sm transition">
                Simpan
            </button>
        </div>
    </form>
</div>