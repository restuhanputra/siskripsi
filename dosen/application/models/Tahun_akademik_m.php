<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun_akademik_m extends CI_Model
{
	protected $tahun_akademik = "tahun_akademik";

	function get()
	{
		$this->db->from($this->tahun_akademik);
		$this->db->order_by('tahun_akademik_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	function now()
	{
		$this->db->from($this->tahun_akademik)
			->where('aktifkah', 2);

		$query = $this->db->get();
		return $query;
	}
} /* /.class */
