<!DOCTYPE html>

<html lang="en">

<head>



	<title>Sparkling Beauty | CMS</title>

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

                                            <h5 class="m-b-10">CMS</h5>

                                        </div>

                                        <ul class="breadcrumb">

                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>

                                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manage CMS</a></li>

                                            

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

                                        <h5>Manage CMS</h5>

										<a style="float:right" class="btn btn-primary" href="<?php echo base_url('BackPanel/CMS/AddCMS');?>">Add New</a>

                                    </div>

									

                                    <div class="card-body">

                                        <div class="table-responsive dt-responsive">

                                            <table id="datatable" class="table table-striped table-bordered nowrap">

                                                <thead>
										<tr>
											<th>Title</th>
											<th>Image</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($CMS as $cm){ ?>
										<tr>
										<td><?php echo $cm['cms_title'];?></td>
										<td><img src="<?php echo base_url('uploads/cms/'.$cm['cms_image']);?>" height="100px" width="100px"></td>
										<td><a class="btn btn-success" href="<?php echo base_url('BackPanel/CMS/Edit_cms/'.$cm['cms_id']);?>"><i class="fa fa-edit icon-white"></i></a>
										<a class="btn btn-danger" href="#" onclick="delete_data(<?php echo $cm['cms_id'];?>,this)"><i class="fa fa-trash icon-white"></i></a>
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
function delete_data(id,ele)
	{
		var r=confirm("Are You Sure??");
		if (r==true){
		$.ajax({
			url:"<?php echo base_url('BackPanel/CMS/DeleteCMS');?>",
			type:"post",
			data:"id="+id,
			success:function(d){
				
				if(d=='1')
				{
					custom_notify('CMS Delete Successfully', "success");
					
					$(ele).parents("tr").remove();
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