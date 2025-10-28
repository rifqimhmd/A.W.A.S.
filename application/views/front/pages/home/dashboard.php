<main class="w-full min-h-screen bg-gray-50 p-8">
  <!-- =============================
       RINGKASAN WARNA ANTISIPASI
  ============================== -->
  <section class="mb-10">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
      <!-- Kotak Merah -->
      <div onclick="showDetail('merah')"
        class="cursor-pointer bg-red-600 text-white rounded-2xl shadow-md p-6 flex flex-col items-center justify-center hover:scale-105 transition-all duration-300">
        <h2 class="text-lg font-semibold tracking-wide">Zona Merah</h2>
        <p class="text-4xl font-extrabold mt-2">
          <?= array_sum(array_column(array_filter($hasil, fn($r) => strtolower($r['warna_antisipasi']) === 'merah'), 'total_hasil')) ?>
        </p>
      </div>

      <!-- Kotak Kuning -->
      <div onclick="showDetail('kuning')"
        class="cursor-pointer bg-yellow-500 text-white rounded-2xl shadow-md p-6 flex flex-col items-center justify-center hover:scale-105 transition-all duration-300">
        <h2 class="text-lg font-semibold tracking-wide">Zona Kuning</h2>
        <p class="text-4xl font-extrabold mt-2">
          <?= array_sum(array_column(array_filter($hasil, fn($r) => strtolower($r['warna_antisipasi']) === 'kuning'), 'total_hasil')) ?>
        </p>
      </div>

      <!-- Kotak Hijau -->
      <div onclick="showDetail('hijau')"
        class="cursor-pointer bg-green-600 text-white rounded-2xl shadow-md p-6 flex flex-col items-center justify-center hover:scale-105 transition-all duration-300">
        <h2 class="text-lg font-semibold tracking-wide">Zona Hijau</h2>
        <p class="text-4xl font-extrabold mt-2">
          <?= array_sum(array_column(array_filter($hasil, fn($r) => strtolower($r['warna_antisipasi']) === 'hijau'), 'total_hasil')) ?>
        </p>
      </div>
    </div>
  </section>

  <!-- =============================
       BAGIAN 1 - NARKOTIKA
  ============================== -->
  <section class="mb-12">
    <h2 class="text-2xl font-semibold mb-6 text-red-600 flex items-center gap-2">
      <span class="w-3 h-3 bg-red-600 rounded-full"></span>
      Instrument: Narkotika
    </h2>

    <!-- Tabel -->
    <div class="overflow-x-auto bg-white rounded-2xl shadow-lg mb-8">
      <table class="min-w-full text-sm text-center">
        <thead class="bg-red-600 text-white text-xs uppercase tracking-wider">
          <tr>
            <th class="py-3 px-4">No</th>
            <th class="py-3 px-4">Kanwil</th>
            <th class="py-3 px-4">Zona Merah</th>
            <th class="py-3 px-4">Zona Kuning</th>
            <th class="py-3 px-4">Zona Hijau</th>
            <th class="py-3 px-4">Total</th>
          </tr>
        </thead>
        <tbody id="bodyNarkotika" class="divide-y divide-gray-200">
          <tr><td colspan="6" class="py-4 text-gray-500">Memuat data...</td></tr>
        </tbody>
      </table>
    </div>

    <!-- Chart -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
      <canvas id="chartNarkotika" height="120"></canvas>
    </div>
  </section>

  <!-- =============================
       BAGIAN 2 - TERORIS
  ============================== -->
  <section>
    <h2 class="text-2xl font-semibold mb-6 text-red-600 flex items-center gap-2">
      <span class="w-3 h-3 bg-red-600 rounded-full"></span>
      Instrument: Teroris
    </h2>

    <!-- Tabel -->
    <div class="overflow-x-auto bg-white rounded-2xl shadow-lg mb-8">
      <table class="min-w-full text-sm text-center">
        <thead class="bg-red-600 text-white text-xs uppercase tracking-wider">
          <tr>
            <th class="py-3 px-4">No</th>
            <th class="py-3 px-4">Kanwil</th>
            <th class="py-3 px-4">Zona Merah</th>
            <th class="py-3 px-4">Zona Kuning</th>
            <th class="py-3 px-4">Zona Hijau</th>
            <th class="py-3 px-4">Total</th>
          </tr>
        </thead>
        <tbody id="bodyTeroris" class="divide-y divide-gray-200">
          <tr><td colspan="6" class="py-4 text-gray-500">Memuat data...</td></tr>
        </tbody>
      </table>
    </div>

    <!-- Chart -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
      <canvas id="chartTeroris" height="120"></canvas>
    </div>
  </section>
</main>

<!-- =============================
         MODAL DETAIL
============================== -->
<div id="modalDetail"
  class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-2xl w-11/12 sm:w-2/3 md:w-1/2 p-6 relative animate-fadeIn">
    <button onclick="closeModal()"
      class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-2xl leading-none">&times;</button>
    <h2 id="modalTitle" class="text-xl font-semibold mb-4 text-gray-800"></h2>
    <div id="modalContent"
      class="overflow-y-auto max-h-[60vh] text-gray-700 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
      <div class="flex justify-center py-10" id="loadingSpinner">
        <div class="w-10 h-10 border-4 border-gray-300 border-t-red-500 rounded-full animate-spin"></div>
      </div>
    </div>
  </div>
