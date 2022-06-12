<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_m extends CI_Model
{
	protected $mahasiswa = "mahasiswa";
	protected $prodi     = "prodi";
	protected $dosen     = "dosen";
	protected $agama     = "agama";

	function count()
	{
		$this->db->from($this->mahasiswa);
		$query = $this->db->get();
		return $query;
	}

	function get($npm = null)
	{
		$this->db->select('mahasiswa.*, agama.nama as agama_nama, prodi.nama as prodi_nama');
		$this->db->from($this->mahasiswa)
			->join($this->prodi, 'prodi.prodi_id = mahasiswa.prodi_id')
			->join($this->agama, 'agama.agama_id = mahasiswa.agama_id');

		if ($npm != null) {
			$this->db->where('npm', $npm);
		}
		$query = $this->db->get();
		return $query;
	}

	function add($post)
	{
		if (empty($post['foto'])) {
			$params = array(
				'npm'        => $post['npm'],
				'prodi_id'   => $post['prodi_id'],
				'agama_id'   => $post['agama'],
				'username'   => $post['npm'],
				'password'   => sha1(xss($post['password'])),
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'status'     => $post['status'],
				'created'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		} else {
			$params = array(
				'npm'        => $post['npm'],
				'prodi_id'   => $post['prodi_id'],
				'agama_id'   => $post['agama'],
				'username'   => $post['npm'],
				'password'   => sha1(xss($post['password'])),
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'foto'       => $post['foto'],
				'status'     => $post['status'],
				'created'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		}

		$query = $this->db->insert($this->mahasiswa, $params);
		return $query;
	}

	function edit($post, $npm)
	{
		if (empty($post['foto']) && empty($post['password'])) {
			$params = array(
				'prodi_id'   => $post['prodi_id'],
				'agama_id'   => $post['agama'],
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'status'     => $post['status'],
				'updated'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		} elseif (empty($post['password'])) {
			$params = array(
				'prodi_id'   => $post['prodi_id'],
				'agama_id'   => $post['agama'],
				'username'   => $post['npm'],
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'foto'       => $post['foto'],
				'status'     => $post['status'],
				'updated'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		} elseif (empty($post['foto'])) {
			$params = array(
				'prodi_id'   => $post['prodi_id'],
				'agama_id'   => $post['agama'],
				'password'   => sha1(xss($post['password'])),
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'status'     => $post['status'],
				'updated'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		} else {
			$params = array(
				'prodi_id'   => $post['prodi_id'],
				'agama_id'   => $post['agama'],
				'password'   => sha1(xss($post['password'])),
				'nama_lkp'   => xss($post['nama_lkp']),
				'jk'         => $post['jk'],
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'foto'       => $post['foto'],
				'status'     => $post['status'],
				'created'    => date('Y-m-d H:i:s'),
				'posted'     => $this->fu->userLogin()['nip']
			);
		}

		$this->db->where('npm', $npm);
		$query = $this->db->update($this->mahasiswa, $params);
		return $query;
	}

	function delete($npm)
	{
		$this->db->where('npm', $npm)
			->delete($this->mahasiswa);
	}
} /* /.class */
