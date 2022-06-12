<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun_akademik extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
	}

	public function index()
	{
		$text = "Tahun Akademik";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['thn_akdmk'] = $this->thn_akdmk->get()->result_array();

		$this->template->load('template', 'tahun_akademik/tahun_akademik_data', $data);
	}

	function add()
	{
		$text = "Tambah Tahun Akademik";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		if (isset($_POST["tambah"])) {
			$this->rules();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'tahun_akademik/tahun_akademik_form_add', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->thn_akdmk->add($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
					redirect('tahun_akademik', 'refresh');
				}
			}
		} else {
			$this->template->load('template', 'tahun_akademik/tahun_akademik_form_add', $data);
		}
	}

	function edit()
	{
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		$text = "Edit Tahun Akademik";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$query = $this->thn_akdmk->get($tahun_akademik_id);
		if ($query->num_rows() > 0) {
			$data['thn_akdmk_id'] = $query->row_array();
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			redirect('tahun_akademik', 'refresh');
		}

		if (isset($_POST["edit"])) {
			$this->rules();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'tahun_akademik/tahun_akademik_form_edit', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->thn_akdmk->edit($post, $tahun_akademik_id);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
					redirect('tahun_akademik', 'refresh');
				}
			}
		} else {
			$this->template->load('template', 'tahun_akademik/tahun_akademik_form_edit', $data);
		}
	}

	function delete()
	{
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');
		$this->thn_akdmk->delete($tahun_akademik_id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			redirect('tahun_akademik', 'refresh');
		}
	}

	private function rules()
	{
		$this->form_validation->set_rules('tahun', 'Tahun', 'required');
		$this->form_validation->set_rules('semester', 'Semester', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('aktifkah', 'Status', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
} /* /.class */
