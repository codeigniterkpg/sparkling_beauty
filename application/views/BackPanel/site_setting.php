<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sparkling Beauty | Site Setting</title>
<?php include("header.php");?>
<script type="text/javascript" src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/ckfinder/ckfinder.js'); ?>"></script>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">

    <div class="pcoded-wrapper">
	

        <div class="pcoded-content">

            <div class="pcoded-inner-content">

                <div class="main-body">

                    <div class="page-wrapper">

                        <!-- [ breadcrumb ] start -->

                        <div class="page-header">

                            <div class="page-block">

                                <div class="row align-items-center">

                                    <div class="col-md-12">

                                        <div class="page-header-title">

                                            <h5 class="m-b-10">Site Setting</h5>

                                        </div>

                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Site Setting</a></li>
                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

						

						<div class="row">
               <div class="col-12">
                  <div class="card m-b-30">
                     <div class="card-body">
					 <form method="post" id="myForm" enctype="multipart/form-data">
                       <input type="hidden" class="form-control" id="image" name="image" required>
					<input type="hidden" class="form-control" id="image1" name="image1" value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_image']; }else{ }?>">
				 <input type="hidden" class="form-control" id="fimage" name="fimage" required>
					<input type="hidden" class="form-control" id="fimage1" name="fimage1" value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_fimage']; }else{ }?>">
				
				<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Company Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_name']; }else{ }?>">
                  </div>
                </div>

				<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Email (Inquiry)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_email']; }else{ }?>">
					<small style="display:none;color:red;" class="err" id="erremail"></small>
                  </div>
                </div>
				<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Email (Complaints)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="email1" name="email1" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_email1']; }else{ }?>">
                  </div>
                </div>
				
				<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Phone No (Customer Support)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_phone']; }else{ }?>">
					<small style="display:none;color:red;" class="err" id="errphone"></small>
                  </div>
                </div>
				
				<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Mobile No</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="mobile" name="mobile" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_mobile']; }else{ }?>">
					<small style="display:none;color:red;" class="err" id="errmobile"></small>
                  </div>
                </div>
				
				<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
					<textarea class="form-control" id="address" name="address"><?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_address']; }else{ }?></textarea>
                    
                  </div>
                </div>
				
				
				
				
				
				<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Home Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_title']; }else{ }?>">
                  </div>
                </div>
				
				<div class="form-group row">
                  <label for="input-8" class="col-sm-2 col-form-label">Home Description</label>
                  <div class="col-sm-10">
					<textarea class="form-control" name="description" id="description"><?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_description']; }else{ }?></textarea>					
                  </div>
                </div>
				
				<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Facebook</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="facebook" name="facebook" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_facebook']; }else{ }?>">
                  </div>
                </div>
				
				<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Pinterest</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="twitter" name="twitter" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_twitter']; }else{ }?>">
                  </div>
                </div>
				
				
                    <input type="hidden" class="form-control" id="jd" name="jd" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_jd']; }else{ }?>">
                  
				
				
                    <input type="hidden" class="form-control" id="utube" name="utube" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_utube']; }else{ }?>">

				
				<div class="form-group row">
                  <label for="input-5" class="col-sm-2 col-form-label">Instagram</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="instagram" name="instagram" required value="<?php if(isset($Site_Detail['ts_id'])){ echo $Site_Detail['ts_instagram']; }else{ }?>">
                  </div>
                </div>
				
						<div class="form-group row">
						<div class="col-sm-6">							
							<img src="<?php echo base_url('assets/images/loader.gif');?>" alt="loader1" style="display:none; height:100px; width:auto;" id="loaderImg">
					
						   <button type="button" class="btn btn-primary waves-effect waves-light" onclick="add_data(this)" id="send"><i class="fa fa-check-square-o"></i> Submit</button>
						</div>
                        </div>
					</form>
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
         </div>
         <!-- end container -->
      </div>

						

						

						 <!-- [ Main Content ] end -->

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- [ Main Content ] end -->



<?php include("footer.php");?>

<script src="<?php echo base_url('assets/js/jquery.form.js');?>"></script>
<script>
	function add_data(btn)
	{
				
		if(validation()){
			for (instance in CKEDITOR.instances) {       CKEDITOR.instances[instance].updateElement();      }
			var $this 		= $("#myForm");
			var formData = new FormData($this[0]);
			$.ajax({
				url:'<?php echo base_url('BackPanel/Site_Setting/Edit_Site_Setting');?>',
				type:"post",
				data        : formData,
				cache       : false,
				contentType : false,
				processData : false,
				async       : false,
				success:function(d) 
				{
					
						window.location.href='<?php echo base_url('BackPanel/Site_Setting/'); ?>';
														
				}
			});	
		}
	}
	
	 function validation(){

                    var isformValid=true;

					

					/*Checking validations Start here*/

					
						var mailformat =/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
						if($("#email").val()!="" && !$("#email").val().match(mailformat)){

      						isformValid=false;

							$('#email').focus();

							$('#erremail').show();

							

							$('#email').parent().addClass('has-danger')

      						document.getElementById('erremail').innerHTML='Please Enter Valid Email Id';

      						}

						else {

							$('#email').parent().removeClass('has-danger')

							$('#erremail').hide();

							$("#erremail").html("");

							

						}
						var letters = /^[0-9 ]+$/;
						if($("#mobile").val()!="" && !$("#mobile").val().match(letters)){

      						isformValid=false;
							$('#mobile').focus();
							$('#errmobile').show();							
							$('#mobile').parent().addClass('has-danger')
      						document.getElementById('errmobile').innerHTML='Please Enter Only Numeric In Mobile No.';
      					} else if($("#mobile").val()!="" && $("#mobile").val().length < 10){
							isformValid=false;
							$("#errmobile").show();
							$("#mobile").focus();
							$("#errmobile").html("Mobile number should be 10 digits");
						} 
						else {
							$('#mobile').parent().removeClass('has-danger')
							$('#errmobile').hide();
							$("#errmobile").html("");						
						}
						
						
                    /*Checking validations End here*/

                    return isformValid;

                }
				
				var editor = CKEDITOR.replace('description', {
                filebrowserBrowseUrl: '<?php echo base_url('assets/ck/ckfinder/ckfinder.html');?>',
                filebrowserImageBrowseUrl: '<?php echo base_url('assets/ck/ckfinder/ckfinder.html?type=Images');?>',
                filebrowserFlashBrowseUrl: '<?php echo base_url('assets/ck/ckfinder/ckfinder.html?type=Flash;');?>',
                filebrowserUploadUrl: '<?php echo base_url('assets/ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
                filebrowserImageUploadUrl: '<?php echo base_url('assets/ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',
                filebrowserFlashUploadUrl: '<?php echo base_url('assets/ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash');?>'
				});
				
				var editor = CKEDITOR.replace('doctor', {
                filebrowserBrowseUrl: '<?php echo base_url('assets/ck/ckfinder/ckfinder.html');?>',
                filebrowserImageBrowseUrl: '<?php echo base_url('assets/ck/ckfinder/ckfinder.html?type=Images');?>',
                filebrowserFlashBrowseUrl: '<?php echo base_url('assets/ck/ckfinder/ckfinder.html?type=Flash;');?>',
                filebrowserUploadUrl: '<?php echo base_url('assets/ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files');?>',
                filebrowserImageUploadUrl: '<?php echo base_url('assets/ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images');?>',
                filebrowserFlashUploadUrl: '<?php echo base_url('assets/ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash');?>'
				});
	
	</script>

</body>



</html>