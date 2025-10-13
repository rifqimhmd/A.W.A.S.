 <?php
	defined("BASEPATH") or exit("No direct script access allowed");

	/**
	 * Class Input_Pegawai
	 *
	 * @property Input_Pegawai_Model $Input_Pegawai_Model
	 * @property CI_Input            $input
	 * @property CI_Session          $session
	 * @property CI_DB_query_builder   $db
	 */
	class Input_Pegawai extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model("Input_Pegawai_Model");
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
				$upt = $this->Input_Pegawai_Model->getNamaUptById($id_upt);
			}

			if ($role != "upt") {
				redirect("/");
			}

			$data["instrument"] = $this->Input_Pegawai_Model->getInstrument();
			$data["page"] = "front/pages/datakerawanan/input_pegawai";
			$data["nama_upt"] = $upt ? $upt->nama_upt : "-";
			$data["title"] = "A.W.A.S. - Input Pegawai";
			$this->load->view("front/layouts/main", $data);
		}

		// Ajax get kategori
		public function getKategori()
		{
			$id_instrument = $this->input->post("id_instrument");
			$kategori = $this->Input_Pegawai_Model->getKategoriByInstrument(
				$id_instrument,
			);
			header("Content-Type: application/json");
			echo json_encode($kategori);
		}

		public function getSkrining()
		{
			$id_kategori = $this->input->post("id_kategori");
			$skrining = $this->Input_Pegawai_Model->getSkriningByKategori(
				$id_kategori,
			);
			header("Content-Type: application/json");
			echo json_encode($skrining);
		}

		public function getFaktor()
		{
			$id_instrument = $this->input->post("id_instrument");
			$faktor = $this->Input_Pegawai_Model->getFaktorByInstrument(
				$id_instrument,
			);
			header("Content-Type: application/json");
			echo json_encode($faktor);
		}

		public function save()
		{
			// // Ambil tanggal hari ini (1–31)
			// $today = date("j");

			// // Validasi: hanya boleh input tanggal 25–28
			// if ($today < 25 || $today > 28) {
			// 	$this->session->set_flashdata(
			// 		"error",
			// 		"Input hanya diperbolehkan tanggal 25–28 setiap bulan.",
			// 	);
			// 	redirect("input_pegawai");
			// 	return;
			// }

			$nip = $this->input->post("nip");
			$nama_pegawai = $this->input->post("nama_pegawai");
			$golongan = $this->input->post("golongan");
			$jabatan = $this->input->post("jabatan");
			$nama_upt = $this->input->post("nama_upt");
			$kategori = $this->input->post("kategori");
			$jawaban = $this->input->post("jawaban"); // skrining
			$faktor = $this->input->post("faktor"); // faktor
			$id_instrument = $this->input->post("id_instrument");
			$id_hasil = $this->uuid_v4();
			// ------------------- Hitung skrining & faktor -------------------
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

			$totalBahaya = $yaBahaya = $totalKerentanan = $yaKerentanan = 0;
			if ($faktor) {
				foreach ($faktor as $id_faktor => $value) {
					$row = $this->Input_Pegawai_Model->getFaktorById($id_faktor);
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
			$nilaiAkhir = round(
				($persenSkrining + $persenBahaya + $persenKerentanan) / 3,
				2,
			);

			// ------------------- Mapping id_antisipasi -------------------
			$id_instrument = strtolower(trim($id_instrument));
			$mapping = [
				"e0eba92c-8d48-11f0-808b-54e1ad047dec" => [
					["min" => 71, "max" => 100, "id_antisipasi" => 1],
					["min" => 41, "max" => 70, "id_antisipasi" => 2],
					["min" => 0, "max" => 40, "id_antisipasi" => 3],
				],
				"ed689f05-8d48-11f0-808b-54e1ad047dec" => [
					["min" => 71, "max" => 100, "id_antisipasi" => 4],
					["min" => 41, "max" => 70, "id_antisipasi" => 5],
					["min" => 0, "max" => 40, "id_antisipasi" => 6],
				],
			];

			$id_antisipasi = null;
			if (isset($mapping[$id_instrument])) {
				foreach ($mapping[$id_instrument] as $rule) {
					if (
						$nilaiAkhir >= $rule["min"] &&
						$nilaiAkhir <= $rule["max"]
					) {
						$id_antisipasi = $rule["id_antisipasi"];
						break;
					}
				}
			}

			if (is_null($id_antisipasi)) {
				log_message(
					"error",
					"Antisipasi tidak ditemukan. UUID: {$id_instrument}, Nilai: {$nilaiAkhir}",
				);
			}

			// ------------------- Mulai TRANSAKSI -------------------
			$this->db->trans_begin();

			try {
				// Simpan ke tbl_hasil
				$dataHasil = [
					"id_hasil" => $id_hasil,
					"id_user" => $this->session->userdata("id_user"),
					"id_object" => $nip,
					"id_antisipasi" => $id_antisipasi,
					"nilai_skrining" => $persenSkrining,
					"nilai_bahaya" => $persenBahaya,
					"nilai_kerentanan" => $persenKerentanan,
					"nilai_akhir" => $nilaiAkhir,
					"created_at" => date("Y-m-d H:i:s"),
				];
				$this->Input_Pegawai_Model->saveHasil($dataHasil);

				// Simpan ke tbl_upload
				if ($nilaiAkhir >= 41) {
					$dataUpload = [
						"id_upload" => $this->uuid_v4(),
						"id_hasil" => $id_hasil,
					];
					$this->db->insert("tbl_upload", $dataUpload);
				}

				// Simpan semua hasil indikator
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
					$this->Input_Pegawai_Model->saveHasilIndikator(
						$dataHasilIndikator,
					);
				}

				// Simpan data pegawai
				$dataPegawai = [
					"nip" => $nip,
					"nama_pegawai" => $nama_pegawai,
					"golongan_pangkat" => $golongan,
					"jabatan" => $jabatan,
					"nama_upt" => $nama_upt,
				];

				// --- Cek duplikat NIP sebelum insert ---
				$cekNip = $this->db
					->where("nip", $nip)
					->get("tbl_pegawai") // ganti dengan nama tabel kamu
					->row();

				if ($cekNip) {
					// Batalkan transaksi jika NIP sudah ada
					$this->db->trans_rollback();
					$this->session->set_flashdata(
						"error",
						"NIP <b>{$nip}</b> sudah terdaftar.",
					);
					redirect("input_pegawai");
					return; // stop eksekusi
				}
				$this->Input_Pegawai_Model->savePegawai($dataPegawai);

				// Commit jika semua berhasil
				if ($this->db->trans_status() === false) {
					$this->db->trans_rollback();
					$this->session->set_flashdata(
						"error",
						"Terjadi kesalahan, data gagal disimpan.",
					);
					redirect("input_pegawai");
				} else {
					$this->db->trans_commit();
					$this->session->set_flashdata(
						"success",
						"Data berhasil disimpan.",
					);
					redirect("histori");
				}
			} catch (Exception $e) {
				$this->db->trans_rollback();
				log_message("error", "Transaksi gagal: " . $e->getMessage());
				$this->session->set_flashdata(
					"error",
					"Terjadi kesalahan, data gagal disimpan.",
				);
				redirect("input_pegawai");
			}
		}

		private function uuid_v4()
		{
			$data = random_bytes(16);
			$data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
			$data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
			return vsprintf("%s%s-%s-%s-%s-%s%s%s", str_split(bin2hex($data), 4));
		}
	}
