<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdg_skripsi_m extends CI_Model
{

	protected $sdg_skripsi    = "sdg_skripsi";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";
	protected $mahasiswa      = "mahasiswa";
	protected $waktu          = "waktu";
	protected $bimbingan      = "bimbingan";

	function count()
	{
		$this->db->from($this->sdg_skripsi);
		$query = $this->db->get();
		return $query;
	}

	// donut chart
	function count_sdg_skripsi($tahun_akademik_id, $status)
	{
		$this->db->from($this->sdg_skripsi);
		$this->db->where('tahun_akademik_id', $tahun_akademik_id)
			->where('status', $status);

		$query = $this->db->get();
		return $query;
	}

	function get($tahun_akademik_id = null)
	{
		$this->db->select('sdg_skripsi.*, semester as semester, tahun as tahun');
		$this->db->from($this->sdg_skripsi)
			->join($this->mahasiswa, 'mahasiswa.npm = sdg_skripsi.npm')
			->join($this->prodi, 'prodi.prodi_id = sdg_skripsi.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = sdg_skripsi.tahun_akademik_id');

		if ($tahun_akademik_id != null) {
			$this->db->where('sdg_skripsi.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function get_id($sdg_skripsi_id = null)
	{
		$this->db->select('sdg_skripsi.*, semester as semester, tahun as tahun, prodi.nama as prodi_nama');
		$this->db->from($this->sdg_skripsi)
			->join($this->mahasiswa, 'mahasiswa.npm = sdg_skripsi.npm')
			->join($this->prodi, 'prodi.prodi_id = sdg_skripsi.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = sdg_skripsi.tahun_akademik_id');

		if ($sdg_skripsi_id != null) {
			$this->db->where('sdg_skripsi.sdg_skripsi_id', $sdg_skripsi_id);
		}

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

	function laporan($tahun_akademik_id = null)
	{
		$this->db->select('sdg_skripsi.*, semester as semester, tahun as tahun, bimbingan.pbb_satu as pbb_satu, bimbingan.pbb_dua as pbb_dua');
		$this->db->from($this->sdg_skripsi)
			->join($this->mahasiswa, 'mahasiswa.npm = sdg_skripsi.npm')
			->join($this->prodi, 'prodi.prodi_id = sdg_skripsi.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = sdg_skripsi.tahun_akademik_id')
			->join($this->bimbingan, 'bimbingan.proposal_id = sdg_skripsi.proposal_id');

		if ($tahun_akademik_id != null) {
			$this->db->where('sdg_skripsi.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function edit($post, $sdg_skripsi_id)
	{
		if ($post['status'] == 1) {
			$daftar_ulang = 1;
		} else {
			$daftar_ulang = 3;
		}

		$params = array(
			'status'       => $post['status'],
			'daftar_ulang' => $daftar_ulang,
			'updated'      => date('Y-m-d H:i:s'),
			'posted'       => $this->fu->userLogin()['nip']
		);

		$this->db->where('sdg_skripsi_id', $sdg_skripsi_id);
		$query = $this->db->update($this->sdg_skripsi, $params);
		return $query;
	}

	function revisi($sdg_skripsi_id)
	{
		$params = array(
			'revisi'  => 1,
			'updated' => date('Y-m-d H:i:s'),
			'posted'  => $this->fu->userLogin()['nip']
		);

		$this->db->where('sdg_skripsi_id', $sdg_skripsi_id);
		$query = $this->db->update($this->sdg_skripsi, $params);
		return $query;
	}

	function delete($sdg_skripsi_id)
	{
		$this->db->where('sdg_skripsi_id', $sdg_skripsi_id)
			->delete($this->sdg_skripsi);
	}
} /* /.class */
