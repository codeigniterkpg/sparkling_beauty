<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sparkling Beauty | Add CMS</title>
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

                                            <h5 class="m-b-10">CMS</h5>

                                        </div>

                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0);">Add CMS</a></li>
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

                                        <h5>CMS</h5>

                                    </div>

                                    <div class="card-body">

                                        <form id="myForm" enctype="multipart/form-data" method="POST" onSubmit="return form_submit();">
                                      
                                       
                                            <fieldset class="form-group">
                                            <label for="exampleInputname">CMS Title</label>
                                            <input type="text" id="title" name="title" value="<?php if(isset($CMS_Detail['cms_id'])){ echo $CMS_Detail['cms_title']; } else{ }?>" class="form-control">
												   
											<input type="hidden" id="id" name="id" value="<?php if(isset($CMS_Detail['cms_id'])){ echo $CMS_Detail['cms_id'];}else{ }?>" />   
                                            
                                        </fieldset>	
										<fieldset class="form-group"> 
										<label for="exampleInputname">Image</label>
										<input id="image" name="image" type="file" class="form-control">
										<input class="form-control col-md-7 col-xs-12" id="image1" name="image1" value="<?php if(isset($CMS_Detail['cms_id'])){ echo $CMS_Detail['cms_image']; }else{ }?>" placeholder="Enter Pack Size Unit"  type="hidden">
										<?php if(isset($CMS_Detail['cms_id'])){?>
										<div class="img-upload-wrap">
										<img style="width:250px;margin-top:10px;margin-right:5px;" class="img-responsive" src="<?php echo base_url('uploads/cms/').$CMS_Detail['cms_image'];?>" alt="">												</div>											<?php } ?>                                        </fieldset>
                                       
										
										<fieldset class="form-group">
                                            <label for="exampleInputname">Description</label>
                                            <textarea id="description" name="description"  class="form-control"><?php if(isset($CMS_Detail['cms_id'])){ echo $CMS_Detail['cms_description']; } else{ }?></textarea>
												   
											
                                            
                                        </fieldset>
										<fieldset class="form-group">
                                            <label for="exampleInputname">CMS URL KEyword</label>
                                            <input type="text" id="url_key" name="url_key" value="<?php if(isset($CMS_Detail['cms_id'])){ echo $CMS_Detail['cms_url']; } else{ }?>" class="form-control">
												   
											
                                            
                                        </fieldset>										
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
	   var editor = CKEDITOR.replace('description', {
       // filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
       // filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
//filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '<?php echo base_url('assets/')?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        toolbarStartupExpanded : false,
        filebrowserImageUploadUrl: '<?php echo base_url('assets/')?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '<?php echo base_url('assets/')?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

    });
	
    CKFinder.setupCKEditor(editor, '../');
CKEDITOR.config.allowedContent = true;

number_valid();

function number_valid(){

$(".prices").keypress(function(e){

		if (e.which != 8 && e.which != 46 && e.which != 0 && (e.which < 48 || e.which > 57)) {

			return false;

		}

	});

}

function getSizeList(){

	

	

	

	var size_id=$("#size_category").val();

	if(size_id>0){

		$("#size_div").empty();

		$("#cnt").val("0");

		showload();

		var cnt=$("#cnt").val();

		var final_cnt=parseInt(cnt) + 1;

		$("#cnt").val(final_cnt);

		$.ajax({

			url:"<?php echo base_url('BackPanel/Product/getCategorySizeList');?>",

			type:"post",

			data:{size_id:size_id,cnt:final_cnt},

			success:function(d){

				hideload();

				$("#size_div").prepend(d);

				number_valid();

				$("#price_div").hide();

			}

		});

	}else{

		$("#size_div").empty();

		$("#cnt").val("0");

	}		

}

/* ------------ Add New Elements Start------------------ */

	function add_new_div(){

		var size_id=$("#size_category").val();

		

		if(size_id>0){

			showload();

			var cnt=$("#cnt").val();

			var final_cnt=parseInt(cnt) + 1;

			$("#cnt").val(final_cnt);

			$.ajax({

				url:"<?php echo base_url('BackPanel/Product/getCategorySizeList');?>",

				type:"post",

				data:{size_id:size_id,cnt:final_cnt},

				success:function(d){

					hideload();

					$("#size_div").prepend(d);

					number_valid();

				}

			});

		}		

	}

	function remove_div(id) {

		var elem = document.getElementById('add'+id);

		elem.parentNode.removeChild(elem);

		var cnt=$("#cnt").val();

		var final_cnt=parseInt(cnt) - 1;

		$("#cnt").val(final_cnt);

		

		return false;

	}

	/* ------------ Add New Elements End ---------------------*/	  



	 function form_submit() {

		return false;

	}

				function showRequest() {

				}

				function showResponse(data) {

						hideload();

						if(data==1){

							

							custom_notify('Cms Added Successfully', "success");

							window.location.href="<?php echo base_url('BackPanel/CMS');?>";

						}else if(data==2){

							custom_notify('Cms Updated Successfully', "success");

							window.location.href="<?php echo base_url('BackPanel/CMS');?>";

						}

						else if(data==3){

							

							custom_notify('CMS URL Keyword Already Exists', "info");

						}else if(data==0){

							

							custom_notify('An error has been occurred while performing this action', "danger");

						} 

					

				}

				 

				$(document).ready(function() {
					var options = {
						url:        '<?php echo base_url('BackPanel/CMS/Add_cms');?>',
						beforeSubmit:  showRequest,
						success:    showResponse
						
					};
					$('#myForm').submit(function() {
						showload();
						
						var isFormValid=validation();
						for (instance in CKEDITOR.instances) {
                          CKEDITOR.instances[instance].updateElement();
                        } 
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
					if($("#title").val()==""){
						isformValid=false;
						$("#title").closest('.form-group').addClass('has-error');
						$('#title').focus();
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

      

	function removeimg(id,t){

	var info = 'id=' + id;

	

	if(confirm("Are you sure you want to delete this?"))

			{

				showload();

				 $.ajax({

				   type: "POST",

				   url: "<?php echo base_url('BackPanel/Product/RemoveProductImage');?>",

				   data: info,

				   success: function(){

					   hideload();

				   			custom_notify('Image Remove Successfully.', "success");	

								

					 $(t).closest("td").remove();



					

				 }

				});

				

			}

}

     

    </script>

</body>



</html>