<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sparkling Beauty | Add Home Category Image</title>
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

                                            <h5 class="m-b-10">Home Category</h5>

                                        </div>

                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Add Home Category</a></li>
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

                                        <h5>Home Category</h5>

                                    </div>

                                    <div class="card-body">

                                        <form id="myForm" enctype="multipart/form-data" method="POST" onSubmit="return form_submit();">
                                      
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleSelect1">Select Category</label>
												<select class="form-control"  name="category" id="category" data-placeholder="Choose a Category" tabindex="1">
												
												<?php echo $Category;?>
												</select>
											</div>
										</div>
                                        <div class="col-md-6">
											<div class="form-group">
												<label for="exampleSelect1">Image</label>
												<input id="image" name="image" type="file" class="form-control">
												<input class="form-control col-md-7 col-xs-12" id="image1" name="image1" value="<?php if(isset($Detail['thc_id'])){ echo $Detail['thc_image']; }else{ }?>" placeholder="Enter Pack Size Unit"  type="hidden">
												<?php if(isset($Detail['thc_id'])){?>
												<div class="img-upload-wrap">
												<img style="width:250px;margin-top:10px;margin-right:5px;" class="img-responsive" src="<?php echo base_url('uploads/home_category/').$Detail['thc_image'];?>" alt="">												
												</div>											
												<?php } ?>                     
											</div>
										</div>										
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleSelect1">Sequence Number</label>
												<input id="seq" name="seq" type="text" class="form-control" value="<?php if(isset($Detail['thc_id'])){ echo $Detail['thc_seq'];}else{ }?>">
											</div>
										</div>
                                       
										
										<input type="hidden" id="id" name="id" value="<?php if(isset($Detail['thc_id'])){ echo $Detail['thc_id'];}else{ }?>" />   								
                                        <button type="submit" class="btn btn-primary">Save</button>
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
$("#seq").keypress(function(e){
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	});

	 function form_submit() {

		return false;

	}

				function showRequest() {

				}

				function showResponse(data) {

						hideload();

						if(data==1){

							

							custom_notify('Home Category Successfully', "success");

							window.location.href="<?php echo base_url('BackPanel/HomeCategory');?>";

						}else if(data==2){

							custom_notify('Home Category Updated Successfully', "success");

							window.location.href="<?php echo base_url('BackPanel/HomeCategory');?>";

						}

						else if(data==3){

							

							custom_notify('Maximum category images are uploded', "warning");

						}else if(data==4){

							

							custom_notify('Sequence number already assigned to other', "warning");

						}else if(data==0){

							

							custom_notify('An error has been occurred while performing this action', "danger");

						} 

					

				}

				 

				$(document).ready(function() {
					var options = {
						url:        '<?php echo base_url('BackPanel/HomeCategory/Add_HomeCategory');?>',
						beforeSubmit:  showRequest,
						success:    showResponse
						
					};
					$('#myForm').submit(function() {
						showload();
						
						var isFormValid=validation();
						
						if(isFormValid){
							$(this).ajaxSubmit(options);
						}else{
							hideload();
							isFormValid=true;
							
							toastr.warning('Some Important Fields Are Empty!!!', "Warning",{
								"preventDuplicates": true,
								"closeButton":true
							});	
							//$.notify("Some Important Fields Are Empty!!!","error",{ position:"top-center" });
						}
						return false;
					});
				});
				function validation(){
					var isformValid=true;
					/*Chacking validations Start here*/
					if($("#category").val()==""){
						isformValid=false;
						$("#category").closest('.form-group').addClass('has-error');
						$('#category').focus();
					}
					/*Chacking validations End here*/
					return isformValid;
				}

	 

     

    </script>

</body>



</html>