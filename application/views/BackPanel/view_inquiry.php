<!DOCTYPE html>

<html lang="en">

<head>



	<title>Sparkling Beauty | Inquiry</title>

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

                                            <h5 class="m-b-10">Inquiry</h5>

                                        </div>

                                        <ul class="breadcrumb">

                                            <li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>

                                            <li class="breadcrumb-item"><a href="javascript:void(0)">Manage Inquiry</a></li>

                                            

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

                                        <h5>Manage Inquiry</h5>

										

                                    </div>

									

                                    <div class="card-body">

                                        <div class="table-responsive dt-responsive">

                                            <table id="datatable" class="table table-striped table-bordered nowrap">

                                                <thead>
													<tr>
														<th>Name</th>
														<th>Email</th>
														<th>Subject</th>
														<th>Comment</th>
														<th>Date</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>Name</th>
														<th>Email</th>
														<th>Subject</th>
														<th>Comment</th>
														<th>Date</th>
													</tr>
												</tfoot>
												<tbody>
													<?php foreach($List as $pro){?>
														<tr>
															<td><?php echo $pro['name'];?></td>
															<td><?php echo $pro['email'];?></td>
															<td><?php echo $pro['subject'];?></td>
															<td><?php echo $pro['comment'];?></td>
															<td><?php echo date('d-m-Y',strtotime($pro['date']));?></td>
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