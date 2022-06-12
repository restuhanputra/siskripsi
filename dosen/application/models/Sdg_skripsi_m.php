<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdg_skripsi_m extends CI_Model
{

	protected $sdg_skripsi    = "sdg_skripsi";
	protected $mahasiswa      = "mahasiswa";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";
	protected $waktu          = "waktu";

	/* untuk mengambil semuad data / data per tahun akademik  */
	function get($tahun_akademik_id = null)
	{
		$this->db->select('sdg_skripsi.*, semester as semester, tahun as tahun');
		$this->db->from($this->sdg_skripsi)
			->join($this->mahasiswa, 'mahasiswa.npm = sdg_skripsi.npm')
			->join($this->prodi, 'prodi.prodi_id = sdg_skripsi.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = sdg_skripsi.tahun_akademik_id');

		if ($tahun_akademik_id != null) {
			$this->db->where('sdg_skripsi.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();

		return $query;
	}

	/* untuk mengambil data per id pada jadwal edit */
	function get_id($sdg_skripsi_id = null)
	{
		$this->db->select('sdg_skripsi.*, semester as semester, tahun as tahun');
		$this->db->from($this->sdg_skripsi)
			->join($this->mahasiswa, 'mahasiswa.npm = sdg_skripsi.npm')
			->join($this->prodi, 'prodi.prodi_id = sdg_skripsi.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = sdg_skripsi.tahun_akademik_id');

		if ($sdg_skripsi_id != null) {
			$this->db->where('sdg_skripsi.sdg_skripsi_id', $sdg_skripsi_id);
		}

		$query = $this->db->get();

		return $query;
	}

	/*untuk mengupdate data sidang skripsi oleh KA.Prodi */
	function edit($post, $sdg_skripsi_id)
	{
		$params = array(
			'dpj_satu'    => $post['dpj_satu'],
			'dpj_dua'     => $post['dpj_dua'],
			'dpj_tiga'    => $post['dpj_tiga'],
			'updated'     => date('Y-m-d H:i:s'),
			'posted'      => $this->fu->userLogin()['nidn']
		);

		$this->db->where('sdg_skripsi_id', $sdg_skripsi_id);
		$query = $this->db->update($this->sdg_skripsi, $params);
		return $query;
	}
} /* /.class */
