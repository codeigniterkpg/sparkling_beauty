<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data');
		if(empty($admin_data))
		{
			redirect(base_url('BackPanel/Login'));
		}	
	}	
	public function index()
	{
		$this->load->view('BackPanel/index');
	}
	
	public function logout()
	{
		$this->session->unset_userdata('admin_data','');
		redirect(base_url('BackPanel/Login'));
	}
}
