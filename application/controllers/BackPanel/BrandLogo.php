<?php header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');

class BrandLogo extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data'); 
		if(empty($admin_data))
		{
			redirect(base_url('BackPanel/Login'));
		}	
		$this->load->model('BackPanel/BrandLogo_model');
	}

	public function index()
	{
		$data['BrandLogo']=$this->BrandLogo_model->slider_list();
		$this->load->view('BackPanel/view_brandlogo',$data);
	}

	public function Add_BrandLogo()
	{
		if (!empty($_FILES['image']['name'])) 
			{
				
				
				$img_res=$this->upload('image','uploads/brand_logo/',$_FILES['image']['name']);
				
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
		$exe=$this->BrandLogo_model->save_slider_data($images);
		echo $exe;
	}

	public function BrandLogo()
	{
		$this->load->view('BackPanel/add_brandlogo');
	}

	public function Edit_BrandLogo($id=0)
	{
		$data=array();
		if($id>0)
		{
			$data['Edit']=$this->BrandLogo_model->getSingleData($id);
		}
		$this->load->view('BackPanel/add_brandlogo',$data);
	}
	public function DeleteBrandLogo()
	{
	    $id=$this->input->get_post('id');
		$exe=$this->BrandLogo_model->Delete_slider($id);
		if($exe)
		{
			echo "1";
		}
		else
		{
			echo "0";
		} 
		
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

}

?>