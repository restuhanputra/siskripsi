<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdg_proposal_m extends CI_Model
{

	protected $sdg_proposal   = "sdg_proposal";
	protected $mahasiswa      = "mahasiswa";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";
	protected $waktu          = "waktu";

	/* untuk mengambil semuad data / data per tahun akademik  */
	function get($tahun_akademik_id = null)
	{
		$this->db->select('sdg_proposal.*, semester as semester, tahun as tahun');
		$this->db->from($this->sdg_proposal)
			->join($this->mahasiswa, 'mahasiswa.npm = sdg_proposal.npm')
			->join($this->prodi, 'prodi.prodi_id = sdg_proposal.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = sdg_proposal.tahun_akademik_id');

		if ($tahun_akademik_id != null) {
			$this->db->where('sdg_proposal.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();

		return $query;
	}

	/* untuk mengambil data per id pada jadwal edit */
	function get_id($sdg_proposal_id = null)
	{
		$this->db->select('sdg_proposal.*, semester as semester, tahun as tahun');
		$this->db->from($this->sdg_proposal)
			->join($this->mahasiswa, 'mahasiswa.npm = sdg_proposal.npm')
			->join($this->prodi, 'prodi.prodi_id = sdg_proposal.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = sdg_proposal.tahun_akademik_id');

		if ($sdg_proposal_id != null) {
			$this->db->where('sdg_proposal.sdg_proposal_id', $sdg_proposal_id);
		}

		$query = $this->db->get();

		return $query;
	}

	/*untuk mengupdate data sidang proposal oleh KA.Prodi */
	function edit($post, $sdg_proposal_id)
	{
		$params = array(
			'dpj_satu'    => $post['dpj_satu'],
			'dpj_dua'     => $post['dpj_dua'],
			'updated'     => date('Y-m-d H:i:s'),
			'posted'      => $this->fu->userLogin()['nidn']
		);

		$this->db->where('sdg_proposal_id', $sdg_proposal_id);
		$query = $this->db->update($this->sdg_proposal, $params);
		return $query;
	}
} /* /.class */
