<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_reg_m extends CI_Model
{

	protected $jdw_proposal     = "jdw_proposal";
	protected $jdw_sdg_proposal = "jdw_sdg_proposal";
	protected $jdw_sdg_skripsi  = "jdw_sdg_skripsi";
	protected $jdw_wisuda       = "jdw_wisuda";

	function get_jdw_proposal()
	{
		$this->db->from($this->jdw_proposal)
			->where('aktifkah', 2);

		$query = $this->db->get();
		return $query;
	}

	function get_jdw_sdg_proposal()
	{
		$this->db->from($this->jdw_sdg_proposal)
			->where('aktifkah', 2);

		$query = $this->db->get();
		return $query;
	}

	function get_jdw_sdg_skripsi()
	{
		$this->db->from($this->jdw_sdg_skripsi)
			->where('aktifkah', 2);

		$query = $this->db->get();
		return $query;
	}

	function get_jdw_wisuda()
	{
		$this->db->from($this->jdw_wisuda)
			->where('aktifkah', 2);

		$query = $this->db->get();
		return $query;
	}
} /* /.class */
