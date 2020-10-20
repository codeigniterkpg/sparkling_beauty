<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
	}	
	public function index()
	{		
		$this->db->where('cat_subcat_id',0);
		$exe_cat=$this->db->get('tbl_category');
	
		$this->db->join("tbl_category","tbl_category.cat_id=tbl_home_category.thc_cat_id");		
		$this->db->order_by('thc_seq','asc');		
		$exe=$this->db->get('tbl_home_category');

		$this->db->order_by('s_id','asc');		
		$exes=$this->db->get('tbl_slider');	
		
		$this->db->order_by('tbl_id','asc');		
		$exebl=$this->db->get('tbl_brand_logo');	

		$this->db->order_by('tcs_id','asc');		
		$execs=$this->db->get('tbl_customer_say');
							
		$this->db->where('tp_attraction !=', 0);
		$this->db->where('tp_status', 1);
		$exe_pro=$this->db->get('tbl_product');
		$result=$exe_pro->result_array();
		$attraction_1=array();
		$attraction_2=array();
		$attraction_3=array();
		foreach($exe_pro->result_array() as  $dt){
			if($dt['tp_attraction']==1){
				$attraction_1[]=$dt;
			}else if($dt['tp_attraction']==2){
				$attraction_2[]=$dt;
			}else if($dt['tp_attraction']==3){
				$attraction_3[]=$dt;
			}
		}
		$query="SELECT `oi_product_id` FROM tbl_order_item GROUP BY oi_product_id ORDER BY COUNT(oi_product_id) desc limit 0,15";
		$top_exe=$this->db->query($query);
		$top_result=$top_exe->result_array();
		$top_array=array();
		foreach($top_result as $tp){
			$top_array[]=$tp['oi_product_id'];
		}
		if(!empty($top_array)){
		$this->db->where_in('tp_id', $top_array);					
		$this->db->where('tp_status', 1);
		$exe_pro1=$this->db->get('tbl_product');
		$data['Hot']=$exe_pro1->result_array();
		}else{
			$data['Hot']=array();
		}
		$data['Categories']=$exe_cat->result_array();
		$data['HomeCat']=$exe->result_array();
		$data['HomeSlider']=$exes->result_array();
		$data['BrandLogo']=$exebl->result_array();
		$data['CustomerSays']=$execs->result_array();
		$data['Attraction1']=$attraction_1;
		$data['Attraction2']=$attraction_2;
		$data['Attraction3']=$attraction_3;
		$data['Images']=$this->AllImage();
		$data['Sizes']=$this->AllSize();
		$this->load->view('index',$data);
		
	}
	public function AllImage(){
		$this->db->group_by('tpi_product_id');
		$this->db->order_by('tpi_id','asc');
		$exe_img=$this->db->get('tbl_product_image');
		$pro_image=array();
		foreach($exe_img->result_array() as $ei){
			$pro_image[$ei['tpi_product_id']]=$ei['tpi_image'];
		}
		return $pro_image;
	}
	public function AllSize(){
		$this->db->select('tpd_price,tpd_product_id');
		$this->db->group_by('tpd_product_id');
		$this->db->order_by('tpd_id','asc');
		$exe_size=$this->db->get('tbl_product_data');
		$pro_sizes=array();
		foreach($exe_size->result_array() as $ei){
			$pro_sizes[$ei['tpd_product_id']]=$ei['tpd_price'];
		}
		return $pro_sizes;
	}
	public function logout()
	{
		$this->session->unset_userdata('admin_data','');
		redirect(base_url('Login'));
	}
	public function getHeader(){
		
		$this->Home_model->getMenu(1);
	}
	public function CMSDetail($id){
		$this->db->where('cms_url',$id);
		$exe=$this->db->get('tbl_cms');
		$data['Data']=$exe->result_array();
		if(sizeof($exe->result_array())>0){
			$this->load->view('cms',$data);
		}else{
			redirect(base_url(''));
		}
	}
	public function ContactUs(){
		$this->load->view('contact-us');
	}
	public function SaveInquiry(){
		$in_array=array(
			"name"=>$this->input->post('name'),
			"email"=>$this->input->post('email'),
			"subject"=>$this->input->post('subject'),
			"comment"=>$this->input->post('comment')
		);
		$exe=$this->db->insert('tbl_inquiry',$in_array);
		if($exe){
			$response['status']=true;
			$response['message']='Your inquiry has been submitted.';
		}else{
			$response['status']=false;
			$response['message']='Unable to submit your inquiry, please try again';
		}
		echo json_encode($response);
	}
}
