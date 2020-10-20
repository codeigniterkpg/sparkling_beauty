<!DOCTYPE html>

<html lang="en">

<head>



	<title>Sparkling Beauty | Customer Order </title>

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

                                            <h5 class="m-b-10">Customer Order</h5>

                                        </div>

                                        <ul class="breadcrumb">

                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>

                                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Customer Order</a></li>

                                            

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

                                        <h5>Manage Order</h5>


                                    </div>

									

                                    <div class="card-body">

                                        <div class="table-responsive dt-responsive">

                                            <table id="datatable" class="table table-striped table-bordered nowrap">

                                                <thead>
													<tr>														
														<th>Name</th>
														<th>Phone No</th>
														<th>Email</th>
														<th>Grand Total</th>
														<th>Date</th>
														<th>Paymode</th>
														<th>Order Status</th>
														<th>Payment Status</th>
														<th>Order Detail</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>Name</th>
														<th>Phone No</th>
														<th>Email</th>
														<th>Grand Total</th>
														<th>Date</th>
														<th>Paymode</th>
														<th>Order Status</th>
														<th>Payment Status</th>
														<th>Order Detail</th>
													</tr>
												</tfoot>
												<tbody>
													<?php foreach($Order as $pro){
														if($pro['o_status']==0){
															$o_status='Pending';
														}else if($pro['o_status']==1){
															$o_status='Dispatched';
														}else if($pro['o_status']==2){
															$o_status='Delivered';
														}else if($pro['o_status']==3){
															$o_status='Cancelled';
														}else if($pro['o_status']==4){
															$o_status='Replace';
														}else if($pro['o_status']==5){
															$o_status='Return';
														}else if($pro['o_status']==6){
															$o_status='Replaced';
														}else if($pro['o_status']==7){
															$o_status='Returned';
														}else{
															$o_status='N/A';
														}
														if($pro['o_type']==1){
															$o_type='Paytm';
														}else{
															$o_type='COD';
														}
														if($pro['o_payment_status']==1){
															$pay_status='Paid';
														}else{
															$pay_status='Due';
														}
														?>
														<tr>
															<td><?php echo $pro['o_name'];?></td>
															<td><?php echo $pro['o_phone'];?></td>
															<td><?php echo $pro['o_email'];?></td>
															<td><?php echo $pro['o_grand_total'];?></td>
															<td><?php echo date('d-m-Y',strtotime($pro['o_date']));?></td>
															<td><?php echo $o_type;?></td>
															<td>
															<?php if($pro['o_status']==0){?>
																<select onchange="changeStatus(this.value,'<?php echo $pro['o_id'];?>')">
																	<option <?php if($pro['o_status']==0){ echo "selected"; }?> value="0">Pending</option>
																	<option <?php if($pro['o_status']==1){ echo "selected"; }?> value="1">Dispatched</option>
																	<option <?php if($pro['o_status']==2){ echo "selected"; }?> value="2">Delivered</option>
																	<option <?php if($pro['o_status']==3){ echo "selected"; }?> value="3">Cancel</option>
																</select>
															<?php }else if($pro['o_status']==1){ ?>
																<?php echo $o_status;?>
																<select onchange="changeStatus(this.value,'<?php echo $pro['o_id'];?>')">
																	<option value="0">Select</option>
																	<option <?php if($pro['o_status']==2){ echo "selected"; }?> value="2">Delivered</option>
																	<option <?php if($pro['o_status']==3){ echo "selected"; }?> value="3">Cancel</option>
																</select>
															<?php }else { ?>
																<?php echo $o_status;?>
																<?php if($pro['o_status']==4 and $pro['o_replace_status']==1){?>
																<br><input type="button" class="btn btn-info" value="Replace Order" data-toggle="modal" data-target="#replaceorder" onclick="GetOrddetail('<?php echo $pro['o_id'];?>')">
																<?php } ?>
															<?php } ?>
															</td>
															<td><?php echo $pay_status;?></td>
															<td><input type="button" class="btn btn-primary" value="View" data-toggle="modal" data-target="#largesizemodal" onclick="GetSelectOrddetail('<?php echo $pro['o_id'];?>')"></td>
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

 <!-- Modal order detail-->
				<div class="modal fade" id="replaceorder">
                  <div class="modal-dialog modal-lg" style="max-width: 80%;">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Order Items</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <!-- [ Invoice ] start -->
                            <div class="container" id="printTable">
                                <div>
                                    <div class="card" id="dataseta">
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- [ Invoice ] end -->
                        </div>						
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="largesizemodal">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Order Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <!-- [ Invoice ] start -->
                            <div class="container" id="printTable">
                                <div>
                                    <div class="card" id="dataset">
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- [ Invoice ] end -->
                        </div>						
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                      </div>
                    </div>
                  </div>
                </div>
				<div class="modal fade" id="tracking_modal">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Traking Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
							<form id="myForm" action="<?php echo base_url("BackPanel/Order/SaveTrackingDetail");?>" method="POST">
								<div class="form-group">
									<label for="exampleInputEmail1">Courier Company</label>
									<input type="text" id="cname" required name="cname"  class="form-control"> 
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Traking Code</label>
									<input type="text" id="tcode" required name="tcode"  class="form-control">
									<input type="hidden" id="ord_id" name="ord_id" />   
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                      </div>
                    </div>
                  </div>
                </div>
<!-- [ Main Content ] end -->



<?php include("footer.php");?>
 
	
<script src="<?php echo base_url('');?>assets/js/pages/form-advance-custom.js"></script>
<script>
function getColors(id,prod,oid){
	showload();
	$.ajax({
	  url: '<?php echo base_url('BackPanel/Order/GetProdColors');?>',
	  type: "POST",
	  data: {id:id,prod:prod},
	  success: function (response) {
		hideload();
		$("#select-color"+oid).html(response);
		$("#select-color"+oid).niceSelect("update");
		
	  }
    });
}
function getPrice(id,prod,oid){
	showload();
	var sz=$("#select-size"+oid).val();
	var qty=$("#qty"+oid).val();
	$.ajax({
	  url: '<?php echo base_url('BackPanel/Order/GetProdPrice');?>',
	  type: "POST",
	  dataType: 'json',
	  data: {id:id,prod:prod,sz:sz},
	  success: function (response) {
		hideload();
		$("#product_final_price"+oid).html(response.product_price*qty);
		$("#pro_price"+oid).html(response.final_price);
		$("#price_product").val(response.final_price);
		$("#gst_type").val(response.gst_type);
		$("#gst_perce").val(response.gst_perce);
		$("#gst_amount").val(response.gst_amount);
		$("#product_price").val(response.product_price);
	  }
    });
}
   function changeStatus(sta,id){
	if(sta==1){
		$("#ord_id").val(id);
		$("#tracking_modal").modal("show");
	}else{
		showload();
		$.ajax({

			url:"<?php echo base_url('BackPanel/Order/changeStatus');?>",

			type:"post",

			data:{id:id,status:sta},

			success:function(d){
				hideload();
				if(d==1){
					custom_notify('Status Changed Successfully', "success");
				}else{
					custom_notify('An unexpected error has been occurred!!', "danger");
				}
			}

		});
	}
	
}
</script>
<script>
	function GetOrddetail(id)
	{				
		$("#dataset").html('');
		$.ajax({
		 url:"<?php echo base_url('BackPanel/Order/GetReplaceOrderdetail');?>",
		 type:"post",
		 data:{'ord_id':id},
		 success:function(data){
			 $("#dataseta").html(data);					
			}									 
	  });
	}
	function GetSelectOrddetail(id)
	{				
		$("#dataset").html('');
		$.ajax({
		 url:"<?php echo base_url('BackPanel/Order/GetOrderdetail');?>",
		 type:"post",
		 data:{'ord_id':id },
		 success:function(data){
			 $("#dataset").html(data);					
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