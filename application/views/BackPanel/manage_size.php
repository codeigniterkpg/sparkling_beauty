<!DOCTYPE html>
<html lang="en">
<head>

	<title>Sparkling Beauty | Size</title>
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
                                            <h5 class="m-b-10">Size</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Size</a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
						
						 <div class="row">
						     <!-- Column Rendering table start -->
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Manage Size Category</h5>
										<button style="float:right" class="btn btn-primary" onclick="show_modal(0)">Add New</button>
                                    </div>
									
                                    <div class="card-body">
                                        <div class="table-responsive dt-responsive">
                                            <table id="datatable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
														<th>Size Category</th>
														<th>Size</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
                                                </thead>
                                                <tbody>
													<?php foreach($List as $lt){?>
														<tr>
															<td><?php echo $lt['tsc_title'];?></td>
															<td><?php echo $lt['tsm_size'];?></td>
															<td><div class="switch switch-success d-inline m-r-10">
																	<input type="checkbox" id="switch-s-1<?php echo $lt['tsm_id'];?>" value="<?php echo $lt['tsm_status'];?>" onchange="change_status(<?php echo $lt['tsm_id'];?>,this.value,this)" <?php if($lt['tsm_status']==1){ echo "checked";}?>>
																	<label for="switch-s-1<?php echo $lt['tsm_id'];?>" class="cr"></label>
																</div>
															</td>
															<td><button class="btn btn-success" onclick="show_modal(<?php echo $lt['tsm_id'];?>,

																								'<?php echo $lt['tsm_size'];?>',
																								'<?php echo $lt['tsm_sizecat_id'];?>'

																								)">

													<i class="fa fa-edit icon-white"></i>

												</button></td>
														</tr>
													<?php } ?>
                                                </tbody>
                                                <tfoot>
													<tr>
														<th>Size Category</th>
														<th>Size</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column Rendering table end -->
							</div>
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

							<div class="modal-dialog" role="document">

								<div class="modal-content">

									<div class="modal-header">

										<h5 class="modal-title" id="exampleModalLabel">Add Size</h5>

										<button type="button" class="close" data-dismiss="modal" aria-label="Close">

											<span aria-hidden="true">&times;</span>

										</button>

									</div>

									<form id="cg_form" data-parsley-validate novalidate>

									<div class="modal-body">
											<fieldset class="form-group">

												<label for="exampleInputname">Size Category <span class="text-danger">*</span></label>

												<select class="form-control" name="size_id" id="size_id">
													<?php $exe=$this->db->get('tbl_size_category');
														foreach($exe->result_array() as $dt){
													?>
													<option value='<?php echo $dt['tsc_id'];?>'><?php echo $dt['tsc_title'];?></option>
														<?php } ?>
												</select>

											</fieldset>
											<fieldset class="form-group">

												<label for="exampleInputname">Title <span class="text-danger">*</span></label>

												<input required type="text" class="form-control" id="title" name="title">

											</fieldset>
												<input type="hidden" class="form-control" id="sc_id" name="sc_id">
											

									</div>

									<div class="modal-footer">

										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

										<button type="submit" id="submit_btn" class="btn btn-primary">Save</button>

									</div>

									</form>

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
<script src="<?php echo base_url('');?>assets/js/pages/form-advance-custom.js"></script>
<script>
            $(document).ready(function() {

                // Default Datatable
               /*  $('#datatable').DataTable(); */

                //Buttons examples
                var table = $('#datatable').DataTable({
					ordering: false
                });

                // Key Tables

              

                // Responsive Datatable
                
                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

			

        </script>
<script>

function change_status(id,status,ele){

	showload();

	if(status==1){

		var st=0;

	}else{

		var st=1;

	}

	$.ajax({

		url:"<?php echo base_url('BackPanel/SizeMaster/ChangeStatusSize');?>",

		type:"post",

		data:{id:id,status:st},

		success:function(d){

			hideload();

			$(ele).val(st);
			custom_notify('Status Changed Successfully', "success");
			

			

		}

	});

}

$("#cg_form").submit(function(e) {

	 e.preventDefault();

	showload();

	var isFormValid=validation();

	if(isFormValid){

		$.ajax({

			url:"<?php echo base_url('BackPanel/SizeMaster/SaveSize');?>",

			type:"post",

			data:$("#cg_form").serialize(),

			success:function(d){

				hideload();

				if(d=='1')

				{

					
					custom_notify('Size Added Successfully', "success");
							location.reload();

							

				}else if(d=='2')

				{
custom_notify('Size Updated Successfully', "success");
					

							location.reload();

							

					

				}else{

					toastr.error('An error has been occurred while performing this action', "Error",{

								"preventDuplicates": true,

								"closeButton":true

							});
					custom_notify('An error has been occurred while performing this action',"danger");
				} 

			}

		});

	}else{

		hideload();

		isFormValid=true;
			custom_notify('Some Important Fields Are Empty!!!',"warning")
			

	}

});

function validation(){

	var isformValid=true;

	/*Chacking validations Start here*/

	if($("#title").val()==""){

		isformValid=false;

		$("#title").closest('.form-control').addClass('parsley-error');

		$('#title').focus();

	}

	/*Chacking validations End here*/

	return isformValid;

}

function show_modal(id,title,size_id){

	if(id>0){

		$("#exampleModalLabel").html('Update Size');

		$("#submit_btn").html('Update');

		$("#sc_id").val(id);

		$("#title").val(title);
		$("#size_id").val(size_id);

		

	}else{

		$("#sc_id").val(id);

	}

	$("#myModal").modal('show');

}

            

        </script>
		</body>

</html>