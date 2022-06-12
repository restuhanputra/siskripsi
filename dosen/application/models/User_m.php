<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
	protected $dosen = "dosen";
	protected $prodi = "prodi";
	protected $dpa   = "dpa";
	protected $agama = "agama";

	function login($username, $password)
	{
		$query = $this->db->get_where(
			$this->dosen,
			array(
				'username' => $username,
				'password' => sha1($password)
			)
		);
		return $query->row_array();
	}

	function get($nidn = null)
	{
		$this->db->select('dosen.*, agama.nama as agama_nama, prodi.nama as prodi_nama');
		$this->db->from($this->dosen)
			->join($this->prodi, 'prodi.prodi_id = dosen.prodi_id')
			->join($this->agama, 'agama.agama_id = dosen.agama_id');

		if ($nidn != null) {
			$this->db->where('nidn', $nidn);
		}
		$query = $this->db->get();
		return $query;
	}

	function edit($post, $nidn)
	{
		if (empty($post['foto']) && empty($post['password'])) {
			$params = array(
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
			);
		} elseif (empty($post['password'])) {
			$params = array(
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'foto'       => $post['foto']
			);
		} elseif (empty($post['foto'])) {
			$params = array(
				'password'   => sha1(xss($post['password'])),
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
			);
		} else {
			$params = array(
				'password'   => sha1(xss($post['password'])),
				'alamat_lkp' => xss($post['alamat_lkp']),
				'no_telp'    => $post['no_telp'],
				'email'      => $post['email'],
				'foto'       => $post['foto']
			);
		}

		$this->db->where('nidn', $nidn);
		$query = $this->db->update($this->dosen, $params);
	}

	function resetpass($pass, $nidn)
	{
		$params = array(
			'password' => sha1($pass),
			'updated'  => date('Y-m-d H:i:s')
		);

		$this->db->where('nidn', $nidn);
		$query = $this->db->update($this->dosen, $params);
	}
} /* /.class */
