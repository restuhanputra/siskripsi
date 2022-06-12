<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proposal_m extends CI_Model
{
	protected $proposal       = "proposal";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";
	protected $bimbingan      = "bimbingan";

	function get($npm)
	{
		$this->db->select('proposal.*, prodi.nama as prodi_nama, tahun_akademik.tahun as tahun, tahun_akademik.semester as semester');
		$this->db->from($this->proposal)
			->join($this->prodi, 'proposal.prodi_id = prodi.prodi_id')
			->join($this->tahun_akademik, 'proposal.tahun_akademik_id = tahun_akademik.tahun_akademik_id');

		$this->db->where('proposal.npm', $npm)
			->order_by('proposal_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	function get_id($proposal_id)
	{
		$this->db->select('proposal.*, prodi.nama as prodi_nama, tahun_akademik.tahun as tahun, tahun_akademik.semester as semester');
		$this->db->from($this->proposal)
			->join($this->prodi, 'proposal.prodi_id = prodi.prodi_id')
			->join($this->tahun_akademik, 'proposal.tahun_akademik_id = tahun_akademik.tahun_akademik_id');

		$this->db->where('proposal.proposal_id', $proposal_id)
			->order_by('proposal_id', 'DESC')
			->limit(1);

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

	function add($post)
	{
		$params = array(
			'npm'               => $post['npm'],
			'prodi_id'          => $post['prodi_id'],
			'tahun_akademik_id' => $post['thn_akdmk_id'],
			'nama_lkp'          => $post['nama_lkp'],
			'kelas'             => xss($post['kelas']),
			'no_telp'           => $post['no_telp'],
			'email'             => $post['email'],
			'judul_proposal'    => xss($post['judul_proposal']),
			'proposal'          => $post['proposal'],
			'revisi'            => 2,
			'created'           => date('Y-m-d H:i:s')
		);

		$query = $this->db->insert($this->proposal, $params);
		return $query;
	}

	function revisi($post, $proposal_id)
	{
		if (empty($post['proposal'])) {
			$params = array(
				'kelas'             => xss($post['kelas']),
				'no_telp'           => $post['no_telp'],
				'email'             => $post['email'],
				'judul_proposal'    => xss($post['judul_proposal']),
				'revisi'            => 2,
				'updated'           => date('Y-m-d H:i:s')
			);
		} else {
			$params = array(
				'kelas'             => xss($post['kelas']),
				'no_telp'           => $post['no_telp'],
				'email'             => $post['email'],
				'judul_proposal'    => xss($post['judul_proposal']),
				'proposal'          => $post['proposal'],
				'revisi'            => 2,
				'updated'           => date('Y-m-d H:i:s')
			);
		}

		$this->db->where('proposal_id', $proposal_id);
		$query = $this->db->update($this->proposal, $params);
	}
} /* /.class */
