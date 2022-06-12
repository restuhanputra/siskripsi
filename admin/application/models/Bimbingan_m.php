<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bimbingan_m extends CI_Model
{
	protected $bimbingan      = "bimbingan";
	protected $mahasiswa      = "mahasiswa";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";

	function count()
	{
		$this->db->from($this->bimbingan);
		$query = $this->db->get();
		return $query;
	}

	// donut chart
	function count_bbg($tahun_akademik_id, $status)
	{
		$this->db->from($this->bimbingan);
		$this->db->where('tahun_akademik_id', $tahun_akademik_id)
			->where('status', $status);

		$query = $this->db->get();
		return $query;
	}

	function get($tahun_akademik_id = null)
	{
		$this->db->select('bimbingan.*, semester as semester, tahun as tahun, mahasiswa.nama_lkp as nama_lkp');
		$this->db->from($this->bimbingan)
			->join($this->mahasiswa, 'mahasiswa.npm = bimbingan.npm')
			->join($this->prodi, 'prodi.prodi_id = bimbingan.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = bimbingan.tahun_akademik_id');

		if ($tahun_akademik_id != null) {
			$this->db->where('bimbingan.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function get_id($bimbingan_id = null)
	{
		$this->db->select('bimbingan.*, semester as semester, tahun as tahun, prodi.nama as prodi_nama, mahasiswa.nama_lkp as nama_lkp');
		$this->db->from($this->bimbingan)
			->join($this->mahasiswa, 'mahasiswa.npm = bimbingan.npm')
			->join($this->prodi, 'prodi.prodi_id = bimbingan.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = bimbingan.tahun_akademik_id');

		if ($bimbingan_id != null) {
			$this->db->where('bimbingan.bimbingan_id', $bimbingan_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function delete($bimbingan_id)
	{
		$this->db->where('bimbingan_id', $bimbingan_id)
			->delete($this->bimbingan);
	}
} /* /.class */
