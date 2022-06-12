<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen_m extends CI_Model
{
	protected $dosen = "dosen";

	function get($prodi_id = null)
	{
		$this->db->from($this->dosen);

		if ($prodi_id != null) {
			$this->db->where('prodi_id', $prodi_id);
		}

		$query = $this->db->get();
		return $query;
	}
} /* /.class */
