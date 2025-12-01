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

    <!-- Narkotika -->
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

    <!-- Teroris -->
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
  // Detail Modal
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

  // Chart - Tabel
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

  refreshData();
  setInterval(refreshData, 5000);
</script>

<style>
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(4px);
    }

    to {
      opacity: 1;
      transform: none;
    }
  }

  .animate-fadeIn {
    animation: fadeIn .25s ease-out;
  }

  .zona-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    transition: all .25s ease;
  }

  .zona-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.07);
    border-color: #d1d5db;
  }

  .zona-icon {
    transition: transform .25s ease;
  }

  .zona-card:hover .zona-icon {
    transform: scale(1.08);
  }

  .table-wrapper {
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    overflow: hidden;
    background: #ffffff;
  }

  table thead {
    background: #f9fafb;
    color: #374151;
    font-weight: 600;
    font-size: 0.85rem;
  }

  table tbody tr {
    transition: background .18s ease;
  }

  table tbody tr:hover {
    background: #f3f4f6;
  }

  table th,
  table td {
    padding: .75rem .6rem;
  }

  @media (min-width: 640px) {

    table th,
    table td {
      padding: .85rem .75rem;
    }
  }

  #modalDetail>div {
    background: rgba(255, 255, 255, 0.97);
    backdrop-filter: blur(10px);
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    box-shadow: 0 14px 34px rgba(0, 0, 0, 0.08);
    animation: fadeIn .3s ease-out;
  }

  .scrollbar-thin::-webkit-scrollbar {
    width: 6px;
  }

  .scrollbar-thin::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 10px;
  }

  .section-title {
    position: relative;
    display: inline-block;
  }

  .section-title::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -3px;
    height: 2px;
    width: 0%;
    background: #dc2626;
    transition: width .25s ease;
  }

  .section-title:hover::after {
    width: 100%;
  }
</style>

<style>
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(4px);
    }

    to {
      opacity: 1;
      transform: none;
    }
  }

  .animate-fadeIn {
    animation: fadeIn .25s ease-out;
  }

  body {
    margin-bottom: 50px;
  }

  h2.section-title {
    font-size: 1.7rem;
    font-weight: 700;
    margin-bottom: 28px;
    color: #1f2937;
    text-align: center;
    position: relative;
    display: inline-block;
  }

  h2.section-title::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -3px;
    height: 2px;
    width: 0%;
    background: #dc2626;
    transition: width .25s ease;
  }

  h2.section-title:hover::after {
    width: 100%;
  }

  /* GRID */
  .pustaka-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 26px;
    justify-content: center;
  }

  /* CARD – mengikuti gaya zona-card */
  .pustaka-card {
    width: 220px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 22px 16px;
    cursor: pointer;
    text-align: center;
    transition: all .25s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .pustaka-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.07);
    border-color: #d1d5db;
  }

  /* THUMBNAIL WRAPPER */
  .thumb-box {
    width: 130px;
    height: 130px;
    border-radius: 14px;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e5e7eb;
    transition: transform .25s ease;
    margin-bottom: 16px;
  }

  /* icon ikut membesar saat hover */
  .pustaka-card:hover .thumb-box {
    transform: scale(1.06);
  }

  .pustaka-thumb {
    max-width: 85%;
    max-height: 85%;
    object-fit: contain;
  }

  /* TITLE */
  .pustaka-title {
    font-size: 14.5px;
    font-weight: 600;
    color: #111827;
    line-height: 1.45;
    min-height: 50px;
  }

  @media (max-width: 550px) {
    .pustaka-card {
      width: 180px;
      padding: 18px 12px;
    }

    .thumb-box {
      width: 110px;
      height: 110px;
    }

    .pustaka-title {
      font-size: 13px;
      min-height: 40px;
    }
  }
</style>

<h2 class="section-title">📘 Pustaka SOP & Regulasi</h2>
<div id="pustakaGrid" class="pustaka-grid"></div>