</div>

<!-- AXIOS -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* ========================
      MODAL DETAIL
======================== */
function showDetail(warna) {
  const modal = document.getElementById("modalDetail");
  const modalTitle = document.getElementById("modalTitle");
  const modalContent = document.getElementById("modalContent");

  modal.classList.remove("hidden");
  modalTitle.innerText = "Detail Warna: " + warna.charAt(0).toUpperCase() + warna.slice(1);

  modalContent.innerHTML = `
    <div class="flex justify-center py-10">
      <div class="w-10 h-10 border-4 border-gray-300 border-t-red-500 rounded-full animate-spin"></div>
    </div>`;

  axios.get("<?= base_url('dashboard/getDetailByWarna') ?>", { params: { warna } })
    .then(res => {
      const data = res.data;
      if (!data || !data.length) {
        modalContent.innerHTML = "<p class='text-center text-gray-400 py-6'>Tidak ada data.</p>";
        return;
      }

      let html = `<div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full text-sm text-left">
                      <thead class="bg-gray-100 text-gray-700 font-semibold sticky top-0">
                        <tr>
                          <th class="px-3 py-2 border-b">#</th>
                          <th class="px-3 py-2 border-b">Instrument</th>
                          <th class="px-3 py-2 border-b">Antisipasi</th>
                          <th class="px-3 py-2 border-b">Nilai Akhir</th>
                        </tr>
                      </thead>
                      <tbody>`;
      data.forEach((d, i) => {
        html += `<tr class="border-t hover:bg-gray-50">
                   <td class="px-3 py-2">${i + 1}</td>
                   <td class="px-3 py-2">${d.nama_instrument}</td>
                   <td class="px-3 py-2">${d.nama_antisipasi}</td>
                   <td class="px-3 py-2">${d.nilai_akhir}</td>
                 </tr>`;
      });
      html += `</tbody></table></div>`;
      modalContent.innerHTML = html;
    })
    .catch(() => {
      modalContent.innerHTML = "<p class='text-center text-red-500 py-6'>Terjadi kesalahan saat memuat data.</p>";
    });
}

function closeModal() {
  document.getElementById("modalDetail").classList.add("hidden");
}

/* ========================
     CHART DAN TABEL
======================== */
let chartNarkotika, chartTeroris;

async function fetchData(url) {
  const res = await fetch(url);
  return await res.json();
}

function updateTable(data, tbodyId) {
  const tbody = document.getElementById(tbodyId);
  tbody.innerHTML = '';
  if (!data.length) {
    tbody.innerHTML = `<tr><td colspan="6" class="py-4 text-gray-500">Tidak ada data</td></tr>`;
    return;
  }
  data.forEach((r, i) => {
    tbody.insertAdjacentHTML('beforeend', `
      <tr class="border-b hover:bg-gray-100 transition">
        <td class="py-2 px-4">${i + 1}</td>
        <td class="py-2 px-4 font-semibold">${r.nama_kanwil}</td>
        <td class="py-2 px-4 text-red-600 font-bold">${r.total_merah}</td>
        <td class="py-2 px-4 text-yellow-500 font-bold">${r.total_kuning}</td>
        <td class="py-2 px-4 text-green-600 font-bold">${r.total_hijau}</td>
        <td class="py-2 px-4">${r.total_data}</td>
      </tr>
    `);
  });
}

function updateChart(data, chartRef, canvasId, color) {
  const labels = data.map(r => r.nama_kanwil);
  const merah = data.map(r => r.total_merah);
  const kuning = data.map(r => r.total_kuning);
  const hijau = data.map(r => r.total_hijau);

  const ctx = document.getElementById(canvasId).getContext('2d');
  if (chartRef) chartRef.destroy();

  const newChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels,
      datasets: [
        { label: 'Merah', data: merah, backgroundColor: 'rgba(239,68,68,0.85)' },
        { label: 'Kuning', data: kuning, backgroundColor: 'rgba(234,179,8,0.85)' },
        { label: 'Hijau', data: hijau, backgroundColor: 'rgba(34,197,94,0.85)' }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'top' },
        title: {
          display: true,
          text: 'Distribusi Warna Antisipasi ' + (color === 'red' ? 'Narkotika' : 'Teroris')
        }
      },
      scales: {
        x: { stacked: true },
        y: { stacked: true, beginAtZero: true }
      }
    }
  });
  return newChart;
}

async function refreshData() {
  const dataNarko = await fetchData('<?= base_url("dashboard/getDataNarkotika") ?>');
  const dataTeror = await fetchData('<?= base_url("dashboard/getDataTeroris") ?>');

  updateTable(dataNarko, 'bodyNarkotika');
  updateTable(dataTeror, 'bodyTeroris');

  chartNarkotika = updateChart(dataNarko, chartNarkotika, 'chartNarkotika', 'red');
  chartTeroris = updateChart(dataTeror, chartTeroris, 'chartTeroris', 'blue');
}

// Jalankan otomatis
refreshData();
setInterval(refreshData, 5000);
</script>

<style>
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}
.animate-fadeIn { animation: fadeIn 0.3s ease-out; }
</style>
