<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_reg_m extends CI_Model
{
	protected $jdw_proposal     = "jdw_proposal";
	protected $jdw_sdg_proposal = "jdw_sdg_proposal";
	protected $jdw_sdg_skripsi  = "jdw_sdg_skripsi";
	protected $jdw_wisuda       = "jdw_wisuda";

	function get_jdw_proposal($jdw_proposal_id = null)
	{
		$this->db->from($this->jdw_proposal);

		if ($jdw_proposal_id != null) {
			$this->db->where('jdw_proposal_id', $jdw_proposal_id);
		}
		$this->db->order_by('jdw_proposal_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	function get_jdw_sdg_proposal($jdw_sdg_proposal_id = null)
	{
		$this->db->from($this->jdw_sdg_proposal);

		if ($jdw_sdg_proposal_id != null) {
			$this->db->where('jdw_sdg_proposal_id', $jdw_sdg_proposal_id);
		}
		$this->db->order_by('jdw_sdg_proposal_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	function get_jdw_sdg_skripsi($jdw_sdg_skripsi_id = null)
	{
		$this->db->from($this->jdw_sdg_skripsi);

		if ($jdw_sdg_skripsi_id != null) {
			$this->db->where('jdw_sdg_skripsi_id', $jdw_sdg_skripsi_id);
		}
		$this->db->order_by('jdw_sdg_skripsi_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	function get_jdw_wisuda($jdw_wisuda_id = null)
	{
		$this->db->from($this->jdw_wisuda);

		if ($jdw_wisuda_id != null) {
			$this->db->where('jdw_wisuda_id', $jdw_wisuda_id);
		}
		$this->db->order_by('jdw_wisuda_id', 'DESC');

		$query = $this->db->get();
		return $query;
	}

	/* ADD */

	function add_proposal($post)
	{
		$params = array(
			'start_date' => $post['start_date'],
			'hari'       => $post['hari'],
			'aktifkah'   => $post['aktifkah'],
			'created'    => date('Y-m-d H:i:s'),
			'posted'     => $this->fu->userLogin()['nip']
		);

		$query = $this->db->insert($this->jdw_proposal, $params);
		return $query;
	}

	function add_sdg_proposal($post)
	{
		$params = array(
			'start_date' => $post['start_date'],
			'hari'       => $post['hari'],
			'aktifkah'   => $post['aktifkah'],
			'created'    => date('Y-m-d H:i:s'),
			'posted'     => $this->fu->userLogin()['nip']
		);

		$query = $this->db->insert($this->jdw_sdg_proposal, $params);
		return $query;
	}

	function add_sdg_skripsi($post)
	{
		$params = array(
			'start_date' => $post['start_date'],
			'hari'       => $post['hari'],
			'aktifkah'   => $post['aktifkah'],
			'created'    => date('Y-m-d H:i:s'),
			'posted'     => $this->fu->userLogin()['nip']
		);

		$query = $this->db->insert($this->jdw_sdg_skripsi, $params);
		return $query;
	}

	function add_wisuda($post)
	{
		$params = array(
			'start_date' => $post['start_date'],
			'hari'       => $post['hari'],
			'aktifkah'   => $post['aktifkah'],
			'created'    => date('Y-m-d H:i:s'),
			'posted'     => $this->fu->userLogin()['nip']
		);

		$query = $this->db->insert($this->jdw_wisuda, $params);
		return $query;
	}

	/* EDIT */

	function edit_proposal($post, $jdw_proposal_id)
	{
		$params = array(
			'start_date' => $post['start_date'],
			'hari'       => $post['hari'],
			'aktifkah'   => $post['aktifkah'],
			'updated'    => date('Y-m-d H:i:s'),
			'posted'     => $this->fu->userLogin()['nip']
		);

		$this->db->where('jdw_proposal_id', $jdw_proposal_id);
		$query = $this->db->update($this->jdw_proposal, $params);
		return $query;
	}

	function edit_sdg_proposal($post, $jdw_sdg_proposal_id)
	{
		$params = array(
			'start_date' => $post['start_date'],
			'hari'       => $post['hari'],
			'aktifkah'   => $post['aktifkah'],
			'updated'    => date('Y-m-d H:i:s'),
			'posted'     => $this->fu->userLogin()['nip']
		);

		$this->db->where('jdw_sdg_proposal_id', $jdw_sdg_proposal_id);
		$query = $this->db->update($this->jdw_sdg_proposal, $params);
		return $query;
	}

	function edit_sdg_skripsi($post, $jdw_sdg_skripsi_id)
	{
		$params = array(
			'start_date' => $post['start_date'],
			'hari'       => $post['hari'],
			'aktifkah'   => $post['aktifkah'],
			'updated'    => date('Y-m-d H:i:s'),
			'posted'     => $this->fu->userLogin()['nip']
		);

		$this->db->where('jdw_sdg_skripsi_id', $jdw_sdg_skripsi_id);
		$query = $this->db->update($this->jdw_sdg_skripsi, $params);
		return $query;
	}

	function edit_wisuda($post, $jdw_wisuda_id)
	{
		$params = array(
			'start_date' => $post['start_date'],
			'hari'       => $post['hari'],
			'aktifkah'   => $post['aktifkah'],
			'updated'    => date('Y-m-d H:i:s'),
			'posted'     => $this->fu->userLogin()['nip']
		);

		$this->db->where('jdw_wisuda_id', $jdw_wisuda_id);
		$query = $this->db->update($this->jdw_wisuda, $params);
		return $query;
	}

	/* DELETE */

	function delete_proposal($jdw_proposal_id)
	{
		$this->db->where('jdw_proposal_id', $jdw_proposal_id)
			->delete($this->jdw_proposal);
	}

	function delete_sdg_proposal($jdw_sdg_proposal_id)
	{
		$this->db->where('jdw_sdg_proposal_id', $jdw_sdg_proposal_id)
			->delete($this->jdw_sdg_proposal);
	}

	function delete_sdg_skripsi($jdw_sdg_skripsi_id)
	{
		$this->db->where('jdw_sdg_skripsi_id', $jdw_sdg_skripsi_id)
			->delete($this->jdw_sdg_skripsi);
	}

	function delete_wisuda($jdw_wisuda_id)
	{
		$this->db->where('jdw_wisuda_id', $jdw_wisuda_id)
			->delete($this->jdw_wisuda);
	}
} /* /.class */
