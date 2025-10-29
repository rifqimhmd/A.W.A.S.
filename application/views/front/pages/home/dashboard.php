<main class="w-full min-h-screen p-4">
  <!-- =============================
       RINGKASAN WARNA ANTISIPASI
  ============================== -->
  <section class="mb-10">
    <div class="text-center mb-10">
      <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
        Hasil Skrining Narkotika & Terorisme
      </h1>
      <p class="text-gray-600 mt-2 text-sm">
        Tingkat kewaspadaan berdasarkan hasil asesmen
      </p>
      <div class="mt-2 mx-auto w-24 h-1 bg-gradient-to-r from-red-600 via-yellow-500 to-green-600 rounded-full"></div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
      <!-- Zona Merah -->
      <div onclick="showDetail('merah')"
        class="group cursor-pointer bg-gradient-to-br from-red-600 to-red-700 text-white rounded-xl shadow-md p-4 flex flex-col items-center justify-center hover:scale-105 hover:shadow-lg transition-all duration-300">
        <div
          class="w-9 h-9 flex items-center justify-center bg-white/20 rounded-full mb-2 group-hover:rotate-12 transition-transform duration-300">
          <i class="ri-alert-line text-lg"></i>
        </div>
        <h2 class="text-sm font-semibold uppercase tracking-wide text-white/90">Zona Merah</h2>
        <p class="text-5xl font-black mt-1 tracking-tight drop-shadow-[0_2px_3px_rgba(0,0,0,0.4)] group-hover:scale-110 transition-transform duration-300">
          <?= array_sum(array_column(array_filter($hasil, fn($r) => strtolower($r['warna_antisipasi']) === 'merah'), 'total_hasil')) ?>
        </p>
        <p class="mt-1 text-[11px] text-white/80">Risiko tinggi</p>
      </div>

      <!-- Zona Kuning -->
      <div onclick="showDetail('kuning')"
        class="group cursor-pointer bg-gradient-to-br from-yellow-400 to-yellow-500 text-white rounded-xl shadow-md p-4 flex flex-col items-center justify-center hover:scale-105 hover:shadow-lg transition-all duration-300">
        <div
          class="w-9 h-9 flex items-center justify-center bg-white/20 rounded-full mb-2 group-hover:rotate-12 transition-transform duration-300">
          <i class="ri-error-warning-line text-lg"></i>
        </div>
        <h2 class="text-sm font-semibold uppercase tracking-wide text-white/90">Zona Kuning</h2>
        <p class="text-5xl font-black mt-1 tracking-tight drop-shadow-[0_2px_3px_rgba(0,0,0,0.4)] group-hover:scale-110 transition-transform duration-300">
          <?= array_sum(array_column(array_filter($hasil, fn($r) => strtolower($r['warna_antisipasi']) === 'kuning'), 'total_hasil')) ?>
        </p>
        <p class="mt-1 text-[11px] text-white/80">Perlu diwaspadai</p>
      </div>

      <!-- Zona Hijau -->
      <div onclick="showDetail('hijau')"
        class="group cursor-pointer bg-gradient-to-br from-green-600 to-green-700 text-white rounded-xl shadow-md p-4 flex flex-col items-center justify-center hover:scale-105 hover:shadow-lg transition-all duration-300">
        <div
          class="w-9 h-9 flex items-center justify-center bg-white/20 rounded-full mb-2 group-hover:rotate-12 transition-transform duration-300">
          <i class="ri-checkbox-circle-line text-lg"></i>
        </div>
        <h2 class="text-sm font-semibold uppercase tracking-wide text-white/90">Zona Hijau</h2>
        <p class="text-5xl font-black mt-1 tracking-tight drop-shadow-[0_2px_3px_rgba(0,0,0,0.4)] group-hover:scale-110 transition-transform duration-300">
          <?= array_sum(array_column(array_filter($hasil, fn($r) => strtolower($r['warna_antisipasi']) === 'hijau'), 'total_hasil')) ?>
        </p>
        <p class="mt-1 text-[11px] text-white/80">Aman & terkendali</p>
      </div>
    </div>
  </section>

  <div class="flex flex-col md:flex-row justify-between">
    <!-- =============================
       BAGIAN 1 - NARKOTIKA
  ============================== -->
    <section class="mb-12">
      <h2 class="relative text-2xl font-semibold mb-6 text-red-600 inline-block after:content-[''] after:block after:w-0 after:h-[3px] after:bg-red-600 after:transition-all after:duration-300 hover:after:w-full">
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
            <tr>
              <td colspan="6" class="py-4 text-gray-500">Memuat data...</td>
            </tr>
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
      <h2 class="relative text-2xl font-semibold mb-6 text-red-600 inline-block
           after:content-[''] after:block after:w-0 after:h-[3px]
           after:bg-red-600 after:transition-all after:duration-300
           hover:after:w-full">
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
            <tr>
              <td colspan="6" class="py-4 text-gray-500">Memuat data...</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Chart -->
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <canvas id="chartTeroris" height="120"></canvas>
      </div>
    </section>
  </div>
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

    axios.get("<?= base_url('dashboard/getDetailByWarna') ?>", {
        params: {
          warna
        }
      })
      .then(res => {
        const {
          success,
          data,
          message
        } = res.data;
        if (!success) {
          modalContent.innerHTML = `<p class='text-center text-red-500 py-6'>${message || "Gagal memuat data."}</p>`;
          return;
        }
        if (!data || !data.length) {
          modalContent.innerHTML = "<p class='text-center text-gray-400 py-6'>Tidak ada data.</p>";
          return;
        }

        let html = `<div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-sm text-left">
                  <thead class="bg-gray-100 text-gray-700 font-semibold sticky top-0">
                    <tr>
                      <th class="px-3 py-2 border-b text-center">No</th>
                      <th class="px-3 py-2 border-b text-center">No Register | NIP</th>
                      <th class="px-3 py-2 border-b text-center">Kanwil</th>
                      <th class="px-3 py-2 border-b text-center">UPT</th>
                      <th class="px-3 py-2 border-b text-center">Instrument</th>
                    </tr>
                  </thead>
                  <tbody>`;

        data.forEach((d, i) => {
          html += `<tr class="border-t hover:bg-gray-50">
               <td class="px-3 py-2 text-center">${i + 1}</td>
               <td class="px-3 py-2 text-center">${d.identitas ?? '-'}</td>
               <td class="px-3 py-2 text-center">${d.nama_kanwil ?? '-'}</td>
               <td class="px-3 py-2 text-center">${d.nama_upt ?? '-'}</td>
               <td class="px-3 py-2 text-center">${d.nama_instrument ?? '-'}</td>
             </tr>`;
        });

        html += `</tbody></table></div>`;
        modalContent.innerHTML = html;
      })
      .catch(err => {
        console.error(err);
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
      <tr class="hover:bg-gray-100 transition">
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
        datasets: [{
            label: 'Zona Merah',
            data: merah,
            backgroundColor: 'rgba(239,68,68,0.85)'
          },
          {
            label: 'Zona Kuning',
            data: kuning,
            backgroundColor: 'rgba(234,179,8,0.85)'
          },
          {
            label: 'Zona Hijau',
            data: hijau,
            backgroundColor: 'rgba(34,197,94,0.85)'
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top'
          },
          title: {
            display: true,
            text: 'Distribusi Warna Antisipasi ' + (color === 'red' ? 'Narkotika' : 'Teroris')
          }
        },
        scales: {
          x: {
            stacked: true
          },
          y: {
            stacked: true,
            beginAtZero: true
          }
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
    from {
      opacity: 0;
      transform: scale(0.95);
    }

    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
  }
</style>