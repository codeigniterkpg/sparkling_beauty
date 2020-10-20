<?php  /* header("Content-type:application/json"); */
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');


class Cart extends CI_Controller {

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
	public function index(){
		$customer_data=$this->session->userdata('customer_data');
		if(empty($customer_data)){
			if($this->session->userdata('guest_id')){
				$customer_id=$this->session->userdata('guest_id');
			}else{
				$this->session->set_userdata('guest_id', rand(1111,9999));
				$customer_id=$this->session->userdata('guest_id');
			}
		}else{
			$customer_id=$this->session->userdata('customer_data')[0]['tc_id'];
		}
		
		
		$this->db->group_by('tpi_product_id');
		$exe_img=$this->db->get('tbl_product_image');
		$img_array=array();
		foreach($exe_img->result_array() as $di){
			$img_array[$di['tpi_product_id']]=$di['tpi_image'];
		}
		$this->db->select('tbl_color.tclr_title,tbl_size_master.tsm_size,tbl_product.tp_slug,tbl_product.tp_name,tbl_cart.*');		
		$this->db->join('tbl_color', 'tbl_color.tclr_id = tbl_cart.cr_color ','left');		
		$this->db->join('tbl_size_master', 'tbl_size_master.tsm_id = tbl_cart.cr_size ','left');		
		$this->db->join('tbl_product', 'tbl_product.tp_id = tbl_cart.cr_product_id ','left');		
		$this->db->where('cr_cust_id',$customer_id);
		$exe=$this->db->get('tbl_cart');
		$cart_data=$exe->result_array();
		
		$data['CartData']=$cart_data;
		$data['CartImg']=$img_array;
		$this->load->view('cart',$data);
	}
	public function checkout(){
		$customer_data=$this->session->userdata('customer_data');
		if(empty($customer_data)){	
			$this->session->set_userdata('previous_url', current_url());
			redirect(base_url('my-account'));
			/* if($this->session->userdata('guest_id')){
				$customer_id=$this->session->userdata('guest_id');
			}else{
				$this->session->set_userdata('guest_id', rand(1111,9999));
				$customer_id=$this->session->userdata('guest_id');
			} */			
		}else{
			$customer_id=$this->session->userdata('customer_data')[0]['tc_id'];
		}
		
		
		$this->db->select('tbl_color.tclr_title,tbl_size_master.tsm_size,tbl_product.tp_slug,tbl_product.tp_shipping_type,tbl_product.tp_shipping_amount,tbl_product.tp_name,tbl_product.tp_gst_type,tbl_product.tp_gst_perce,tbl_cart.*');		
		$this->db->join('tbl_color', 'tbl_color.tclr_id = tbl_cart.cr_color ','left');		
		$this->db->join('tbl_size_master', 'tbl_size_master.tsm_id = tbl_cart.cr_size ','left');		
		$this->db->join('tbl_product', 'tbl_product.tp_id = tbl_cart.cr_product_id ','left');		
		$this->db->where('cr_cust_id',$customer_id);
		$exe=$this->db->get('tbl_cart');
		$cart_data=$exe->result_array();
		$data['CartData']=$cart_data;
		$this->db->where('tca_customer_id',$customer_data[0]['tc_id']);
		$exe=$this->db->get('tbl_customer_address');
		$data['Address']=$exe->result_array();
		if(!empty($cart_data)){
		$this->load->view('checkout',$data);
		}else{
			redirect(base_url('home'));
		}
	}
	public function AddCart()
	{
		$customer_data=$this->session->userdata('customer_data');
		if(empty($customer_data)){
			if($this->session->userdata('guest_id')){
				$customer_id=$this->session->userdata('guest_id');
			}else{
				$this->session->set_userdata('guest_id', rand(1111,9999));
				$customer_id=$this->session->userdata('guest_id');
			}
		}else{
			$customer_id=$this->session->userdata('customer_data')[0]['tc_id'];
		}
		
		$pro_id=$this->input->post('id');
		$price=$this->input->post('price');
		$qty=$this->input->post('qty');
		$sz=$this->input->post('sz');
		$color=$this->input->post('color');
		
		$mrp=$this->input->post('mrp');
		$gst_amount=$this->input->post('gst_amount');
		$gst_type=$this->input->post('gst_type');
		$gst_perce=$this->input->post('gst_perce');
		
		
		$insert_data=array("cr_cust_id"=>$customer_id,"cr_product_id"=>$pro_id,"cr_price"=>$price,"cr_size"=>$sz,"cr_color"=>$color,"cr_gst_type"=>$gst_type,"cr_gst_perce"=>$gst_perce);
		$this->db->where('cr_cust_id',$customer_id);
		$this->db->where('cr_product_id',$pro_id);
		$this->db->where('cr_size',$sz);
		$this->db->where('cr_color',$color);
		$exe=$this->db->get('tbl_cart');
		$cart_data=$exe->result_array();
		
		
		if(sizeof($cart_data)>0){
			$insert_data["cr_qty"]=$cart_data[0]['cr_qty']+$qty;
			$final_qty=$cart_data[0]['cr_qty']+$qty;
			$insert_data["cr_amount"]=$final_qty*$price;
			$insert_data["cr_mrp"]=$final_qty*$mrp;
			$insert_data["cr_gst_amount"]=$final_qty*$gst_amount;
			$this->db->where('cr_cust_id',$customer_id);
			$this->db->where('cr_product_id',$pro_id);
			$this->db->where('cr_size',$sz);
			$this->db->where('cr_color',$color);
			$exe_cart=$this->db->update('tbl_cart',$insert_data);
			if($exe_cart){
				$response = ["status" => true, "message" => "Your cart has been updated."];
			}else{
				$response = ["status" => false, "message" => "Unable to update your cart."];
			}
		}else{
			$insert_data["cr_qty"]=$qty;
			$insert_data["cr_amount"]=$qty*$price;
			$insert_data["cr_mrp"]=$qty*$mrp;
			$insert_data["cr_gst_amount"]=$qty*$gst_amount;
			$exe_cart=$this->db->insert('tbl_cart',$insert_data);
			if($exe_cart){
				$response = ["status" => true, "message" => "You have added product to your cart!."];
			}else{
				$response = ["status" => false, "message" => "Unable to add book to your cart."];
			}
		}
		echo json_encode($response);
	}
	public function CartData()
	{
			$customer_data=$this->session->userdata('customer_data');
			if(empty($customer_data)){
				if($this->session->userdata('guest_id')){
					$customer_id=$this->session->userdata('guest_id');
				}else{
					$this->session->set_userdata('guest_id', rand(1111,9999));
					$customer_id=$this->session->userdata('guest_id');
				}
			}else{
				$customer_id=$this->session->userdata('customer_data')[0]['tc_id'];
			}
			$this->db->group_by('tpi_product_id');
			$exe_img=$this->db->get('tbl_product_image');
			$img_array=array();
			foreach($exe_img->result_array() as $di){
				$img_array[$di['tpi_product_id']]=$di['tpi_image'];
			}
			$this->db->join('tbl_product', 'tbl_product.tp_id = tbl_cart.cr_product_id ','left');		
			$this->db->where('cr_cust_id',$customer_id);
			$exe=$this->db->get('tbl_cart');
			$cart_data=$exe->result_array();
			
			$html='';
			if(sizeof($cart_data)>0){
				$html.='<div class="cart-widget-content">
							<div class="cart-widget-product">
								<ul class="cart-product-item">';
									$total=0;
								foreach($cart_data as $cd){
									if(isset($img_array[$cd['cr_product_id']])){
										$img=base_url("uploads/product/").$img_array[$cd['cr_product_id']];
									}else{
										$img=base_url('front_assets/img/noimage.png');
									}
									$html.='<li>
										<a target="_blank" href="'.base_url('shop/').$cd['tp_slug'].'" class="product-image">
											<img src="'.$img.'" alt="" /></a>
										<div class="product-content">
											<a target="_blank" class="product-link" href="'.base_url('shop/').$cd['tp_slug'].'">'.$cd['tp_name'].'</a>
											<div class="cart-collateral">
												<span class="qty-cart">'.$cd['cr_qty'].'</span>&nbsp;<span>&#215;</span>&nbsp;<span class="product-price-amount"><span class="currency-sign">₹</span>'.$cd['cr_price'].'</span>
											</div>
											<a class="product-remove" href="javascript:void(0);" onclick="cart_remove('.$cd['cr_id'].');"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
										</div>
									</li>';
								$total=$total+$cd['cr_amount'];
								}
								$html.='</ul>
							</div>
						</div>
						<div class="cart-widget-footer">
							<div class="cart-footer-inner">
								<h4 class="cart-total-hedding normal"><span>Total :</span><span class="cart-total-price">₹'.$total.'</span></h4>
								<div class="cart-action-buttons">
									<a href="'.base_url('cart').'" class="view-cart btn btn-md btn-gray">View Cart</a>
									<a href="'.base_url('checkout').'" class="checkout btn btn-md btn-color">Checkout</a>
								</div>
							</div>
						</div>';
			}else{
				$html.='<div class="cart-empty">
									<p>You have no items in your shopping cart.</p>
								</div>';
			}
		
		$response = ["message" => $html,"cart_items"=>sizeof($cart_data),"cart_total"=>$total];
		echo json_encode($response);
	}
	public function RemoveCartData(){
		$cart_id=$this->input->post('id');
		$this->db->where('cr_id',$cart_id);
		$exe=$this->db->delete('tbl_cart');
		if($exe){
			$response = ["status" =>true];
		}else{
			$response = ["status" => false];
		}
		echo json_encode($response);
	}
	public function UpdateCartData(){
		$cr_cust_id=$this->input->post('cr_cust_id');
		$cart_id=$this->input->post('id');
		$qty=$this->input->post('qty');
		$price=$this->input->post('price');
		
		$update_data=array("cr_qty"=>$qty,"cr_amount"=>$qty*$price);
		$this->db->where('cr_id',$cart_id);
		$exe=$this->db->update('tbl_cart',$update_data);
		if($exe){
			$this->db->select('sum(cr_amount) as total');
			$this->db->where('cr_cust_id',$cr_cust_id);
			$exe_crt=$this->db->get('tbl_cart');
			$crt_data=$exe_crt->result_array();
			if(!empty($crt_data)){
				$total=$crt_data[0]['total'];
			}else{
				$total=0;
			}
			$response = ["status" =>true,"cart_total"=>$total];
		}else{
			$response = ["status" => false];
		}
		echo json_encode($response);
	}
	public function PlaceOrder()
	{
		$customer_data=$this->session->userdata('customer_data');
		if(empty($customer_data)){
			redirect(base_url('Login'));
		}else{
			$customer_id=$this->session->userdata('customer_data')[0]['tc_id'];
		}
		$this->db->select('tbl_color.tclr_title,tbl_product.tp_name,tbl_cart.*');
		$this->db->join('tbl_color', 'tbl_color.tclr_id = tbl_cart.cr_color ','left');		
		/*$this->db->join('tbl_size_master', 'tbl_size_master.tsm_id = tbl_cart.cr_size ','left');*/
		$this->db->join('tbl_product', 'tbl_product.tp_id = tbl_cart.cr_product_id ','left');		
		$this->db->where('cr_cust_id',$customer_id);
		$exe_cart=$this->db->get('tbl_cart');
		$cart_data=$exe_cart->result_array();
		if(!empty($cart_data)){
			if($this->input->post('payment_method')=='cod'){
				$this->db->where('o_invoice_no !=','');
				$this->db->order_by('o_id','desc');
				$this->db->limit('1');
				$exe_inv=$this->db->get('tbl_order');
				$data_inv=$exe_inv->result_array();
				
				if(!empty($data_inv)){
					$current_year=date('y');
					$current_month=date('m');
					if($current_month>=1 and $current_month<=3){
						$temp_year=$current_year-1;
						$final_year=$temp_year."-".$current_year;
					}else{
						$temp_year=$current_year+1;
						$final_year=$current_year."-".$temp_year;
					}
					
					$inv=$data_inv[0]['o_invoice_no'];
					$exp_inv=explode('/',$inv);
					$last_year=$exp_inv[0];
					$last_invoice=$exp_inv[1];
					if($last_year==$final_year){
						$no=$last_invoice+'0001';
						$num_padded = sprintf("%04d", $no);
						$final_invoice=$final_year."/".$num_padded;
					}else{
						$no='0001';
						$final_invoice=$final_year."/".$no;
					}
					$insert_data["o_invoice_no"]=$final_invoice;
				}else{
					$current_year=date('y');
					$current_month=date('m');
					if($current_month>=1 and $current_month<=3){
						$temp_year=$current_year-1;
						$final_year=$temp_year."-".$current_year;
					}else{
						$temp_year=$current_year+1;
						$final_year=$current_year."-".$temp_year;
					}
					$no='0001';
					$final_invoice=$final_year."/".$no;
					$insert_data["o_invoice_no"]=$final_invoice;
				}
			}
			$insert_data["o_cust_id"]=$customer_id;
			$insert_data["o_discount_amount"]=$this->input->post('discount');
			$insert_data["o_shipping_charge"]=$this->input->post('shipping');
			$insert_data["o_sub_total"]=$this->input->post('sub_total');
			$insert_data["o_tax"]=$this->input->post('tax');
			$insert_data["o_grand_total"]=$this->input->post('total');
			$insert_data["o_date"]=date('Y-m-d');
			$insert_data["o_name"]=$this->input->post('tca_name');
			$insert_data["o_phone"]=$this->input->post('tca_phone');
			$insert_data["o_email"]=$this->input->post('tca_email');
			$insert_data["o_address"]=$this->input->post('tca_street_address');
			$insert_data["o_address1"]=$this->input->post('tca_street_address1');
			$insert_data["o_company_name"]=$this->input->post('tca_company_name');
			$insert_data["o_town"]=$this->input->post('tca_town');
			$insert_data["o_state"]=$this->input->post('tca_state');
			$insert_data["o_postcode"]=$this->input->post('tca_postcode');
			$save_order=$this->db->insert('tbl_order',$insert_data);
			$insert_id = $this->db->insert_id();
			$this->session->set_userdata('order_id', $insert_id);
			$this->session->set_userdata('cust_id', $customer_id);
			$this->session->set_userdata('order_amount', $this->input->post('total'));
			$this->session->set_userdata('order_email', $this->input->post('tca_email'));
			$this->session->set_userdata('order_phone', $this->input->post('tca_phone'));
			if($save_order){
				foreach($cart_data as $cd){
					if(isset($cd['tsm_size'])){
						$size=$cd['tsm_size'];
					}else{
						$size="Regular";
					}
					if(isset($cd['tsm_size'])){
						$color=$cd['tsm_size'];
					}else{
						$color="Regular";
					}
					$order_data=array(
							"oi_order_id"=>$insert_id,
							"oi_product_id"=>$cd['cr_product_id'],
							"oi_product_name"=>$cd['tp_name'],
							"oi_size_category"=>$cd['tp_size_category'],
							"oi_size"=>$size,
							"oi_color"=>$color,
							"oi_qty"=>$cd['cr_qty'],
							"oi_gst_type"=>$cd['cr_gst_type'],
							"oi_gst_perce"=>$cd['cr_gst_perce'],
							"oi_gst_amount"=>$cd['cr_gst_amount'],
							"oi_mrp"=>$cd['cr_mrp'],
							"oi_price"=>$cd['cr_price'],
							"oi_amount"=>$cd['cr_amount']
					);
					$save_order_item=$this->db->insert('tbl_order_item',$order_data);
				}
				$response = ["status" => true, "message" => "Your order has been placed successfully."];
				
				$this->db->where('cr_cust_id',$customer_id);
				$this->db->delete('tbl_cart');
				
			}else{
				$response = ["status" => false, "message" => "Unable to place your order."];
				echo json_encode($response);
			}
		}else{
			$response = ["status" => false, "message" => "Your cart is empty, Please add items to your cart."];
			echo json_encode($response);
		}
		
		
		echo json_encode($response);
	}
	public function Details()
	{
		$id=$this->input->post('id');
		$this->db->join("tbl_customer","tbl_customer.tc_id=tbl_order.o_cust_id",'left');
		$this->db->where('o_id',$id);
		$exe=$this->db->get('tbl_order');
		$order_data=$exe->result_array();
		$order_items=$this->getOrderItems($id);
		$html='';
		if(!empty($order_data)){
			$html='<div class="panel-body">
						<div class="clearfix">
							<div class="float-left">
								<h3 class="logo invoice-logo">'.$order_data[0]['tc_name'].'</h3>
							</div>
						</div>
						<hr>
						<div class="">
							<div class="col-12">

								<div class="float-left m-t-30">
									<address>
										<strong>'.$order_data[0]['o_name'].'</strong><br>
										'.$order_data[0]['o_address'].'<br>
										<abbr title="Phone">M:</abbr> '.$order_data[0]['o_phone'].' <br>
										<abbr title="Phone">E:</abbr> '.$order_data[0]['o_email'].' <br>
									</address>
								</div>
								<div class="float-right m-t-30">
									<p><strong>Order Date: </strong> '.date('F d, Y',strtotime($order_data[0]['o_date'])).'</p>
									
									<p class="m-t-10"><strong>Order ID: </strong> '.$order_data[0]['o_id'].'</p>
								</div>
							</div>
						</div>

						<div class="m-h-50"></div>

						<div class="">
							<div class="col-12">
								<div class="table-responsive">
									<table class="table m-t-30">
										<thead class="bg-faded">
										<tr><th>#</th>
											<th>Book</th>
											<th>Description</th>
											<th>Quantity</th>
											<th>Price</th>
											<th>Total</th>
										</tr></thead>
										<tbody>';
										$i=1;foreach($order_items as $oi){
											$html.='<tr>
												<td>'.$i.'</td>
												<td><img style="height:100px;width:50px;" src="'.base_url("uploads/books/").$oi['tb_image'].'"></td>
												<td>'.$oi['oi_book_name'].'</td>
												<td>'.$oi['oi_qty'].'</td>
												<td>₹ '.$oi['oi_price'].'</td>
												<td>₹ '.$oi['oi_amount'].'</td>
											</tr>';
										$i++;}
										$html.='</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="">
							<div class="col-6">
								
							</div>
							<div class="col-6 ">
								<p class="text-right"><b>Sub-total:</b> ₹ '.$order_data[0]['o_sub_total'].'</p>
								<p class="text-right"><b>Discount:</b> ₹ '.$order_data[0]['o_discount_amount'].'</p>
								<p class="text-right"><b>Shipping Charge:</b> ₹ '.$order_data[0]['o_shipping_charge'].'</p>
								<hr>
								<h3 class="text-right">Total ₹ '.$order_data[0]['o_grand_total'].'</h3>
							</div>
						</div>
						<hr>
						
					</div>';
		}else{
			$html.='No record found';
		}
		echo $html;
	}
	public function getOrderItems($id)
	{
		$this->db->join("tbl_book","tbl_book.tb_id=tbl_order_item.oi_book_id");
		$this->db->where('oi_order_id',$id);
		$exe=$this->db->get('tbl_order_item');
		return $exe->result_array();
	}
	public function getBookData($id)
	{
		$this->db->where('tb_id',$id);
		$exe=$this->db->get('tbl_book');
		return $exe->result_array();
	}
	public function GenerateInvoice($id=0){
		 
		$filename="invoice_".$id.".pdf"; 
		$this->db->join("tbl_customer","tbl_customer.tc_id=tbl_order.o_cust_id",'left');
		$this->db->where('o_id',$id);
		$exe=$this->db->get('tbl_order');
		$order_data=$exe->result_array();
		$order_items=$this->getOrderItems($id);
		
		$data['order_data']=$order_data;
		$data['order_items']=$order_items;
		$data['filename']=$filename;
		
		$this->load->view('pdf_invoice',$data);
		
		
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
	public function GetOrderdetail()
	{
		$id = $this->input->post('ord_id');
		$html='';
		if($id > 0)
		{
			$this->db->where('o_id',$id);
			$this->db->from('tbl_order');						
			$exe=$this->db->get(); 
			$exe_data=$exe->result_array();
			if(!empty($exe_data)){
				if($exe_data[0]['o_status']==0){
					$o_status='Pending';
				}else if($exe_data[0]['o_status']==1){
					$o_status='Dispatched';
				}else if($exe_data[0]['o_status']==2){
					$o_status='Delivered';
				}else if($exe_data[0]['o_status']==3){
					$o_status='Cancelled';
				}else if($exe_data[0]['o_status']==4){
					$o_status='Replace';
				}else if($exe_data[0]['o_status']==5){
					$o_status='Return';
				}else{
					$o_status='N/A';
				}
				if($exe_data[0]['o_type']==1){
					$o_type='Paytm';
				}else{
					$o_type='COD';
				}
				if($exe_data[0]['o_payment_status']==1){
					$pay_status='Paid';
				}else{
					$pay_status='Due';
				}
				if($exe_data[0]['o_status']==4){
					if($exe_data[0]['o_replace_status']==0){
						$rp_status='<p style="color:orange">Your request for order replace has been pending</p>';
					}else if($exe_data[0]['o_replace_status']==1){
						$rp_status='<p style="color:orange">Your request for order replace has been accepted</p>';
					}else if($exe_data[0]['o_replace_status']==2){
						$rp_status='<p style="color:orange">Your request for order replace has been rejected</p>';
					}else{
						$rp_status='';
					}
				}
				if($exe_data[0]['o_status']==5){
					if($exe_data[0]['o_return_status']==0){
						$rp_status='<p style="color:orange">Your request for order return has been pending</p>';
					}else if($exe_data[0]['o_return_status']==1){
						$rp_status='<p style="color:orange">Your request for order return has been accepted</p>';
					}else if($exe_data[0]['o_return_status']==2){
						$rp_status='<p style="color:orange">Your request for order return has been rejected</p>';
					}else{
						$rp_status='';
					}
				}
				$html.='<div class="card-body">
							<div class="row invoive-info">
								<div class="col-md-4 col-xs-12 invoice-client-info">
									<h6>Client Information :</h6>
									<h6 class="m-0">'.$exe_data[0]['o_name'].'</h6>
									<p class="m-0 m-t-10">'.$exe_data[0]['o_address'].', <br>'.$exe_data[0]['o_address1'].', <br>'.$exe_data[0]['o_town'].', '.$exe_data[0]['o_state'].', '.$exe_data[0]['o_postcode'].'</p>
									<p class="m-0">'.$exe_data[0]['o_phone'].'</p>
									<p>'.$exe_data[0]['o_email'].'</p>
								</div>
								<div class="col-md-4 col-sm-6">
									<h6>Order Information :</h6>
									<table class="table table-responsive invoice-table invoice-order table-borderless">
										<tbody>
											<tr>
												<th>Date :</th>
												<td>'.date('F d, Y',strtotime($exe_data[0]['o_date'])).'</td>
											</tr>
											<tr>
												<th>Status :</th>
												<td>
													'.$o_status.'
													
												</td>
											</tr>
											<tr>
												<th>Id :</th>
												<td>
													#'.$exe_data[0]['o_id'].'
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-4 col-sm-6">
									<h6 class="m-b-20">Invoice Number :- <span>'.$exe_data[0]['o_invoice_no'].'</span></h6>
									<h6 class="text-uppercase text-primary">Payment Mode :
										<span>'.$o_type.'</span>
									</h6>';
									if($exe_data[0]['o_type']==1){
										$html.='<p><b>Payment Status :-</b> '.$pay_status.'</p>';
									}
								$html.='</div>
							</div>
							<div class="row">
								<div class="col-sm-12">'.$rp_status.'
									<div class="table-responsive">
										<table class="table invoice-detail-table">
											<thead>
												<tr class="thead-default">
													<th>Description<br>Size - Color</th>
													<th>Quantity</th>
													<th>Amount</th>
													<th>Total</th>
													<th>Review/Rating</th>
												</tr>
											</thead>
											<tbody>';
												$this->db->where('oi_order_id',$id);
												$this->db->from('tbl_order_item');						
												$getusr=$this->db->get(); 
												$OrdData=$getusr->result_array();
												foreach($OrdData as $dt){
													$this->db->where('tr_product_id',$dt["oi_product_id"]);
													$this->db->where('tr_order_id',$dt["oi_order_id"]);
													$exe_review=$this->db->get('tbl_review');
													$data_review=$exe_review->result_array();
													if($dt["oi_size"]!='Regular'){
														$size_color=$dt["oi_size"].' - '.$dt["oi_color"];
													}else{
														$size_color="Regular";
													}
													$gst_amount=$dt['oi_gst_amount']/$dt["oi_qty"];
													
													if($dt['oi_gst_type']==1){
														$amount=$dt['oi_mrp'];
														
													}else{
														$amount=$dt['oi_mrp']-$dt['oi_gst_amount'];
													}
													$html.='<tr>
														<td>
															<h6>'.$dt["oi_product_name"].'</h6>
															<p class="m-0">'.$size_color.'</p>
														</td>
														<td>'.$dt["oi_qty"].'</td>
														<td>₹ '.$amount/$dt["oi_qty"].'</td>
														<td>₹ '.$amount.'</td>
														<td>';
														if(empty($data_review)){
															$html.='<button type="button" data-toggle="modal" data-target="#reviewmodal" class="btn btn-xs btn-black pull-right" pname="'.$dt["oi_product_name"].'" onclick="GetReviewDetail('.$dt["oi_product_id"].','.$dt["oi_order_id"].','.$exe_data[0]['o_cust_id'].',this)">Give</button>';
														}else{
															$html.='Review Given';
														}
														$html.='</td>
													</tr>';
												}
											$html.='</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="row" style="float: right;">
								<div class="col-sm-12">
									<table class="table table-responsive invoice-table invoice-total">
										<tbody>
											<tr>
												<th>Sub Total :</th>
												<td>₹ '.$exe_data[0]['o_sub_total'].'</td>
											</tr>
											<tr>
												<th>Taxes (0%) :</th>
												<td>₹ '.$exe_data[0]['o_tax'].'</td>
											</tr>
											<tr>
												<th>Shipping Charge :</th>
												<td>₹ '.$exe_data[0]['o_shipping_charge'].'</td>
											</tr>
											<tr class="text-info">
												<td>
													<hr />
													<h5 class="text-primary m-r-10">Total :</h5>
												</td>
												<td>
													<hr />
													<h5 class="text-primary">₹ '.$exe_data[0]['o_grand_total'].'</h5>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>';
			}else{
				$html.='<h4 align="center"> Order detail not avalible! </h4>';
			}				
		}else{
			$html.='<h4  align="center"> Unknown request! </h4>';
		}
		echo $html;
	}
	public function OrderRRC(){
		$id = $this->input->post('ord_id');
		$html='';
		if($id > 0)
		{
			$this->db->where('o_id',$id);
			$this->db->from('tbl_order');						
			$exe=$this->db->get(); 
			$exe_data=$exe->result_array();
			if(!empty($exe_data)){
				if($exe_data[0]['o_status']==0){
					$o_status='Pending';
				}else if($exe_data[0]['o_status']==1){
					$o_status='Dispatched';
				}else if($exe_data[0]['o_status']==2){
					$o_status='Delivered';
				}else if($exe_data[0]['o_status']==3){
					$o_status='Cancelled';
				}else if($exe_data[0]['o_status']==4){
					$o_status='Replace';
				}else if($exe_data[0]['o_status']==5){
					$o_status='Return';
				}else{
					$o_status='N/A';
				}
				if($exe_data[0]['o_type']==1){
					$o_type='Paytm';
				}else{
					$o_type='COD';
				}
				if($exe_data[0]['o_payment_status']==1){
					$pay_status='Paid';
				}else{
					$pay_status='Due';
				}
				$html.='<div class="card-body">';
							
							$html.='<form action="'.base_url("Cart/UpdateOrderStatus").'" method="post" enctype="multipart/form-data">
									<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table class="table invoice-detail-table">
											<thead>
												<tr class="thead-default">
													<th>Select For<br>Return/Replace</th>
													<th>Name</th>
													<th>Size</th>
													<th>Color</th>
													<th>Quantity</th>
													<th>Amount</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>';
												
												$this->db->where('oi_order_id',$id);
												$this->db->from('tbl_order_item');						
												$getusr=$this->db->get(); 
												$OrdData=$getusr->result_array();
												
												foreach($OrdData as $dt){
													$Color=$this->ProductColor($dt["oi_product_id"],$dt["oi_size_id"]);
													$Size=$this->ProductSizes($dt["oi_product_id"]);
													
													$ProductPrice=$this->GetProductPrice($dt['oi_color_id'],$dt["oi_product_id"],$dt["oi_size_id"]);
													
													$gst_amount=$dt['oi_gst_amount']/$dt["oi_qty"];
													
													if($dt['oi_gst_type']==1){
														$amount=$dt['oi_mrp'];
													}else{
														$amount=$dt['oi_mrp']-$dt['oi_gst_amount'];
													}
													
													$html.='<tr>
														<td><input name="pro_chk'.$dt['oi_id'].'" type="checkbox"></td>
														<td><h6>'.$dt["oi_product_name"].'</h6></td>
														<td>
														<select class="selectsize" name="select_size[]" id="select-size'.$dt['oi_id'].'" onchange="getColors(this.value,'.$dt['oi_product_id'].','.$dt['oi_id'].')">
														<option value="0">Select Size</option>
														';
														
														foreach($Size as $sz){
															
															if($sz['tsm_id']!=''){
																if($sz['tsm_id']==$dt['oi_size_id']){
																	$size_slt='selected="selected"';
																}else{
																	$size_slt='';
																}
																$html.='<option '.$size_slt.' value="'.$sz['tsm_id'].'">'.$sz['tsm_size'].'</option>';
															}
														} 
														
														$html.='</select></td>';
														$html.='<td>
														<select class="selectcolor" name="select_color[]" id="select-color'.$dt['oi_id'].'" onchange="getPrice(this.value,'.$dt['oi_product_id'].','.$dt['oi_id'].','.$dt['oi_qty'].')">
														<option value="0">Select Color</option>';
														if(!empty($Color)){
														foreach($Color as $cl){
															
															if($cl['tclr_id']!=''){
																if($cl['tclr_id']==$dt['oi_color_id']){
																	$color_slt='selected="selected"';
																}else{
																	$color_slt='';
																}
																$html.='<option '.$color_slt.' value="'.$cl['tclr_id'].'">'.$cl['tclr_title'].'</option>';
															}
														} }
														$html.='</select></td>
														<td>'.$dt["oi_qty"].'</td>
														<td>₹ <span id="pro_price'.$dt['oi_id'].'">'.$ProductPrice['product_price'].'</span></td>
														<td>₹ <span id="product_final_price'.$dt['oi_id'].'">'.$ProductPrice['final_price']*$dt["oi_qty"].'</span></td>
														<input type="hidden" name="oi_id[]" value="'.$dt['oi_id'].'">
													</tr>';
												
												}
												
											$html.='</tbody>
										</table>
									</div>
								</div>
							</div>';
							$html.='<div class="row" style="float: right;">
								<div class="col-sm-12">
								
								<div class="col-md-12 col-sm-12">
									<h6>Order Status :</h6>
										<div style="margin-bottom: 10px;">
											<input type="hidden" name="order_id" value="'.$id.'">
												<select name="order_status" class="form-control" onchange="SetOrderStatusReason(this.value)">
													<option value="0">Change Status</option>';
													if($exe_data[0]['o_status']==0){
														$html.='<option value="3">Cancel</option>';
													}else if($exe_data[0]['o_status']==1){
														$html.='<option value="3">Cancel</option>';
														$html.='<option value="5">Return</option>';
													}else if($exe_data[0]['o_status']==2){
														$html.='<option value="4">Replace</option>';
														$html.='<option value="5">Return</option>';
													}
												$html.='</select></div><div style="margin-bottom: 10px;">
												<select name="order_status_reason" id="order_status_reason" class="form-control">
													<option value="0">Select Reason</option>
												</select></div>
												<div style="margin-bottom: 10px;">
													<input type="file" name="order_file[]" multiple>
												</div>
												<div style="margin-bottom: 10px;">
													<textarea class="form-control" name="additional_msg" placeholder="Additional Message"></textarea>
												</div>
												<div style="margin-bottom: 10px;">
													<button class="btn btn-xs btn-black pull-right" type="submit">Save</button>
												</div>
										</div>
								</form>
							</div>
							</div>
						</div>';
						
						
			}else{
				$html.='<h4 align="center"> Order detail not avalible! </h4>';
			}				
		}else{
			$html.='<h4  align="center"> Unknown request! </h4>';
		}
		echo $html;
		
	}
	public function UpdateOrderStatus(){
		$order_status=$this->input->post('order_status');
		$order_status_reason=$this->input->post('order_status_reason');
		$additional_msg=$this->input->post('additional_msg');
		$order_id=$this->input->post('order_id');
		$select_color=$this->input->post('select_color');
		$select_size=$this->input->post('select_size');
		$oi_id=$this->input->post('oi_id');
		
		if($order_status>0){
			
			for($i=0;$i<sizeof($select_color);$i++){
				if($this->input->post("pro_chk".$oi_id[$i])){
					if($order_status==4){
						$ups_array=array("oi_replace_status"=>1,"oi_tmp_size_id"=>$select_size[$i],"oi_tmp_color_id"=>$select_color[$i]);
						$this->db->where('oi_id',$oi_id[$i]);
						$this->db->update('tbl_order_item',$ups_array);
					}
					if($order_status==5){
						$ups_array=array("oi_return_status"=>1,"oi_tmp_size_id"=>$select_size[$i],"oi_tmp_color_id"=>$select_color[$i]);
						$this->db->where('oi_id',$oi_id[$i]);
						$this->db->update('tbl_order_item',$ups_array);
					}
				}
			}
			$images=array();
			if(!empty($_FILES['order_file'])){
				$images=$this->upload_files('order', $_FILES['order_file'],$id);
			}
			$up_array=array("o_status"=>$order_status,"o_images"=>implode(',',$images),"o_status_reason"=>$order_status_reason,"o_additional_message"=>$additional_msg);	
			$customer_data=$this->session->userdata('customer_data');
			$customer_mobile=$this->session->userdata('customer_data')[0]['tc_mobile'];
			if($order_status==3){
				$up_array['o_cancel_date']=date('Y-m-d');
				$msg='Return/Refund request for Order ID ('.$order_id.') has been taken. Our logistics partner will pick up the product from the delivery address in 2-3 business days. Please keep the product ready with invoice. We will process refund amount within 48 hours of pickup. We will inform you by Email/SMS once we have transferred the refund amount.';
				
				$this->send_sms($customer_mobile,$msg);
			}else if($order_status==4){
				$up_array['o_replace_date']=date('Y-m-d');
				$msg='Replacement request for Order ID ('.$order_id.') has been taken. Our logistics partner will pick up the product from the delivery address in 2-3 business days. Please keep the product ready with invoice. We will process new order within 24 hours of pickup. We will inform you by Email/SMS once we have placed new order as per your request.';
				$this->send_sms($customer_mobile,$msg);
			}else if($order_status==5){
				$up_array['o_return_date']=date('Y-m-d');
				$msg='Cancel request for Order ID ('.$order_id.') has been taken. We understand your reason for cancellation of order. Hope you will soon shop on Sparkling Beauty. Happy Shopping. Thank you.';
				$this->send_sms($customer_mobile,$msg);
			}
			
			$this->db->where('o_id',$order_id);
			$this->db->update('tbl_order',$up_array);
		}
		
		redirect(base_url('my-orders'));
	}
	public function ProductSize($id=0){
		$this->db->where('tpd_product_id',$id);
		$this->db->order_by('tpd_id','asc');
		$exe_size=$this->db->get('tbl_product_data');
		return $exe_size->result_array();
	}
	public function ProductSizes($id=0){
		$this->db->join("tbl_size_master","tbl_size_master.tsm_id=tbl_product_data.tpd_size_master_id",'left');
		$this->db->where('tpd_product_id',$id);
		$this->db->group_by('tsm_id');
		$exe_size=$this->db->get('tbl_product_data');
		return $exe_size->result_array();
	}
	public function ProductColor($prod=0,$size=0){
		$this->db->join("tbl_color","tbl_color.tclr_id=tbl_product_data.tpd_color_id",'left');
		$this->db->where('tpd_size_master_id',$size);
		$this->db->where('tpd_product_id',$prod);
		$this->db->group_by('tclr_id');
		$exe_size=$this->db->get('tbl_product_data');
		return $exe_size->result_array();
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
	public function GetProductPrice($color=0,$product=0,$size=0){
		
		$this->db->where('tpd_color_id',$color);
		$this->db->where('tpd_size_master_id',$size);
		$this->db->where('tpd_product_id',$product);
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
		return $response;
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
	public function AddReview(){
		$rating=$this->input->post('rating');
		$comment=$this->input->post('comment');
		$r_order_id=$this->input->post('r_order_id');
		$r_product_id=$this->input->post('r_product_id');
		$r_user_id=$this->input->post('r_user_id');
		$in_array=array(
						"tr_product_id"=>$r_product_id,
						"tr_user_id"=>$r_user_id,
						"tr_order_id"=>$r_order_id,
						"tr_rating"=>$rating,
						"tr_review"=>$comment,
						"tr_date"=>date('Y-m-d')
						);
		$this->db->update('tbl_review',$in_array);
		
		redirect(base_url('my-orders'));
	}
	
	public function send_sms($mobile,$msg){
			
		$username = "askme@promotial.in";
		$hash = "b3f915bb00d8c0e03b959d4387f29d35dcb94e4a1ebb1bb54cec491c371a2130";
		$test = "0";
		$sender = "TXTLCL"; 
		$numbers = "91".$mobile;
		$message =$msg;
		$message = urlencode($message);
		$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
		$ch = curl_init('http://api.textlocal.in/send/?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); 
		curl_close($ch);
		/*  echo $result;  */
	}
	private function upload_files($title, $files,$ids)
    {
        $config = array(
            'upload_path'   => 'uploads/order/',
            'allowed_types' => 'jpg|gif|png|jpeg',
            'overwrite'     => 1,                       
        );
        $this->load->library('upload', $config);
        $images = array();
        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName =$title .'_'. $image;
            $config['file_name'] =  str_replace(',','',$fileName);

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
               echo $this->upload->display_errors(); 
            }
			$images[] = $this->upload->data()['file_name'];
        }
        return $images;
    }
}
?>