<script>
  const files = [{
      file: "uploads/pustaka/AWAS -  Narkoba - Panduan Penggunaan dan Pengumpulan Data.pdf",
      thumb: "https://i.ibb.co.com/1NBJQGN/panduan.png",
      title: "AWAS Narkoba - Panduan Penggunaan & Pengumpulan Data"
    },
    {
      file: "uploads/pustaka/AWAS -  Terorisme - Panduan Penggunaan dan Pengumpulan Data.pdf",
      thumb: "https://i.ibb.co.com/1NBJQGN/panduan.png",
      title: "AWAS Terorisme - Panduan Penggunaan & Pengumpulan Data"
    },
    {
      file: "uploads/pustaka/SOP Penggunaan Instrumen Deteksi Dini Kerawanan Narkoba di Rutan, LPAS, Lapas, dan LPKA.pdf",
      thumb: "https://i.ibb.co.com/KTsQmFz/sop.png",
      title: "SOP Penggunaan Instrumen Deteksi Dini Kerawanan Narkoba"
    },
    {
      file: "uploads/pustaka/SOP Penggunaan Instrumen Deteksi Dini Kerawanan Terorisme di Rutan, LPAS, Lapas, dan LPKA.pdf",
      thumb: "https://i.ibb.co.com/KTsQmFz/sop.png",
      title: "SOP Penggunaan Instrumen Deteksi Dini Kerawanan Terorisme"
    },
    {
      file: "uploads/pustaka/Kepdirjen Pemasyarakatan Nomor PAS-44.PR.01.03 Tahun 2025 Tentang Standar Pemulihan Gangguan Kamtib Pada Rutan, Lpas, Lapas, Dan Lpka.pdf",
      thumb: "https://i.ibb.co.com/cSpgFNs4/rules.png",
      title: "Kepdirjen PAS 44/2025 Tentang Standar Pemulihan Gangguan Kamtib"
    },
    {
      file: "uploads/pustaka/Kepdirjen Pemasyarakatan Nomor PAS-45.PR.01.03 Tahun 2025 Tentang Standar Penindakan & Penegakan Disiplin Gangguan Kamtib Pada Rutan, Lpas, Lapas, Dan Lpka.pdf",
      thumb: "https://i.ibb.co.com/cSpgFNs4/rules.png",
      title: "Kepdirjen PAS 45/2025 Tentang Standar Penindakan & Penegakan Disiplin Kamtib"
    },
    {
      file: "uploads/pustaka/Kepdirjen Pemasyarakatan Nomor PAS-46.PR.01.03 Tahun 2025 Tentang Standar Pencegahan Gangguan Kamtib Pada Rutan, Lpas, Lapas, Dan Lpka.pdf",
      thumb: "https://i.ibb.co.com/cSpgFNs4/rules.png",
      title: "Kepdirjen PAS 46/2025 Tentang Standar Pencegahan Gangguan Kamtib"
    },
    {
      file: "uploads/pustaka/Permenkumham Nomor 7-Tahun 2023 tentang Intelijen Pemasyarakatan.pdf",
      thumb: "https://i.ibb.co.com/cSpgFNs4/rules.png",
      title: "Permenkumham 7/2023 Tentang Intelijen Pemasyarakatan"
    },
    {
      file: "uploads/pustaka/Permenkumham Nomor 8 Tahun 2024 tentang Penyelenggaraan Keamanan dan Ketertiban pada Satuan Kerja Pemasyarakatan.pdf",
      thumb: "https://i.ibb.co.com/cSpgFNs4/rules.png",
      title: "Permenkumham 8/2024 Tentang Penyelenggaraan Keamanan & Ketertiban"
    },
    {
      file: "uploads/pustaka/UU Nomor 22 Tahun 2022 tentang Pemasyarakatan.pdf",
      thumb: "https://i.ibb.co.com/cSpgFNs4/rules.png",
      title: "UU Nomor 22 Tahun 2022 tentang Pemasyarakatan"
    }
  ];

  function loadPustakaCards() {
    const grid = document.getElementById("pustakaGrid");
    grid.innerHTML = "";
    files.forEach(item => {
      const card = `
        <div class="pustaka-card" onclick="window.open('${item.file}','_blank')">
          <div class="thumb-box">
            <img src="${item.thumb}" class="pustaka-thumb" alt="Cover" />
          </div>
          <div class="pustaka-title">${item.title}</div>
        </div>
      `;
      grid.innerHTML += card;
    });
  }

  loadPustakaCards();
</script>