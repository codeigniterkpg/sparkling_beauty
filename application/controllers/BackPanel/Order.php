<?php header('Cache-Control: max-age=86400');
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$admin_data=$this->session->userdata('admin_data'); 
		if(empty($admin_data))
		{
			redirect(base_url('BackPanel/Login'));
		}	
		
	}

	public function index()
	{
		$this->db->order_by('o_id','desc');
		$exe=$this->db->get('tbl_order');
		$data['Order']=$exe->result_array();
		$this->load->view('BackPanel/view_order',$data);
	}
	
	public function GetOrderdetailOld()
	{
		$id = $this->input->post('ord_id');
		if($id > 0)
		{
			$this->db->where('oi_order_id',$id);
			$this->db->from('tbl_order_item');						
			$getusr=$this->db->get(); 
			$OrdData=$getusr->result_array();
				if(sizeof($OrdData) != 0)
				{
					$totaldata = sizeof($OrdData);
					  $final_data='';
					  
					  for($i=0; $i < $totaldata; $i++)
					  {
							$final_data.='<tr>';
							$final_data.='<td>'.$OrdData[$i]['oi_product_name'].'</td>';
							$final_data.='<td>'.$OrdData[$i]['oi_size'].'</td>';
							$final_data.='<td>'.$OrdData[$i]['oi_color'].'</td>';
							$final_data.='<td>' . $OrdData[$i]['oi_qty'].'</td>';
							$final_data.='<td>' . $OrdData[$i]['oi_price'].'</td>';
							$final_data.='<td>' . $OrdData[$i]['oi_amount'].'</td>';													
							$final_data.='</tr>';								 								 
					  }
					  
					  echo $final_data;
				
				}
				else
				{
				  echo '<h4  align="center"> No order avalible! </h4>';    
				}				
		}
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
								<div class="col-sm-12">
									<div class="table-responsive">
										<table class="table invoice-detail-table">
											<thead>
												<tr class="thead-default">
													<th>Description<br>Size - Color</th>
													<th>Quantity</th>
													<th>Amount</th>
													<th>Total</th>
													<th>Replace/Return</th>
												</tr>
											</thead>
											<tbody>';
												$this->db->where('oi_order_id',$id);
												$this->db->from('tbl_order_item');						
												$getusr=$this->db->get(); 
												$OrdData=$getusr->result_array();
												foreach($OrdData as $dt){
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
														<td>₹ '.$amount.'</td>';
														$replace="No";
														if($dt['oi_replace_status']==1){
															$replace="Replace";
														}else if($dt['oi_return_status']==1){
															$replace="Return";
														}
														$html.='<td>'.$replace.'</td>';
													$html.='</tr>';
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
						
						if($exe_data[0]['o_status']==4 or $exe_data[0]['o_status']==5){
								$html.='<form action="'.base_url("BackPanel/Order/UpdateOrderStatus").'" method="post" enctype="multipart/form-data"><div class="col-md-12 col-sm-12">
									<h6>This order has been apply for '.$o_status.'</h6>
									<p>Reason :- '.$exe_data[0]['o_status_reason'].'</p>
									<p>Additonal Message :- '.$exe_data[0]['o_additional_message'].'</p>
									';
									if($exe_data[0]['o_images']!=''){
										$images=explode(',',$exe_data[0]['o_images']);
										if(!empty($images)){
											for($i=0;$i<sizeof($images);$i++){
												$html.='<a target="_blank" href="'.base_url("uploads/order/").$images[$i].'"><img src="'.base_url("uploads/order/").$images[$i].'" style="width:100px;height:100px;margin-right:5px"></a>';
											}
										}
									}
										if($exe_data[0]['o_return_status']==0 and $exe_data[0]['o_replace_status']==0){
											$st="";
											$st1="";
										}else if($exe_data[0]['o_return_status']==1 or $exe_data[0]['o_replace_status']==1){
											$st1="selected='selected'";
											$st="";
										}else if($exe_data[0]['o_return_status']==2 or $exe_data[0]['o_replace_status']==2){
											$st="selected='selected'";
											$st1="";
										}
										
											$html.='<div style="margin-top: 10px;margin-bottom: 10px;" class="col-md-4 col-sm-6">
												<input type="hidden" name="order_id" value="'.$id.'">
												<input type="hidden" name="order_status" value="'.$exe_data[0]['o_status'].'">
												<select name="order_status_reason" id="order_status_reason" class="form-control">
													<option value="">Change Status</option>
													<option '.$st1.' value="1">Accept</option>
													<option '.$st.' value="2">Reject</option>
												</select>
											</div>
											<div style="margin-bottom: 10px;">
												<button class="btn btn-primary" type="submit">Save</button>
											</div>';
										
								$html.='</div></form>';
						}
			}else{
				$html.='<h4  align="center"> Order detail not avalible! </h4>';
			}				
		}else{
			$html.='<h4  align="center"> Unknown request! </h4>';
		}
		echo $html;
	}
	public function GetReplaceOrderdetail()
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
				
				$html.='<div class="card-body">
							<form action="'.base_url("BackPanel/Order/PlaceOrder").'" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table class="table invoice-detail-table">
											<thead>
												<tr class="thead-default">
													<th>Description</th>
													<th>Size</th>
													<th>Color</th>
													<th>Quantity</th>
													<th>Amount</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>';
												$where = '(oi_replace_status="1" or oi_return_status = "1")';
												$this->db->where($where);
												$this->db->where('oi_order_id',$id);
												$this->db->from('tbl_order_item');						
												$getusr=$this->db->get(); 
												$OrdData=$getusr->result_array();
												$total=0;
												$sub_total=0;
												$tax=0;
												$shipping=0;
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
														<select class="selectcolor" name="select_color[]" id="select-color'.$dt['oi_id'].'" onchange="getPrice(this.value,'.$dt['oi_product_id'].','.$dt['oi_id'].')">
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
													<input type="hidden" name="product_id[]" id="product_id'.$dt['oi_id'].'" value="'.$dt["oi_product_id"].'">
													<input type="hidden" name="product_name[]" id="product_name'.$dt['oi_id'].'" value="'.$dt["oi_product_name"].'">
													<input type="hidden" name="qty[]" id="qty'.$dt['oi_id'].'" value="'.$dt["oi_qty"].'">
													<input type="hidden" name="price_product[]" id="price_product'.$dt['oi_id'].'" value="'.$ProductPrice['final_price'].'">
													<input type="hidden" name="gst_type[]" id="gst_type'.$dt['oi_id'].'" value="'.$ProductPrice['gst_type'].'">
													<input type="hidden" name="gst_perce[]" id="gst_perce'.$dt['oi_id'].'" value="'.$ProductPrice['gst_perce'].'">
													<input type="hidden" name="gst_amount[]" id="gst_amount'.$dt['oi_id'].'" value="'.$ProductPrice['gst_amount'].'">
													<input type="hidden" name="product_price[]" id="product_price'.$dt['oi_id'].'" value="'.$ProductPrice['product_price'].'">
													<input type="hidden" name="tp_size_category[]" value="'.$dt['oi_size_category'].'">
													</tr>';
												$sub_total=$sub_total+($ProductPrice['product_price']*$dt["oi_qty"]);
												$tax=$tax+$ProductPrice['gst_amount'];
												 $this->db->where('tp_id',$dt['oi_product_id']);
												 $pro_exe=$this->db->get('tbl_product');
												 $pro_data=$pro_exe->result_array();
												 if(!empty($pro_data)){
													 if($pro_data[0]['tp_shipping_type']==1){
														$shipping=$shipping+($pro_data[0]['tp_shipping_amount']*$dt['oi_qty']);
													 }
												 }
												
												}
												if($exe_data[0]['o_status']==4){
													$o_status=6;
												}else if($exe_data[0]['o_status']==5){
													$o_status=7;
												}else{
													$o_status=$exe_data[0]['o_status'];
												}
											$html.='<input type="hidden" name="total" value="'.($sub_total+$tax+$shipping).'">
													<input type="hidden" name="sub_total" value="'.$sub_total.'">
													<input type="hidden" name="tax" value="'.$tax.'">
													<input type="hidden" name="discount" value="0">
													<input type="hidden" name="shipping" value="'.$shipping.'">
													<input type="hidden" name="o_cust_id" value="'.$exe_data[0]['o_cust_id'].'">
													<input type="hidden" name="tca_name" value="'.$exe_data[0]['o_name'].'">
													<input type="hidden" name="tca_phone" value="'.$exe_data[0]['o_phone'].'">
													<input type="hidden" name="tca_email" value="'.$exe_data[0]['o_email'].'">
													<input type="hidden" name="tca_street_address" value="'.$exe_data[0]['o_address'].'">
													<input type="hidden" name="tca_street_address1" value="'.$exe_data[0]['o_address1'].'">
													<input type="hidden" name="tca_company_name" value="'.$exe_data[0]['o_company_name'].'">
													<input type="hidden" name="tca_town" value="'.$exe_data[0]['o_town'].'">
													<input type="hidden" name="tca_state" value="'.$exe_data[0]['o_state'].'">
													<input type="hidden" name="tca_postcode" value="'.$exe_data[0]['o_postcode'].'">
													<input type="hidden" name="o_status" value="'.$o_status.'">
													</tbody>
										</table>
										<div style="margin-bottom: 10px;">
												<button class="btn btn-success" type="submit">Place Order</button>
											</div>
									</div>
								</div>
							</div>
							
						</div></form>';
						
			}else{
				$html.='<h4  align="center"> Order detail not avalible! </h4>';
			}				
		}else{
			$html.='<h4  align="center"> Unknown request! </h4>';
		}
		echo $html;
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
	public function PlaceOrder()
	{
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
			
			$insert_data["o_status"]=$this->input->post('o_status');
			$insert_data["o_cust_id"]=$this->input->post('o_cust_id');
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
			$product_id=$this->input->post('product_id');
			$product_name=$this->input->post('product_name');
			$qty=$this->input->post('qty');
			$price_product=$this->input->post('price_product');
			$gst_type=$this->input->post('gst_type');
			$gst_perce=$this->input->post('gst_perce');
			$gst_amount=$this->input->post('gst_amount');
			$product_price=$this->input->post('product_price');
			$tp_size_category=$this->input->post('tp_size_category');
			$select_color=$this->input->post('select_color');
			$select_size=$this->input->post('select_size');
			if($save_order){
				for($i=0;$i<sizeof($select_size);$i++){
					$this->db->where('tsm_id',$select_size[$i]);
					$size_exe=$this->db->get('tbl_size_master');
					$size_data=$size_exe->result_array();
					
					$this->db->where('tclr_id',$select_color[$i]);
					$color_exe=$this->db->get('tbl_color');
					$color_data=$color_exe->result_array();
					
					if(!empty($size_data)){
						$size=$size_data[0]['tsm_size'];
					}else{
						$size="Regular";
					}
					if(!empty($color_data)){
						$color=$color_data[0]['tclr_title'];
					}else{
						$color="Regular";
					}
					$mrp=$product_price[$i]*$qty[$i];
					$price=$price_product[$i]*$qty[$i];
					$order_data=array(
							"oi_order_id"=>$insert_id,
							"oi_product_id"=>$product_id[$i],
							"oi_product_name"=>$product_name[$i],
							"oi_size_category"=>$tp_size_category[$i],
							"oi_size"=>$size,
							"oi_color"=>$color,
							"oi_size_id"=>$select_size[$i],
							"oi_color_id"=>$select_color[$i],
							"oi_qty"=>$qty[$i],
							"oi_gst_type"=>$gst_type[$i],
							"oi_gst_perce"=>$gst_perce[$i],
							"oi_gst_amount"=>$gst_amount[$i],
							"oi_mrp"=>$mrp,
							"oi_price"=>$price_product[$i],
							"oi_amount"=>$price
					);
					$save_order_item=$this->db->insert('tbl_order_item',$order_data);
				}
				echo "<script>alert('Your order has been placed successfully.');window.location='".base_url("BackPanel/Order")."'</script>";
			}else{
				echo "<script>alert('Unable to place your order.');window.location='".base_url("BackPanel/Order")."'</script>";
			}
		
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
	public function changeStatus()
	{
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		$update_data=array("o_status"=>$status);
		if($status==2){
			$update_data['o_payment_status']=1;
		}
		$this->db->where('o_id',$id);
		$exe=$this->db->update('tbl_order',$update_data);
		if($exe){
			echo 1;
			$this->db->select("tbl_customer.tc_name,tbl_customer.tc_mobile");	
			$this->db->join("tbl_customer","tbl_customer.tc_id=tbl_order.o_cust_id");	
			$this->db->where('o_id',$id);
			$ex=$this->db->get('tbl_order');
			$ex_data=$ex->result_array();
			if(!empty($ex_data)){
				if($status==2){
					$msg='Hello '.$ex_data[0]['tc_name'].', Delivery Successful of order (#'.$id.'), thanks for shopping with Sparkling Beauty. We hope you have a lovely day and stay tuned.';
					$this->send_sms($ex_data[0]['tc_mobile'],$msg);
				}else if($status==3){
					$msg='Hello '.$ex_data[0]['tc_name'].', Your order (#'.$id.') has been cancelled. Sparkling Beauty.';
					$this->send_sms($ex_data[0]['tc_mobile'],$msg);
				}
			}
		}else{
			echo 0;
		}
	}
	public function SaveTrackingDetail()
	{
		$cname=$this->input->post('cname');
		$tcode=$this->input->post('tcode');
		$ord_id=$this->input->post('ord_id');
		$update_data=array("o_courier_name"=>$cname,"o_tracking_code"=>$tcode,"o_status"=>1);
		$this->db->where('o_id',$ord_id);
		$exe=$this->db->update('tbl_order',$update_data);
		$this->db->select("tbl_customer.tc_name,tbl_customer.tc_mobile");	
		$this->db->join("tbl_customer","tbl_customer.tc_id=tbl_order.o_cust_id");	
		$this->db->where('o_id',$ord_id);
		$ex=$this->db->get('tbl_order');
		$ex_data=$ex->result_array();
		if(!empty($ex_data)){
			$msg='Hello '.$ex_data[0]['tc_name'].',We have shipped your order (#'.$ord_id.'). Here is your parcel tracking code '.$tcode.'.You can track your shipment at '.$cname.'. Sparkling Beauty.';
			$this->send_sms($ex_data[0]['tc_mobile'],$msg);
		}
		redirect(base_url('BackPanel/Order')); 
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
	public function UpdateOrderStatus(){
		$order_status=$this->input->post('order_status');
		$order_id=$this->input->post('order_id');
		$order_status_reason=$this->input->post('order_status_reason');
		$up_array=array();
		if($order_status_reason!=''){
			if($order_status==4){
				$up_array['o_replace_status']=$order_status_reason;
				if($order_status_reason==1){
					$up_array['o_status']=6;
				}
			}else if($order_status==5){
				$up_array['o_return_status']=$order_status_reason;
				if($order_status_reason==1){
					$up_array['o_status']=7;
				}
			}
			$this->db->where('o_id',$order_id);
			$exe=$this->db->update('tbl_order',$up_array);
			if($exe){
				if($order_status==4 and $order_status_reason==1){
					$where = '(oi_replace_status="1" or oi_return_status = "1")';
					$this->db->where($where);
					$this->db->where('oi_order_id',$order_id);
					$this->db->from('tbl_order_item');						
					$getusr=$this->db->get(); 
					$OrdData=$getusr->result_array();
					$total=0;
					foreach($OrdData as $od){
						if($od['oi_gst_type']==1){
							$total=$total+$od['oi_mrp'];
						}else{
							$total=$total+($od['oi_mrp']-$od['oi_gst_amount']);
						}
					}
					
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
					
					$this->db->where('o_id',$order_id);
					$exe_ord=$this->db->get('tbl_order');
					$data_ord=$exe_ord->result_array();
					if(!empty($data_ord)){
						$insert_data["o_status"]=0;
						$insert_data["o_cust_id"]=$data_ord[0]['o_cust_id'];
						$insert_data["o_discount_amount"]=0;
						$insert_data["o_shipping_charge"]=0;
						$insert_data["o_sub_total"]=$total;
						$insert_data["o_tax"]=0;
						$insert_data["o_grand_total"]=$total;
						$insert_data["o_date"]=date('Y-m-d');
						$insert_data["o_name"]=$data_ord[0]['o_name'];
						$insert_data["o_phone"]=$data_ord[0]['o_phone'];
						$insert_data["o_email"]=$data_ord[0]['o_email'];
						$insert_data["o_address"]=$data_ord[0]['o_address'];
						$insert_data["o_address1"]=$data_ord[0]['o_address1'];
						$insert_data["o_company_name"]=$data_ord[0]['o_company_name'];
						$insert_data["o_town"]=$data_ord[0]['o_town'];
						$insert_data["o_state"]=$data_ord[0]['o_state'];
						$insert_data["o_postcode"]=$data_ord[0]['o_postcode'];
						$insert_data["o_type"]=$data_ord[0]['o_type'];
						$insert_data["o_payment_status"]=1;
						$save_order=$this->db->insert('tbl_order',$insert_data);
						$insert_id = $this->db->insert_id();
						if($save_order){
							$i=0;
							$order_data=array();
							foreach($OrdData as $od){
								$this->db->where('tsm_id',$od['oi_tmp_size_id']);
								$exe_size=$this->db->get('tbl_size_master');
								$data_size=$exe_size->result_array();
								if(!empty($data_size)){
									$size_name=$data_size[0]['tsm_size'];
								}else{
									$size_name='Regular';
								}
								
								$this->db->where('tclr_id',$od['oi_tmp_color_id']);
								$exe_cl=$this->db->get('tbl_color');
								$data_cl=$exe_cl->result_array();
								if(!empty($data_cl)){
									$color_name=$data_cl[0]['tclr_title'];
								}else{
									$color_name='Regular';
								}
								$order_data[$i]['oi_order_id']=$insert_id;
								$order_data[$i]['oi_product_id']=$od['oi_product_id'];
								$order_data[$i]['oi_product_name']=$od['oi_product_name'];
								$order_data[$i]['oi_size_category']=$od['oi_size_category'];
								$order_data[$i]['oi_size']=$size_name;
								$order_data[$i]['oi_color']=$color_name;
								$order_data[$i]['oi_size_id']=$od['oi_tmp_size_id'];
								$order_data[$i]['oi_color_id']=$od['oi_tmp_color_id'];
								$order_data[$i]['oi_qty']=$od['oi_qty'];
								$order_data[$i]['oi_price']=$od['oi_price'];
								$order_data[$i]['oi_amount']=$od['oi_amount'];
								$order_data[$i]['oi_gst_type']=$od['oi_gst_type'];
								$order_data[$i]['oi_gst_perce']=$od['oi_gst_perce'];
								$order_data[$i]['oi_gst_amount']=$od['oi_gst_amount'];
								$order_data[$i]['oi_mrp']=$od['oi_mrp'];
								$i++;
							}
							$this->db->insert_batch('tbl_order_item', $order_data);
						}
					}
				}
			}
		}
		redirect(base_url('BackPanel/Order'));
	}
}

?>