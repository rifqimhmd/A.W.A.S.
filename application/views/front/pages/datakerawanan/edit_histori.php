<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-6 mt-10">
    <h1 class="text-xl font-semibold text-gray-700 mb-6">Edit Data Kerawanan</h1>

    <form action="<?= site_url("histori/update") ?>"
          method="post"
          enctype="multipart/form-data"
          class="space-y-5">

        <input type="hidden" name="id_hasil" value="<?= $hasil->id_hasil ?>">

        <!-- Tindak Lanjut -->
        <div>
            <label class="block text-gray-600 mb-2">Tindak Lanjut</label>
            <select name="tindak_lanjut"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-red-300">
                <option value="">-- Pilih Tindak Lanjut --</option>
                <option value="Pemindahan">Pemindahan</option>
                <option value="Pembinaan">Pembinaan</option>
            </select>
        </div>

        <!-- Upload File -->
        <div>
            <label class="block text-gray-600 mb-2">Upload File</label>
            <input type="file" name="file_dokumen"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:ring focus:ring-red-300">

            <?php if (!empty($hasil->file_dokumen)): ?>
                <p class="mt-2 text-sm text-gray-500">
                    File saat ini:
                    <a href="<?= base_url(
                    	"./uploads/" . $hasil->file_dokumen,
                    ) ?>"
                       class="text-blue-600 underline" target="_blank">
                        <?= $hasil->file_dokumen ?>
                    </a>
                </p>
            <?php endif; ?>
        </div>

        <!-- Tombol Aksi -->
        <div class="pt-4 flex justify-end gap-3">
            <a href="<?= site_url("histori") ?>"
               class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-gray-700">Batal</a>
            <button type="submit"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-white font-medium">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
