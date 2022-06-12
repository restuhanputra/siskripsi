<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bimbingan_m extends CI_Model
{

	protected $bimbingan    = "bimbingan";
	protected $mahasiswa    = "mahasiswa";
	protected $proposal     = "proposal";
	protected $sdg_proposal = "sdg_proposal";
	protected $sdg_skripsi  = "sdg_skripsi";

	function get($nidn)
	{
		$this->db->select('bimbingan.*, mahasiswa.nama_lkp as nama_lkp, mahasiswa.foto as foto, proposal.proposal_id as proposal_id,  proposal.proposal as proposal');
		$this->db->from($this->bimbingan)
			->join($this->mahasiswa, 'bimbingan.npm = mahasiswa.npm')
			->join($this->proposal, 'bimbingan.proposal_id = proposal.proposal_id');

		if ($nidn != null) {
			$this->db->group_start()
				->where('bimbingan.pbb_satu', $nidn)
				->or_where('bimbingan.pbb_dua', $nidn)
				->group_end()
				->where('bimbingan.status', 1);
			$this->db->order_by('bimbingan_id', 'DESC');
		}

		$query = $this->db->get();
		return $query;
	}

	function get_id($proposal_id = null)
	{
		$this->db->select('bimbingan.*, mahasiswa.nama_lkp as nama_lkp, proposal.kelas as kelas, proposal.proposal as proposal, proposal.no_telp as no_telp');
		$this->db->from($this->bimbingan)
			->join($this->mahasiswa, 'bimbingan.npm = mahasiswa.npm')
			->join($this->proposal, 'bimbingan.proposal_id = proposal.proposal_id');

		if ($proposal_id != null) {
			$this->db->where('bimbingan.proposal_id', $proposal_id);
		}

		$query = $this->db->get();
		return $query;
	}

	function get_riwayat($nidn)
	{
		$this->db->select('bimbingan.*, mahasiswa.nama_lkp as nama_lkp, mahasiswa.foto as foto, proposal.proposal_id as proposal_id, proposal.kelas as kelas, proposal.no_telp as no_telp');
		$this->db->from($this->bimbingan)
			->join($this->mahasiswa, 'bimbingan.npm = mahasiswa.npm')
			->join($this->proposal, 'bimbingan.proposal_id = proposal.proposal_id');

		if ($nidn != null) {
			$this->db->group_start()
				->where('bimbingan.pbb_satu', $nidn)
				->or_where('bimbingan.pbb_dua', $nidn)
				->group_end()
				->where('bimbingan.status', 2);
			$this->db->order_by('bimbingan_id', 'DESC');
		}

		$query = $this->db->get();
		return $query;
	}

	function get_sdg_proposal($proposal_id)
	{
		$this->db->select('bimbingan.*, sdg_proposal.status as status_sdg_proposal');
		$this->db->from($this->bimbingan)
			->join($this->sdg_proposal, 'bimbingan.proposal_id = sdg_proposal.proposal_id');

		if ($proposal_id != null) {
			$this->db->where('bimbingan.proposal_id', $proposal_id);
		}

		$query = $this->db->get();
		return $query;
	}

	function get_sdg_skripsi($proposal_id)
	{
		$this->db->select('bimbingan.*, sdg_skripsi.status as status_sdg_skripsi');

		$this->db->from($this->bimbingan)
			->join($this->sdg_skripsi, 'bimbingan.proposal_id = sdg_skripsi.proposal_id');

		if ($proposal_id != null) {
			$this->db->where('bimbingan.proposal_id', $proposal_id);
		}

		$query = $this->db->get();
		return $query;
	}

	function selesai($bimbingan_id)
	{
		$params = array(
			'status'  => 2,
			'updated' => date('Y-m-d H:i:s'),
			'posted'  => $this->fu->userLogin()['nidn']
		);

		$this->db->where('bimbingan_id', $bimbingan_id);
		$query = $this->db->update($this->bimbingan, $params);
		return $query;
	}
} /* /.class */
