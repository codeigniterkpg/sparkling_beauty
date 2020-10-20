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
                                <span>Login & Register</span>
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
                                <form id="login_form" action="#" method="post">
                                    <h2 class="normal"><span>Registered Customers</span></h2>
                                    <div class="form-field-wrapper">
                                        <label>Email address <span class="required">*</span></label>
                                        <input class="input-md form-full-width"  name="email" id="email" placeholder="Enter Username or Email Address" type="text">
                                    </div>
                                    <div class="form-field-wrapper">
                                        <label>Enter Your Password <span class="required">*</span></label>
                                        <input class="input-md form-full-width" id="password" name="password" placeholder="Enter Your Password" type="password">
                                    </div>
                                    <div class="form-field-wrapper">
                                        <input name="submit" id="submit" class="submit btn btn-md btn-black" value="Sign In" type="submit">
                                    </div>
									<div class="form-field-wrapper">
										<a href="<?php echo base_url('lost-password');?>">Lost your password?</a>
									</div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-border-box">
                                <form id="user_form" action="" method="post">
                                    <h2 class="normal"><span>New Customers</span></h2>
                                    <div class="form-field-wrapper">
                                        <label>Name  <span class="required">*</span></label>
                                        <input class="input-md form-full-width" name="uname" placeholder="Enter Your Name" type="text">
                                    </div>
                                       <div class="form-field-wrapper">
                                        <label>Email  <span class="required">*</span></label>
                                        <input  class="input-md form-full-width" id="remail" name="email" placeholder="Enter Your Email Address" type="email">
                                    </div>
                                       <div class="form-field-wrapper">
                                        <label>Mobile Number <span class="required">*</span></label>
                                        <input class="input-md form-full-width" name="mobile" placeholder="Enter Your Mobile Number" type="text">
                                    </div>
                                    <div class="form-field-wrapper">
                                        <label>Enter Your Password <span class="required">*</span></label>
                                        <input class="input-md form-full-width" id="pwd" name="password" placeholder="Enter Your Password" type="password">
                                    </div>
                                    <div class="form-field-wrapper">
                                        <label>Confirm Password  <span class="required">*</span></label>
                                        <input class="input-md form-full-width" name="confirm_password" placeholder="Enter Confirm Password" type="password">
                                    </div>
                                    <div class="form-field-wrapper">
                                        <input name="submit" id="submit1" class="submit btn btn-md btn-color" value="Create An Account" type="submit">
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
					password: {
						required: true,
						minlength: 6
					},
					confirm_password: {
						required: true,
						minlength: 6,
						equalTo: "input[id='pwd']"
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
					password: {
						required: "Please enter a password",
						minlength: "Your password must be at least 6 characters long"
					},
					
					confirm_password: {
						required: "Please enter confirm password",
						minlength: "Your password must be at least 6 characters long",
						equalTo: "Please enter the same password as above"
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
                        data: {email: $("#remail").val()},
                        dataType: 'json',
                        success: function (response) {
                            if (response.status == true) {
									
									$.ajax({
										url: '<?php echo base_url('User/SaveCustomer');?>',
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
			var $login_form = $(this);
			$.validator.setDefaults( {
				
			} );
			$( "#login_form" ).validate( {
				rules: {
					email: {
						required: true,
						email: true
					},
					password: {
						required: true,
						minlength: 6
					}
				},
				messages: {
					
					password: {
						required: "Please enter a password",
						minlength: "Your password must be at least 6 characters long"
					},
					email: {
						required: "Please enter email address"
					},
				},
				submitHandler: function (form) {
                    showload();
                    $.ajax({
                        url: '<?php echo base_url('User/check_login');?>',
                        type: "POST",
                        data: {email: $("#email").val(),password: $("#password").val(),page:""},
                        dataType: 'json',
                        success: function (response) {
							if (response.status == true) {
								<?php 
									$previous_url=$this->session->userdata('previous_url');
									if(!empty($previous_url)){
								?>
									window.location.href = "<?php echo $previous_url;?>";
								<?php }else{ ?>
									window.location.href = "<?php echo base_url('my-account');?>";
								<?php } ?>
							} else {
								toast_msg_postition('Error',response.message,'error','top-center');
							}
							hideload();
                        }
                    });
                    $login_form.submit();
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