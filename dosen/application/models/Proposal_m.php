<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proposal_m extends CI_Model
{
	protected $proposal       = "proposal";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";

	function now()
	{
		$this->db->from($this->tahun_akademik)
			->where('aktifkah', 2);

		$query = $this->db->get();
		return $query;
	}

	function get($npm = null)
	{
		$tahun_aktif       = $this->now()->row_array();
		$tahun_akademik_id = $tahun_aktif['tahun_akademik_id'];

		$this->db->select('proposal.*, prodi.nama as prodi_nama, tahun_akademik.tahun as tahun, tahun_akademik.semester as semester');
		$this->db->from($this->proposal)
			->join($this->prodi, 'prodi.prodi_id = proposal.prodi_id')
			->join($this->tahun_akademik, 'proposal.tahun_akademik_id = tahun_akademik.tahun_akademik_id');

		if ($npm != null) {
			$this->db->where('npm', $npm)
				->where('proposal.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();
		return $query;
	}

	function get_pbb($tahun_akademik_id = null)
	{
		$this->db->select('proposal.*, prodi.nama as prodi_nama, tahun_akademik.tahun as tahun, tahun_akademik.semester as semester');
		$this->db->from($this->proposal)
			->join($this->prodi, 'prodi.prodi_id = proposal.prodi_id')
			->join($this->tahun_akademik, 'proposal.tahun_akademik_id = tahun_akademik.tahun_akademik_id');

		if ($tahun_akademik_id != null) {
			$this->db->where('proposal.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();
		return $query;
	}
} /* /.class */
