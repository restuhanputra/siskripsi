<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdg_skripsi_m extends CI_Model
{
	protected $sdg_skripsi    = "sdg_skripsi";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";
	protected $waktu          = "waktu";
	protected $dosen          = "dosen";
	protected $bimbingan      = "bimbingan";

	function get($npm)
	{
		$this->db->select('sdg_skripsi.*, prodi.nama as prodi_nama, tahun_akademik.tahun as tahun, tahun_akademik.semester as semester');
		$this->db->from($this->sdg_skripsi)
			->join($this->prodi, 'prodi.prodi_id = sdg_skripsi.prodi_id')
			->join($this->tahun_akademik, 'sdg_skripsi.tahun_akademik_id = tahun_akademik.tahun_akademik_id');

		$this->db->where('sdg_skripsi.npm', $npm)
			->order_by('sdg_skripsi_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	function get_id($sdg_skripsi_id)
	{
		$this->db->select('sdg_skripsi.*, prodi.nama as prodi_nama, tahun_akademik.tahun as tahun, tahun_akademik.semester as semester');
		$this->db->from($this->sdg_skripsi)
			->join($this->prodi, 'prodi.prodi_id = sdg_skripsi.prodi_id')
			->join($this->tahun_akademik, 'sdg_skripsi.tahun_akademik_id = tahun_akademik.tahun_akademik_id');

		$this->db->where('sdg_skripsi.sdg_skripsi_id', $sdg_skripsi_id)
			->order_by('sdg_skripsi_id', 'DESC')
			->limit(1);

		$query = $this->db->get();
		return $query;
	}

	function bimbingan($proposal_id)
	{
		$this->db->from($this->bimbingan)
			->where('proposal_id', $proposal_id)
			->limit(1);

		$query = $this->db->get();
		return $query;
	}

	function daftar_ulang($sdg_skripsi_id, $post)
	{
		$params = array(
			'daftar_ulang' => $post['daftar_ulang_sdg_skripsi'],
			'updated'      => date('Y-m-d H:i:s')
		);

		$this->db->where('sdg_skripsi_id', $sdg_skripsi_id);
		$query = $this->db->update($this->sdg_skripsi, $params);
	}


	function add($post)
	{
		$params = array(
			'proposal_id'       => $post['proposal_id'],
			'sdg_proposal_id'   => $post['sdg_proposal_id'],
			'npm'               => $post['npm'],
			'prodi_id'          => $post['prodi_id'],
			'tahun_akademik_id' => $post['thn_akdmk_id'],
			'nama_lkp'          => $post['nama_lkp'],
			'tempat_lahir'      => xss($post['tmpt_lahir']),
			'tgl_lahir'         => $post['tgl_lahir'],
			'nama_ayah'         => xss($post['nama_ayah']),
			'nama_ibu'          => xss($post['nama_ibu']),
			'no_telp'           => $post['no_telp'],
			'email'             => $post['email'],
			'judul_skripsi'     => xss($post['judul_skripsi']),
			'revisi'            => 2,
			'daftar_ulang'      => 3,
			'created'           => date('Y-m-d H:i:s')
		);

		$query = $this->db->insert($this->sdg_skripsi, $params);
		return $query;
	}

	function revisi($post, $sdg_skripsi_id)
	{
		$params = array(
			'tempat_lahir'  => xss($post['tmpt_lahir']),
			'tgl_lahir'     => $post['tgl_lahir'],
			'nama_ayah'     => xss($post['nama_ayah']),
			'nama_ibu'      => xss($post['nama_ibu']),
			'no_telp'       => $post['no_telp'],
			'email'         => $post['email'],
			'judul_skripsi' => xss($post['judul_skripsi']),
			'revisi'        => 2,
			'updated'       => date('Y-m-d H:i:s')
		);

		$this->db->where('sdg_skripsi_id', $sdg_skripsi_id);
		$query = $this->db->update($this->sdg_skripsi, $params);
	}
} /* /.class */
