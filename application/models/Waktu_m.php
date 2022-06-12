<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Waktu_m extends CI_Model
{
	protected $waktu = "waktu";

	function get()
	{
		$this->db->from($this->waktu);

		$query = $this->db->get();
		return $query;
	}
} /* /.class */
