<?php header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');
class Site_Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data');
		if(empty($admin_data))
		{
			redirect(base_url('BackPanel/Login'));
		}	
		$this->load->model('BackPanel/Site_Setting_model');
	}
	
	public function index()
	{
		$data['Site_Detail']=$this->Site_Setting_model->getSingleData();
		
		
		$this->load->view('BackPanel/site_setting',$data);
		
	}
	public function Edit_Site_Setting()
	{
		if (!empty($_FILES['image']['name'])) 
			{								
				$img_res=$this->upload('image','upload/logo/',$_FILES['image']['name']);
				
				if(isset($img_res['error']) && !empty($img_res['error']))
				{
					print_r($img_res['error']);	
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
			
			
			
			if (!empty($_FILES['fimage']['name'])) 
			{
				
				
				$img_res=$this->upload('fimage','upload/logo/',$_FILES['fimage']['name']);
				
				if(isset($img_res['error']) && !empty($img_res['error']))
				{
					print_r($img_res['error']);	
					exit;
					
				}
				else
				{
					$fimages=$img_res;
				}
			}
			else
			{
				$fimages='';
			}
			 
			
			
		$exe=$this->Site_Setting_model->site_setting_update($images,$fimages);
		echo $exe;
	}
	
	public function upload($temp,$dir,$dfm)
	{
		$this->load->helper('date');
		$config['upload_path'] =$dir;
		$config['allowed_types'] = 'jpg|png|jpeg|ico';	
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
	
}
