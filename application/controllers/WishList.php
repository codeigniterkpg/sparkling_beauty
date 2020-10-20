<?php  
defined('BASEPATH') OR exit('No direct script access allowed');


class WishList extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		/* $admin_data=$this->session->userdata('dealer_data');
			if(empty($admin_data))
			{
				redirect(base_url('Login'));
			}
		*/

	}
	public function AddWishList(){
		$id=$this->input->post('id');
		$customer_data=$this->session->userdata('customer_data');
		if(!empty($customer_data)){
			$this->db->where('tw_user_id',$this->session->userdata('customer_data')[0]['tc_id']);
			$this->db->where('tw_product_id',$id);
			$get_qry=$this->db->get('tbl_wishlist');
			if(sizeof($get_qry->result_array())>0){
				$response['status']='already';
			}else{
				$update_data=array("tw_user_id"=>$this->session->userdata('customer_data')[0]['tc_id'],"tw_product_id"=>$id);
				$exe=$this->db->insert('tbl_wishlist',$update_data);
				if($exe){
					$response['status']=true;
				}else{
					$response['status']=false;
				}
				
			}
			echo json_encode($response);
		}else{
			$response['status']='login';
			echo json_encode($response);
		}
	}
	public function WishListCount(){
		$customer_data=$this->session->userdata('customer_data');
		if(!empty($customer_data)){
			$this->db->where('tw_user_id',$this->session->userdata('customer_data')[0]['tc_id']);
			$get_qry=$this->db->get('tbl_wishlist');
			$response['count']=sizeof($get_qry->result_array());
		}else{
			$response['count']=0;
		}
		echo json_encode($response);
	}
	public function Wishlist(){
		$customer_data=$this->session->userdata('customer_data');
		if(!empty($customer_data)){
			$this->db->join("tbl_product","tbl_product.tp_id=tbl_wishlist.tw_product_id");
			$this->db->where('tw_user_id',$this->session->userdata('customer_data')[0]['tc_id']);
			$get_qry=$this->db->get('tbl_wishlist');
			$data['List']=$get_qry->result_array();
			
			$this->db->group_by('tpi_product_id');
			$exe_img=$this->db->get('tbl_product_image');
			$img_array=array();
			foreach($exe_img->result_array() as $di){
				$img_array[$di['tpi_product_id']]=$di['tpi_image'];
			}
			$data['ImgList']=$img_array;
			$this->load->view('wishlist',$data);
		}else{
			redirect(base_url('my-account'));
		}
	}
	public function RemoveWishListData(){
		$cart_id=$this->input->post('id');
		$this->db->where('tw_id',$cart_id);
		$exe=$this->db->delete('tbl_wishlist');
		if($exe){
			$response = ["status" =>true];
		}else{
			$response = ["status" => false];
		}
		echo json_encode($response);
	}
}
?>