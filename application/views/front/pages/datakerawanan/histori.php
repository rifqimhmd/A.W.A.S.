<main class="w-full min-h-screen p-4 sm:p-6 bg-gray-50">
    <!-- Flash Message -->
    <?php if ($this->session->flashdata("success")): ?>
        <div id="flash-message" class="bg-green-50 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base">
            <div class="flex items-start gap-3">
                <div class="text-xl">✅</div>
                <div><?= $this->session->flashdata("success") ?></div>
            </div>
        </div>
    <?php elseif ($this->session->flashdata("error")): ?>
        <div id="flash-message" class="bg-red-50 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-lg shadow-sm text-sm sm:text-base">
            <div class="flex items-start gap-3">
                <div class="text-xl">❌</div>
                <div><?= $this->session->flashdata("error") ?></div>
            </div>
        </div>
    <?php endif; ?>

    <script>
        // Auto hide flash message after 5 seconds
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.classList.add('opacity-0'); // fade out
                setTimeout(() => flash.remove(), 500); // remove from DOM after fade
            }
        }, 5000); // 5000ms = 5 detik
    </script>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b pb-4 gap-3">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-red-700 tracking-tight">📊 <?= $title ?></h2>
            <p class="text-sm text-gray-500 mt-1"><?= $subtitle ?></p>
        </div>
        <!-- Tombol Filter Mobile -->
        <div class="flex sm:hidden justify-end mb-4">
            <button id="open-filter-btn" class="bg-red-500 text-white px-4 py-2 rounded-lg">
                Filter
            </button>
        </div>

        <!-- Filter Desktop -->
        <div id="filter-desktop" class="hidden sm:flex flex-col sm:flex-row gap-4 mb-4 items-start sm:items-center">

            <!-- Filter Tipe -->
            <div class="flex items-center gap-2">
                <label for="filter-tipe" class="text-sm text-gray-700">Tipe:</label>
                <select id="filter-tipe" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm" onchange="applyFilters()">
                    <option value="all">Semua</option>
                    <option value="Pegawai">Pegawai</option>
                    <option value="Narapidana">Narapidana</option>
                </select>
            </div>

            <!-- Filter Level -->
            <div class="flex items-center gap-2">
                <label for="filter-level" class="text-sm text-gray-700">Level:</label>
                <select id="filter-level" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm" onchange="applyFilters()">
                    <option value="all">Semua</option>
                    <option value="Merah">Merah</option>
                    <option value="Kuning">Kuning</option>
                    <option value="Hijau">Hijau</option>
                </select>
            </div>

            <!-- Filter UPT -->
            <div class="flex items-center gap-2">
                <label for="filter-upt" class="text-sm text-gray-700">UPT:</label>
                <select id="filter-upt" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm" onchange="applyFilters()">
                    <option value="all">Semua</option>
                    <?php foreach ($list_upt as $upt): ?>
                        <option value="<?= htmlspecialchars(
                        	$upt["nama_upt"],
                        ) ?>"><?= htmlspecialchars($upt["nama_upt"]) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Filter Kanwil -->
            <div class="flex items-center gap-2">
            <label for="filter-upt" class="text-sm text-gray-700">Kanwil:</label>
            <?php if ($this->session->userdata("role") === "kanwil"): ?>
                <!-- Jika role kanwil → tampilkan teks saja -->
                <?php foreach ($list_kanwil as $kanwil): ?>
                    <input type="text" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm" value="<?= $row[
                    	"nama_kanwil"
                    ] ?>" readonly>
                    <!-- simpan id_kanwil tersembunyi supaya tetap bisa dikirim -->
                    <input type="hidden" name="kanwil" value="<?= $kanwil[
                    	"id_kanwil"
                    ] ?>">
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Jika role admin/upt → tetap pakai combobox -->
                <select name="kanwil" id="filter-kanwil" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none text-sm" onchange="applyFilters()">
                <option value="all">Semua</option>
                    <?php foreach ($list_kanwil as $kanwil): ?>
                    <option value="<?= htmlspecialchars(
                    	$kanwil["nama_kanwil"],
                    ) ?>"><?= htmlspecialchars(
	$kanwil["nama_kanwil"],
) ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            </div>

        </div>

        <!-- Modal Filter Mobile -->
        <div id="filter-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg p-6 w-11/12 max-w-md">
                <h2 class="text-lg font-semibold mb-4">Filter</h2>

                <!-- Filter Mobile (sama seperti desktop) -->
                <div id="filter-mobile-content" class="flex flex-col gap-3">
                    <div class="flex items-center gap-2">
                        <label for="filter-tipe-mobile" class="text-sm text-gray-700">Tipe:</label>
                        <select id="filter-tipe-mobile" class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-red-500 focus:outline-none text-sm"></select>
                    </div>

                    <div class="flex items-center gap-2">
                        <label for="filter-level-mobile" class="text-sm text-gray-700">Level:</label>
                        <select id="filter-level-mobile" class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-red-500 focus:outline-none text-sm"></select>
                    </div>

                    <div class="flex items-center gap-2">
                        <label for="filter-upt-mobile" class="text-sm text-gray-700">UPT:</label>
                        <select id="filter-upt-mobile" class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-red-500 focus:outline-none text-sm"></select>
                    </div>

                    <div class="flex items-center gap-2">
                        <label for="filter-kanwil-mobile" class="text-sm text-gray-700">Kanwil:</label>
                        <select id="filter-kanwil-mobile" class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-red-500 focus:outline-none text-sm"></select>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button id="close-filter-btn" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                    <button id="apply-filter-btn" class="bg-red-500 text-white px-4 py-2 rounded-lg">Terapkan</button>
                </div>
            </div>
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
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->nama_kanwil ?? "-",
                                ) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->nama_upt ?? "-",
                                ) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->nama_pegawai ??
                                		($row->nama_narapidana ?? "-"),
                                ) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->jenis_skrining ?? "-",
                                ) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->nilai_akhir ?? "-",
                                ) ?></td>
                                <td class="px-2 py-3">
                                    <?php
                                    $levelColor = [
                                    	"Merah" => "bg-red-100 text-red-700",
                                    	"Kuning" =>
                                    		"bg-yellow-100 text-yellow-700",
                                    	"Hijau" =>
                                    		"bg-green-100 text-green-700",
                                    ];
                                    $color =
                                    	$levelColor[$row->level] ??
                                    	"bg-gray-100 text-gray-600";
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                        <?= htmlspecialchars(
                                        	$row->level ?? "-",
                                        ) ?>
                                    </span>
                                </td>
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->tipe_object ?? "-",
                                ) ?></td>
                                <td class="px-2 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick='showDetail(<?= json_encode(
                                        	$row,
                                        ) ?>)' class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow" title="Detail">🔍</button>
                                        <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')" class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-indigo-500 hover:bg-indigo-600 text-white shadow" title="Jawaban">📄</button>
                                        <?php
                                        $role = $this->session->userdata(
                                        	"role",
                                        );
                                        if (
                                        	$role === "admin" ||
                                        	($role === "kanwil" &&
                                        		$row->level !== "Merah")
                                        ): ?>
                                            <a href="<?= site_url(
                                            	"histori/delete/" .
                                            		$row->id_hasil,
                                            ) ?>"
                                                onclick="return confirm('Yakin hapus data ini?')"
                                                class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow"
                                                title="Hapus">🗑️</a>
                                        <?php endif;
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;
                    else:
                    	 ?>
                        <tr>
                            <td colspan="9" class="py-6 text-gray-500 italic">Belum ada data narkotika</td>
                        </tr>
                    <?php
                    endif; ?>
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
                            <div><span class="font-medium">Nama Kanwil:</span> <?= htmlspecialchars(
                            	$row->nama_kanwil ?? "-",
                            ) ?></div>
                            <div><span class="font-medium">Nama UPT:</span> <?= htmlspecialchars(
                            	$row->nama_upt ?? "-",
                            ) ?></div>
                            <div><span class="font-medium">Nama:</span> <?= htmlspecialchars(
                            	$row->nama_pegawai ??
                            		($row->nama_narapidana ?? "-"),
                            ) ?></div>
                            <div><span class="font-medium">Kategori:</span> <?= htmlspecialchars(
                            	$row->jenis_skrining ?? "-",
                            ) ?></div>
                            <div><span class="font-medium">Nilai Akhir:</span> <?= htmlspecialchars(
                            	$row->nilai_akhir ?? "-",
                            ) ?></div>
                            <div><span class="font-medium">Level:</span>
                                <?php
                                $levelColor = [
                                	"Merah" => "bg-red-100 text-red-700",
                                	"Kuning" => "bg-yellow-100 text-yellow-700",
                                	"Hijau" => "bg-green-100 text-green-700",
                                ];
                                $color =
                                	$levelColor[$row->level] ??
                                	"bg-gray-100 text-gray-600";
                                ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                    <?= htmlspecialchars($row->level ?? "-") ?>
                                </span>
                            </div>
                            <div><span class="font-medium">Tipe:</span> <?= htmlspecialchars(
                            	$row->tipe_object ?? "-",
                            ) ?></div>
                        </div>

                        <!-- Tombol aksi dipindahkan ke bawah card -->
                        <div class="flex justify-end gap-2 mt-3">
                            <button onclick='showDetail(<?= json_encode(
                            	$row,
                            ) ?>)'
                                class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow"
                                title="Detail">🔍</button>
                            <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')"
                                class="cursor-pointer  w-9 h-9 flex items-center justify-center rounded-full bg-indigo-500 hover:bg-indigo-600 text-white shadow"
                                title="Jawaban">📄</button>
                            <?php
                            $role = $this->session->userdata("role");
                            if (
                            	$role === "admin" ||
                            	($role === "kanwil" && $row->level !== "Merah")
                            ): ?>
                                <a href="<?= site_url(
                                	"histori/delete/" . $row->id_hasil,
                                ) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow"
                                    title="Hapus">🗑️</a>
                            <?php endif;
                            ?>
                        </div>
                    </div>
                <?php endforeach;
            else:
            	 ?>
                <div class="p-4 text-center text-gray-500 italic">Belum ada data narkotika</div>
            <?php
            endif; ?>
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
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->nama_kanwil ?? "-",
                                ) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->nama_upt ?? "-",
                                ) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->nama_pegawai ??
                                		($row->nama_narapidana ?? "-"),
                                ) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->jenis_skrining ?? "-",
                                ) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->nilai_akhir ?? "-",
                                ) ?></td>
                                <td class="px-2 py-3">
                                    <?php
                                    $levelColor = [
                                    	"Merah" => "bg-red-100 text-red-700",
                                    	"Kuning" =>
                                    		"bg-yellow-100 text-yellow-700",
                                    	"Hijau" =>
                                    		"bg-green-100 text-green-700",
                                    ];
                                    $color =
                                    	$levelColor[$row->level] ??
                                    	"bg-gray-100 text-gray-600";
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                        <?= htmlspecialchars(
                                        	$row->level ?? "-",
                                        ) ?>
                                    </span>
                                </td>
                                <td class="px-2 py-3"><?= htmlspecialchars(
                                	$row->tipe_object ?? "-",
                                ) ?></td>
                                <td class="px-2 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick='showDetail(<?= json_encode(
                                        	$row,
                                        ) ?>)' class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow" title="Detail">🔍</button>
                                        <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')" class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-indigo-500 hover:bg-indigo-600 text-white shadow" title="Jawaban">📄</button>
                                        <?php
                                        $role = $this->session->userdata(
                                        	"role",
                                        );
                                        if (
                                        	$role === "admin" ||
                                        	($role === "kanwil" &&
                                        		$row->level !== "Merah")
                                        ): ?>
                                            <a href="<?= site_url(
                                            	"histori/delete/" .
                                            		$row->id_hasil,
                                            ) ?>"
                                                onclick="return confirm('Yakin hapus data ini?')"
                                                class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow"
                                                title="Hapus">🗑️</a>
                                        <?php endif;
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;
                    else:
                    	 ?>
                        <tr>
                            <td colspan="9" class="py-6 text-gray-500 italic">Belum ada data teroris</td>
                        </tr>
                    <?php
                    endif; ?>
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
                            <div><span class="font-medium">Nama Kanwil:</span> <?= htmlspecialchars(
                            	$row->nama_kanwil ?? "-",
                            ) ?></div>
                            <div><span class="font-medium">Nama UPT:</span> <?= htmlspecialchars(
                            	$row->nama_upt ?? "-",
                            ) ?></div>
                            <div><span class="font-medium">Nama:</span> <?= htmlspecialchars(
                            	$row->nama_pegawai ??
                            		($row->nama_narapidana ?? "-"),
                            ) ?></div>
                            <div><span class="font-medium">Kategori:</span> <?= htmlspecialchars(
                            	$row->jenis_skrining ?? "-",
                            ) ?></div>
                            <div><span class="font-medium">Nilai Akhir:</span> <?= htmlspecialchars(
                            	$row->nilai_akhir ?? "-",
                            ) ?></div>
                            <div><span class="font-medium">Level:</span>
                                <?php
                                $levelColor = [
                                	"Merah" => "bg-red-100 text-red-700",
                                	"Kuning" => "bg-yellow-100 text-yellow-700",
                                	"Hijau" => "bg-green-100 text-green-700",
                                ];
                                $color =
                                	$levelColor[$row->level] ??
                                	"bg-gray-100 text-gray-600";
                                ?>
                                <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                                    <?= htmlspecialchars($row->level ?? "-") ?>
                                </span>
                            </div>
                            <div><span class="font-medium">Tipe:</span> <?= htmlspecialchars(
                            	$row->tipe_object ?? "-",
                            ) ?></div>
                            <?php if (
                            	strtolower(trim($row->tipe_object ?? "")) ===
                            	"narapidana"
                            ): ?>
                                <div><span class="font-medium">Perkara:</span> <?= htmlspecialchars(
                                	$row->perkara ?? "-",
                                ) ?></div>
                            <?php endif; ?>
                            <div><span class="font-medium">Antisipasi:</span> <?= htmlspecialchars(
                            	$row->nama_antisipasi ?? "-",
                            ) ?></div>
                            <div><span class="font-medium">Solusi:</span> <?= htmlspecialchars(
                            	$row->solusi ?? "-",
                            ) ?></div>
                            <div><span class="font-medium">Created At:</span> <?= htmlspecialchars(
                            	$row->created_at ?? "-",
                            ) ?></div>
                        </div>

                        <!-- Tombol aksi dipindahkan ke bawah card -->
                        <div class="flex justify-end gap-2 mt-3">
                            <button onclick='showDetail(<?= json_encode(
                            	$row,
                            ) ?>)'
                                class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-blue-500 hover:bg-blue-600 text-white shadow"
                                title="Detail">🔍</button>
                            <button type="button" onclick="showJawaban('<?= $row->id_hasil ?>')"
                                class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-indigo-500 hover:bg-indigo-600 text-white shadow"
                                title="Jawaban">📄</button>
                            <?php
                            $role = $this->session->userdata("role");
                            if (
                            	$role === "admin" ||
                            	($role === "kanwil" && $row->level !== "Merah")
                            ): ?>
                                <a href="<?= site_url(
                                	"histori/delete/" . $row->id_hasil,
                                ) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="cursor-pointer w-9 h-9 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 text-white shadow"
                                    title="Hapus">🗑️</a>
                            <?php endif;
                            ?>
                        </div>
                    </div>
                <?php endforeach;
            else:
            	 ?>
                <div class="p-4 text-center text-gray-500 italic">Belum ada data teroris</div>
            <?php
            endif; ?>
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

        let initialLoad = true; // flag load pertama

        // ===== Ambil filter dari URL hash =====
        function getFiltersFromURL() {
            const params = new URLSearchParams(location.hash.slice(1)); // hash setelah #
            const filters = {};

            for (const [key, value] of params.entries()) {
                filters[key.toLowerCase()] = value;
            }

            return {
                tipe: filters.tipe || "all",
                level: filters.level || "all",
                upt: filters.upt || "all",
                kanwil: filters.kanwil || "all"
            };
        }

        function applyFilters() {
            const tipe = document.getElementById("filter-tipe")?.value || "all";
            const level = document.getElementById("filter-level")?.value || "all";
            const upt = document.getElementById("filter-upt")?.value || "all";
            const kanwil = document.getElementById("filter-kanwil")?.value || "all";

            // ===== Update hash hanya jika bukan load pertama =====
            if (!initialLoad) {
                const params = new URLSearchParams();
                if (tipe !== "all") params.set("tipe", tipe);
                if (level !== "all") params.set("level", level);
                if (upt !== "all") params.set("upt", upt);
                if (kanwil !== "all") params.set("kanwil", kanwil);

                // Hash-based URL: tidak membuat 404
                window.location.hash = params.toString();
            }

            const tables = ["narkotika", "teroris"];

            tables.forEach(tableId => {
                // ===== Desktop rows =====
                document.querySelectorAll(`#table-${tableId} tbody tr`).forEach(row => {
                    const rowTipe = (row.querySelector("td:nth-child(8)")?.textContent.trim() || "").toLowerCase();
                    const rowLevel = (row.querySelector("td:nth-child(7)")?.textContent.trim() || "").toLowerCase();
                    const rowUpt = (row.querySelector("td:nth-child(3)")?.textContent.trim() || "").toLowerCase();
                    const rowKanwil = (row.querySelector("td:nth-child(2)")?.textContent.trim() || "").toLowerCase();

                    row.style.display =
                        (tipe === "all" || rowTipe === tipe.toLowerCase()) &&
                        (level === "all" || rowLevel === level.toLowerCase()) &&
                        (upt === "all" || rowUpt === upt.toLowerCase()) &&
                        (kanwil === "all" || rowKanwil === kanwil.toLowerCase()) ? "table-row" : "none";
                });

                // ===== Mobile cards =====
                document.querySelectorAll(`#table-${tableId} .block.sm\\:hidden > div.p-4`).forEach(card => {
                    const getCardValue = (labelText) => {
                        const labelSpan = Array.from(card.querySelectorAll("span.font-medium"))
                            .find(s => s.textContent.trim() === labelText);
                        if (!labelSpan) return "";
                        let node = labelSpan.nextSibling;
                        while (node) {
                            if (node.nodeType === Node.TEXT_NODE && node.textContent.trim() !== "") return node.textContent.trim();
                            if (node.nodeType === 1) return node.textContent.trim();
                            node = node.nextSibling;
                        }
                        return "";
                    };

                    const cardTipe = getCardValue("Tipe:").toLowerCase();
                    const cardLevel = getCardValue("Level:").toLowerCase();
                    const cardUpt = getCardValue("Nama UPT:").toLowerCase();
                    const cardKanwil = getCardValue("Nama Kanwil:").toLowerCase();

                    card.style.display =
                        (tipe === "all" || cardTipe === tipe.toLowerCase()) &&
                        (level === "all" || cardLevel === level.toLowerCase()) &&
                        (upt === "all" || cardUpt === upt.toLowerCase()) &&
                        (kanwil === "all" || cardKanwil === kanwil.toLowerCase()) ? "block" : "none";
                });
            });
        }

        // ===== Set filter dropdown dari URL hash saat load =====
        function setFiltersFromURL() {
            const filters = getFiltersFromURL();

            Object.keys(filters).forEach(f => {
                const el = document.getElementById(`filter-${f}`);
                if (el) el.value = filters[f];
            });

            applyFilters();
            initialLoad = false; // setelah load pertama, hash boleh diupdate
        }

        window.addEventListener("DOMContentLoaded", () => {
            setFiltersFromURL();

            // ===== Desktop dropdown listener =====
            ["filter-tipe", "filter-level", "filter-upt", "filter-kanwil"].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener("change", applyFilters);
            });

            // ===== Sinkronisasi modal mobile =====
            function syncMobileOptions() {
                ['tipe', 'level', 'upt', 'kanwil'].forEach(f => {
                    const desktop = document.getElementById(`filter-${f}`);
                    const mobile = document.getElementById(`filter-${f}-mobile`);
                    if (desktop && mobile) {
                        mobile.innerHTML = desktop.innerHTML;
                        mobile.value = desktop.value;
                    }
                });
            }

            document.getElementById('open-filter-btn').addEventListener('click', () => {
                syncMobileOptions();
                document.getElementById('filter-modal').classList.remove('hidden');
            });

            document.getElementById('close-filter-btn').addEventListener('click', () => {
                document.getElementById('filter-modal').classList.add('hidden');
            });

            document.getElementById('apply-filter-btn').addEventListener('click', () => {
                ['tipe', 'level', 'upt', 'kanwil'].forEach(f => {
                    const desktop = document.getElementById(`filter-${f}`);
                    const mobile = document.getElementById(`filter-${f}-mobile`);
                    if (desktop && mobile) desktop.value = mobile.value;
                });
                applyFilters();
                document.getElementById('filter-modal').classList.add('hidden');
            });
        });
    </script>
</main>
