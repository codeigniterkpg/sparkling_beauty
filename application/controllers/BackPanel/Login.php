<?php  /* header("Content-type:application/json"); */
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data');
		if(!empty($admin_data))
		{
			redirect(base_url('BackPanel/Dashboard'));
		}	
		
	}
	public function index()
	{
		$this->load->view('BackPanel/login');
	}
	

	public function check_login()
	{
		
		$data=array();
		$data['u_email']=$this->input->post('name');
		$data['u_password']=md5($this->input->post('password'));
		$exe=$this->db->get_where('tbl_admin',$data);
		
		$admin_data=$exe->result_array();
		if(!empty($admin_data)){
            $this->session->set_userdata('admin_data', $admin_data);
			$response = ["status" => true, "message" => "Login Successfully."];
		}else{
			$response = ["status" => false, "message" => "Please check your login credentials."];
		} 
		
		echo json_encode($response);
	}
}