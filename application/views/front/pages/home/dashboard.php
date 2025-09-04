<main class="w-full p-6 bg-white rounded-2xl shadow-lg space-y-8">

    <?php if (!empty($message)): ?>
        <div class="text-center py-6 text-gray-500 italic"><?= $message ?></div>
    <?php endif; ?>

    <!-- Data Kanwil (Admin) -->
    <?php if (!empty($hasil_kanwil)): ?>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-gray-200 pb-4">
            <h2 class="text-2xl sm:text-3xl font-bold text-red-700">📊 Rekap Hasil Per Kanwil</h2>
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-sm w-full mb-8">
            <table class="w-full border-collapse text-sm sm:text-base">
                <thead class="bg-red-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3 text-center">Peringkat</th>
                        <th class="px-4 py-3 text-center">Nama Kanwil</th>
                        <th class="px-4 py-3 text-center">Merah</th>
                        <th class="px-4 py-3 text-center">Kuning</th>
                        <th class="px-4 py-3 text-center">Hijau</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $no = 1;
                    foreach ($hasil_kanwil as $row): ?>
                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-3 text-gray-800 text-center"><?= $no++ ?></td>
                            <td class="px-4 py-3 text-center font-semibold"><?= $row->peringkat ?></td>
                            <td class="px-4 py-3 text-gray-700 text-center"><?= $row->nama_kanwil ?></td>
                            <td class="px-4 py-3 text-center font-semibold text-red-600"><?= $row->Merah ?></td>
                            <td class="px-4 py-3 text-center font-semibold text-yellow-500"><?= $row->Kuning ?></td>
                            <td class="px-4 py-3 text-center font-semibold text-green-600"><?= $row->Hijau ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- Data UPT (Kanwil) -->
    <?php if (!empty($hasil_upt)): ?>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-gray-200 pb-4">
            <h2 class="text-2xl sm:text-3xl font-bold text-red-700">📊 Rekap Hasil Per UPT</h2>
        </div>

        <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-sm w-full">
            <table class="w-full border-collapse text-sm sm:text-base">
                <thead class="bg-red-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3 text-center">Peringkat</th>
                        <th class="px-4 py-3 text-center">Nama UPT</th>
                        <th class="px-4 py-3 text-center">Merah</th>
                        <th class="px-4 py-3 text-center">Kuning</th>
                        <th class="px-4 py-3 text-center">Hijau</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $no = 1;
                    foreach ($hasil_upt as $row): ?>
                        <tr class="hover:bg-red-50 transition">
                            <td class="px-4 py-3 text-gray-800 text-center"><?= $no++ ?></td>
                            <td class="px-4 py-3 text-center font-semibold"><?= $row->peringkat ?></td>
                            <td class="px-4 py-3 text-gray-700 text-center"><?= $row->nama_upt ?></td>
                            <td class="px-4 py-3 text-center font-semibold text-red-600"><?= $row->Merah ?></td>
                            <td class="px-4 py-3 text-center font-semibold text-yellow-500"><?= $row->Kuning ?></td>
                            <td class="px-4 py-3 text-center font-semibold text-green-600"><?= $row->Hijau ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</main>