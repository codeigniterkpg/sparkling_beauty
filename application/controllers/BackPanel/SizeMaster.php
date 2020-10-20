<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SizeMaster extends CI_Controller {

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
	public function SizeCategory()
	{
		$exe=$this->db->get('tbl_size_category');
		$data['List']=$exe->result_array();
		$this->load->view('BackPanel/manage_size_category',$data);
	}
	public function SaveSizeCategory(){
		$id=$this->input->post('sc_id');
		$image1=$this->input->post('image1');
		if (!empty($_FILES['chart_image']['name'])) 
			{
				$img_res=$this->upload('chart_image','uploads/size_chart/',$_FILES['chart_image']['name']);
				if(isset($img_res['error']) && !empty($img_res['error']))
				{
					
					$data = [
						"status"	=> "false",
						"message"	=> $img_res['error'],
					];
					echo json_encode($data);
					exit;
				}
				else
				{
						$chart_images=$img_res;
				}
			}
			else
			{
				$chart_images='';
			}
		if($chart_images==''){
			$chart_images=$image1;
		}
		$cg_data=array("tsc_image"=>$chart_images,"tsc_title"=>$this->input->post('title'));
		if($id>0){
			$this->db->where('tsc_id',$id);
			$exe=$this->db->update('tbl_size_category',$cg_data);
			if($exe){
				echo "2";
			}else{
				echo "0";
			}
		}else{
			$exe=$this->db->insert('tbl_size_category',$cg_data);
			if($exe){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	 public function upload($temp,$dir,$dfm)
	{
		$this->load->helper('date');
		$config['upload_path'] =$dir;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|PNG|JPEG';
		$config['file_name'] = $dfm;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload($temp))
		{
			 $error = array('error' => $this->upload->display_errors());
			 return $error;
		}
		else
		{
				$upload_data = $this->upload->data();
				return $upload_data['file_name'];
		}
	}
	public function ChangeStatusSizeCategory()
	{
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		$this->db->where('tsc_id',$id);
		$data['tsc_status']=$status;
		echo $exe=$this->db->update('tbl_size_category',$data);
	}
	/*------------------Size Category End----------------*/	
	
	/*------------------Size Start----------------*/	
	public function Size()
	{
		 $this->db->join('tbl_size_category', 'tbl_size_category.tsc_id = tbl_size_master.tsm_sizecat_id', 'left');
		$exe=$this->db->get('tbl_size_master');
		$data['List']=$exe->result_array();
		$this->load->view('BackPanel/manage_size',$data);
	}
	public function SaveSize(){
		$id=$this->input->post('sc_id');
		$cg_data=array(
						"tsm_sizecat_id"=>$this->input->post('size_id'),
						"tsm_size"=>$this->input->post('title')
						);
		if($id>0){
			$this->db->where('tsm_id',$id);
			$exe=$this->db->update('tbl_size_master',$cg_data);
			if($exe){
				echo "2";
			}else{
				echo "0";
			}
		}else{
			$exe=$this->db->insert('tbl_size_master',$cg_data);
			if($exe){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function ChangeStatusSize()
	{
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		$this->db->where('tsm_id',$id);
		$data['tsm_status']=$status;
		echo $exe=$this->db->update('tbl_size_master',$data);
	}
	/*------------------Size End----------------*/	
}
