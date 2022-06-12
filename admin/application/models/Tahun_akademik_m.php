<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun_akademik_m extends CI_Model
{
	protected $tahun_akademik = "tahun_akademik";

	function get($tahun_akademik_id = null)
	{
		$this->db->from($this->tahun_akademik);

		if ($tahun_akademik_id != null) {
			$this->db->where('tahun_akademik_id', $tahun_akademik_id);
		}
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

	function add($post)
	{
		$params = array(
			'tahun'    => xss($post['tahun']),
			'aktifkah' => $post['aktifkah'],
			'semester' => $post['semester'],
			'created'  => date('Y-m-d H:i:s'),
			'posted'   => $this->fu->userLogin()['nip']
		);

		$query = $this->db->insert($this->tahun_akademik, $params);
		return $query;
	}

	function edit($post, $tahun_akademik_id)
	{
		$params = array(
			'tahun'    => xss($post['tahun']),
			'aktifkah' => $post['aktifkah'],
			'semester' => $post['semester'],
			'created'  => date('Y-m-d H:i:s'),
			'posted'   => $this->fu->userLogin()['nip']
		);

		$this->db->where('tahun_akademik_id', $tahun_akademik_id);
		$query = $this->db->update($this->tahun_akademik, $params);
		return $query;
	}

	function delete($tahun_akademik_id)
	{
		$this->db->where('tahun_akademik_id', $tahun_akademik_id)
			->delete($this->tahun_akademik);
	}
} /* /.class */
