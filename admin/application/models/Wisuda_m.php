<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisuda_m extends CI_Model
{
	protected $wisuda         = "wisuda";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";
	protected $mahasiswa      = "mahasiswa";
	protected $waktu          = "waktu";
	protected $bimbingan      = "bimbingan";

	function count()
	{
		$this->db->from($this->wisuda);
		$query = $this->db->get();
		return $query;
	}

	function get($tahun_akademik_id = null)
	{
		$this->db->select('wisuda.*, semester as semester, tahun as tahun, prodi.nama as prodi_nama');
		$this->db->from($this->wisuda)
			->join($this->mahasiswa, 'mahasiswa.npm = wisuda.npm')
			->join($this->prodi, 'prodi.prodi_id = wisuda.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = wisuda.tahun_akademik_id');

		if ($tahun_akademik_id != null) {
			$this->db->where('wisuda.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function get_id($wisuda_id = null)
	{
		$this->db->select('wisuda.*, semester as semester, tahun as tahun, prodi.nama as prodi_nama');
		$this->db->from($this->wisuda)
			->join($this->mahasiswa, 'mahasiswa.npm = wisuda.npm')
			->join($this->prodi, 'prodi.prodi_id = wisuda.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = wisuda.tahun_akademik_id');

		if ($wisuda_id != null) {
			$this->db->where('wisuda.wisuda_id', $wisuda_id);
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
		$this->db->select('wisuda.*, semester as semester, tahun as tahun, prodi.nama as prodi_nama, bimbingan.pbb_satu as pbb_satu, bimbingan.pbb_dua as pbb_dua');
		$this->db->from($this->wisuda)
			->join($this->mahasiswa, 'mahasiswa.npm = wisuda.npm')
			->join($this->prodi, 'prodi.prodi_id = wisuda.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = wisuda.tahun_akademik_id')
			->join($this->bimbingan, 'bimbingan.proposal_id = wisuda.proposal_id');

		if ($tahun_akademik_id != null) {
			$this->db->where('wisuda.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function revisi($wisuda_id)
	{
		$params = array(
			'revisi'  => 1,
			'updated' => date('Y-m-d H:i:s'),
			'posted'  => $this->fu->userLogin()['nip']
		);

		$this->db->where('wisuda_id', $wisuda_id);
		$query = $this->db->update($this->wisuda, $params);
		return $query;
	}

	function delete($wisuda_id)
	{
		$this->db->where('wisuda_id', $wisuda_id)
			->delete($this->wisuda);
	}
} /* /.class */
