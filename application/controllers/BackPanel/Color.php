<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Color extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data');
		if(empty($admin_data))
		{
			redirect(base_url('BackPanel/Login'));
		}	
	}
	/*------------------Size Category Start----------------*/	
	public function index()
	{
		$exe=$this->db->get('tbl_color');
		$data['List']=$exe->result_array();
		$this->load->view('BackPanel/manage_color',$data);
	}
	public function SaveColor(){
		$id=$this->input->post('sc_id');
		$cg_data=array(
						"tclr_title"=>$this->input->post('title')
						);
		if($id>0){
			$this->db->where('tclr_id',$id);
			$exe=$this->db->update('tbl_color',$cg_data);
			if($exe){
				echo "2";
			}else{
				echo "0";
			}
		}else{
			$exe=$this->db->insert('tbl_color',$cg_data);
			if($exe){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function ChangeStatus()
	{
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		$this->db->where('tclr_id',$id);
		$data['tclr_status']=$status;
		echo $exe=$this->db->update('tbl_color',$data);
	}
	/*------------------Size Category End----------------*/	
	
	
}
