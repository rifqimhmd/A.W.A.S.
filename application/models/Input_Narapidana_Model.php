 <?php
defined("BASEPATH") or exit("No direct script access allowed");

class Input_Narapidana_Model extends CI_Model
{
	// Ambil semua instrument
	public function getInstrument()
	{
		return $this->db->get("tbl_instrument")->result();
	}

	// Ambil kategori berdasarkan instrument, unik (group by)
	public function getKategoriByInstrument($id_instrument)
	{
		return $this->db
			->select("jenis_skrining")
			->from("tbl_skrining")
			->where("id_instrument", $id_instrument)
			->group_by("jenis_skrining") // supaya unik
			->get()
			->result();
	}

	// Ambil nama UPT dari id_upt (session)
	public function getNamaUptById($id_upt)
	{
		$this->db->select("nama_upt");
		$this->db->from("tbl_upt");
		$this->db->where("id_upt", $id_upt);
		return $this->db->get()->row();
	}

	// Ambil skrining berdasarkan kategori
	public function getSkriningByKategori($id_kategori)
	{
		return $this->db
			->get_where("tbl_skrining", ["jenis_skrining" => $id_kategori])
			->result();
	}

	// Ambil faktor berdasarkan instrument
	public function getFaktorByInstrument($id_instrument)
	{
		return $this->db
			->get_where("tbl_faktor", ["id_instrument" => $id_instrument])
			->result();
	}

	// Ambil faktor by id
	public function getFaktorById($id_faktor)
	{
		return $this->db
			->get_where("tbl_faktor", ["id_faktor" => $id_faktor])
			->row();
	}

	public function saveHasil($data)
	{
		return $this->db->insert("tbl_hasil", $data);
	}

	public function saveNarapidana($data)
	{
		return $this->db->insert("tbl_narapidana", $data);
	}

	public function saveHasilIndikator($data)
	{
		return $this->db->insert_batch("tbl_hasil_indikator", $data);
	}
}