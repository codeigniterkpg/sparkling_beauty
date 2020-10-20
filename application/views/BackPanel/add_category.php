<!DOCTYPE html>
<html lang="en">
<head>

	<title>Sparkling Beauty | Add Category</title>
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
                                            <h5 class="m-b-10">Category</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Add Category</a></li>
                                            
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
                                        <h5>Category</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="myForm" enctype="multipart/form-data" method="POST" onSubmit="return form_submit();" data-parsley-validate novalidate>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleSelect1">Select Category</label>
                                                        <select class="form-control"  name="category" id="category" data-placeholder="Choose a Category" tabindex="1">
                                                            <option value='0'>Main Category</option>
                                                            <?php echo $Category;?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Category Name</label>
                                                        <input type="text" id="cname" oninput="write_urlkey(this.value)" required name="cname" value="<?php if(isset($Category_Detail['cat_id'])){ echo $Category_Detail['cat_name']; } else{ }?>" class="form-control" placeholder="Enter category name">
                                                        <input type="hidden" id="id" name="id" value="<?php if(isset($Category_Detail['cat_id'])){ echo $Category_Detail['cat_id'];}else{ }?>" />
                                                        <input type="hidden" id="image1" name="image1" value="<?php if(isset($Category_Detail['cat_id'])){ echo $Category_Detail['cat_icon'];}else{ }?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Image</label>
                                                        <input name="image" id="image" type="file" class="form-control"/>
                                                    </div>
                                                    <?php if(isset($Category_Detail['cat_id'])){?>
                                                        <div class="img-upload-wrap">
                                                            <img style="width:150px;margin-top:10px;margin-right:5px;" class="img-responsive" src="<?php echo base_url('uploads/category/').$Category_Detail['cat_icon'];?>" alt="">
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="HSNCode">HSN Code</label>
                                                        <input name="HSNCode" id="HSNCode" type="text" class="form-control" placeholder="HSNCode" value="<?php if(isset($Category_Detail['cat_HSNCode'])){ echo $Category_Detail['cat_HSNCode'];}?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="HSNCode">GST Percentage</label>
                                                        <input name="GSTPercentage" id="GSTPercentage" type="text" class="form-control" placeholder="GST Percentage" max="18" maxlength="3" min="0" minlength="1" value="<?php if(isset($Category_Detail['cat_GSTPercentage'])){ echo $Category_Detail['cat_GSTPercentage'];}?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputname">URL Keyword</label>
                                                        <input type="text" id="url_key" required name="url_key" value="<?php if(isset($Category_Detail['cat_id'])){ echo $Category_Detail['cat_url_keyword']; } else{ }?>" class="form-control" placeholder="Url Key Word">
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-primary">Submit</button>
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
	 function write_urlkey(urlkey){		$("#url_key").val(urlkey);	} 

	 function form_submit() {
		return false;
	}
				function showRequest() {
				}
				function showResponse(data) {
						hideload();
						if(data==1){
							
							custom_notify('Category Added Successfully', "success");
							$("#cname").val("");
							$("#image").val("");
							$("#url_key").val("");
							
							
							
						}else if(data==2){
							custom_notify('Category Updated Successfully', "success");
							window.location.href="<?php echo base_url('BackPanel/Category');?>";
						}
						else if(data==3){
							
							custom_notify('Category URL Keyword Already Exists', "info");
						}else if(data==0){
							
							custom_notify('An error has been occurred while performing this action', "danger");
						} 
					
				}
				 
				$(document).ready(function() {
					var options = {
						url:        '<?php echo base_url('BackPanel/Category/Add_category');?>',
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
							custom_notify('Some Important Fields Are Empty!!!', "warning");
							//$.notify("Some Important Fields Are Empty!!!","error",{ position:"top-center" });
						}
						return false;
					});
				});
				function validation(){
					var isformValid=true;
					/*Chacking validations Start here*/
					if($("#cname").val()==""){
						isformValid=false;
						$("#cname").closest('.form-group').addClass('has-error');
						$('#cname').focus();
					}
					if($("#url_key").val()==""){
						isformValid=false;
						$("#url_key").closest('.form-group').addClass('has-error');
						$('#url_key').focus();
					}
					/*Chacking validations End here*/
					return isformValid;
				}
	 
	
	
      // initialize the validator function
      

     
    </script>
</body>

</html>