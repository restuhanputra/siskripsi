<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen_m extends CI_Model
{

	protected $dosen = "dosen";
	protected $agama = "agama";

	function get($prodi_id = null)
	{
		$this->db->select('dosen.*, agama.nama as agama_nama')
			->from($this->dosen)
			->join($this->agama, 'agama.agama_id = dosen.agama_id');

		if ($prodi_id != null) {
			$this->db->where('prodi_id', $prodi_id);
		}

		$query = $this->db->get();
		return $query;
	}

	function kaprodi()
	{
		$this->db->from($this->dosen)
			->where('role', 2);
		$query = $this->db->get();
		return $query;
	}
} /* /.class */
