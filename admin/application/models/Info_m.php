<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Info_m extends CI_Model
{
	protected $info = "info";

	function get($info_id = null)
	{
		$this->db->from($this->info);

		if ($info_id != null) {
			$this->db->where('info_id', $info_id);
		}
		$this->db->order_by('info_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	function add($post)
	{
		$params = array(
			'judul'   => xss($post['judul']),
			'content' => strip_tags($post['content']),
			'created' => date('Y-m-d H:i:s'),
			'posted'  => $this->fu->userLogin()['nip']
		);

		$query = $this->db->insert($this->info, $params);
		return $query;
	}

	function edit($post, $id_info)
	{
		$params = array(
			'judul'   => xss($post['judul']),
			'content' => strip_tags($post['content']),
			'updated' => date('Y-m-d H:i:s'),
			'posted'  => $this->fu->userLogin()['nip']
		);

		$this->db->where('info_id', $id_info);
		$query = $this->db->update($this->info, $params);
		return $query;
	}

	function delete($info_id)
	{
		$this->db->where('info_id', $info_id)
			->delete($this->info);
	}
} /* /.class */
