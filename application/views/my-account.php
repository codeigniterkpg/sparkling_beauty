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
                        <div class="col-md-6">
                            <div class="form-border-box">
                               <form id="user_form" action="" method="post">
                                    <h2 class="normal"><span>Profile</span></h2>
                                    <div class="form-field-wrapper">
                                        <label>Name <span class="required">*</span></label>
                                        <input class="input-md form-full-width" value="<?php echo $Profile[0]['tc_name'];?>" name="uname" placeholder="Enter Your Name" type="text">
                                    </div>
                                       <div class="form-field-wrapper">
                                        <label>Email <span class="required">*</span></label>
                                        <input readonly class="input-md form-full-width" value="<?php echo $Profile[0]['tc_email'];?>" id="email" name="email" placeholder="Enter Your Email Address" type="email">
                                    </div>
                                       <div class="form-field-wrapper">
                                        <label>Mobile Number <span class="required">*</span></label>
                                        <input class="input-md form-full-width" value="<?php echo $Profile[0]['tc_mobile'];?>" name="mobile" placeholder="Enter Your Mobile Number" type="text">
                                    </div>

                                   <div class="form-field-wrapper">
                                       <label>Whats App Number<span class="required">*</span></label>
                                       <input class="input-md form-full-width" value="<?php echo $Profile[0]['tc_whats_app_number'];?>" name="whats_app_number" placeholder="Enter Your Whats App Number" type="text">
                                   </div>
									<div class="form-field-wrapper">
                                        <input name="submit" id="submit1" class="submit btn btn-md btn-color" value="Update" type="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-border-box">
                               <form id="address_form" action="" method="post">
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
                                        <label>Street Address 1 <span class="required">*</span></label>
                                        <input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_street_address'];}?>" name="tca_street_address" placeholder="Enter Street Address Line 1" type="text">
                                        <label>Street Address 2 <span class="required">*</span></label>
                                        <input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_street_address1'];}?>" name="tca_street_address1" placeholder="Enter  Street Address Line 2" type="text">
                                    </div>
                                   <div class="form-field-wrapper">
                                       <label>Landmark <span class="required">*</span></label>
                                       <input class="input-md form-full-width" value="<?php if(isset($Address[0])){ echo $Address[0]['tca_landmark'];}?>" id="tca_landmark" name="tca_landmark" placeholder="Enter Landmark" type="text">
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
                                        <input value="<?php if(isset($Address[0])){ echo $Address[0]['tca_id'];}else{ echo "0";}?>" name="add_id" type="hidden">
                                    </div>
									<div class="form-field-wrapper">
                                        <input name="submit" id="submit1" class="submit btn btn-md btn-color" value="Update" type="submit">
                                    </div>
                                </form>
                            </div>
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
			$( "#user_form" ).validate( {
				rules: {
					uname: {
						required: true,
						minlength: 5
					},
					
					email: {
						required: true,
						email: true
					},
					mobile: {
						required: true,
						number: true,
                        minlength: 10,
                        maxlength: 10
					}
				},
				messages: {
					uname: {
						required: "Please enter a username",
						minlength: "Your username must consist of at least 5 characters"
					},
					
					mobile: {
						required: "Please enter mobile",
						minlength: "Mobile number should be 10 digits"
					},
					email: {
						required: "Please enter email address",
						email: "Please enter a valid email address"
					},
				},
				submitHandler: function (form) {
                    showload();
                    $.ajax({
                        url: '<?php echo base_url('User/CheckEmail');?>',
                        type: "POST",
                        data: {email: $("#email").val()},
                        dataType: 'json',
                        success: function (response) {
                            if (response.status == true) {
									
									$.ajax({
										url: '<?php echo base_url('User/UpdateCustomer');?>',
										type: "POST",
										data: new FormData(form),
										dataType: 'json',
										contentType: false,
										cache: false,
										processData: false,
										success: function (response) {
											if (response.status == true) {
												hideload();
												toast_msg('Success',response.message,'success');	 
												setTimeout(function () {
													window.location.href = "<?php echo base_url('my-account');?>";
												}, 1000);
											} else {
												hideload();
												toast_msg('Error',response.message,'error');
											}
											
										}
									});   
                            } else {
								hideload();
								toast_msg('Warning',response.message,'warning');
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
		$( document ).ready( function () {
			var $form = $(this);
			$.validator.setDefaults( {
				
			} );
			$( "#address_form" ).validate( {
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
                        url: '<?php echo base_url('User/CheckEmail');?>',
                        type: "POST",
                        data: {email: $("#email").val()},
                        dataType: 'json',
                        success: function (response) {
                            if (response.status == true) {
									
									$.ajax({
										url: '<?php echo base_url('User/UpdateCustomerAddress');?>',
										type: "POST",
										data: new FormData(form),
										dataType: 'json',
										contentType: false,
										cache: false,
										processData: false,
										success: function (response) {
											if (response.status == true) {
												hideload();
												toast_msg('Success',response.message,'success');	 
												setTimeout(function () {
													window.location.href = "<?php echo base_url('my-account');?>";
												}, 1000);
											} else {
												hideload();
												toast_msg('Error',response.message,'error');
											}
											
										}
									});   
                            } else {
								hideload();
								toast_msg('Warning',response.message,'warning');
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