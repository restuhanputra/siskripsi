<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdg_proposal_m extends CI_Model
{
	protected $sdg_proposal   = "sdg_proposal";
	protected $jdw_s_proposal = "jdw_sdg_proposal";
	protected $prodi          = "prodi";
	protected $tahun_akademik = "tahun_akademik";
	protected $waktu          = "waktu";
	protected $bimbingan      = "bimbingan";

	function get($npm)
	{
		$this->db->select('sdg_proposal.*, prodi.nama as prodi_nama, tahun_akademik.tahun as tahun, tahun_akademik.semester as semester');

		$this->db->from($this->sdg_proposal)
			->join($this->prodi, 'prodi.prodi_id = sdg_proposal.prodi_id')
			->join($this->tahun_akademik, 'sdg_proposal.tahun_akademik_id = tahun_akademik.tahun_akademik_id');

		$this->db->where('sdg_proposal.npm', $npm)
			->order_by('sdg_proposal_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	function get_id($sdg_proposal_id)
	{
		$this->db->select('sdg_proposal.*, prodi.nama as prodi_nama, tahun_akademik.tahun as tahun, tahun_akademik.semester as semester');

		$this->db->from($this->sdg_proposal)
			->join($this->prodi, 'sdg_proposal.prodi_id = prodi.prodi_id')
			->join($this->tahun_akademik, 'sdg_proposal.tahun_akademik_id = tahun_akademik.tahun_akademik_id');

		$this->db->where('sdg_proposal.sdg_proposal_id', $sdg_proposal_id)
			->order_by('sdg_proposal_id', 'DESC')
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

	function daftar_ulang($sdg_ppsal_id, $post)
	{
		$params = array(
			'daftar_ulang' => $post['daftar_ulang_sdg_proposal'],
			'updated'      => date('Y-m-d H:i:s')
		);

		$this->db->where('sdg_proposal_id', $sdg_ppsal_id);
		$query = $this->db->update($this->sdg_proposal, $params);
	}

	function add($post)
	{
		$params = array(
			'proposal_id'       => $post['proposal_id'],
			'npm'               => $post['npm'],
			'prodi_id'          => $post['prodi_id'],
			'tahun_akademik_id' => $post['thn_akdmk_id'],
			'nama_lkp'          => $post['nama_lkp'],
			'no_telp'           => $post['no_telp'],
			'email'             => $post['email'],
			'judul_proposal'    => xss($post['judul_proposal']),
			'revisi'            => 2,
			'daftar_ulang'      => 3,
			'created'           => date('Y-m-d H:i:s')
		);

		$query = $this->db->insert($this->sdg_proposal, $params);
		return $query;
	}

	function revisi($post, $sdg_ppsal_id)
	{
		$params = array(
			'no_telp'           => $post['no_telp'],
			'email'             => $post['email'],
			'judul_proposal'    => xss($post['judul_proposal']),
			'revisi'            => 2,
			'updated'           => date('Y-m-d H:i:s')
		);

		$this->db->where('sdg_proposal_id', $sdg_ppsal_id);
		$query = $this->db->update($this->sdg_proposal, $params);
	}
} /* /.class */
