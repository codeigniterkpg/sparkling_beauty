<?php include("header.php");?>



 <!-- Page Content Wraper -->

        <div class="page-content-wraper">

            <!-- Bread Crumb -->

            <section class="breadcrumb">

                <div class="container">

                    <div class="row">

                        <div class="col-12">

                            <nav class="breadcrumb-link">

                                <a href="<?php echo base_url();?>">Home</a>

                                <span>My Account</span>

                            </nav>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Bread Crumb -->



            <!-- Page Content -->

            <section class="content-page">

                <div class="container">

                    <div class="row">

                        

                        
                        <div class="col-sm-12">

                            <article class="post-8">

                                <form class="cart-form" action="#" method="post">
									<h2 class="normal"><span>My Orders</span></h2>
                                    <div class="cart-product-table-wrap responsive-table table-bordered">

                                        <table>

                                            <thead>

                                                <tr>

                                                   

                                                    <th class="product-name">Srno.</th>

                                                    <th class="product-name">OrderID</th>

                                                    <th class="product-name">Date</th>
                                                    <th class="product-name">Paymode</th>
                                                    <th class="product-name">Order Status</th>

                                                    <th class="product-subtotal">Amount</th>
                                                    <th class="product-subtotal">Detail</th>
                                                    <th class="product-subtotal">Action</th>

                                                </tr>

                                            </thead>

                                            <tbody>

												<?php $i=1;foreach($Orders as $pro){
													if($pro['o_status']==0){
															$o_status='Pending';
														}else if($pro['o_status']==1){
															$o_status='Dispatched';
														}else if($pro['o_status']==2){
															$o_status='Delivered';
														}else if($pro['o_status']==3){
															$o_status='Cancelled';
														}else if($pro['o_status']==4){
															$o_status='Replace';
														}else if($pro['o_status']==5){
															$o_status='Return';
														}else if($pro['o_status']==6){
															$o_status='Replaced';
														}else if($pro['o_status']==7){
															$o_status='Returned';
														}else{
															$o_status='N/A';
														}
														if($pro['o_type']==1){
															$o_type='Paytm';
														}else{
															$o_type='COD';
														}
														if($pro['o_payment_status']==1){
															$pay_status='Paid';
														}else{
															$pay_status='Due';
														}
													
													?>

                                                <tr>

                                                    <td class="product-name">

                                                        <?php echo $i;?>

                                                    </td>

													<td class="product-name">

														<?php echo $pro['o_id'];?>

                                                    </td>

													<td class="product-name">

														<?php echo date('d-m-Y',strtotime($pro['o_date']));?>

                                                    </td>
													<td class="product-name">

														<?php echo $o_type;?>

                                                    </td>
													<td class="product-name">

														<?php echo $o_status;?>

                                                    </td>
													
                                                    <td class="product-price">

                                                        <span class="product-price-amount amount"><span class="currency-sign">₹</span><?php echo $pro['o_grand_total'];?></span>

                                                    </td>
													<td><button class="btn btn-xs btn-black pull-right " type="button" data-toggle="modal" data-target="#largesizemodal" onclick="GetSelectOrddetail('<?php echo $pro['o_id'];?>')">View / Review/ Rating</button></td>
													<td>
													<?php if($pro['o_status']==0 or $pro['o_status']==1 or $pro['o_status']==2){ ?>
													<button type="button" class="btn btn-xs btn-black pull-right" data-toggle="modal" data-target="#rrmodal" onclick="GetRRCDetail('<?php echo $pro['o_id'];?>')">Return/Replace</button>
													<?php } ?>
													</td>
												</tr>

                                                <?php $i++;} ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </form>

                            </article>

                        </div>

                    </div>

                </div>

            </section>

			

            <!-- End Page Content -->



        </div>

        <!-- End Page Content Wraper -->
		<div class="modal fade" id="rrmodal">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Order Return/Replace/Cancel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <!-- [ Invoice ] start -->
                            <div class="container" id="printTable">
                                <div>
                                    <div class="card" id="dataseta">
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- [ Invoice ] end -->
                        </div>						
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                      </div>
                    </div>
                  </div>
                </div>
		<div class="modal fade" id="largesizemodal">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Order Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <!-- [ Invoice ] start -->
                            <div class="container" id="printTable">
                                <div>
                                    <div class="card" id="dataset">
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- [ Invoice ] end -->
                        </div>						
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                      </div>
                    </div>
                  </div>
                </div>
		<div class="modal fade" id="reviewmodal">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Give Rating & Review For</h5>
						
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
						
                      </div>
                      <div class="modal-body">
						<p id="pro_name"></p>
                        <div class="row">
							<style>
								@font-face {
									font-family: 'Material Icons';
									font-style: normal;
									font-weight: 400;
									src: local('Material Icons'), local('MaterialIcons-Regular'), url(https://fonts.gstatic.com/s/materialicons/v7/2fcrYFNaTjcS6g4U3t-Y5UEw0lE80llgEseQY3FEmqw.woff2) format('woff2'), url(https://fonts.gstatic.com/s/materialicons/v7/2fcrYFNaTjcS6g4U3t-Y5RV6cRhDpPC5P4GCEJpqGoc.woff) format('woff');
								}
								.material-icons {
									font-family: 'Material Icons';
									font-weight: normal;
									font-style: normal;
									font-size: 24px;
									line-height: 1;
									letter-spacing: normal;
									text-transform: none;
									display: inline-block;
									word-wrap: normal;
									color:#4b0082;
									-moz-font-feature-settings: 'liga';
									-moz-osx-font-smoothing: grayscale;
								}
								i {
									cursor :  pointer;
								}
							</style>
                            <!-- [ Invoice ] start -->
                            <div class="container" id="printTable">
                                <div>
									<form action="<?php echo base_url('Cart/AddReview');?>" method="post">
										<div class="form-field-wrapper">             
											<div class="rating"></div>
										</div>
										<div class="form-field-wrapper">
											<label>Your Review <span class="required">*</span></label>
											<textarea id="comment" class="form-full-width" name="comment" cols="45" rows="8" aria-required="true" required=""></textarea>
										</div>
										<input type="hidden" id="r_order_id" name="r_order_id">
										<input type="hidden" id="r_product_id" name="r_product_id">
										<input type="hidden" id="r_user_id" name="r_user_id">
										<input type="submit" class="btn btn-xs btn-black pull-right" value="Submit">
									</form>
                                </div>
                            </div>
                            <!-- [ Invoice ] end -->
                        </div>						
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                      </div>
                    </div>
                  </div>
                </div>

<?php include("footer.php");?>

	<script type="text/javascript" src="<?php echo base_url('front_assets/js');?>/jquery.validate.js"></script>
	<script src="<?php echo base_url('front_assets/js');?>/jquery.star.rating.js"></script>
<script>
function getColors(id,prod,oid){
	showload();
	$.ajax({
	  url: '<?php echo base_url('Cart/GetProdColors');?>',
	  type: "POST",
	  data: {id:id,prod:prod},
	  success: function (response) {
		hideload();
		$("#select-color"+oid).html(response);
		$("#select-color"+oid).niceSelect("update");
		
	  }
    });
}
function getPrice(id,prod,oid,qty){
	showload();
	var sz=$("#select-size"+oid).val();
	$.ajax({
	  url: '<?php echo base_url('Cart/GetProdPrice');?>',
	  type: "POST",
	  dataType: 'json',
	  data: {id:id,prod:prod,sz:sz},
	  success: function (response) {
		hideload();
		$("#product_final_price"+oid).html(response.product_price*qty);
		$("#pro_price"+oid).html(response.final_price);
		$("#price_product").val(response.final_price);
		$("#gst_type").val(response.gst_type);
		$("#gst_perce").val(response.gst_perce);
		$("#gst_amount").val(response.gst_amount);
		$("#product_price").val(response.product_price);
	  }
    });
}
function SetOrderStatusReason(status){
	if(status==3){
		$("#order_status_reason").html("<option value='Out Of Station'>Out Of Station</option><option value='Order Bymistaken'>Order Bymistaken</option><option value='Cash not available'>Cash not available</option><option value='Incorrect Size or Color Selected'>Incorrect Size or Color Selected</option><option value='other'>Other</option>");	
	}else if(status==4){
		$("#order_status_reason").html("<option value='Color Or Design is not the same as shown'>Color Or Design is not the same as shown</option><option value='Material Quality is not good'>Material Quality is not good</option><option value='Incorrect Size'>Incorrect Size</option><option value='Did not Fit'>Did not Fit</option><option value='Missing Product'>Missing Product</option><option value='Wrong Product Delivered'>Wrong Product Delivered</option><option value='Wrong Size Delivered'>Wrong Size Delivered</option><option value='Product is Defective or Damage'>Product is Defective or Damage</option><option value='other'>Other</option>");	
	}else if(status==5){
		$("#order_status_reason").html("<option value='Color Or Design is not the same as shown'>Color Or Design is not the same as shown</option><option value='Material Quality is not good'>Material Quality is not good</option><option value='Incorrect Size'>Incorrect Size</option><option value='Did not Fit'>Did not Fit</option><option value='Missing Product'>Missing Product</option><option value='Wrong Product Delivered'>Wrong Product Delivered</option><option value='Wrong Size Delivered'>Wrong Size Delivered</option><option value='Product is Defective or Damage'>Product is Defective or Damage</option><option value='other'>Other</option>");	
	}
}
	
	 function GetRRCDetail(id)
	{				
		$("#dataseta").html('');
		$.ajax({
		 url:"<?php echo base_url('Cart/OrderRRC');?>",
		 type:"post",
		 data:{'ord_id':id },
		 success:function(data){
			 $("#dataseta").html(data);		
				/* $(".selectsize").niceSelect();
				$(".selectcolor").niceSelect(); */
			}									 
	  });
	}
	 function GetSelectOrddetail(id)
	{				
		$("#dataset").html('');
		$.ajax({
		 url:"<?php echo base_url('Cart/GetOrderdetail');?>",
		 type:"post",
		 data:{'ord_id':id },
		 success:function(data){
			 $("#dataset").html(data);					
			}									 
	  });
	}
	function GetReviewDetail(id,ord_id,user_id,ele){
		
		$("#pro_name").html($(ele).attr("pname"));
		$("#r_order_id").val(ord_id);
		$("#r_product_id").val(id);
		$("#r_user_id").val(user_id);
		$("#largesizemodal").modal("hide");
		$('#comment').val("");
		$('.rating').html("");
		$('.rating').addRating();
	}
	</script>
