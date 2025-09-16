<main class="w-full p-6 bg-white rounded-2xl shadow-lg space-y-8">

    <!-- Header -->
    <div>
        <h2 class="text-2xl sm:text-3xl font-bold text-red-700 tracking-tight">👥 Input Pegawai</h2>
        <p class="text-sm text-gray-500 mt-1">Lengkapi data pegawai dan lakukan skrining serta penilaian faktor.</p>
    </div>

    <!-- Flash Message -->
    <?php if ($this->session->flashdata("success")) { ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm">
            ✅ <?= $this->session->flashdata("success") ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata("error")) { ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl shadow-sm">
            ❌ <?= $this->session->flashdata("error") ?>
        </div>
    <?php } ?>

    <!-- Form -->
    <form action="<?= base_url("Input_Pegawai/save") ?>" method="post" class="space-y-10">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">NIP</label>
                <input type="text" name="nip"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-red-600"
                    placeholder="Masukkan NIP Pegawai" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nama Pegawai</label>
                <input type="text" name="nama_pegawai"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-red-600"
                    placeholder="Masukkan Nama Pegawai" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Pangkat/Golongan</label>
                <select name="golongan" id="golongan"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-red-600">
                    <option value="">-- Pilih Golongan --</option>
                    <option value="Juru Muda (I/a)">Juru Muda (I/a)</option>
                    <option value="Juru Muda Tingkat I (I/b)">Juru Muda Tingkat I (I/b)</option>
                    <option value="Juru (I/c)">Juru (I/c)</option>
                    <option value="Juru Tingkat I (I/d)">Juru Tingkat I (I/d)</option>
                    <option value="Pengatur Muda (II/a)">Pengatur Muda (II/a)</option>
                    <option value="Pengatur Muda Tingkat I (II/b)">Pengatur Muda Tingkat I (II/b)</option>
                    <option value="Pengatur (II/c)">Pengatur (II/c)</option>
                    <option value="Pengatur Tingkat I (II/d)">Pengatur Tingkat I (II/d)</option>
                    <option value="Penata Muda (III/a)">Penata Muda (III/a)</option>
                    <option value="Penata Muda Tingkat I (III/b)">Penata Muda Tingkat I (III/b)</option>
                    <option value="Penata (III/c)">Penata (III/c)</option>
                    <option value="Penata Tingkat I (III/d)">Penata Tingkat I (III/d)</option>
                    <option value="Pembina (IV/a)">Pembina (IV/a)</option>
                    <option value="Pembina Tingkat I (IV/b)">Pembina Tingkat I (IV/b)</option>
                    <option value="Pembina Utama Muda (IV/c)">Pembina Utama Muda (IV/c)</option>
                    <option value="Pembina Utama Madya (IV/d)">Pembina Utama Madya (IV/d)</option>
                    <option value="Pembina Utama (IV/e)">Pembina Utama (IV/e)</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jabatan</label>
                <input type="text" name="jabatan"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-red-600"
                    placeholder="Masukkan Jabatan Pegawai" required>
            </div>
            <!-- Identitas -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Satuan Kerja</label>
                <input type="text" name="nama_upt" value="<?= htmlspecialchars($nama_upt) ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm bg-gray-100"
                    readonly>
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2">Instrument</label>
            <select name="instrument" id="instrument"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-red-600">
                <option value="">-- Pilih Instrument --</option>
                <?php foreach ($instrument as $row): ?>
                    <option value="<?= $row->id_instrument ?>"><?= htmlspecialchars($row->nama_instrument) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Kategori -->
        <div id="kategori-section" class="hidden">
            <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
            <select name="kategori" id="kategori"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-red-600">
            </select>
        </div>

        <!-- Skrining -->
        <div id="skrining-section" class="hidden">
            <h3 class="text-lg font-bold text-red-600 mb-3">📑 Pertanyaan Skrining</h3>
            <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-sm">
                <table class="min-w-full border-collapse text-sm sm:text-base">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Pertanyaan</th>
                            <th class="px-4 py-3 text-center w-20">Ya</th>
                            <th class="px-4 py-3 text-center w-20">Tidak</th>
                        </tr>
                    </thead>
                    <tbody id="skrining-body" class="divide-y divide-gray-200"></tbody>
                </table>
            </div>
        </div>

        <!-- Faktor -->
        <div id="faktor-section" class="hidden space-y-8">

            <!-- Faktor Bahaya -->
            <div id="faktor-bahaya" class="hidden">
                <h4 class="text-md font-semibold text-gray-700 mb-2">🚨 Faktor Bahaya</h4>
                <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-sm">
                    <table class="min-w-full border-collapse text-sm sm:text-base">
                        <thead class="bg-red-600 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left">Faktor</th>
                                <th class="px-4 py-3 text-center w-20">Ya</th>
                                <th class="px-4 py-3 text-center w-20">Tidak</th>
                            </tr>
                        </thead>
                        <tbody id="faktor-bahaya-body" class="divide-y divide-gray-200"></tbody>
                    </table>
                </div>
            </div>

            <!-- Faktor Kerentanan -->
            <div id="faktor-kerentanan" class="hidden">
                <h4 class="text-md font-semibold text-gray-700 mb-2">⚠️ Faktor Kerentanan</h4>
                <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-sm">
                    <table class="min-w-full border-collapse text-sm sm:text-base">
                        <thead class="bg-red-600 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left">Faktor</th>
                                <th class="px-4 py-3 text-center w-20">Ya</th>
                                <th class="px-4 py-3 text-center w-20">Tidak</th>
                            </tr>
                        </thead>
                        <tbody id="faktor-kerentanan-body" class="divide-y divide-gray-200"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tombol -->
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <button type="submit"
                class="w-full sm:w-auto px-8 py-3 bg-red-600 text-white font-semibold rounded-xl shadow hover:bg-red-700 transition cursor-pointer">
                ✅ Kirim
            </button>
            <button type="reset"
                class="w-full sm:w-auto px-8 py-3 bg-gray-200 text-gray-800 font-semibold rounded-xl shadow hover:bg-gray-300 transition cursor-pointer">
                🔄 Reset
            </button>
        </div>
    </form>
