<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
	}

	public function index()
	{
		$text = "Dashboard";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		$this->template->load('template', 'dashboard', $data);
	}
} /* /.class */
