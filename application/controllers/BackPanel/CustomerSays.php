<?php header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerSays extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data'); 
		if(empty($admin_data))
		{
			redirect(base_url('BackPanel/Login'));
		}	
		$this->load->model('BackPanel/CustomerSays_model');
		
	}

	public function index()
	{
		$data['CustomerSays']=$this->CustomerSays_model->slider_list();
		$this->load->view('BackPanel/view_cs',$data);
	}

	public function Add_CustomerSays()
	{
		
		$exe=$this->CustomerSays_model->save_slider_data();
		echo $exe;
	}

	public function CustomerSays()
	{
		$this->load->view('BackPanel/add_cs');
	}

	public function Edit_CustomerSays($id=0)
	{
		$data=array();
		if($id>0)
		{
			$data['Edit']=$this->CustomerSays_model->getSingleData($id);
		}
		$this->load->view('BackPanel/add_cs',$data);
	}
	public function DeleteCustomerSays()
	{
	    $id=$this->input->get_post('id');
		$exe=$this->CustomerSays_model->Delete_slider($id);
		if($exe)
		{
			echo "1";
		}
		else
		{
			echo "0";
		} 
		
	}
	
}

?>