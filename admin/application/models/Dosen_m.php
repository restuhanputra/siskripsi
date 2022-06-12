<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dosen_m extends CI_Model
{
	protected $dosen = "dosen";
	protected $prodi = "prodi";
	protected $agama = "agama";

	function count()
	{
		$this->db->from($this->dosen);
		$query = $this->db->get();
		return $query;
	}

	function get($nidn = null)
	{
		$this->db->select('dosen.*, agama.nama as agama_nama, prodi.nama as prodi_nama')
			->from($this->dosen)
			->join($this->prodi, 'prodi.prodi_id = dosen.prodi_id')
			->join($this->agama, 'agama.agama_id = dosen.agama_id');

		if ($nidn != null) {
			$this->db->where('nidn', $nidn);
		}
		$query = $this->db->get();
		return $query;
	}

	function kaprodi()
	{
		$this->db->from($this->dosen)
			->where('role', 2);
		$query = $this->db->get();
		return $query;
	}

	function add($post)
	{
		if (empty($post['foto'])) {
			$params = array(
				'nidn'       => $post['nidn'],
				'prodi_id'   => 1,
				'agama_id'   => $post['agama'],
				'username'   => $post['nidn'],
				'password'   => sha1(xss($post['password'])),
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
				'nidn'       => $post['nidn'],
				'prodi_id'   => 1,
				'agama_id'   => $post['agama'],
				'username'   => $post['nidn'],
				'password'   => sha1(xss($post['password'])),
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

		$query = $this->db->insert($this->dosen, $params);
		return $query;
	}

	function edit($post, $nidn)
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
				'password'   => sha1(xss($post['password'])),
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
				'password'   => sha1(xss($post['password'])),
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

		$this->db->where('nidn', $nidn);
		$query = $this->db->update($this->dosen, $params);
		return $query;
	}

	function delete($nidn)
	{
		$this->db->where('nidn', $nidn)
			->delete($this->dosen);
	}
} /* /.class */
