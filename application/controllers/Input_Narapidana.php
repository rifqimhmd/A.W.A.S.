 <?php
defined("BASEPATH") or exit("No direct script access allowed");

/**
 * Class Input_Pegawai
 *
 * @property Input_Narapidana_Model $Input_Narapidana_Model
 * @property CI_Input            $input
 * @property CI_Session          $session
 */
class Input_Narapidana extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Input_Narapidana_Model");
		if (!$this->session->userdata("logged_in")) {
			redirect("login"); // jika belum login
		}
	}

	public function index()
	{
		$id_upt = $this->session->userdata("id_upt");
		$role = $this->session->userdata("role");
		$upt = null;

		if ($id_upt) {
			$upt = $this->Input_Narapidana_Model->getNamaUptById($id_upt);
		}

		if ($role != "upt") {
			redirect("/");
		}

		$data["instrument"] = $this->Input_Narapidana_Model->getInstrument();
		$data["page"] = "front/pages/datakerawanan/input_narapidana";
		$data["nama_upt"] = $upt ? $upt->nama_upt : "-";
		$this->load->view("front/layouts/main", $data);
	}

	// Ajax get kategori
	public function getKategori()
	{
		$id_instrument = $this->input->post("id_instrument");
		$kategori = $this->Input_Narapidana_Model->getKategoriByInstrument(
			$id_instrument,
		);
		echo json_encode($kategori);
	}

	public function getSkrining()
	{
		$id_kategori = $this->input->post("id_kategori");
		$skrining = $this->Input_Narapidana_Model->getSkriningByKategori(
			$id_kategori,
		);
		echo json_encode($skrining);
	}

	public function getFaktor()
	{
		$id_instrument = $this->input->post("id_instrument");
		$faktor = $this->Input_Narapidana_Model->getFaktorByInstrument(
			$id_instrument,
		);
		echo json_encode($faktor);
	}

	public function save()
	{
		$no_register = $this->input->post("no_register");
		$nama_narapidana = $this->input->post("nama_narapidana");
		$perkara = $this->input->post("perkara");
		$lama_pidana = $this->input->post("lama_pidana");
		$alamat = $this->input->post("alamat");
		$nama_upt = $this->input->post("nama_upt");
		$kategori = $this->input->post("kategori");
		$jawaban = $this->input->post("jawaban"); // skrining
		$faktor = $this->input->post("faktor"); // faktor
		$id_instrument = $this->input->post("id_instrument");
		$id_hasil = $this->uuid_v4();

		// --- Hitung Skrining ---
		$totalSkrining = $yaSkrining = 0;
		if ($jawaban) {
			foreach ($jawaban as $id_skrining => $value) {
				$totalSkrining++;
				if ($value == 1) {
					$yaSkrining++;
				}
			}
		}

		$persenSkrining =
			$totalSkrining > 0
				? round(($yaSkrining / $totalSkrining) * 100, 2)
				: 0;

		// --- Hitung Faktor ---
		$totalBahaya = $yaBahaya = 0;
		$totalKerentanan = $yaKerentanan = 0;

		if ($faktor) {
			foreach ($faktor as $id_faktor => $value) {
				$row = $this->Input_Narapidana_Model->getFaktorById($id_faktor);

				if ($row) {
					if ($row->jenis_faktor === "Bahaya") {
						$totalBahaya++;
						if ($value == 1) {
							$yaBahaya++;
						}
					} elseif ($row->jenis_faktor === "Kerentanan") {
						$totalKerentanan++;
						if ($value == 1) {
							$yaKerentanan++;
						}
					}
				}
			}
		}

		$persenBahaya =
			$totalBahaya > 0 ? round(($yaBahaya / $totalBahaya) * 100, 2) : 0;
		$persenKerentanan =
			$totalKerentanan > 0
				? round(($yaKerentanan / $totalKerentanan) * 100, 2)
				: 0;

		// --- Nilai akhir ---
		$nilaiAkhir = round(
			($persenSkrining + $persenBahaya + $persenKerentanan) / 3,
			2,
		);

		// --- Tentukan id_antisipasi ---
		$id_antisipasi = null;

		switch ($id_instrument) {
			case 1: // Instrumen 1
				if ($nilaiAkhir >= 71) {
					$id_antisipasi = 1; // Tinggi
				} elseif ($nilaiAkhir >= 41) {
					$id_antisipasi = 2; // Sedang
				} else {
					$id_antisipasi = 3; // Rendah
				}
				break;

			case 2: // Instrumen 2
				if ($nilaiAkhir >= 71) {
					$id_antisipasi = 4; // Tinggi
				} elseif ($nilaiAkhir >= 41) {
					$id_antisipasi = 5; // Sedang
				} else {
					$id_antisipasi = 6; // Rendah
				}
				break;

			default:
				// fallback kalau id_instrument tidak dikenal
				$id_antisipasi = 6;
				break;
		}

		// Simpan ke tbl_hasil
		$dataHasil = [
			"id_hasil" => $id_hasil,
			"id_user" => $this->session->userdata("id_user"),
			"id_object" => $no_register,
			"id_antisipasi" => $id_antisipasi,
			"nilai_skrining" => $persenSkrining,
			"nilai_bahaya" => $persenBahaya,
			"nilai_kerentanan" => $persenKerentanan,
			"nilai_akhir" => $nilaiAkhir,
			"created_at" => date("Y-m-d H:i:s"),
		];
		$this->Input_Narapidana_Model->saveHasil($dataHasil);

		// Simpan semua hasil indikator (skrining & faktor)
		$dataHasilIndikator = [];

		if ($jawaban) {
			foreach ($jawaban as $id_skrining => $value) {
				$dataHasilIndikator[] = [
					"id_hasil_indikator" => $this->uuid_v4(),
					"id_hasil" => $id_hasil,
					"id_skrining" => $id_skrining,
					"id_faktor" => null,
					"jawaban" => $value,
				];
			}
		}

		if ($faktor) {
			foreach ($faktor as $id_faktor => $value) {
				$dataHasilIndikator[] = [
					"id_hasil_indikator" => $this->uuid_v4(),
					"id_hasil" => $id_hasil,
					"id_skrining" => null,
					"id_faktor" => $id_faktor,
					"jawaban" => $value,
				];
			}
		}

		if (!empty($dataHasilIndikator)) {
			$this->Input_Narapidana_Model->saveHasilIndikator(
				$dataHasilIndikator,
			);
		}

		// Simpan data pegawai
		$dataNarapidana = [
			"no_register" => $no_register,
			"nama_narapidana" => $nama_narapidana,
			"perkara" => $perkara,
			"lama_pidana" => $lama_pidana,
			"alamat" => $alamat,
			"tempat_penahanan" => $nama_upt,
		];
		$this->Input_Narapidana_Model->saveNarapidana($dataNarapidana);

		// Flash message & redirect
		$this->session->set_flashdata("success", "Data berhasil disimpan.");
		redirect("Input_Pegawai");
	}

	private function uuid_v4()
	{
		$data = random_bytes(16);
		$data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
		$data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
		return vsprintf("%s%s-%s-%s-%s-%s%s%s", str_split(bin2hex($data), 4));
	}
}