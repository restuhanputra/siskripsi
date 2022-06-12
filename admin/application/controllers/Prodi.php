<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('Prodi_m', 'prodi');
	}

	public function index()
	{
		$text = "Program Studi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['prodi'] = $this->prodi->get()->result_array();

		$this->template->load('template', 'prodi/prodi_data', $data);
	}

	function add()
	{
		$text = "Tambah Program Studi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		if (isset($_POST["tambah"])) {
			$this->rules();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'prodi/prodi_form_add', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->prodi->add($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
					$this->index();
				}
			}
		} else {
			$this->template->load('template', 'prodi/prodi_form_add', $data);
		}
	}

	function edit()
	{
		$prodi_id = $this->input->post('prodi_id');

		$text = "Edit Program Studi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$query = $this->prodi->get($prodi_id);
		if ($query->num_rows() > 0) {
			$data['prodi_id'] = $query->row_array();
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			redirect('prodi', 'refresh');
		}


		if (isset($_POST["edit"])) {
			$this->rules();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'prodi/prodi_form_edit', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->prodi->edit($post, $prodi_id);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
					$this->index();
				}
			}
		} else {
			$this->template->load('template', 'prodi/prodi_form_edit', $data);
		}
	}

	function delete()
	{
		$prodi_id = $this->input->post('prodi_id');
		$this->prodi->delete($prodi_id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			$this->index();
		}
	}

	private function rules()
	{
		$this->form_validation->set_rules('nama_prodi', 'Nama Prodi', 'required');

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
} /* /.class */
