<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Info_m extends CI_Model
{
	protected $info = "info";

	function get()
	{
		$this->db->from($this->info);

		$this->db->order_by('info_id', 'DESC')
			->limit(20);

		$query = $this->db->get();
		return $query;
	}
} /* /.class */
