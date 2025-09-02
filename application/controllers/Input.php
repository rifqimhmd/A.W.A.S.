<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Input
 *
 * @property InputModel    $InputModel
 * @property CI_Input      $input
 * @property CI_Session    $session
 * @property CI_Pagination $pagination
 * @property CI_Loader     $load
 * @property CI_DB_query_builder $db
 */
class Input extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('InputModel');
    }

    public function index()
    {
        $id_upt = $this->session->userdata('id_upt');
        $upt = null;

        if ($id_upt) {
            $upt = $this->InputModel->getNamaUptById($id_upt);
        }

        $data['instrument'] = $this->InputModel->getInstrument();
        $data['nama_upt']   = $upt ? $upt->nama_upt : '-';
        $data['page']       = 'front/pages/datakerawanan/input';
        $this->load->view('front/layouts/main', $data);
    }



    public function getKategori()
    {
        $id_instrument = $this->input->post('id_instrument');
        $kategori = $this->InputModel->getKategoriByInstrument($id_instrument);
        echo json_encode($kategori);
    }

    public function getSkrining()
    {
        $id_kategori = $this->input->post('id_kategori');
        $skrining = $this->InputModel->getSkriningByKategori($id_kategori);
        echo json_encode($skrining);
    }

    public function getFaktor()
    {
        $id_instrument = $this->input->post('id_instrument');
        $faktor = $this->InputModel->getFaktorByInstrument($id_instrument);
        echo json_encode($faktor);
    }

    public function save()
    {
        $nama_wbp     = $this->input->post('nama_wbp');
        $jawaban      = $this->input->post('jawaban'); // skrining
        $faktor       = $this->input->post('faktor');  // bahaya + kerentanan
        $id_user      = $this->session->userdata('id_user');
        $id_instrumen = $this->input->post('instrument');
        $id_kategori  = $this->input->post('kategori');

        // --- Hitung Skrining ---
        $totalSkrining = $yaSkrining = 0;
        if ($jawaban) {
            foreach ($jawaban as $id_skrining => $value) {
                $totalSkrining++;
                if ($value == 1) $yaSkrining++;
            }
        }
        $persenSkrining = $totalSkrining > 0 ? round(($yaSkrining / $totalSkrining) * 100, 2) : 0;

        // --- Hitung Faktor (Bahaya & Kerentanan) ---
        $totalBahaya = $yaBahaya = 0;
        $totalKerentanan = $yaKerentanan = 0;

        if ($faktor) {
            foreach ($faktor as $id_faktor => $value) {
                $row = $this->InputModel->getFaktorById($id_faktor);

                if ($row) {
                    if ($row->jenis_faktor === 'Bahaya') {
                        $totalBahaya++;
                        if ($value == 1) $yaBahaya++;
                    } elseif ($row->jenis_faktor === 'Kerentanan') {
                        $totalKerentanan++;
                        if ($value == 1) $yaKerentanan++;
                    }
                }
            }
        }

        $persenBahaya     = $totalBahaya > 0 ? round(($yaBahaya / $totalBahaya) * 100, 2) : 0;
        $persenKerentanan = $totalKerentanan > 0 ? round(($yaKerentanan / $totalKerentanan) * 100, 2) : 0;

        // --- Nilai akhir (rata-rata dari 3 aspek)
        $nilaiAkhir = round(($persenSkrining + $persenBahaya + $persenKerentanan) / 3, 2);

        // --- Tentukan id_antisipasi ---
        $id_antisipasi = null;

        if ($id_instrumen == 1) {
            if ($nilaiAkhir >= 71) {
                $id_antisipasi = 1; // Tinggi
            } elseif ($nilaiAkhir >= 41) {
                $id_antisipasi = 2; // Sedang
            } else {
                $id_antisipasi = 3; // Rendah
            }
        } elseif ($id_instrumen == 2) {
            if ($nilaiAkhir >= 71) {
                $id_antisipasi = 4; // Tinggi
            } elseif ($nilaiAkhir >= 41) {
                $id_antisipasi = 5; // Sedang
            } else {
                $id_antisipasi = 6; // Rendah
            }
        }

        // Jika instrumen tidak dikenali → fallback rendah (6)
        if ($id_antisipasi === null) {
            $id_antisipasi = 6;
        }

        // --- Simpan ke tabel hasil (hanya 1 record) ---
        $dataHasil = [
            'nama_wbp'         => $nama_wbp,
            'id_user'          => $id_user,
            'id_antisipasi'    => $id_antisipasi,
            'nilai_akhir'      => $nilaiAkhir,
            'nilai_skrining'   => $persenSkrining,
            'nilai_bahaya'     => $persenBahaya,
            'nilai_kerentanan' => $persenKerentanan,
            'id_kategori'      => $id_kategori,
            'created_at'      => date('Y-m-d H:i:s'),
        ];
        $this->InputModel->saveHasil($dataHasil);

        // --- Notif sukses ---
        $this->session->set_flashdata('success', "
        📊 Skrining: {$persenSkrining}% 
        🚨 Bahaya: {$persenBahaya}% 
        ⚠️ Kerentanan: {$persenKerentanan}% 
        🏁 Nilai Akhir: {$nilaiAkhir}% 
        berhasil disimpan!
    ");

        redirect('histori');
    }
}
