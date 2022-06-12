<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bimbingan_m extends CI_Model
{
	protected $bimbingan = "bimbingan";
	protected $mahasiswa = "mahasiswa";
	protected $proposal  = "proposal";

	function get_id($proposal_id)
	{
		$this->db->select('bimbingan.*, mahasiswa.nama_lkp as nama_lkp, mahasiswa.foto as foto, proposal.proposal_id as proposal_id,  proposal.proposal as proposal');
		$this->db->from($this->bimbingan)
			->join($this->mahasiswa, 'bimbingan.npm = mahasiswa.npm')
			->join($this->proposal, 'bimbingan.proposal_id = proposal.proposal_id');

		if ($proposal_id != null) {
			$this->db->where('bimbingan.status', 1)
				->where('bimbingan.proposal_id', $proposal_id);
		}

		$query = $this->db->get();
		return $query;
	}
} /* /.class */
