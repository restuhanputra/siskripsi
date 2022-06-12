<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends CI_Model
{
	protected $admin = "admin";
	protected $agama = "agama";

	function get($nip = null)
	{
		$this->db->select('admin.*, agama.nama as agama_nama');
		$this->db->from($this->admin)
			->join($this->agama, 'agama.agama_id = admin.agama_id');

		if ($nip != null) {
			$this->db->where('nip', $nip);
		}
		$query = $this->db->get();
		return $query;
	}

	function add($post)
	{
		if (empty($post['foto'])) {
			$params = array(
				'nip'        => $post['nip'],
				'agama_id'   => $post['agama'],
				'username'   => $post['nip'],
				'password'   => sha1($post['password']),
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'role'       => $post['role'],
				'status'     => $post['status'],
				'created'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		} else {
			$params = array(
				'nip'        => $post['nip'],
				'agama_id'   => $post['agama'],
				'username'   => $post['nip'],
				'password'   => sha1($post['password']),
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'foto'       => $post['foto'],
				'role'       => $post['role'],
				'status'     => $post['status'],
				'created'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		}

		$query = $this->db->insert($this->admin, $params);
		return $query;
	}

	function edit($post, $nip)
	{
		if (empty($post['foto']) && empty($post['password'])) {
			$params = array(
				'agama_id'   => $post['agama'],
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'role'       => $post['role'],
				'status'     => $post['status'],
				'updated'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		} elseif (empty($post['password'])) {
			$params = array(
				'agama_id'   => $post['agama'],
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'foto'       => $post['foto'],
				'role'       => $post['role'],
				'status'     => $post['status'],
				'updated'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		} elseif (empty($post['foto'])) {
			$params = array(
				'agama_id'   => $post['agama'],
				'password'   => sha1($post['password']),
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'role'       => $post['role'],
				'status'     => $post['status'],
				'updated'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		} else {
			$params = array(
				'agama_id'   => $post['agama'],
				'password'   => sha1($post['password']),
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'foto'       => $post['foto'],
				'role'       => $post['role'],
				'status'     => $post['status'],
				'updated'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		}

		$this->db->where('nip', $nip);
		$query = $this->db->update($this->admin, $params);
		return $query;
	}

	function delete($nip)
	{
		$this->db->where('nip', $nip)
			->delete($this->admin);
	}
} /* /.class */
