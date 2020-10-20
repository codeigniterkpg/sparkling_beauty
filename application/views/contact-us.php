<?php include("header.php");?>
<style>
.list-none li {
	display:inline;
	width:auto;
	padding:5px;
}
</style>
 <!-- Page Content Wraper -->
        <div class="page-content-wraper">
            <!-- Bread Crumb -->
            <section class="breadcrumb">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav class="breadcrumb-link">
                                <a href="<?php echo base_url();?>">Home</a>
                                <span>Contact Us</span>
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
						<?php 
						$exe=$this->db->get('tbl_site_setting');
						$con_data=$exe->result_array();
						?>
                        <div class="col-md-5">							
                                <form id="login_form" action="#" method="post">
                                    <h2 class="normal"><span>Stay In Touch</span></h2>
									<p><b>Company address</b></p>
									<p>
									<?php echo $con_data[0]['ts_address'];?>
									</p><br>
									<p><b>Contact Information</b></p>
                                    <ul class="Contact-information mb-25">
										<li>
											<i class="fa fa-envelope" aria-hidden="true"></i>
											For Queries <a href="mailto:<?php echo $con_data[0]['ts_email'];?>"><?php echo $con_data[0]['ts_email'];?></a>
										</li>
										<li>
											<i class="fa fa-envelope" aria-hidden="true"></i>
												For Complaints
											<a href="mailto:<?php echo $con_data[0]['ts_email1'];?>"><?php echo $con_data[0]['ts_email1'];?></a>
										</li>
									  <li><i class="fa fa-fax" aria-hidden="true">&nbsp;</i>+91 <?php echo $con_data[0]['ts_mobile'];?></li>
									</ul>
                                </form>
								<div>
								<ul class="list-none">
									 <li><a href="https://wa.me/919167672264" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
									<li><a href="<?php echo $con_data[0]['ts_facebook'];?>" target="_blank"><i class="fa fa-facebook">&nbsp;</i></a></li>
									<li><a href="<?php echo $con_data[0]['ts_twitter'];?>" target="_blank"><i class="fa fa-pinterest">&nbsp;</i></a></li>
									<li><a href="<?php echo $con_data[0]['ts_instagram'];?>" target="_blank"><i class="fa fa-instagram">&nbsp;</i></a></li>
								  </ul>
								</div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-border-box">
                                <form id="user_forms" action="" method="post">
                                    <h2 class="normal"><span>Contact Us</span></h2>
                                    <div class="form-field-wrapper">
                                        <label>Name  <span class="required">*</span></label>
                                        <input class="input-md form-full-width" name="name" placeholder="Enter Your Name" type="text">
                                    </div>
                                       <div class="form-field-wrapper">
                                        <label>Email  <span class="required">*</span></label>
                                        <input  class="input-md form-full-width" id="remail" name="email" placeholder="Enter Your Email Address" type="email">
                                    </div>
                                    <div class="form-field-wrapper">
                                        <label>Subject<span class="required">*</span></label>
                                        <input class="input-md form-full-width" id="pwd" name="subject" placeholder="Enter Subject" type="text">
                                    </div>
                                    <div class="form-field-wrapper">
                                        <label>Comment  <span class="required">*</span></label>
                                        <textarea class="input-md form-full-width" name="comment" placeholder="Enter Comment"></textarea>
                                    </div>
                                    <div class="form-field-wrapper">
                                        <input name="submit" id="submit1" class="submit btn btn-md btn-color" value="Send Inquiry" type="submit">
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
			$( "#user_forms" ).validate( {
				rules: {
					name: {
						required: true,
						minlength: 5
					},
					subject: {
						required: true,
						minlength: 6
					},
					comment: {
						required: true,
						minlength: 20
					},
					email: {
						required: true,
						email: true
					}
				},
				
				submitHandler: function (form) {
                    showload();
                    $.ajax({
						url: '<?php echo base_url('Home/SaveInquiry');?>',
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
								form.reset();
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