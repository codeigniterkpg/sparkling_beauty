<?php header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry extends CI_Controller 
{

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
		$this->db->order_by('id','desc');
		$exe=$this->db->get('tbl_inquiry');
		$data['List']=$exe->result_array();
		$this->load->view('BackPanel/view_inquiry',$data);
	}
	
	
	
}

?>