<main class="w-full min-h-screen p-4 sm:p-6 bg-gray-50">
    <!-- Flash Message -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base">
            <div class="flex items-start gap-3">
                <div class="text-xl">✅</div>
                <div><?= $this->session->flashdata('success') ?></div>
            </div>
        </div>
    <?php elseif ($this->session->flashdata('error')): ?>
        <div class="bg-red-50 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base">
            <div class="flex items-start gap-3">
                <div class="text-xl">❌</div>
                <div><?= $this->session->flashdata('error') ?></div>
            </div>
        </div>
    <?php endif; ?>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b pb-4 gap-3">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-red-700 tracking-tight">📊 <?= $title ?></h2>
            <p class="text-sm text-gray-500 mt-1"><?= $subtitle ?></p>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex items-center gap-3 mb-6">
        <button onclick="toggleTable('narkotika')" id="btn-narkotika"
            class="px-4 py-2 rounded-lg shadow font-medium bg-red-600 text-white transition cursor-pointer">
            Narkotika
        </button>
        <button onclick="toggleTable('teroris')" id="btn-teroris"
            class="px-4 py-2 rounded-lg shadow font-medium bg-gray-200 text-gray-800 transition hover:bg-gray-300 cursor-pointer">
            Teroris
        </button>
    </div>

    <!-- Table Narkotika -->
    <div id="table-narkotika" class="overflow-x-auto mt-6">

        <!-- Desktop Table -->
        <div class="hidden sm:block bg-white shadow rounded-xl overflow-hidden min-w-[800px]">
            <table class="min-w-full border-collapse text-center">
                <thead class="bg-red-600 text-white text-sm sm:text-base">
                    <tr>
                        <th class="px-2 py-3 font-semibold">No</th>
                        <th class="px-2 py-3 font-semibold">Nama Kanwil</th>
                        <th class="px-2 py-3 font-semibold">Nama UPT</th>
                        <th class="px-2 py-3 font-semibold">Nama</th>
                        <th class="px-2 py-3 font-semibold">Kategori</th>
                        <th class="px-2 py-3 font-semibold">Nilai Akhir</th>
                        <th class="px-2 py-3 font-semibold">Level</th>
                        <th class="px-2 py-3 font-semibold">Tipe</th>
                        <th class="px-2 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm sm:text-base">
                    <?php if (!empty($narkotika)):
                        $no = 1;
                        foreach ($narkotika as $row): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-2 py-3"><?= $no++ ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->nama_kanwil ?? "-") ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->nama_upt ?? "-") ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->nama_pegawai ?? ($row->nama_narapidana ?? "-")) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->jenis_skrining ?? "-") ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->nilai_akhir ?? "-") ?></td>
                                <td class="px-2 py-3">
                                    <?php
                                    $levelColor = [
                                        'Merah' => 'bg-red-100 text-red-700',
                                        'Kuning' => 'bg-yellow-100 text-yellow-700',
                                        'Hijau' => 'bg-green-100 text-green-700'
                                    ];
                                    $color = $levelColor[$row->level] ?? 'bg-gray-100 text-gray-600';
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                        <?= htmlspecialchars($row->level ?? "-") ?>
                                    </span>
                                </td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->tipe_object ?? "-") ?></td>
                                <td class="px-2 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick='showDetail(<?= json_encode($row) ?>)' class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow" title="Detail">🔍</button>
                                        <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')" class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-indigo-500 hover:bg-indigo-600 text-white shadow" title="Jawaban">📄</button>
                                        <?php
                                        $role = $this->session->userdata("role");
                                        if ($role === "admin" || ($role === "kanwil" && $row->level !== "Merah")):
                                        ?>
                                            <a href="<?= site_url('histori/delete/' . $row->id_hasil) ?>"
                                                onclick="return confirm('Yakin hapus data ini?')"
                                                class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow"
                                                title="Hapus">🗑️</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="9" class="py-6 text-gray-500 italic">Belum ada data narkotika</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards Narkotika -->
        <div class="block sm:hidden divide-y divide-gray-100 bg-white shadow rounded-xl">
            <?php if (!empty($narkotika)):
                $no = 1;
                foreach ($narkotika as $row): ?>
                    <div class="p-4 hover:bg-red-50 transition">
                        <div class="mb-2">
                            <span class="font-semibold text-red-600">#<?= $no++ ?></span>
                        </div>
                        <div class="text-gray-700 text-sm space-y-1">
                            <div><span class="font-medium">Nama Kanwil:</span> <?= htmlspecialchars($row->nama_kanwil ?? "-") ?></div>
                            <div><span class="font-medium">Nama UPT:</span> <?= htmlspecialchars($row->nama_upt ?? "-") ?></div>
                            <div><span class="font-medium">Nama:</span> <?= htmlspecialchars($row->nama_pegawai ?? ($row->nama_narapidana ?? "-")) ?></div>
                            <div><span class="font-medium">Kategori:</span> <?= htmlspecialchars($row->jenis_skrining ?? "-") ?></div>
                            <div><span class="font-medium">Nilai Akhir:</span> <?= htmlspecialchars($row->nilai_akhir ?? "-") ?></div>
                            <div><span class="font-medium">Level:</span>
                                <?php
                                $levelColor = [
                                    'Merah' => 'bg-red-100 text-red-700',
                                    'Kuning' => 'bg-yellow-100 text-yellow-700',
                                    'Hijau' => 'bg-green-100 text-green-700'
                                ];
                                $color = $levelColor[$row->level] ?? 'bg-gray-100 text-gray-600';
                                ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                    <?= htmlspecialchars($row->level ?? "-") ?>
                                </span>
                            </div>
                            <div><span class="font-medium">Tipe:</span> <?= htmlspecialchars($row->tipe_object ?? "-") ?></div>
                        </div>

                        <!-- Tombol aksi dipindahkan ke bawah card -->
                        <div class="flex justify-end gap-2 mt-3">
                            <button onclick='showDetail(<?= json_encode($row) ?>)'
                                class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow"
                                title="Detail">🔍</button>
                            <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')"
                                class="cursor-pointer  w-9 h-9 flex items-center justify-center rounded-full bg-indigo-500 hover:bg-indigo-600 text-white shadow"
                                title="Jawaban">📄</button>
                            <?php
                            $role = $this->session->userdata("role");
                            if ($role === "admin" || ($role === "kanwil" && $row->level !== "Merah")):
                            ?>
                                <a href="<?= site_url('histori/delete/' . $row->id_hasil) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow"
                                    title="Hapus">🗑️</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;
            else: ?>
                <div class="p-4 text-center text-gray-500 italic">Belum ada data narkotika</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Table Teroris -->
    <div id="table-teroris" class="overflow-x-auto hidden mt-6">

        <!-- Desktop Table -->
        <div class="hidden sm:block bg-white shadow rounded-xl overflow-hidden min-w-[800px]">
            <table class="min-w-full border-collapse text-center">
                <thead class="bg-red-600 text-white text-sm sm:text-base">
                    <tr>
                        <th class="px-2 py-3 font-semibold">No</th>
                        <th class="px-2 py-3 font-semibold">Nama Kanwil</th>
                        <th class="px-2 py-3 font-semibold">Nama UPT</th>
                        <th class="px-2 py-3 font-semibold">Nama</th>
                        <th class="px-2 py-3 font-semibold">Kategori</th>
                        <th class="px-2 py-3 font-semibold">Nilai Akhir</th>
                        <th class="px-2 py-3 font-semibold">Level</th>
                        <th class="px-2 py-3 font-semibold">Tipe</th>
                        <th class="px-2 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm sm:text-base">
                    <?php if (!empty($teroris)):
                        $no = 1;
                        foreach ($teroris as $row): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-2 py-3"><?= $no++ ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->nama_kanwil ?? "-") ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->nama_upt ?? "-") ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->nama_pegawai ?? ($row->nama_narapidana ?? "-")) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->jenis_skrining ?? "-") ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->nilai_akhir ?? "-") ?></td>
                                <td class="px-2 py-3">
                                    <?php
                                    $levelColor = [
                                        'Merah' => 'bg-red-100 text-red-700',
                                        'Kuning' => 'bg-yellow-100 text-yellow-700',
                                        'Hijau' => 'bg-green-100 text-green-700'
                                    ];
                                    $color = $levelColor[$row->level] ?? 'bg-gray-100 text-gray-600';
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                        <?= htmlspecialchars($row->level ?? "-") ?>
                                    </span>
                                </td>
                                <td class="px-2 py-3"><?= htmlspecialchars($row->tipe_object ?? "-") ?></td>
                                <td class="px-2 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick='showDetail(<?= json_encode($row) ?>)' class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow" title="Detail">🔍</button>
                                        <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')" class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-indigo-500 hover:bg-indigo-600 text-white shadow" title="Jawaban">📄</button>
                                        <?php
                                        $role = $this->session->userdata("role");
                                        if ($role === "admin" || ($role === "kanwil" && $row->level !== "Merah")):
                                        ?>
                                            <a href="<?= site_url('histori/delete/' . $row->id_hasil) ?>"
                                                onclick="return confirm('Yakin hapus data ini?')"
                                                class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow"
                                                title="Hapus">🗑️</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="9" class="py-6 text-gray-500 italic">Belum ada data teroris</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- CARD: tampil di mobile -->
        <div class="block sm:hidden divide-y divide-gray-100 bg-white shadow rounded-xl">
            <?php if (!empty($teroris)):
                $no = 1;
                foreach ($teroris as $row): ?>
                    <div class="p-4 hover:bg-red-50 transition">
                        <div class="mb-2">
                            <span class="font-semibold text-red-600">#<?= $no++ ?></span>
                        </div>
                        <div class="text-gray-700 text-sm space-y-1">
                            <div><span class="font-medium">Nama Kanwil:</span> <?= htmlspecialchars($row->nama_kanwil ?? "-") ?></div>
                            <div><span class="font-medium">Nama UPT:</span> <?= htmlspecialchars($row->nama_upt ?? "-") ?></div>
                            <div><span class="font-medium">Nama:</span> <?= htmlspecialchars($row->nama_pegawai ?? ($row->nama_narapidana ?? "-")) ?></div>
                            <div><span class="font-medium">Kategori:</span> <?= htmlspecialchars($row->jenis_skrining ?? "-") ?></div>
                            <div><span class="font-medium">Nilai Akhir:</span> <?= htmlspecialchars($row->nilai_akhir ?? "-") ?></div>
                            <div><span class="font-medium">Level:</span>
                                <?php
                                $levelColor = [
                                    'Merah' => 'bg-red-100 text-red-700',
                                    'Kuning' => 'bg-yellow-100 text-yellow-700',
                                    'Hijau' => 'bg-green-100 text-green-700'
                                ];
                                $color = $levelColor[$row->level] ?? 'bg-gray-100 text-gray-600';
                                ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                    <?= htmlspecialchars($row->level ?? "-") ?>
                                </span>
                            </div>
                            <div><span class="font-medium">Tipe:</span> <?= htmlspecialchars($row->tipe_object ?? "-") ?></div>
                            <?php if (strtolower(trim($row->tipe_object ?? "")) === "narapidana"): ?>
                                <div><span class="font-medium">Perkara:</span> <?= htmlspecialchars($row->perkara ?? "-") ?></div>
                            <?php endif; ?>
                            <div><span class="font-medium">Antisipasi:</span> <?= htmlspecialchars($row->nama_antisipasi ?? "-") ?></div>
                            <div><span class="font-medium">Solusi:</span> <?= htmlspecialchars($row->solusi ?? "-") ?></div>
                            <div><span class="font-medium">Created At:</span> <?= htmlspecialchars($row->created_at ?? "-") ?></div>
                        </div>

                        <!-- Tombol aksi dipindahkan ke bawah card -->
                        <div class="flex justify-end gap-2 mt-3">
                            <button onclick='showDetail(<?= json_encode($row) ?>)'
                                class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow"
                                title="Detail">🔍</button>
                            <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')"
                                class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-indigo-500 hover:bg-indigo-600 text-white shadow"
                                title="Jawaban">📄</button>
                            <?php
                            $role = $this->session->userdata("role");
                            if ($role === "admin" || ($role === "kanwil" && $row->level !== "Merah")):
                            ?>
                                <a href="<?= site_url('histori/delete/' . $row->id_hasil) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow"
                                    title="Hapus">🗑️</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;
            else: ?>
                <div class="p-4 text-center text-gray-500 italic">Belum ada data teroris</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal"
        class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full relative mx-4">
            <h3 class="text-xl font-semibold text-blue-700 p-6 pb-3">📋 Detail Data</h3>
            <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto" id="detailContent">
                <p><strong>Nama:</strong> <span id="detailNama">-</span></p>
                <p><strong>Tipe:</strong> <span id="detailTipe">-</span></p>
                <p><strong>Perkara:</strong> <span id="detailPerkara">-</span></p>
                <p><strong>Antisipasi:</strong> <span id="detailAntisipasi">-</span></p>
                <p><strong>Solusi:</strong> <span id="detailSolusi">-</span></p>
                <p><strong>Created At:</strong> <span id="detailCreated">-</span></p>
            </div>
            <div class="flex justify-end space-x-3 p-6 pt-0">
                <button onclick="closeDetail()"
                    class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer hover:bg-gray-300">Tutup</button>
            </div>
            <button onclick="closeDetail()"
                class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>
    </div>

    <!-- Modal Jawaban -->
    <div id="jawabanModal"
        class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-lg max-w-3xl w-full relative mx-4">
            <h3 class="text-xl font-semibold text-red-700 p-6 pb-3">📑 Detail Jawaban</h3>
            <div class="flex border-b border-gray-200 px-6">
                <button onclick="switchTab('skrining')" id="tab-skrining"
                    class="px-4 py-2 font-medium text-red-600 border-b-2 border-red-600">Skrining</button>
                <button onclick="switchTab('bahaya')" id="tab-bahaya"
                    class="px-4 py-2 font-medium text-gray-600 hover:text-red-600">Faktor Bahaya</button>
                <button onclick="switchTab('kerentanan')" id="tab-kerentanan"
                    class="px-4 py-2 font-medium text-gray-600 hover:text-red-600">Faktor Kerentanan</button>
            </div>
            <div class="p-6 space-y-6 max-h-[70vh] overflow-y-auto">
                <div id="content-skrining">
                    <table class="table-auto w-full border border-gray-300 rounded-lg text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-4 py-2 text-left">Indikator Skrining</th>
                                <th class="border px-4 py-2 text-left">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody id="skriningTable" class="divide-y divide-gray-200 text-gray-600"></tbody>
                    </table>
                </div>
                <div id="content-bahaya" class="hidden">
                    <table class="table-auto w-full border border-gray-300 rounded-lg text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-4 py-2 text-left">Indikator Faktor</th>
                                <th class="border px-4 py-2 text-left">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody id="bahayaTable" class="divide-y divide-gray-200 text-gray-600"></tbody>
                    </table>
                </div>
                <div id="content-kerentanan" class="hidden">
                    <table class="table-auto w-full border border-gray-300 rounded-lg text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-4 py-2 text-left">Indikator Faktor</th>
                                <th class="border px-4 py-2 text-left">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody id="kerentananTable" class="divide-y divide-gray-200 text-gray-600"></tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-end space-x-3 p-6 pt-0">
                <button onclick="closeJawaban()"
                    class="px-4 py-2 bg-gray-200 rounded-lg cursor-pointer hover:bg-gray-300">Tutup</button>
            </div>
            <button onclick="closeJawaban()"
                class="absolute top-3 right-3 cursor-pointer text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>
    </div>

    <script>
        function toggleTable(type) {
            const narkotika = document.getElementById('table-narkotika');
            const teroris = document.getElementById('table-teroris');
            const btnN = document.getElementById('btn-narkotika');
            const btnT = document.getElementById('btn-teroris');

            // sembunyikan semua tabel
            narkotika.classList.add('hidden');
            teroris.classList.add('hidden');

            // reset style tombol
            [btnN, btnT].forEach(btn => {
                btn.classList.remove('bg-red-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
            });

            if (type === 'narkotika') {
                narkotika.classList.remove('hidden');
                btnN.classList.add('bg-red-600', 'text-white');
                btnN.classList.remove('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
            } else {
                teroris.classList.remove('hidden');
                btnT.classList.add('bg-red-600', 'text-white');
                btnT.classList.remove('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300');
            }
        }

        function showDetail(rowData) {
            document.getElementById("detailNama").textContent = rowData.nama_pegawai || rowData.nama_narapidana || "-";
            document.getElementById("detailTipe").textContent = rowData.tipe_object || "-";
            document.getElementById("detailPerkara").textContent = rowData.perkara || "-";
            document.getElementById("detailAntisipasi").textContent = rowData.nama_antisipasi || "-";
            document.getElementById("detailSolusi").textContent = rowData.solusi || "-";
            document.getElementById("detailCreated").textContent = rowData.created_at || "-";

            const modal = document.getElementById("detailModal");
            modal.classList.remove("opacity-0", "pointer-events-none", "hidden");
        }

        function closeDetail() {
            const modal = document.getElementById("detailModal");
            modal.classList.add("opacity-0", "pointer-events-none");
            setTimeout(() => modal.classList.add("hidden"), 300);
        }

        function showJawaban(id_hasil) {
            fetch("<?= base_url("histori/get_jawaban/") ?>" + id_hasil)
                .then(res => res.json())
                .then(data => {
                    let skriningHtml = "";
                    data.skrining.forEach(item => {
                        if (item.indikator_skrining && item.jawaban !== null) {
                            skriningHtml += `<tr>
                        <td class="border px-4 py-2">${item.indikator_skrining}</td>
                        <td class="border px-4 py-2">${item.jawaban}</td>
                    </tr>`;
                        }
                    });
                    document.getElementById("skriningTable").innerHTML =
                        skriningHtml || '<tr><td colspan="2" class="text-center py-2">Tidak ada jawaban</td></tr>';

                    let bahayaHtml = "";
                    data.bahaya.forEach(item => {
                        bahayaHtml += `<tr>
                    <td class="border px-4 py-2">${item.indikator_faktor}</td>
                    <td class="border px-4 py-2">${item.jawaban}</td>
                </tr>`;
                    });
                    document.getElementById("bahayaTable").innerHTML =
                        bahayaHtml || '<tr><td colspan="2" class="text-center py-2">Tidak ada jawaban</td></tr>';

                    let kerentananHtml = "";
                    data.kerentanan.forEach(item => {
                        kerentananHtml += `<tr>
                    <td class="border px-4 py-2">${item.indikator_faktor}</td>
                    <td class="border px-4 py-2">${item.jawaban}</td>
                </tr>`;
                    });
                    document.getElementById("kerentananTable").innerHTML =
                        kerentananHtml || '<tr><td colspan="2" class="text-center py-2">Tidak ada jawaban</td></tr>';

                    const modal = document.getElementById("jawabanModal");
                    modal.classList.remove("opacity-0", "pointer-events-none", "hidden");
                    switchTab("skrining");
                })
                .catch(err => {
                    console.error("Gagal ambil data:", err);
                    alert("Terjadi kesalahan saat mengambil data.");
                });
        }

        function closeJawaban() {
            const modal = document.getElementById("jawabanModal");
            modal.classList.add("opacity-0", "pointer-events-none");
            setTimeout(() => modal.classList.add("hidden"), 300);
        }

        function switchTab(tab) {
            const tabs = ["skrining", "bahaya", "kerentanan"];
            tabs.forEach(t => {
                document.getElementById("content-" + t).classList.add("hidden");
                document.getElementById("tab-" + t).classList.remove("text-red-600", "border-b-2", "border-red-600");
                document.getElementById("tab-" + t).classList.add("text-gray-600");
            });
            document.getElementById("content-" + tab).classList.remove("hidden");
            document.getElementById("tab-" + tab).classList.add("text-red-600", "border-b-2", "border-red-600");
        }
    </script>
</main>