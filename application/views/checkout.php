<?php include("header.php");?>

 <!-- Page Content Wraper -->
        <div class="page-content-wraper">
            <!-- Bread Crumb -->
            <section class="breadcrumb">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav class="breadcrumb-link">
                                <a href="#">Home</a>
                                <span>Checkout</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bread Crumb -->

            <!-- Page Content -->
            <section class="content-page">
                <div class="container mb-80">
                    <div class="row">
                        <div class="col-sm-12">
                            <article class="post-8">
                                <!--<p class="checkout-info">
                                    Returning customer? <strong><a href="login-register.html">Click here to login</a></strong>
                                </p>
                                <p class="checkout-info">
                                    Have a coupon? <strong><a href="#">Click here to enter your code</a></strong>
                                </p>-->
								<form id="checkout_form" action="<?php echo base_url("Payment_by_paytm/payby_paytm");?>" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Billing details</h3>
                                            <div class="row">
													<h2 class="normal"><span>Address</span></h2>
													<div class="form-field-wrapper">
														<label>Name <span class="required">*</span></label>
														<input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_name']; }else{ echo $Profile[0]['tc_name'];}?>" name="tca_name" placeholder="Enter Your Name" type="text">
													</div>
													<div class="form-field-wrapper">
														<label>Company Name</label>
														<input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_company_name'];}?>" id="tca_company_name" name="tca_company_name" placeholder="Enter Company Name" type="text">
													</div>
													<div class="form-field-wrapper">
														<label>Street Address<span class="required">*</span></label>
														<input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_street_address'];}?>" name="tca_street_address" placeholder="Enter Street Address" type="text">
														<input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_street_address1'];}?>" name="tca_street_address1" placeholder="Enter  Street Address" type="text">
													</div>
													<div class="form-field-wrapper">
														<label>Town / City <span class="required">*</span></label>
														<input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_town'];}?>" id="tca_town" name="tca_town" placeholder="Enter Town / City" type="text">
													</div>
													<div class="form-field-wrapper">
														<label>State <span class="required">*</span></label>
														<select name="tca_state" id="tca_state" class="input-md form-full-width" autocomplete="address-level1" data-placeholder="" tabindex="-1" aria-hidden="true" required="" aria-required="true">
															<option selected value="">Select an option...</option>
															<option value="Andhra Pradesh">Andhra Pradesh</option>
															<option value="Arunachal Pradesh">Arunachal Pradesh</option>
															<option value="Assam">Assam</option>
															<option value="Bihar">Bihar</option>
															<option value="Chhattisgarh">Chhattisgarh</option>
															<option value="Goa">Goa</option>
															<option value="Gujarat">Gujarat</option>
															<option value="Haryana">Haryana</option>
															<option value="Himachal Pradesh">Himachal Pradesh</option>
															<option value="Jammu and Kashmir">Jammu and Kashmir</option>
															<option value="Jharkhand">Jharkhand</option>
															<option value="Karnataka">Karnataka</option>
															<option value="Kerala">Kerala</option>
															<option value="Madhya Pradesh">Madhya Pradesh</option>
															<option value="Maharashtra">Maharashtra</option>
															<option value="Manipur">Manipur</option>
															<option value="Meghalaya">Meghalaya</option>
															<option value="Mizoram">Mizoram</option>
															<option value="Nagaland">Nagaland</option>
															<option value="Orissa">Orissa</option>
															<option value="Punjab">Punjab</option>
															<option value="Rajasthan">Rajasthan</option>
															<option value="Sikkim">Sikkim</option>
															<option value="Tamil Nadu">Tamil Nadu</option>
															<option value="Telangana">Telangana</option>
															<option value="Tripura">Tripura</option>
															<option value="Uttarakhand">Uttarakhand</option>
															<option value="Uttar Pradesh">Uttar Pradesh</option>
															<option value="West Bengal">West Bengal</option>
															<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
															<option value="Chandigarh">Chandigarh</option>
															<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
															<option value="Daman and Diu">Daman and Diu</option>
															<option value="Delhi">Delhi</option>
															<option value="Lakshadeep">Lakshadeep</option>
															<option value="Pondicherry">Pondicherry</option>
														</select>
													</div>
													<div class="form-field-wrapper">
														<label>Postcode <span class="required">*</span></label>
														<input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_postcode'];}?>" id="tca_postcode" name="tca_postcode" placeholder="Enter Postcode" type="text">
													</div>
													 <div class="form-field-wrapper">
														<label>Phone<span class="required">*</span></label>
														<input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_phone'];}else{ echo $Profile[0]['tc_mobile'];}?>" name="tca_phone" placeholder="Enter Your Mobile Number" type="text">
													</div>
													<div class="form-field-wrapper">
														<label>Email <span class="required">*</span></label>
														<input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_email'];}else{ echo $Profile[0]['tc_email'];}?>" id="tca_email" name="tca_email" placeholder="Enter Your Email Address" type="email">
													</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-order-review">
                                                <h3>Your order</h3>
                                                <div class="product-checkout-review-order">
                                                    <div class="responsive-table">
                                                        <table class="">
                                                            <thead>
                                                                <tr>
                                                                    <th class="product-name">Product</th>
                                                                    <th class="product-total">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
																<?php $total=0;
																$sub_total=0;
																$tax=0;
																$shipping=0;
																foreach($CartData as $cd){
																	if($cd['cr_gst_type']==1){
																		$amount=$cd['cr_mrp'];
																		
																	}else{
																		$amount=$cd['cr_mrp']-$cd['cr_gst_amount'];
																	}
																	?>
                                                                <tr class="cart_item">
                                                                    <td class="product-name"><?php echo $cd['tp_name'];?><strong> x <?php echo $cd['cr_qty'];?></strong></td>
                                                                    <td class="product-total">
                                                                        <span class="product-price-amount amount"><span class="currency-sign">₹</span><?php echo $amount;?></span>
                                                                    </td>
                                                                </tr>
                                                                 <?php 
																 if($cd['tp_shipping_type']==1){
																	 $shipping=$shipping+($cd['tp_shipping_amount']*$cd['cr_qty']);
																 }
																 $total=$total+$cd['cr_amount'];
																 $sub_total=$sub_total+$amount;
																 $tax=$tax+$cd['cr_gst_amount'];
																 } ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr class="cart-subtotal">
                                                                    <th>Subtotal</th>
                                                                    <td>
                                                                        <strong><span class="product-price-amount amount"><span class="currency-sign">₹</span><?php echo $sub_total;?></span></strong>
                                                                    </td>
                                                                </tr>
																<tr class="cart-subtotal">
                                                                    <th>GST</th>
                                                                    <td>
                                                                        <strong><span class="product-price-amount amount"><span class="currency-sign">₹</span><?php echo $tax;?></span></strong>
                                                                    </td>
                                                                </tr>
																<tr class="shipping">
                                                                    <th>Shipping</th>
                                                                    <td>
                                                                        <ul id="shipping_method">
                                                                            
                                                                            <li>
                                                                                <label for="shipping_method_0_legacy_free_shipping"><?php echo $shipping;?></label>
                                                                            </li>
                                                                          
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                <tr class="order-total">
                                                                    <th>Total</th>
                                                                    <td>
                                                                        <span class="product-price-amount amount"><span class="currency-sign">₹</span><?php echo $total+$shipping;?></span>
																		<input type="hidden" name="total" value="<?php echo $total+$shipping;?>">
																		<input type="hidden" name="sub_total" value="<?php echo $sub_total;?>">
																		<input type="hidden" name="tax" value="<?php echo $tax;?>">
																		<input type="hidden" name="discount" value="0">
																		<input type="hidden" name="shipping" value="<?php echo $shipping;?>">
																	</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                    <div class="product-checkout-payment">
                                                       <!--<ul>
                                                            <li>
                                                                
                                                                <div class="payment_box payment_method_bacs">
                                                                    <p>Payment Mode</p>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <input checked id="payment_method_cheque" name="payment_method" value="cod" type="radio" />
                                                                <label for="payment_method_cheque">COD</label>
                                                            </li>
                                                            <li>

                                                                <label for="payment_method_cod">Paytm</label>
                                                            </li>
                                                            
                                                        </ul>-->
                                                        <input  id="payment_method_cod" name="payment_method" value="paytm" type="hidden" />
                                                        <div class="place-order">
                                                            <button class="btn btn-lg btn-color form-full-width" type="submit" value="<?php echo ($total+$shipping);?>" style="font-weight: 700">Pay <i class="fa fa-rupee"></i> <?php echo ($total+$shipping);?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
