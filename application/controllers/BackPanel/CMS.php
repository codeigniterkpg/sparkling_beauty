<?php header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');

class CMS extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data');
		if(empty($admin_data))
		{
			redirect(base_url('BackPanel/Login'));
		}	
		$this->load->model('BackPanel/CMS_model');
        $this->perPage = 100;
	}
	
	public function index()
	{ 
		$data['CMS']=$this->CMS_model->get_cms();
		$this->load->view('BackPanel/manage_cms',$data);
	}
	public function AddCMS()
	{
		$this->load->view('BackPanel/add_cms');
	}
	
	public function Add_cms()
	{
		if (!empty($_FILES['image']['name'])) 
			{
				
				
				$img_res=$this->upload('image','uploads/cms/',$_FILES['image']['name']);
				
				if(isset($img_res['error']) && !empty($img_res['error']))
				{
					echo $img_res['error'];	
					exit;
					
				}
				else
				{
					$images=$img_res;
				}
			}
			else
			{
				$images='';
			}
			if($images!='')
		{
			@unlink('uploads/cms/'.$this->input->post('image1'));
		}
		$exe=$this->CMS_model->save_cms_data($images);
		echo $exe;
	}
	public function upload($temp,$dir,$dfm)
	{
		$this->load->helper('date');
		$config['upload_path'] =$dir;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';	
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
	// for add/edit b news view
	public function Edit_cms($id=0)
	{
		$data=array();
		if($id>0)
		{
			$data['CMS_Detail']=$this->CMS_model->getSingleData($id);
		}
		$this->load->view('BackPanel/add_cms',$data);
	}
	
	public function DeleteCMS()
	{
		
	    $id=$this->input->get_post('id');
			$exe=$this->CMS_model->Delete_cms($id);
			if($exe)
			{
				echo "1";
			}
			else
			{
				echo "0";
			} 
		
		
	}
	public function ChangeStatus()
	{
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		$this->db->where('cat_id',$id);
		$data['cat_show_in_menu']=$status;
		$exe=$this->db->update('tbl_category',$data);
		if($exe){
			$response=array("status"=>1);
		}else{
			$response=array("status"=>0);
		}
		
				print json_encode($response);
		
	}
	public function Edit_order()
	{
	    $id=$this->input->get_post('id');
		$dorder=$this->input->get_post('dorder');
		$exe=$this->CMS_model->Edit_order($id,$dorder);
		echo $exe;
		
	}
}
