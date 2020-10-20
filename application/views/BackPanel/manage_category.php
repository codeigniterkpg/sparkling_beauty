<!DOCTYPE html>
<html lang="en">
<head>

	<title>Sparkling Beauty | Category</title>
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
                                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Category</a></li>
                                            
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
                                        <h5>Manage Category</h5>
										<a style="float:right" href="<?php echo base_url('BackPanel/Category/AddCategory');?>" class="btn btn-primary">Add New</a>
                                    </div>
									
                                    <div class="card-body">
                                        <div class="table-responsive dt-responsive">
                                            <table id="datatable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
														<th>Category</th>
														<th>Actions</th>
													</tr>
                                                </thead>
                                                <tbody>
													<?php echo $Category; ?>
                                                </tbody>
                                                <tfoot>
													<tr>
														<th>Category</th>
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
						
						 <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- [ Main Content ] end -->

<?php include("footer.php");?>
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

			
function delete_data(id,ele)
	{
		var r=confirm("Are You Sure??");
		if (r==true){
		$.ajax({
			url:"<?php echo base_url('BackPanel/Category/DeleteCategory');?>",
			type:"post",
			data:"id="+id,
			success:function(d){
				
				if(d=='1')
				{
					custom_notify('Category Delete Successfully', "success");
					$(ele).parents("tr").remove();
				}else if(d=='sorry')
				{
					
					custom_notify('Please Delete Sub Category or Product', "warning");
				} else{
					
					custom_notify('An error has been occurred while performing this action', "danger");
				}
			}
		});
		}else{
			
		}
	}function change_status(id,status,ele){	showload();	if(status==1){		var st=0;	}else{		var st=1;	}	$.ajax({		url:"<?php echo base_url('BackPanel/Category/ChangeStatus');?>",		type:"post",		data:{id:id,status:st},		success:function(d){			hideload();			$(ele).val(st);			custom_notify('Status Changed Successfully', "success");								}	});}
        </script>
		</body>

</html>