<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_m', 'user');
		$this->load->library('form_validation');
	}

	public function index()
	{
		checkAlreadyLogin();
		$text = "Login";
		$data = array(
			'h_title' => strtoupper($text),
		);
		$this->load->view('auth/login', $data);
	}

	function process()
	{
		$this->rules();

		$username = blockSQLInjection($this->input->post('username'));
		$password = blockSQLInjection($this->input->post('password'));

		if ($this->form_validation->run() === FALSE) {
			$this->index();
		} else {
			$query = $this->user->login($username, $password);

			if (isset($query)) {
				if ($query['status'] == 2) {
					$params = array(
						'nidn' => $query['nidn'],
						'role' => $query['role']
					);
					$this->session->set_userdata($params);
					redirect('dashboard');
				} elseif ($query['status'] == 1) {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Akun Tidak Aktif</center></div>');
					$this->index();
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Username atau password salah</center></div>');
					$this->index();
				}
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Username atau password salah</center></div>');
				$this->index();
			}
		}
	}

	function logout()
	{
		$params = array(
			'nidn',
			'role'
		);
		$this->session->unset_userdata($params);
		redirect('auth');
	}

	private function rules()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$this->form_validation->set_message('required', '{field} masih kosong silahkan diisi');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}

	private function reset_rules()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_message('required', '{field} masih kosong silahkan diisi');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}

	function resetpass()
	{
		checkAlreadyLogin();
		$text = "Reset Password";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		$this->load->view('auth/resetpass', $data);
	}

	function reset()
	{
		$this->reset_rules();

		if ($this->form_validation->run() === FALSE) {
			$this->resetpass();
		} else {
			// post data
			$nidn = blockSQLInjection($this->input->post('username'));

			// get data
			$query = $this->user->get($nidn);
			if ($query->num_rows() > 0) {
				$dosen = $query->row_array();
				$email = $dosen['email'];
			}

			// Random password
			$pass = substr(sha1(rand()), 0, 12);

			$this->user->resetpass($pass, $nidn);
			if ($this->db->affected_rows() > 0) {
				$from_email = "@gmail.com"; //isi email untuk mengirim password baru
				$to_email = $email;

				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => $from_email,
					'smtp_pass' => '', // isi password email untuk mengirim password baru
					'mailtype'  => 'html',
					'charset'   => 'iso-8859-1'
				);

				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");

				$this->email->from($from_email, "SISKRIP UBJ");
				$this->email->to($to_email);
				$this->email->subject('Reset Password SISKRIP UBJ');

				$pesan = "
					<html>
						<head>
							<title>Reset Password SISKRIP UBJ</title>
						</head>
						<body>
							<p>Akun Anda:</p>
							<p>Username : " . $nidn . "</p>
							<p>Password : " . $pass . "</p>
							<p>Mohon untuk login, dan ubah password baru. Terima kasih.</p>
							<h4><a href='" . base_url() . "'>Login</a></h4>
						</body>
					</html>
					";
				$this->email->message($pesan);

				if ($this->email->send()) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Reset Berhasil, Silahkan cek email anda!</center></div>');

					$this->index();
				} else {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Reset tidak berhasil!</center></div>');
					$this->resetpass();
				}
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Reset tidak berhasil!</center></div>');
				$this->resetpass();
			}
		}
	}
} /* /.class */
