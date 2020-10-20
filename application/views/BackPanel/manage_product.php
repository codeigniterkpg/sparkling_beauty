<!DOCTYPE html>
<html lang="en">
<head>

	<title>Sparkling Beauty | Product</title>
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
                                            <h5 class="m-b-10">Product</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Product</a></li>
                                            
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
                                        <h5>Manage Product</h5>
										<a style="float:right" href="<?php echo base_url('BackPanel/Product/AddProduct');?>" class="btn btn-primary">Add New</a>
                                    </div>
									
                                    <div class="card-body">
                                        <div class="table-responsive dt-responsive">
                                            <table id="product_table" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
														<th>SrNo.</th>
														<th>Product</th>
														<th>Category</th>
														<th>SKU</th>
														<th>Status</th>
														<th>Actions</th>
													</tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
													<tr>
														<th>SrNo.</th>
														<th>Product</th>
														<th>Category</th>
														<th>SKU</th>
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


                /* var table = $('#datatable').DataTable({

					ordering: false

                }); */


                function books() {
					var table_name = "product_table";
					var member_json = [
						"no",
						"name",
						"category",
						"sku",
						"status",
						"action"
					];
					var url                 = "<?php echo base_url('BackPanel/Product/table');?>";
					var additional_search   = [];

					my_data_table(table_name, member_json, url, additional_search);
				}


				books();
				function my_data_table($table_name, $column, $url, $additional_search) {
					if($table_name !== null && $column.length > 0 && $url !== null) {
						$aocolumn = [];
						for (var i = 0; i < $column.length; i++){
							$aocolumn.push({"mData":$column[i]})
						}

						var json = {
							"aoColumns"     : $aocolumn,
							"bLengthChange" : true,
							"iDisplayLength": 10,
							"bDestroy"      : true,
							"aaSorting"     : [],
							"bProcessing"   : true,
							"bServerSide"   : true,
							"sServerMethod" : "POST",
							"sAjaxSource"   : $url,
							"fnServerData"  : function ( sSource, aoData, fnCallback ) {
								if($additional_search.length > 0){
									$.each($additional_search,function(){
										aoData.push( { "name": this.key, "value": this.value } );
									});
								}
								$.ajax( {
									"dataType"  : 'json',
									"type"      : "POST",
									"url"       : sSource,
									"data"      : aoData,
									"success"   : fnCallback
								}).done(function(){
									
								});
							},
							"aLengthMenu": [
								[10, 25, 50, -1],
								[10, 25, 50, "All"] // change per page values here
							],
							"oLanguage": {
								"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
								"sLengthMenu": "Show _MENU_ entries",
								"oPaginate": {
									"sPrevious": "Prev",
									"sNext": "Next"
								}
							},
							"aoColumnDefs": [
								{'bSortable': false, 'aTargets': [0,-1]}
							],
							"dom": "Bfrtip",

							"buttons": [

								'excelHtml5',

								'pdfHtml5'

							]
						};
					}
					$("#" + $table_name).dataTable(json);
				}

            } );

			
function changeStatus(id){
	showload();
	var status=$("#chk_"+id).val();
	if(status==1){
		var st=0;
		var spn='<span style="color:green">Active</span>';
	}else{
		var st=1;
		var spn='<span style="color:red">DeActive</span>';
	}
	$.ajax({

		url:"<?php echo base_url('BackPanel/Product/ChangeStatus');?>",

		type:"post",

		data:{id:id,status:status},

		success:function(d){

			hideload();

			$("#chk_"+id).val(st);
			$("#span_"+id).html(spn);

		}

	});

}
        </script>
		</body>

</html>