<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembimbing_m extends CI_Model
{

	protected $bimbingan    = "bimbingan";
	protected $mahasiswa    = "mahasiswa";
	protected $dosen        = "dosen";
	protected $proposal     = "proposal";
	protected $sdg_proposal = "sdg_proposal";
	protected $sdg_skripsi  = "sdg_skripsi";

	function get($tahun_akademik_id = null)
	{
		$this->db->select('bimbingan.*, nama_lkp as nama_lkp');
		$this->db->from($this->bimbingan)
			->join($this->mahasiswa, 'bimbingan.npm = mahasiswa.npm');

		if ($tahun_akademik_id != null) {
			$this->db->where('tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();
		return $query;
	}

	function get_id($bimbingan_id = null)
	{
		$this->db->select('bimbingan.*, nama_lkp as nama_lkp');
		$this->db->from($this->bimbingan)
			->join($this->mahasiswa, 'bimbingan.npm = mahasiswa.npm');

		if ($bimbingan_id != null) {
			$this->db->where('bimbingan_id', $bimbingan_id);
		}

		$query = $this->db->get();
		return $query;
	}

	function add($post)
	{
		$params = array(
			'prodi_id'          => $this->fu->userLogin()['prodi_id'],
			'tahun_akademik_id' => $post['thn_akdmk_id'],
			'proposal_id'       => $post['proposal_id'],
			'npm'               => $post['npm'],
			'pbb_satu'          => $post['pbb_satu'],
			'pbb_dua'           => $post['pbb_dua'],
			'judul_proposal'    => $post['judul_proposal'],
			'status'            => 1,
			'created'           => date('Y-m-d H:i:s'),
			'posted'            => $this->fu->userLogin()['nidn']
		);

		$query = $this->db->insert($this->bimbingan, $params);
		return $query;
	}

	function edit($post, $bimbingan_id)
	{
		$params = array(
			'pbb_satu' => $post['pbb_satu'],
			'pbb_dua'  => $post['pbb_dua'],
			'updated'  => date('Y-m-d H:i:s'),
			'posted'   => $this->fu->userLogin()['nidn']
		);

		$this->db->where('bimbingan_id', $bimbingan_id);
		$query = $this->db->update($this->bimbingan, $params);
		return $query;
	}
} /* /.class */
