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
                                <span>Lost Password</span>
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
                        <div class="col-md-12">
                            <div class="form-border-box">							
                                <form id="login_form" action="#" method="post">
                                    <h5 class="normal"><span>Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.</span></h5>
                                    <div class="form-field-wrapper">
                                        <label>Email address <span class="required">*</span></label>
                                        <input class="input-md form-full-width" required name="email" id="email" placeholder="Enter Email Address" type="text">
                                    </div>                                    
                                    <div class="form-field-wrapper">
                                        <input name="submit" id="submit" class="submit btn btn-md btn-black" value="Submit" type="submit">
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
			var $login_form = $(this);
			$.validator.setDefaults( {
				
			} );
			$( "#login_form" ).validate( {
				rules: {
					email: {
						required: true,
						email: true
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
                        url: '<?php echo base_url('User/CheckEmailPass');?>',
                        type: "POST",
                        data: {email: $("#email").val()},
                        dataType: 'json',
                        success: function (response) {
							if (response.status == true) {
								toast_msg_postition('Success',response.message,'success','top-center');
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