</main>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        // Instrument dipilih
        $('#instrument').change(function() {
            let id_instrument = $(this).val();
            if (id_instrument) {
                $.post("<?= site_url("input_pegawai/kategori") ?>", {
                    id_instrument: id_instrument
                }, function(data) {
                    let html = '<option value="">-- Pilih Kategori --</option>';
                    if (Array.isArray(data)) {
                        data.forEach(function(row) {
                            if (row.jenis_skrining !== undefined) {
                                html += `<option value="${row.jenis_skrining}">${row.jenis_skrining}</option>`;
                            }
                        });
                    }
                    $('#kategori').html(html);
                    $('#kategori-section').removeClass('hidden');
                }, "json");

                // reset skrining & faktor
                $('#skrining-section').addClass('hidden');
                $('#faktor-section').addClass('hidden');
                $('#faktor-bahaya').addClass('hidden');
                $('#faktor-kerentanan').addClass('hidden');
            } else {
                $('#kategori-section').addClass('hidden');
                $('#skrining-section').addClass('hidden');
                $('#faktor-section').addClass('hidden');
            }
        });

        // Kategori dipilih
        $('#kategori').change(function() {
            let id_kategori = $(this).val();
            let id_instrument = $('#instrument').val();

            if (id_kategori) {
                // Ambil skrining
                $.post("<?= site_url("Input_Pegawai/getSkrining") ?>", {
                    id_kategori: id_kategori
                }, function(data) {
                    let html = '';
                    if (Array.isArray(data)) {
                        data.forEach(function(row) {
                            html += `
                        <tr>
                            <td class="px-4 py-3 text-gray-800 font-medium">${row.indikator_skrining}</td>
                            <td class="px-4 py-3 text-center">
                                <input type="radio" name="jawaban[${row.id_skrining}]" value="1" class="h-4 w-4 text-red-600">
                            </td>
                            <td class="px-4 py-3 text-center">
                                <input type="radio" name="jawaban[${row.id_skrining}]" value="0" class="h-4 w-4 text-black">
                            </td>
                        </tr>`;
                        });
                    }
                    $('#skrining-body').html(html);
                    $('#skrining-section').removeClass('hidden');
                }, "json");

                // Ambil faktor
                $.post("<?= site_url("Input_Pegawai/getFaktor") ?>", {
                    id_instrument: id_instrument
                }, function(data) {
                    let htmlBahaya = '';
                    let htmlKerentanan = '';

                    if (Array.isArray(data)) {
                        data.forEach(function(row) {
                            let htmlRow = `
                            <tr>
                                <td class="px-4 py-3 text-gray-800 font-medium">${row.indikator_faktor}</td>
                                <td class="px-4 py-3 text-center">
                                    <input type="radio" name="faktor[${row.id_faktor}]" value="1" class="h-4 w-4 text-red-600">
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <input type="radio" name="faktor[${row.id_faktor}]" value="0" class="h-4 w-4 text-black">
                                </td>
                            </tr>`;
                            if (row.jenis_faktor === 'Bahaya') {
                                htmlBahaya += htmlRow;
                            } else if (row.jenis_faktor === 'Kerentanan') {
                                htmlKerentanan += htmlRow;
                            }
                        });
                    }

                    if (htmlBahaya) {
                        $('#faktor-bahaya-body').html(htmlBahaya);
                        $('#faktor-bahaya').removeClass('hidden');
                    } else {
                        $('#faktor-bahaya').addClass('hidden');
                    }

                    if (htmlKerentanan) {
                        $('#faktor-kerentanan-body').html(htmlKerentanan);
                        $('#faktor-kerentanan').removeClass('hidden');
                    } else {
                        $('#faktor-kerentanan').addClass('hidden');
                    }

                    $('#faktor-section').removeClass('hidden');
                }, "json");
            } else {
                $('#skrining-section').addClass('hidden');
                $('#faktor-section').addClass('hidden');
            }
        });
    });
</script>