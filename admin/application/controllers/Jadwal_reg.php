<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_reg extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('Jadwal_reg_m', 'jdw_reg');
	}

	function index()
	{
		$text = "Jadwal Registrasi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		$this->template->load('template', 'jdw_reg/jdw_reg', $data);
	}

	function proposal()
	{
		$text = "Jadwal Registrasi Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_jdw_reg_proposal'] = $this->jdw_reg->get_jdw_proposal()->result_array();

		$this->template->load('template', 'jdw_reg/jdw_reg_proposal', $data);
	}

	function sdg_proposal()
	{
		$text = "Jadwal Registrasi Sidang Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_jdw_reg_sdg_proposal'] = $this->jdw_reg->get_jdw_sdg_proposal()->result_array();

		$this->template->load('template', 'jdw_reg/jdw_reg_sdg_proposal', $data);
	}

	function sdg_skripsi()
	{
		$text = "Jadwal Registrasi Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_jdw_reg_sdg_skripsi'] = $this->jdw_reg->get_jdw_sdg_skripsi()->result_array();

		$this->template->load('template', 'jdw_reg/jdw_reg_sdg_skripsi', $data);
	}

	function wisuda()
	{
		$text = "Jadwal Registrasi Wisuda";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_jdw_reg_wisuda'] = $this->jdw_reg->get_jdw_wisuda()->result_array();

		$this->template->load('template', 'jdw_reg/jdw_reg_wisuda', $data);
	}

	/* ADD */

	function add_proposal()
	{
		$text = "Tambah Jadwal Registrasi Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data

		if (isset($_POST["tambah"])) {
			$this->rules_add();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'jdw_reg/jdw_reg_proposal_add', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->jdw_reg->add_proposal($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
					$this->proposal();
				}
			}
		} else {
			$this->template->load('template', 'jdw_reg/jdw_reg_proposal_add', $data);
		}
	}

	function add_sdg_proposal()
	{
		$text = "Tambah Jadwal Registrasi Sidang Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data

		if (isset($_POST["tambah"])) {
			$this->rules_add();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'jdw_reg/jdw_reg_sdg_proposal_add', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->jdw_reg->add_sdg_proposal($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
					$this->sdg_proposal();
				}
			}
		} else {
			$this->template->load('template', 'jdw_reg/jdw_reg_sdg_proposal_add', $data);
		}
	}

	function add_sdg_skripsi()
	{
		$text = "Tambah Jadwal Registrasi Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data

		if (isset($_POST["tambah"])) {
			$this->rules_add();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'jdw_reg/jdw_reg_sdg_skripsi_add', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->jdw_reg->add_sdg_skripsi($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
					$this->sdg_skripsi();
				}
			}
		} else {
			$this->template->load('template', 'jdw_reg/jdw_reg_sdg_skripsi_add', $data);
		}
	}

	function add_wisuda()
	{
		$text = "Tambah Jadwal Registrasi Wisuda";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data

		if (isset($_POST["tambah"])) {
			$this->rules_add();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'jdw_reg/jdw_reg_wisuda_add', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->jdw_reg->add_wisuda($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
					$this->wisuda();
				}
			}
		} else {
			$this->template->load('template', 'jdw_reg/jdw_reg_wisuda_add', $data);
		}
	}

	/* EDIT */

	function edit_proposal()
	{
		$text = "Edit Jadwal Registrasi Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$jdw_proposal_id = $this->input->post('jdw_proposal_id');

		// get data
		$query = $this->jdw_reg->get_jdw_proposal($jdw_proposal_id);
		if ($query->num_rows() > 0) {
			$data['g_jdw_proposal_id'] = $query->row_array();
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			$this->proposal();
		}

		if (isset($_POST["edit"])) {
			$this->rules_edit();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'jdw_reg/jdw_reg_proposal_edit', $data);
			} else {
				$post            = $this->input->post(null, true);
				$jdw_proposal_id = $post['jdw_proposal_id'];
				$this->jdw_reg->edit_proposal($post, $jdw_proposal_id);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
					$this->proposal();
				}
			}
		} else {
			$this->template->load('template', 'jdw_reg/jdw_reg_proposal_edit', $data);
		}
	}

	function edit_sdg_proposal()
	{
		$text = "Edit Jadwal Registrasi Sidang Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$jdw_sdg_proposal_id = $this->input->post('jdw_sdg_proposal_id');

		// get data
		$query = $this->jdw_reg->get_jdw_sdg_proposal($jdw_sdg_proposal_id);
		if ($query->num_rows() > 0) {
			$data['g_jdw_sdg_proposal_id'] = $query->row_array();
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			$this->sdg_proposal();
		}

		if (isset($_POST["edit"])) {
			$this->rules_edit();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'jdw_reg/jdw_reg_sdg_proposal_edit', $data);
			} else {
				$post                = $this->input->post(null, true);
				$jdw_sdg_proposal_id = $post['jdw_sdg_proposal_id'];
				$this->jdw_reg->edit_sdg_proposal($post, $jdw_sdg_proposal_id);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
					$this->sdg_proposal();
				}
			}
		} else {
			$this->template->load('template', 'jdw_reg/jdw_reg_sdg_proposal_edit', $data);
		}
	}

	function edit_sdg_skripsi()
	{
		$text = "Edit Jadwal Registrasi Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$jdw_sdg_skripsi_id = $this->input->post('jdw_sdg_skripsi_id');

		// get data
		$query = $this->jdw_reg->get_jdw_sdg_skripsi($jdw_sdg_skripsi_id);
		if ($query->num_rows() > 0) {
			$data['g_jdw_sdg_skripsi_id'] = $query->row_array();
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			$this->sdg_proposal();
		}

		if (isset($_POST["edit"])) {
			$this->rules_edit();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'jdw_reg/jdw_reg_sdg_skripsi_edit', $data);
			} else {
				$post               = $this->input->post(null, true);
				$jdw_sdg_skripsi_id = $post['jdw_sdg_skripsi_id'];
				$this->jdw_reg->edit_sdg_skripsi($post, $jdw_sdg_skripsi_id);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
					$this->sdg_skripsi();
				}
			}
		} else {
			$this->template->load('template', 'jdw_reg/jdw_reg_sdg_skripsi_edit', $data);
		}
	}

	function edit_wisuda()
	{
		$text = "Edit Jadwal Registrasi Wisuda";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$jdw_wisuda_id = $this->input->post('jdw_wisuda_id');

		// get data
		$query = $this->jdw_reg->get_jdw_wisuda($jdw_wisuda_id);
		if ($query->num_rows() > 0) {
			$data['g_jdw_wisuda_id'] = $query->row_array();
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			$this->wisuda();
		}

		if (isset($_POST["edit"])) {
			$this->rules_edit();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'jdw_reg/jdw_reg_wisuda_edit', $data);
			} else {
				$post          = $this->input->post(null, true);
				$jdw_wisuda_id = $post['jdw_wisuda_id'];
				$this->jdw_reg->edit_wisuda($post, $jdw_wisuda_id);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
					$this->wisuda();
				}
			}
		} else {
			$this->template->load('template', 'jdw_reg/jdw_reg_wisuda_edit', $data);
		}
	}

	/* DELETE */

	function delete_proposal()
	{
		$jdw_proposal_id = $this->input->post('jdw_proposal_id');
		$this->jdw_reg->delete_proposal($jdw_proposal_id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			$this->proposal();
		}
	}

	function delete_sdg_proposal()
	{
		$jdw_sdg_proposal_id = $this->input->post('jdw_sdg_proposal_id');
		$this->jdw_reg->delete_sdg_proposal($jdw_sdg_proposal_id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			$this->sdg_proposal();
		}
	}

	function delete_sdg_skripsi()
	{
		$jdw_sdg_skripsi_id = $this->input->post('jdw_sdg_skripsi_id');
		$this->jdw_reg->delete_sdg_skripsi($jdw_sdg_skripsi_id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			$this->sdg_skripsi();
		}
	}

	function delete_wisuda()
	{
		$jdw_wisuda_id = $this->input->post('jdw_wisuda_id');
		$this->jdw_reg->delete_wisuda($jdw_wisuda_id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			$this->wisuda();
		}
	}

	private function rules_add()
	{
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('hari', 'Hari (Masa Berlaku)', 'required|numeric|max_length[3]', array('max_length' => '%s maximal 3 digit angka !'));
		$this->form_validation->set_rules('aktifkah', 'Status', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}

	private function rules_edit()
	{
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('hari', 'Hari (Masa Berlaku)', 'required|numeric|max_length[3]', array('max_length' => '%s maximal 3 digit angka !'));

		$this->form_validation->set_rules('aktifkah', 'Status', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
}
/** /.class */
