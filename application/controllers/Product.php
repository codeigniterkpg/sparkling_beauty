<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
		$this->session->set_userdata('previous_url', current_url());
	
	}	
	public $cat_array = array();
	public $cat_array_filter = array();
	public function index($cat='',$cat1='',$cat2='')
	{
		$result=array();
		$pass['Category']='';
		if($cat2==''){
			if($cat1==''){
				$this->db->where('cat_url_keyword',$cat);
				$exe=$this->db->get('tbl_category');
				$data=$exe->result_array();
				if(!empty($data)){
					array_push($this->cat_array,$data[0]['cat_id']);
					$this->getCategory($data[0]['cat_id']);
					$this->db->where_in('tp_category_id', $this->cat_array);					
					$this->db->where('tp_status', 1);
					$exe_pro=$this->db->get('tbl_product');
					$result=$exe_pro->result_array();
					/* print_r($this->cat_array); */
					$pass['Category']=$data[0]['cat_name'];
				}
			}else{
				$this->db->where('cat_url_keyword',$cat1);
				$exe=$this->db->get('tbl_category');
				$data=$exe->result_array();
				if(!empty($data)){
					array_push($this->cat_array,$data[0]['cat_id']);
					$this->getCategory($data[0]['cat_id']);
					$this->db->where_in('tp_category_id', $this->cat_array);					
					$this->db->where('tp_status', 1);
					$exe_pro=$this->db->get('tbl_product');
					$result=$exe_pro->result_array();
					/* print_r($this->cat_array); */
					$pass['Category']=$data[0]['cat_name'];
				}
			}
		}else{
			$this->db->where('cat_url_keyword',$cat2);
			$exe=$this->db->get('tbl_category');
			$data=$exe->result_array();
			if(!empty($data)){
				array_push($this->cat_array,$data[0]['cat_id']);
				$this->db->where_in('tp_category_id', $this->cat_array);				
				$this->db->where('tp_status', 1);
				$exe_pro=$this->db->get('tbl_product');
				$result=$exe_pro->result_array();
				$pass['Category']=$data[0]['cat_name'];
			}
		}
		
		
		$pass['List']=$result;
		/*---------Image-------------*/
		
		$pass['Images']=$this->AllImage();
		$Size = $this->AllSize(true);
		$pass['Sizes']=$Size[1];
		$pass['MaxPrice']=max($Size[0]);
		$pass['Cat']=$cat;
		$pass['Search']='';
		$pass['Cat1']=$cat1;
		$pass['Cat2']=$cat2;
		$pass['CatArray']=$this->cat_array;
		$this->load->view('product',$pass);
	}
	public function SearchProduct($search=''){
		if($search!=''){
			$this->db->where("tp_name LIKE '%".$search."%' or tp_name LIKE '".$search."%' or tp_name LIKE '%".$search."'");
			$this->db->where('tp_status', 1);
			$exe_pro=$this->db->get('tbl_product');
			$result=$exe_pro->result_array();
			$pass['List']=$result;
			/*---------Image-------------*/
			
			$pass['Images']=$this->AllImage();
			$pass['Sizes']=$this->AllSize();
			$pass['Search']=$search;
			$pass['Cat']='Search Product';
			$pass['Cat1']='';
			$pass['Cat2']='';
			$pass['CatArray']=array();
			$this->load->view('product',$pass);
		}else{
			redirect(base_url(''));
		}
	}
	public function loadRecord($cat_id=0){

 

       if($this->input->post('color_list')){
			$color_list=$this->input->post('color_list');
			
		}else{
			$color_list=array();
		}
		if($this->input->post('size_list')){
			$size_list=$this->input->post('size_list');
		}else{
			$size_list=array();
		}
		
		$search=$this->input->post('search');
		$cat=$this->input->post('cat');
		$cat1=$this->input->post('cat1');
		$cat2=$this->input->post('cat2');
		$sort_by=$this->input->post('short_by');
		$price_range_min=$this->input->post('price_range_min');
		$price_range_max=$this->input->post('price_range_max');
		
		if($cat2==''){
			if($cat1==''){
				$this->db->where('cat_url_keyword',$cat);
				$exe=$this->db->get('tbl_category');
				$data=$exe->result_array();
				if(!empty($data)){
					array_push($this->cat_array_filter,$data[0]['cat_id']);
					$this->getCategoryFilter($data[0]['cat_id']);
					$pass['Category']=$data[0]['cat_name'];
				}
			}else{
				$this->db->where('cat_url_keyword',$cat1);
				$exe=$this->db->get('tbl_category');
				$data=$exe->result_array();
				if(!empty($data)){
					array_push($this->cat_array_filter,$data[0]['cat_id']);
					$this->getCategoryFilter($data[0]['cat_id']);
					$pass['Category']=$data[0]['cat_name'];
				}
			}
		}else{
			$this->db->where('cat_url_keyword',$cat2);
			$exe=$this->db->get('tbl_category');
			$data=$exe->result_array();
			if(!empty($data)){
				array_push($this->cat_array_filter,$data[0]['cat_id']);
				$pass['Category']=$data[0]['cat_name'];
			}
		}
		if($search!=''){
			$this->db->where("(tp_name LIKE '%".$search."%' or tp_name LIKE '".$search."%' or tp_name LIKE '%".$search."')");
		}else{
			$this->db->where_in('tp_category_id', $this->cat_array_filter);		
		}
		$this->db->where('tp_status', 1);
		$this->db->join("tbl_product_data","tbl_product_data.tpd_product_id=tbl_product.tp_id",'left');
		$this->db->where("tbl_product_data.tpd_price BETWEEN $price_range_min AND $price_range_max");
		if(!empty($color_list)){
			$this->db->where_in('tbl_product_data.tpd_color_id',$color_list);
		}
		if(!empty($size_list)){
			$this->db->where_in('tbl_product_data.tpd_size_master_id',$size_list);
		}
		
		$this->db->group_by('tbl_product.tp_id');
		
		if($sort_by=='asc'){
			$this->db->order_by('tbl_product.tp_name','asc');
		}else if($sort_by=='desc'){
			$this->db->order_by('tbl_product.tp_name','desc');
		}else if($sort_by=='plh'){
			$this->db->order_by('tbl_product_data.tpd_price','asc');
		}else if($sort_by=='phl'){
			$this->db->order_by('tbl_product_data.tpd_price','desc');
		}else if($sort_by=='new'){
			$this->db->order_by('tbl_product.tp_id','desc');
		}
		$exe_pro=$this->db->get('tbl_product');
		
		$result=$exe_pro->result_array();
		
		$Images=$this->AllImage();
		$html='';
		if(sizeof($result)>0){
		  foreach($result as $lt){	
				if($lt['tpd_gst_type']==2){
					$final_price=$lt['tpd_price'];
					$promotion_price = $lt['promotion_price'];
                }else{
                    $final_price=$lt['tpd_price']+$lt['tpd_gst_amount'];
                    $promotion_price = $lt['promotion_price'] + $lt['tpd_gst_amount'];
                }
				$html.='<div class="product-item-element col-sm-6 col-md-6 col-lg-4">
                                    <div class="product-item">
                                        <div class="product-item-inner">
                                            <div class="product-img-wrap">';
												if(isset($Images[$lt['tp_id']])){
													$html.='<img src="'.base_url("uploads/product/").$Images[$lt["tp_id"]].'" alt="">';
												}else{
													$html.='<img src="'.base_url("front_assets/img/noimage.png").'" alt="">';
												 } 
                                            $html.='</div>
                                            <div class="product-button">';
											if(isset($lt['tp_size_category']) && $lt['tp_size_category']>0){
                                                $html.='<a href="'.base_url('shop/').$lt['tp_slug'].'" class="js_tooltip" data-mode="top" data-tip="Select Option"><i class="fa fa-shopping-bag"></i></a>';
											}else{ 
												$html.='<a href="javascript:void(0)" onclick="add_to_cart('.$lt['tp_id'].','.$final_price.','.$lt['tpd_price'].','.$lt['tpd_gst_amount'].','.$lt['tpd_gst_type'].','.$lt['tpd_gst_perce'].')" class="js_tooltip" data-mode="top" data-tip="Add To Cart"><i class="fa fa-shopping-bag"></i></a>';
											} 
											
											$customer_data=$this->session->userdata('customer_data');
												if(!empty($customer_data)){
													$wish_link="onclick='add_to_wishlist(".$lt['tp_id'].")'";
												}else{
													$wish_link="onclick='go_to_login()'";
												}													
											
											$string = strip_tags($lt['tp_name']);
											  if (strlen($string) > 50) {
												  $stringCut = substr($string, 0,50);
												  $endPoint = strrpos($stringCut, ' ');
												  $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
												  $string .= '...';
											  }
                                                $link = b2b($lt['tp_name'], $lt['tp_id'], $final_price);
												$html.='<a href="javascript:void(0)" '.$wish_link.' class="js_tooltip" data-mode="top" data-tip="Add To Whishlist"><i class="fa fa-heart"></i></a>
                                                   <a href="'.$link.'" target="_blank" class="js_tooltip" data-mode="top" data-tip="B2B Inquiry"><i class="fa fa-whatsapp"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <p class="product-title"><a href="'.base_url('shop/').$lt['tp_slug'].'">'.$string.'</a></p>
                                            
                                            <p class="product-description">'.$lt['tp_desc'].'</p>
                                            <h5 class="item-price">₹'.$final_price. ($final_price < $promotion_price ? (' <s style="font-size:15px !important; ">'.$promotion_price.'</s>') : '') . '</h5>
                                        </div>
                                    </div>
                                </div>
								';			
            }     
        }else{
			$html.='<center><h4>sorry, product not available in your search criteria</h4></center>';
		}
		echo $html;

  }
	public function Detail($id=0){
		$this->db->join("tbl_category","tbl_category.cat_id=tbl_product.tp_category_id");
		$this->db->where('tp_slug',$id);		
		$this->db->where('tp_status', 1);
		$exe=$this->db->get('tbl_product');
		$result=$exe->result_array();
		if(!empty($result)){
			$pass['Images']=$this->ProductImage($result[0]['tp_id']);
            $pass['Sizes']=$this->ProductSize($result[0]['tp_id']);
            $pass['Color']=$this->ProductColor($result[0]['tp_id']);
            $pass['Size']=$this->ProductSizes($result[0]['tp_id']);
            /*p($pass['Images']);*/
            $pass['Review']=$this->ProductReview($result[0]['tp_id']);
			$pass['Detail']=$result;
			$pass['Imagess']=$this->AllImage();
			$pass['Sizess']=$this->AllSize();
			$this->load->view('product-detail',$pass);
		}else{
			redirect(base_url(''));
		}
	}
	public function ProductReview($id=0){
		$this->db->join("tbl_customer","tbl_customer.tc_id=tbl_review.tr_user_id");
		$this->db->where('tr_product_id',$id);
		$exe_img=$this->db->get('tbl_review');
		return $exe_img->result_array();
	}
	public function ProductImage($id=0){
		$this->db->where('tpi_product_id',$id);
		$exe_img=$this->db->get('tbl_product_image');
		return $exe_img->result_array();
	}
	public function ProductSize($id=0){
		$this->db->where('tpd_product_id',$id);
		$this->db->order_by('tpd_id','asc');
		$exe_size=$this->db->get('tbl_product_data');
		return $exe_size->result_array();
	}
	
	public function ProductSizes($id=0){
		/*$this->db->join("tbl_size_master","tbl_size_master.tsm_id=tbl_product_data.tpd_size_master_id",'left');
		$this->db->where('tpd_product_id',$id);
		$this->db->group_by('tsm_id');
		$exe_size=$this->db->get('tbl_product_data');
		return $exe_size->result_array();*/

        return new stdClass();
	}
	public function GetProdColors(){
		$id=$this->input->post('id');
		$prod=$this->input->post('prod');
		$this->db->join("tbl_color","tbl_color.tclr_id=tbl_product_data.tpd_color_id",'left');
		$this->db->where('tpd_size_master_id',$id);
		$this->db->where('tpd_product_id',$prod);
		$this->db->group_by('tclr_id');
		$exe_size=$this->db->get('tbl_product_data');
		$html='';
		if(sizeof($exe_size->result_array())>0){
			$html.='<option value="0">Choose Color</option>';
			foreach($exe_size->result_array() as $dt){
				$html.='<option value="'.$dt['tclr_id'].'">'.$dt['tclr_title'].'</option>';
			}
		}else{
			$html.='<option value="0">No Color Found</option>';
		}
		echo $html;
	}
	public function GetProdPrice(){
		$id=$this->input->post('id');
		$prod=$this->input->post('prod');
		$sz=$this->input->post('sz');
		$this->db->where('tpd_color_id',$id);
		$this->db->where('tpd_size_master_id',$sz);
		$this->db->where('tpd_product_id',$prod);
		$exe_size=$this->db->get('tbl_product_data');
		if(sizeof($exe_size->result_array())>0){
			if($exe_size->result_array()[0]['tpd_gst_type']==2){
				$final_price=$exe_size->result_array()[0]['tpd_price'];
			}else{
				$final_price=$exe_size->result_array()[0]['tpd_price']+$exe_size->result_array()[0]['tpd_gst_amount'];
			}
			$response['final_price']=$final_price;
			$response['gst_type']=$exe_size->result_array()[0]['tpd_gst_type'];
			$response['gst_perce']=$exe_size->result_array()[0]['tpd_gst_perce'];
			$response['gst_amount']=$exe_size->result_array()[0]['tpd_gst_amount'];
			$response['product_price']=$exe_size->result_array()[0]['tpd_price'];
			
		}else{
			$response['final_price']=0;
			$response['gst_type']=0;
			$response['gst_perce']=0;
			$response['gst_amount']=0;
			$response['product_price']=0;
		}
		echo json_encode($response);
	}
	public function ProductColor($id=0){
		$this->db->join("tbl_color","tbl_color.tclr_id=tbl_product_data.tpd_color_id",'left');
		$this->db->where('tpd_product_id',$id);
		$this->db->group_by('tclr_id');
		$exe_size=$this->db->get('tbl_product_data');
		return $exe_size->result_array();
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
	public function AllSize($both = false){
		$this->db->select('tpd_price,tpd_product_id,promotion_price');
		$this->db->group_by('tpd_product_id');
		$this->db->order_by('tpd_id','asc');
		$exe_size=$this->db->get('tbl_product_data');
		$pro_sizes=array();
		$sizes = array();
		foreach($exe_size->result_array() as $ei){
			$pro_sizes[$ei['tpd_product_id']]=array($ei['tpd_price'],$ei['promotion_price']);
            $sizes[] = $ei['tpd_price'];
		}
		return $both ? array($sizes,$pro_sizes) : $pro_sizes;
	}
	public function getCategory($id){
		$this->db->where('cat_subcat_id',$id);
		$exe1=$this->db->get('tbl_category');
		$data1=$exe1->result_array();
		foreach($data1 as $dt){
			array_push($this->cat_array,$dt['cat_id']);
			$this->getCategory($dt['cat_id']);
		}
	}
	public function getCategoryFilter($id){
		$this->db->where('cat_subcat_id',$id);
		$exe1=$this->db->get('tbl_category');
		$data1=$exe1->result_array();
		foreach($data1 as $dt){
			array_push($this->cat_array_filter,$dt['cat_id']);
			$this->getCategoryFilter($dt['cat_id']);
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('admin_data','');
		redirect(base_url('BackPanel/Login'));
	}
	public function getHeader(){
		
		$this->Home_model->getMenu(1);
	}
	
}
