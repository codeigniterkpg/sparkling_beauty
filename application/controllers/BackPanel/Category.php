<?php header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data');
		if(empty($admin_data))
		{
			redirect(base_url('BackPanel/Login'));
		}	
		$this->load->model('BackPanel/Category_model');
        $this->perPage = 100;
	}
	
	public function index()
	{
		$data['Category']=$this->Category_model->category_menu();
		$this->load->view('BackPanel/manage_category',$data);
	}
	public function AddCategory()
	{
		$data['Category']=$this->Category_model->category_menu_add();
		$this->load->view('BackPanel/add_category',$data);
	}
	public function GetCategory()
	{
		echo $this->Category_model->category_menu_add();
		 
	}
	public function Add_category()
	{
		if (!empty($_FILES['image']['name'])) 
		{
			
			
			$img_res=$this->upload('image','uploads/category/',$_FILES['image']['name']);
			
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
		$exe=$this->Category_model->save_category_data($images);
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
	public function Edit_category($id=0)
	{
		$data=array();
		if($id>0)
		{
			$data['Category']=$this->Category_model->category_menu_add();
			$data['Category_Detail']=$this->Category_model->getSingleData($id);
		}
		$this->load->view('BackPanel/add_category',$data);
	}
	
	public function DeleteCategory()
	{
		
	    $id=$this->input->get_post('id');
		$data['category']=$this->Category_model->getdata($id);
		$data['product']=$this->Category_model->getdataproduct($id);
		if(empty($data['category']) and empty($data['product'])){
			$exe=$this->Category_model->Delete_category($id);
			if($exe)
			{
				echo "1";
			}
			else
			{
				echo "0";
			} 
		}else{
			echo "sorry";
		}
		
	}
	public function ChangeStatus()

	{

		$id=$this->input->post('id');

		$status=$this->input->post('status');

		$this->db->where('cat_id',$id);

		$data['cat_status']=$status;

		echo $exe=$this->db->update('tbl_category',$data);

	}
}
