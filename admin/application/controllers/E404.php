<?php
defined('BASEPATH') or exit('No direct script access allowed');

class E404 extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
	}

	public function index()
	{
		$text = "404 Not Found";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		$this->template->load('template', 'e404', $data);
	}
}
