<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agama_m extends CI_Model
{
	protected $agama = "agama";

	function get()
	{
		$this->db->from($this->agama);

		$query = $this->db->get();
		return $query;
	}
} /* /.class */
