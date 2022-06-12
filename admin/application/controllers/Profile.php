<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->model('User_m', 'user');
		$this->load->model('Agama_m', 'agama');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$text = "Profile";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$nip             = $this->session->userdata('nip');
		$data['user_id'] = $this->user->get($nip)->row_array();

		$this->template->load('template', 'profile/profile_data', $data);
	}

	function edit()
	{
		$text = "Edit Profile";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$nip             = $this->session->userdata('nip');
		$data['user_id'] = $this->user->get($nip)->row_array();
		$data['agama']   = $this->agama->get()->result_array();

		if (isset($_POST["edit"])) {
			$this->rules();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'profile/profile_edit', $data);
			} else {
				$post  = $this->input->post(null, true);

				$config['upload_path']   = './upload/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = 2048;
				$config['file_name']     = 'adm' . '_' . date('ymd') . '_' . substr(md5(rand()), 0, 10);

				$this->load->library('upload', $config);

				if (@$_FILES['foto']['name'] != null) {
					if ($this->upload->do_upload('foto')) {
						$user = $this->user->get($nip)->row_array();
						if ($user['foto'] != null) {
							$target_file = './upload/' . $user['foto'];
							unlink($target_file);
						}

						$post['foto'] = $this->upload->data('file_name');
						$this->user->edit($post, $nip);

						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Profile berhasil diedit.</center></div>');
							redirect('profile', 'refresh');
						}
					} else {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center>' . $error . '</center></div>');
						redirect('profile/edit', 'refresh');
					}
				} else {
					$this->user->edit($post, $nip);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Profile berhasil diedit.</center></div>');
						redirect('profile', 'refresh');
					} else {
						redirect('profile', 'refresh');
					}
				}
			}
		} else {
			$this->template->load('template', 'profile/profile_edit', $data);
		}
	}

	private function rules()
	{
		$this->form_validation->set_rules('no_telp', 'No. Telp', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('valid_email' => '%s tidak valid !'));
		$this->form_validation->set_rules('alamat_lkp', 'Alamat Lengkap', 'required');
		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Ubah Password', 'trim|required|min_length[6]|max_length[16]', array('min_length' => '%s minimal 6 karakter !', 'max_length' => '%s maximal 16 karakter !'));
		}
		if ($this->input->post('password_konf')) {
			$this->form_validation->set_rules('password_konf', 'Ubah Password Konfirmasi', 'trim|required|matches[password]|min_length[6]|max_length[16]', array('matches' => '%s tidak sesuai dengan Ubah Password', 'min_length' => '%s minimal 6 karakter !', 'max_length' => '%s maximal 16 karakter !'));
		}

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
} /* /.class */
