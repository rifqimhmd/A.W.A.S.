<?php
defined("BASEPATH") or exit("No direct script access allowed");

class HistoriModel extends CI_Model
{
	public function get_histori_by_instrument($instrument, $user)
	{
		$this->db->select("
            h.id_hasil,
            h.nilai_akhir,
            DATE_FORMAT(h.created_at, '%d-%m-%Y') AS created_at,
            a.nama_antisipasi,
            a.warna_antisipasi,
            i.nama_instrument,
            s.jenis_skrining,
            p.nama_pegawai,
            n.nama_narapidana,
            n.perkara,
            n.no_register,
            p.nip,
            COALESCE(u_peg.nama_upt, u_nap.nama_upt) AS nama_upt,
            COALESCE(k_peg.nama_kanwil, k_nap.nama_kanwil) AS nama_kanwil
        ");
		$this->db->from("tbl_hasil h");

		// Hasil indikator -> skrining -> instrument
		$this->db->join(
			"tbl_hasil_indikator hi",
			"hi.id_hasil = h.id_hasil",
			"left",
		);
		$this->db->join(
			"tbl_skrining s",
			"s.id_skrining = hi.id_skrining",
			"left",
		);
		$this->db->join(
			"tbl_instrument i",
			"i.id_instrument = s.id_instrument",
			"left",
		);

		// Antisipasi
		$this->db->join(
			"tbl_antisipasi a",
			"a.id_antisipasi = h.id_antisipasi",
			"left",
		);

		// Relasi pegawai -> UPT -> Kanwil
		$this->db->join("tbl_pegawai p", "p.nip = h.id_object", "left");
		$this->db->join(
			"tbl_upt u_peg",
			"u_peg.id_upt = p.nama_upt OR u_peg.nama_upt = p.nama_upt",
			"left",
		);
		$this->db->join(
			"tbl_kanwil k_peg",
			"k_peg.id_kanwil = u_peg.id_kanwil",
			"left",
		);

		// Relasi narapidana -> UPT -> Kanwil
		$this->db->join(
			"tbl_narapidana n",
			"n.no_register = h.id_object",
			"left",
		);
		$this->db->join(
			"tbl_upt u_nap",
			"u_nap.id_upt = n.tempat_penahanan OR u_nap.nama_upt = n.tempat_penahanan",
			"left",
		);
		$this->db->join(
			"tbl_kanwil k_nap",
			"k_nap.id_kanwil = u_nap.id_kanwil",
			"left",
		);

		// Filter berdasarkan instrument
		$this->db->where("LOWER(i.nama_instrument)", strtolower($instrument));

		// Filter sesuai role user
		if ($user["role"] === "upt") {
			$this->db
				->group_start()
				->where("u_peg.id_upt", $user["id_upt"])
				->or_where("u_nap.id_upt", $user["id_upt"])
				->group_end();
		} elseif ($user["role"] === "kanwil") {
			$this->db
				->group_start()
				->where("k_peg.id_kanwil", $user["id_kanwil"])
				->or_where("k_nap.id_kanwil", $user["id_kanwil"])
				->group_end();
		}
		// Admin → tampilkan semua data

		$this->db->distinct();

		$results = $this->db->get()->result();

		// Tambahkan atribut level, solusi, tipe object
		foreach ($results as $row) {
			$nilai = (int) $row->nilai_akhir;
			if ($nilai >= 71) {
				$row->level = "Merah"; // Tinggi
				$row->solusi =
					"Pembatasan gerak dan pemindahan dengan isolasi.";
			} elseif ($nilai >= 41) {
				$row->level = "Kuning"; // Sedang
				$row->solusi = "Pembatasan gerak atau isolasi.";
			} else {
				$row->level = "Hijau"; // Rendah
				$row->solusi = "Peningkatan kepatuhan, Reward & Punishment.";
			}

			// tipe object
			if (!empty($row->nama_pegawai)) {
				$row->tipe_object = "Pegawai";
				$row->nama_object = $row->nama_pegawai;
			} elseif (!empty($row->nama_narapidana)) {
				$row->tipe_object = "Narapidana";
				$row->nama_object = $row->nama_narapidana;
			} else {
				$row->tipe_object = "Tidak diketahui";
				$row->nama_object = "-";
			}
		}

		return $results;
	}

	public function getJawabanSkrining($id_hasil)
	{
		return $this->db
			->select(
				"s.indikator_skrining,
                  CASE hi.jawaban
                    WHEN '1' THEN 'Ya'
                    WHEN '0' THEN 'Tidak'
                    ELSE hi.jawaban
                  END AS jawaban",
			)
			->from("tbl_hasil_indikator hi")
			->join("tbl_skrining s", "s.id_skrining = hi.id_skrining", "left")
			->where("hi.id_hasil", $id_hasil)
			->where("hi.id_skrining IS NOT NULL", null, false)
			->where("hi.jawaban IS NOT NULL", null, false)
			->get()
			->result();
	}

	public function getJawabanFaktor($id_hasil)
	{
		return $this->db
			->select(
				"f.indikator_faktor, f.jenis_faktor,
                  CASE hi.jawaban
                    WHEN '1' THEN 'Ya'
                    WHEN '0' THEN 'Tidak'
                    ELSE hi.jawaban
                  END AS jawaban",
			)
			->from("tbl_hasil_indikator hi")
			->join("tbl_faktor f", "f.id_faktor = hi.id_faktor", "left")
			->where("hi.id_hasil", $id_hasil)
			->where("hi.id_faktor IS NOT NULL", null, false)
			->where("hi.jawaban IS NOT NULL", null, false)
			->get()
			->result();
	}
	public function getAllUpt($user = null)
	{
		$this->db->select("id_upt, nama_upt, id_kanwil");
		$this->db->from("tbl_upt");
		$this->db->order_by("nama_upt");

		// Jika role = upt → hanya tampilkan upt sesuai id_upt
		if ($user && $user["role"] === "upt") {
			$this->db->where("id_upt", $user["id_upt"]);
		}

		// Jika role = kanwil → hanya tampilkan upt di kanwil tersebut
		if ($user && $user["role"] === "kanwil") {
			$this->db->where("id_kanwil", $user["id_kanwil"]);
		}

		return $this->db->get()->result_array();
	}

	public function getAllKanwil($user = null)
	{
		$this->db->select("id_kanwil, nama_kanwil");
		$this->db->from("tbl_kanwil");
		$this->db->order_by("nama_kanwil");

		if ($user) {
			// Jika role = kanwil → hanya tampilkan kanwil sesuai id_kanwil user
			if ($user["role"] === "kanwil") {
				$this->db->where("id_kanwil", $user["id_kanwil"]);
			}

			// Jika role = upt → hanya tampilkan kanwil sesuai id_kanwil dari upt
			if ($user["role"] === "upt") {
				$this->db->where("id_kanwil", $user["id_kanwil"]);
			}
		}

		return $this->db->get()->result_array();
	}
}
