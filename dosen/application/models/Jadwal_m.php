<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_m extends CI_Model
{

	protected $mahasiswa      = "mahasiswa";
	protected $sdg_proposal   = "sdg_proposal";
	protected $sdg_skripsi    = "sdg_skripsi";
	protected $tahun_akademik = "tahun_akademik";
	protected $prodi = "prodi";

	function get_sdg_proposal($nidn = null)
	{
		$this->db->select('sdg_proposal.*, semester as semester, tahun as tahun');
		$this->db->from($this->sdg_proposal)
			->join($this->mahasiswa, 'mahasiswa.npm = sdg_proposal.npm')
			->join($this->prodi, 'prodi.prodi_id = sdg_proposal.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = sdg_proposal.tahun_akademik_id');

		if ($nidn != null) {
			$this->db->where('sdg_proposal.status', 0)
				->where('sdg_proposal.dpj_satu', $nidn)
				->or_where('sdg_proposal.dpj_dua', $nidn);
		}

		$query = $this->db->get();
		return $query;
	}

	function get_sdg_skripsi($nidn = null)
	{
		$this->db->select('sdg_skripsi.*, semester as semester, tahun as tahun');
		$this->db->from($this->sdg_skripsi)
			->join($this->mahasiswa, 'mahasiswa.npm = sdg_skripsi.npm')
			->join($this->prodi, 'prodi.prodi_id = sdg_skripsi.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = sdg_skripsi.tahun_akademik_id');

		if ($nidn != null) {
			$this->db->where('sdg_skripsi.status', 0)
				->where('sdg_skripsi.dpj_satu', $nidn)
				->or_where('sdg_skripsi.dpj_dua', $nidn)
				->or_where('sdg_skripsi.dpj_tiga', $nidn);
		}

		$query = $this->db->get();
		return $query;
	}
} /* /.class */
