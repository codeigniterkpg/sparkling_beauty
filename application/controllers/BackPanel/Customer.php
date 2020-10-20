<?php header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller 
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
		$this->db->order_by('tc_id','desc');
		$exe=$this->db->get('tbl_customer');
		$data['Customer']=$exe->result_array();
		$this->load->view('BackPanel/view_customer',$data);
	}
	
	public function Change_status()
	{
	    $id=$this->input->get_post('user_id');
	    $status=$this->input->get_post('status');
		$data['tc_status']=$status;
		$this->db->where('tc_id',$id);
		$exe=$this->db->update('tbl_customer',$data);
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