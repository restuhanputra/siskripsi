<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proposal_m extends CI_Model
{
	protected $proposal       = "proposal";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";
	protected $mahasiswa      = "mahasiswa";
	protected $bimbingan      = "bimbingan";

	function count()
	{
		$this->db->from($this->proposal);
		$query = $this->db->get();
		return $query;
	}

	function get($tahun_akademik_id = null)
	{
		$this->db->select('proposal.*, semester as semester, tahun as tahun, prodi.nama as prodi_nama');
		$this->db->from($this->proposal)
			->join($this->mahasiswa, 'mahasiswa.npm = proposal.npm')
			->join($this->prodi, 'prodi.prodi_id = proposal.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = proposal.tahun_akademik_id');

		if ($tahun_akademik_id != null) {
			$this->db->where('proposal.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function get_id($proposal_id = null)
	{
		$this->db->select('proposal.*, semester as semester, tahun as tahun, prodi.nama as prodi_nama');
		$this->db->from($this->proposal)
			->join($this->mahasiswa, 'mahasiswa.npm = proposal.npm')
			->join($this->prodi, 'prodi.prodi_id = proposal.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = proposal.tahun_akademik_id');

		if ($proposal_id != null) {
			$this->db->where('proposal.proposal_id', $proposal_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function bimbingan($proposal_id)
	{
		$this->db->select('pbb_satu')
			->from($this->bimbingan)
			->where('proposal_id', $proposal_id)
			->limit(1);

		$query = $this->db->get();
		return $query;
	}

	function laporan($tahun_akademik_id = null)
	{
		$this->db->select('proposal.*, semester as semester, tahun as tahun, prodi.nama as prodi_nama, bimbingan.pbb_satu as pbb_satu');
		$this->db->from($this->proposal)
			->join($this->mahasiswa, 'mahasiswa.npm = proposal.npm')
			->join($this->prodi, 'prodi.prodi_id = proposal.prodi_id')
			->join($this->tahun_akademik, 'tahun_akademik.tahun_akademik_id = proposal.tahun_akademik_id')
			->join($this->bimbingan, 'bimbingan.proposal_id = proposal.proposal_id');

		if ($tahun_akademik_id != null) {
			$this->db->where('proposal.tahun_akademik_id', $tahun_akademik_id);
		}

		$query = $this->db->get();

		return $query;
	}

	function edit($post, $proposal_id)
	{
		if (empty($post['proposal'])) {
			$params = array(
				'npm'            => $post['npm'],
				'prodi_id'       => $post['prodi_id'],
				'nama_lkp'       => $post['nama_lkp'],
				'kelas'          => $post['kelas'],
				'no_telp'        => $post['no_telp'],
				'email'          => $post['email'],
				'judul_proposal' => $post['judul_proposal'],
				'updated'        => date('Y-m-d H:i:s'),
				'posted'         => $this->fu->userLogin()['nip']
			);
		} else {
			$params = array(
				'npm'            => $post['npm'],
				'prodi_id'       => $post['prodi_id'],
				'nama_lkp'       => $post['nama_lkp'],
				'kelas'          => $post['kelas'],
				'no_telp'        => $post['no_telp'],
				'email'          => $post['email'],
				'judul_proposal' => $post['judul_proposal'],
				'proposal'       => $post['proposal'],
				'updated'        => date('Y-m-d H:i:s'),
				'posted'         => $this->fu->userLogin()['nip']
			);
		}

		$this->db->where('proposal_id', $proposal_id);
		$query = $this->db->update($this->proposal, $params);
		return $query;
	}

	function revisi($proposal_id)
	{
		$params = array(
			'revisi'  => 1,
			'updated' => date('Y-m-d H:i:s'),
			'posted'  => $this->fu->userLogin()['nip']
		);

		$this->db->where('proposal_id', $proposal_id);
		$query = $this->db->update($this->proposal, $params);
		return $query;
	}

	function delete($proposal_id)
	{
		$this->db->where('proposal_id', $proposal_id)
			->delete($this->proposal);
	}
} /* /.class */
