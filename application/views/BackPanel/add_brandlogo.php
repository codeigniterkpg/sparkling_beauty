<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sparkling Beauty | Add Brand Logo</title>
<?php include("header.php");?>
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

                                            <h5 class="m-b-10">Brand Logo</h5>

                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Add Brand Logo</a></li>
                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

						

						<div class="row">

                            <!-- [ form-element ] start -->

                            <div class="col-sm-12">

                                <div class="card">

                                    <div class="card-header">

                                        <h5>Brand Logo</h5>

                                    </div>

                                    <div class="card-body">
                                        <form id="myForm" enctype="multipart/form-data" method="POST" onSubmit="return form_submit();">
											<input type="hidden" id="id" name="id" value="<?php if(isset($Edit['tbl_id'])){ echo $Edit['tbl_id']; }else{ }?>" />
											<div class="form-group">
												<label>Image</label>
												<input id="image" name="image" <?php if(!isset($Edit['tbl_id'])){ ?> required <?php } ?> type="file" class="form-control">
												<input class="form-control col-md-7 col-xs-12" id="image1" name="image1" value="<?php if(isset($Edit['tbl_id'])){ echo $Edit['tbl_image']; }else{ }?>"  type="hidden">
												 <?php if(isset($Edit['tbl_id'])){?>
													<div class="img-upload-wrap">
														<img style="width:250px;margin-top:10px;margin-right:5px;" class="img-responsive" src="<?php echo base_url('uploads/brand_logo/').$Edit['tbl_image'];?>" alt="">
													</div>
												<?php } ?>
											</div>
											
											<button id="submit_btn" type="submit" class="btn btn-primary">Save</button>
											<span id="spinner" style="display: none"><i class="fa fa-spinner"></i></span>
										</form>
									</div>

								</div>

							</div>

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
     
     function form_submit() {
        return false;
    }
                function showRequest() {
                }
                function showResponse(data) {
                        
                        if(data==1){
							 custom_notify('Brand Logo Add Successfully.', "success");
                            
                                window.location.href="<?php echo base_url('BackPanel/BrandLogo');?>";
                       
                        }else if(data==2){
                            
							custom_notify('Brand Logo Update Successfully.', "success");
                            
                                window.location.href="<?php echo base_url('BackPanel/BrandLogo');?>";
                        }else if(data==0){
							custom_notify('An unexpected error has occurred!', "danger");
                        } 
                        $("#submit_btn").show();
                        $("#spinner").hide();
                }
                 
                $(document).ready(function() {
                    var options = {
                        url:        '<?php echo base_url('BackPanel/BrandLogo/Add_BrandLogo');?>',
                        beforeSubmit:  showRequest,
                        success:    showResponse
                        
                    };
                    $('#myForm').submit(function() {
                        $("#submit_btn").hide();
                        $("#spinner").show();
                        var isFormValid=validation();
                        if(isFormValid){
                            $(this).ajaxSubmit(options);
                        }else{
                            isFormValid=true;
                                $context = 'info';
                                $message = 'Some Important Fields Are Empty!!!';
                                $position = 'top-right';
                    
                                $positionClass = 'toast-' + $position;
                                
                                toastr.remove();
                                toastr[$context]($message, '', {
                                    positionClass: $positionClass
                                });
                                $("#submit_btn").show();
                                $("#spinner").hide();
                        }
                        return false;
                    });
                });
                function validation(){
                    var isformValid=true;
                    /*Chacking validations Start here*/
                    
                    /*Chacking validations End here*/
                    return isformValid;
                }
     
    </script>

</body>



</html>