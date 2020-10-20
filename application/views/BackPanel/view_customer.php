<!DOCTYPE html>

<html lang="en">

<head>



	<title>Sparkling Beauty | Customer </title>

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

                                            <h5 class="m-b-10">Customer</h5>

                                        </div>

                                        <ul class="breadcrumb">

                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>

                                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Customer</a></li>

                                            

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

                                        <h5>Manage Customer</h5>


                                    </div>

									

                                    <div class="card-body">

                                        <div class="table-responsive dt-responsive">

                                            <table id="datatable" class="table table-striped table-bordered nowrap">

                                                <thead>
													<tr>
														
														<th>Name</th>
														<th>Email</th>
														<th>Mobile No</th>
														<th>Status</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>Name</th>
														<th>Email</th>
														<th>Mobile No</th>
														<th>Status</th>
													</tr>
												</tfoot>
												<tbody>
													<?php foreach($Customer as $pro){?>
														<tr>
															<td><?php echo $pro['tc_name'];?></td>
															<td><?php echo $pro['tc_email'];?></td>
															<td><?php echo $pro['tc_mobile'];?></td>
															<td><div class="switch switch-success d-inline m-r-10">
																	<input type="checkbox" id="switch-s-1" value="<?php echo $pro['tc_status'];?>" onchange="change_status(<?php echo $pro['tc_id'];?>,this.value,this)" <?php if($pro['tc_status']==1){ echo "checked";}?>>
																	<label for="switch-s-1" class="cr"></label>
																</div>
															</td>
															
														</tr>
													<?php } ?>
												</tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- Column Rendering table end -->

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
	 
	function change_status(id,status,ele){

	showload();

	if(status==1){

		var st=0;

	}else{

		var st=1;

	}

	$.ajax({

		url:"<?php echo base_url('BackPanel/Customer/Change_status');?>",

		type:"post",

		data:{user_id:id,status:st},

		success:function(d){

			hideload();

			$(ele).val(st);
			custom_notify('Status Changed Successfully', "success");
			

			

		}

	});

}
	

            $(document).ready(function() {



                // Default Datatable

               $('#datatable').DataTable({
				
				dom: 'Bfrtip',

				buttons: [

					'excelHtml5',

					'pdfHtml5'

				]

			});



                //Buttons examples

                



                // Key Tables



              



                // Responsive Datatable

                

               

            } );



			



        </script>
		</body>



</html>