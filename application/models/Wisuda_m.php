<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisuda_m extends CI_Model
{
	protected $wisuda         = "wisuda";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";
	protected $bimbingan      = "bimbingan";

	function get($npm)
	{
		$this->db->select('wisuda.*, prodi.nama as prodi_nama, tahun_akademik.tahun as tahun, tahun_akademik.semester as semester');
		$this->db->from($this->wisuda)
			->join($this->prodi, 'prodi.prodi_id = wisuda.prodi_id')
			->join($this->tahun_akademik, 'wisuda.tahun_akademik_id = tahun_akademik.tahun_akademik_id');

		$this->db->where('wisuda.npm', $npm)
			->order_by('wisuda_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	function get_id($wisuda_id)
	{
		$this->db->select('wisuda.*, prodi.nama as prodi_nama, tahun_akademik.tahun as tahun, tahun_akademik.semester as semester');
		$this->db->from($this->wisuda)
			->join($this->prodi, 'prodi.prodi_id = wisuda.prodi_id')
			->join($this->tahun_akademik, 'wisuda.tahun_akademik_id = tahun_akademik.tahun_akademik_id');

		$this->db->where('wisuda.wisuda_id', $wisuda_id)
			->order_by('wisuda_id', 'DESC')
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

	function add($post)
	{
		$params = array(
			'proposal_id'       => $post['proposal_id'],
			'sdg_skripsi_id'    => $post['sdg_skripsi_id'],
			'npm'               => $post['npm'],
			'prodi_id'          => $post['prodi_id'],
			'tahun_akademik_id' => $post['thn_akdmk_id'],
			'nama_lkp'          => $post['nama_lkp'],
			'email'             => $post['email'],
			'nik'               => $post['nik'],
			'sma_smk'           => xss($post['sma_smk']),
			'lulus_sma_smk'     => $post['lulus_sma_smk'],
			'tanggal_lahir'     => $post['tgl_lahir'],
			'alamat_lkp'        => xss($post['alamat']),
			'no_telp'           => $post['no_telp'],
			'nama_ayah'         => xss($post['nama_ayah']),
			'nama_ibu'          => xss($post['nama_ibu']),
			'tanggal_sdg'       => $post['tanggal_sdg'],
			'judul_skripsi_ina' => xss($post['judul_skripsi_ina']),
			'judul_skripsi_eng' => xss($post['judul_skripsi_eng']),
			'revisi'            => 2,
			'created'           => date('Y-m-d H:i:s')
		);

		$query = $this->db->insert($this->wisuda, $params);
		return $query;
	}

	function revisi($post, $wisuda_id)
	{
		$params = array(
			'email'             => $post['email'],
			'nik'               => $post['nik'],
			'sma_smk'           => xss($post['sma_smk']),
			'lulus_sma_smk'     => $post['lulus_sma_smk'],
			'tanggal_lahir'     => $post['tgl_lahir'],
			'alamat_lkp'        => xss($post['alamat']),
			'no_telp'           => $post['no_telp'],
			'nama_ayah'         => xss($post['nama_ayah']),
			'nama_ibu'          => xss($post['nama_ibu']),
			'tanggal_sdg'       => $post['tanggal_sdg'],
			'judul_skripsi_ina' => xss($post['judul_skripsi_ina']),
			'judul_skripsi_eng' => xss($post['judul_skripsi_eng']),
			'revisi'            => 2,
			'updated'           => date('Y-m-d H:i:s')
		);

		$this->db->where('wisuda_id', $wisuda_id);
		$query = $this->db->update($this->wisuda, $params);
	}
} /* /.class */
