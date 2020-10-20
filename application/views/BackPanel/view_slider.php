<!DOCTYPE html>

<html lang="en">

<head>



	<title>Sparkling Beauty | Slider</title>

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

                                            <h5 class="m-b-10">Slider</h5>

                                        </div>

                                        <ul class="breadcrumb">

                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>

                                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Slider</a></li>

                                            

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

                                        <h5>Manage Slider</h5>

										<a style="float:right" class="btn btn-primary" href="<?php echo base_url('BackPanel/Slider/Slider');?>">Add New</a>

                                    </div>

									

                                    <div class="card-body">

                                        <div class="table-responsive dt-responsive">

                                            <table id="datatable" class="table table-striped table-bordered nowrap">

                                                <thead>
													<tr>
														
														<th>Title</th>
														<th>Url</th>
														<th>Image</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>Title</th>
														<th>Url</th>
														<th>Image</th>
														<th>Actions</th>
													</tr>
												</tfoot>
												<tbody>
													<?php foreach($Slider as $pro){?>
														<tr>
															<td><?php echo $pro['s_title'];?></td>
															<td><a target="_blank" href="<?php echo $pro['s_url'];?>">View</a></td>
															<td><img src="<?php echo base_url('uploads/slider/').$pro['s_img'];?>" style="width:100px;"></td>
															<td class=''>
																<a class='btn btn-info' title='Edit' href='<?php echo base_url("BackPanel/Slider/Edit_slider/"). $pro['s_id'];?>'>
																	<i class='fa fa-edit'></i>
																</a>
																<a class='btn btn-danger js-sweetalert' href='#' onclick='delete_data(<?php echo $pro['s_id'];?>)'>
																	<i class='fa fa-trash'></i>
																</a>
															</td>
														<tr>
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
function delete_data(id)
    {
        var r=confirm("Are You Sure??");
        if (r==true){
        $.ajax({
            url:"<?php echo base_url('BackPanel/Slider/DeleteSlider');?>",
            type:"post",
            data:"id="+id,
            success:function(d){
                
                if(d=='1')
                {
                   custom_notify('Slider Data Delete Successfully', "success");
				   location.reload();
                } else{
                    
					custom_notify('An error has been occurred while performing this action', "danger");
                }
            }
        });
        }else{
            
        }
    }

            $(document).ready(function() {



                // Default Datatable

               $('#datatable').DataTable();



                //Buttons examples

                



                // Key Tables



              



                // Responsive Datatable

                

               

            } );



			



        </script>
		</body>



</html>