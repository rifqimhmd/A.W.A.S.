<main class="w-full min-h-screen p-4">
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
        class="group cursor-pointer bg-white rounded-2xl shadow-sm border border-red-100 p-5 flex flex-col items-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

        <div class="w-10 h-10 flex items-center justify-center bg-rose-100 text-rose-600 rounded-xl mb-3 group-hover:scale-110 transition">
          <i class="ri-alert-line text-xl"></i>
        </div>

        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Zona Merah</h2>

        <p class="text-5xl font-black mt-2 text-rose-600 tracking-tight group-hover:scale-110 transition">
          <?= array_sum(array_column(array_filter($hasil, fn($r) => strtolower($r['warna_antisipasi']) === 'merah'), 'total_hasil')) ?>
        </p>

        <p class="mt-1 text-[11px] text-gray-500">Risiko tinggi</p>
      </div>

      <!-- Zona Kuning -->
      <div onclick="showDetail('kuning')"
        class="group cursor-pointer bg-white rounded-2xl shadow-sm border border-yellow-100 p-5 flex flex-col items-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

        <div class="w-10 h-10 flex items-center justify-center bg-yellow-100 text-yellow-600 rounded-xl mb-3 group-hover:scale-110 transition">
          <i class="ri-error-warning-line text-xl"></i>
        </div>

        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Zona Kuning</h2>

        <p class="text-5xl font-black mt-2 text-yellow-600 tracking-tight group-hover:scale-110 transition">
          <?= array_sum(array_column(array_filter($hasil, fn($r) => strtolower($r['warna_antisipasi']) === 'kuning'), 'total_hasil')) ?>
        </p>

        <p class="mt-1 text-[11px] text-gray-500">Perlu perhatian</p>
      </div>

      <!-- Zona Hijau -->
      <div onclick="showDetail('hijau')"
        class="group cursor-pointer bg-white rounded-2xl shadow-sm border border-green-100 p-5 flex flex-col items-center transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

        <div class="w-10 h-10 flex items-center justify-center bg-green-100 text-green-600 rounded-xl mb-3 group-hover:scale-110 transition">
          <i class="ri-checkbox-circle-line text-xl"></i>
        </div>

        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Zona Hijau</h2>

        <p class="text-5xl font-black mt-2 text-green-600 tracking-tight group-hover:scale-110 transition">
          <?= array_sum(array_column(array_filter($hasil, fn($r) => strtolower($r['warna_antisipasi']) === 'hijau'), 'total_hasil')) ?>
        </p>

        <p class="mt-1 text-[11px] text-gray-500">Aman & Terkendali</p>
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
      <div class="overflow-x-auto bg-white rounded-2xl shadow-md border border-gray-100 mb-8">
        <table class="min-w-full text-sm text-center">
          <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-semibold tracking-wide">
            <tr>
              <th class="py-3 px-4">No</th>
              <th class="py-3 px-4">Kanwil</th>
              <th class="py-3 px-4">Zona Merah</th>
              <th class="py-3 px-4">Zona Kuning</th>
              <th class="py-3 px-4">Zona Hijau</th>
              <th class="py-3 px-4">Total</th>
            </tr>
          </thead>
          <tbody id="bodyNarkotika" class="divide-y divide-gray-100">
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
      <div class="overflow-x-auto bg-white rounded-2xl shadow-md border border-gray-100 mb-8">
        <table class="min-w-full text-sm text-center">
          <thead class="bg-gray-50 text-gray-600 text-xs uppercase font-semibold tracking-wide">
            <tr>
              <th class="py-3 px-4">No</th>
              <th class="py-3 px-4">Kanwil</th>
              <th class="py-3 px-4">Zona Merah</th>
              <th class="py-3 px-4">Zona Kuning</th>
              <th class="py-3 px-4">Zona Hijau</th>
              <th class="py-3 px-4">Total</th>
            </tr>
          </thead>
          <tbody id="bodyTeroris" class="divide-y divide-gray-100">
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
  class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">

  <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl w-11/12 sm:w-2/3 md:w-1/2 p-7 border border-white/40 relative animate-fadeIn">

    <button onclick="closeModal()"
      class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>

    <h2 id="modalTitle" class="text-xl font-semibold mb-4 text-gray-800"></h2>

    <div id="modalContent"
      class="overflow-y-auto max-h-[60vh] px-1 text-gray-700 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
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
    modalTitle.innerText = "Detail Zona " + warna.charAt(0).toUpperCase() + warna.slice(1);

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

  function updateTable(data, tbodyId, instrument) {
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
        <td class="py-2 px-4 font-semibold cursor-pointer" 
            onclick="showDetailKanwil('${r.nama_kanwil}', '${instrument}')">
          <span class="relative inline-block after:content-[''] after:absolute after:left-0 after:-bottom-0.5
                after:h-[2px] after:w-0 after:bg-red-600 after:transition-all after:duration-300
                hover:after:w-full">
            ${r.nama_kanwil}
          </span>
        </td>

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

  function showDetailKanwil(kanwil, instrument) {
    const modal = document.getElementById("modalDetail");
    const modalTitle = document.getElementById("modalTitle");
    const modalContent = document.getElementById("modalContent");

    modal.classList.remove("hidden");
    modalTitle.innerText = `Detail ${instrument} - ${kanwil}`;

    modalContent.innerHTML = `
    <div class="flex justify-center py-10">
      <div class="w-10 h-10 border-4 border-gray-300 border-t-red-500 rounded-full animate-spin"></div>
    </div>`;

    axios.get("<?= base_url('dashboard/getDetailByKanwil') ?>", {
        params: {
          kanwil,
          instrument
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
                <th class="px-3 py-2 border-b text-center">Nama UPT</th>
                <th class="px-3 py-2 border-b text-center">Zona Merah</th>
                <th class="px-3 py-2 border-b text-center">Zona Kuning</th>
                <th class="px-3 py-2 border-b text-center">Zona Hijau</th>
                <th class="px-3 py-2 border-b text-center">Total</th>
              </tr>
            </thead>
            <tbody>`;

        data.forEach((d, i) => {
          html += `<tr class="border-t hover:bg-gray-50">
          <td class="px-3 py-2 text-center">${i + 1}</td>
          <td class="px-3 py-2 text-center">${d.nama_upt ?? '-'}</td>
          <td class="px-3 py-2 text-center text-red-600 font-bold">${d.total_merah}</td>
          <td class="px-3 py-2 text-center text-yellow-500 font-bold">${d.total_kuning}</td>
          <td class="px-3 py-2 text-center text-green-600 font-bold">${d.total_hijau}</td>
          <td class="px-3 py-2 text-center">${d.total_data}</td>
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


  async function refreshData() {
    const dataNarko = await fetchData('<?= base_url("dashboard/getDataNarkotika") ?>');
    const dataTeror = await fetchData('<?= base_url("dashboard/getDataTeroris") ?>');

    updateTable(dataNarko, 'bodyNarkotika', 'Narkotika');
    updateTable(dataTeror, 'bodyTeroris', 'Teroris');

    chartNarkotika = updateChart(dataNarko, chartNarkotika, 'chartNarkotika', 'red');
    chartTeroris = updateChart(dataTeror, chartTeroris, 'chartTeroris', 'blue');
  }

  // Jalankan otomatis
  refreshData();
  setInterval(refreshData, 5000);
</script>

<style>
  /* Animasi fadeIn tetap */
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

  /* ================================
     CARD ZONA — MODERN ELEVATED RED
  ================================= */
  .zona-card {
    backdrop-filter: blur(6px);
    border: 1px solid rgba(239, 68, 68, 0.25);
    /* red-500 */
    background: rgba(255, 255, 255, 0.85);
    transition: all .35s ease;
  }

  .zona-card:hover {
    transform: translateY(-6px) scale(1.04);
    box-shadow: 0 20px 35px rgba(220, 38, 38, 0.28);
    /* red shadow */
    border-color: rgba(239, 68, 68, 0.45);
  }

  /* Icon hover twist */
  .zona-icon {
    transition: transform .3s ease;
    color: #dc2626;
    /* red-600 */
  }

  .zona-icon:hover {
    transform: rotate(14deg) scale(1.1);
  }

  /* ================================
     TABLE MODERN — RED CLEAN
  ================================= */
  table thead {
    letter-spacing: 0.5px;
    background: #dc2626;
    /* red-600 */
    color: white;
  }

  table tbody tr {
    transition: background 0.25s ease;
  }

  table tbody tr:hover {
    background: rgba(220, 38, 38, 0.06);
    /* soft red hover */
  }

  /* Rounded table on scroll */
  .table-wrapper {
    border-radius: 18px;
    overflow: hidden;
    border: 1px solid rgba(220, 38, 38, 0.35);
  }

  /* ================================
     MODAL — RED GLASSMORPHISM
  ================================= */
  #modalDetail>div {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(239, 68, 68, 0.35);
    /* red-500 */
    box-shadow: 0 25px 45px rgba(220, 38, 38, 0.25);
    /* red-600 */
  }

  /* Scrollbar modern */
  .scrollbar-thin::-webkit-scrollbar {
    width: 6px;
  }

  .scrollbar-thin::-webkit-scrollbar-thumb {
    background: #f87171;
    /* red-400 */
    border-radius: 10px;
  }

  /* Header underline animation (red) */
  .section-title {
    position: relative;
    display: inline-block;
  }

  .section-title::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -4px;
    height: 3px;
    width: 0%;
    background: #dc2626;
    /* red-600 */
    border-radius: 2px;
    transition: width 0.3s ease;
  }

  .section-title:hover::after {
    width: 100%;
  }
</style>