<?php include("footer.php");?>
	<script type="text/javascript" src="<?php echo base_url('front_assets/js');?>/jquery.validate.js"></script>
<script>
<?php if(isset($Address[0])){ ?>
$("#tca_state").val('<?php echo $Address[0]['tca_state'];?>');

<?php } ?>
$( document ).ready( function () {
			var $form = $(this);
			$.validator.setDefaults( {
				
			} );
			$( "#checkout_form" ).validate( {
				rules: {
					tca_name: {
						required: true,
						minlength: 5
					},
					tca_street_address: {required: true,},
					tca_street_address1: {required: true,},
					tca_town: {required: true,},
					tca_state: {required: true,},
					tca_email: {
						required: true,
						email: true
					},
					tca_phone: {
						required: true,
						number: true,
                        minlength: 10,
                        maxlength: 10
					},
					tca_postcode: {
						required: true,
						number: true
					}
				},
				
				submitHandler: function (form) {
                    showload();

					$.ajax({
						url: '<?php echo base_url('Cart/GenerateOrderID');?>',
						type: "POST",
						data: $("#checkout_form").serialize(),
						dataType: 'json',
						success: function (response) {
							if (response.status == true) {
								hideload();
								toast_msg('Success',response.message,'success');
                                form.submit();
							} else {
								hideload();
								toast_msg('Error',response.message,'error');
							}
							
						}
					});
                },
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}
			} );
		} );
</script>