<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi_m extends CI_Model
{
	protected $prodi = "prodi";

	function get($prodi_id = null)
	{
		$this->db->from($this->prodi);

		if ($prodi_id != null) {
			$this->db->where('prodi_id', $prodi_id);
		}
		$this->db->order_by('prodi_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	function add($post)
	{
		$params = array(
			'nama'    => xss($post['nama_prodi']),
			'created' => date('Y-m-d H:i:s'),
			'posted'  => $this->fu->userLogin()['nip']
		);

		$query = $this->db->insert($this->prodi, $params);
		return $query;
	}

	function edit($post, $prodi_id)
	{
		$params = array(
			'nama'    => xss($post['nama_prodi']),
			'updated' => date('Y-m-d H:i:s'),
			'posted'  => $this->fu->userLogin()['nip']
		);

		$this->db->where('prodi_id', $prodi_id);
		$query = $this->db->update($this->prodi, $params);
		return $query;
	}

	function delete($prodi_id)
	{
		$this->db->where('prodi_id', $prodi_id)
			->delete($this->prodi);
	}
} /* /.class */
