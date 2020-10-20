<!DOCTYPE html>
<html lang="en">
<head>

	<title>Sparkling Beauty | Dashboard</title>
<?php include("header.php");?>


    
    
    
    <!-- [ Main Content ] start -->
<div class="pcoded-main-container">
	<div class="pcoded-wrapper">
		<div class="pcoded-content">
			<div class="pcoded-inner-content">
				<div class="main-body">
					<div class="page-wrapper">
						<div class="page-header">
							<div class="page-block">
								<div class="row align-items-center">
									<div class="col-md-12">
										<div class="page-header-title">
											<h5>Home</h5>
										</div>
										<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href="<?php echo base_url('BackPanel');?>"><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<!--<div class="col-xl-8 col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="card table-card">
											<div class="row-table">
												<div class="col-sm-6 card-body-big br">
													<div class="row">
														<div class="col-sm-4">
															<i class="icon feather icon-eye text-c-green mb-1 d-block"></i>
														</div>
														<div class="col-sm-8 text-md-center">
															<h5>10k</h5>
															<span>Visitors</span>
														</div>
													</div>
												</div>
												<div class="col-sm-6 card-body-big">
													<div class="row">
														<div class="col-sm-4">
															<i class="icon feather icon-music text-c-red mb-1 d-block"></i>
														</div>
														<div class="col-sm-8 text-md-center">
															<h5>100%</h5>
															<span>Volume</span>
														</div>
													</div>
												</div>
											</div>
											<div class="row-table">
												<div class="col-sm-6 card-body-big br">
													<div class="row">
														<div class="col-sm-4">
															<i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i>
														</div>
														<div class="col-sm-8 text-md-center">
															<h5>2000 +</h5>
															<span>Files</span>
														</div>
													</div>
												</div>
												<div class="col-sm-6 card-body-big">
													<div class="row">
														<div class="col-sm-4">
															<i class="icon feather icon-mail text-c-yellow mb-1 d-block"></i>
														</div>
														<div class="col-sm-8 text-md-center">
															<h5>120</h5>
															<span>Mails</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card table-card">
											<div class="row-table">
												<div class="col-sm-6 card-body-big br">
													<div class="row">
														<div class="col-sm-4">
															<i class="icon feather icon-share-2 text-c-purple mb-1 d-block"></i>
														</div>
														<div class="col-sm-8 text-md-center">
															<h5>1000</h5>
															<span>Shares</span>
														</div>
													</div>
												</div>
												<div class="col-sm-6 card-body-big">
													<div class="row ">
														<div class="col-sm-4">
															<i class="icon feather icon-wifi text-c-purple mb-1 d-block"></i>
														</div>
														<div class="col-sm-8 text-md-center">
															<h5>600</h5>
															<span>Network</span>
														</div>
													</div>
												</div>
											</div>
											<div class="row-table">
												<div class="col-sm-6 card-body-big br">
													<div class="row ">
														<div class="col-sm-4">
															<i class="icon feather icon-rotate-ccw text-c-purple mb-1 d-block"></i>
														</div>
														<div class="col-sm-8 text-md-center">
															<h5>3550</h5>
															<span>Returns</span>
														</div>
													</div>
												</div>
												<div class="col-sm-6 card-body-big">
													<div class="row ">
														<div class="col-sm-4">
															<i class="icon feather icon-shopping-cart text-c-purple mb-1 d-blockz"></i>
														</div>
														<div class="col-sm-8 text-md-center">
															<h5>100%</h5>
															<span>Order</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="card">
											<div class="card-body">
												<h6 class="text-c-blue mb-3">Department wise annual recurring and profit </h6>
												<div class="row">
													<div class="col-auto mb-3">
														<h3>$687,578</h3>
														<h6><i class="feather icon-trending-down text-c-red mr-2"></i>Marketing Growth</h6>
														<span>Measure How Fast You're Growing in <br>current Market.<span class="text-c-blue">Learn More</span></span>
													</div>
													<div class="col mb-3">
														<h3>30%</h3>
														<h6><i class="feather icon-trending-up text-c-blue mr-2"></i>Annual profit/stakeholders</h6>
														<span>Ave 30% or more profite provide to investor as <br>Anual return.<span class="text-c-blue">Learn More</span></span>
													</div>
												</div>
											</div>
											<div id="account-chart" style="height:215px;width:100%;"></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card">
											<div class="card-header">
												<h5>Sale report of year</h5>
											</div>
											<div class="card-body">
												<div id="type-chart" style="height:170px;"></div>
												<div class="mt-3">
													<span class="d-block mb-2"><i class="fas fa-circle f-10 m-r-15" style="color:#67b7dc;"></i>Desktop Computers<span class="float-right f-w-400">76.7%</span></span>
													<span class="d-block mb-2"><i class="fas fa-circle f-10 m-r-15" style="color:#8067dc;"></i>Smartphones<span class="float-right f-w-400">15%</span></span>
													<span class="d-block"><i class="fas fa-circle f-10 m-r-15" style="color:#dc67ce;"></i>Tablets<span class="float-right f-w-400">30%</span></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="card">
													<div class="card-body">
														<h6>Conversions <span class="text-muted">( purchased )</span></h6>
														<h4 class="m-0">0.85%<span class="text-c-blue ml-2"><i class="feather icon-arrow-up"></i>0.50%</span></h4>
													</div>
													<div id="coversions-chart1" style="height:60px;width:100%;"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card">
											<div class="card-header">
												<h5>Visits by Location</h5>
											</div>
											<div class="card-body">
												<div id="am-map-chart" style="height:285px;width:100%;"></div>
												<div class="row mb-2 mt-3">
													<div class="col">
														<p class="m-0"><i class="fas fa-circle text-c-blue f-10 m-r-10"></i>USA</p>
													</div>
													<div class="col">
														<p class="m-0">8.2 k</p>
													</div>
													<div class="col">
														<p class="text-c-blue m-0"><i class="feather icon-arrow-up"></i>8%</p>
													</div>
												</div>
												<div class="row mb-2">
													<div class="col">
														<p class="m-0"><i class="fas fa-circle text-c-red f-10 m-r-10"></i>India</p>
													</div>
													<div class="col">
														<p class="m-0">7.2 k</p>
													</div>
													<div class="col">
														<p class="text-c-red m-0"><i class="feather icon-arrow-up"></i>5%</p>
													</div>
												</div>
												<div class="row mb-2">
													<div class="col">
														<p class="m-0"><i class="fas fa-circle text-c-green f-10 m-r-10"></i>China</p>
													</div>
													<div class="col">
														<p class="m-0">9.2 k</p>
													</div>
													<div class="col">
														<p class="text-c-green m-0"><i class="feather icon-arrow-up"></i>6%</p>
													</div>
												</div>
												<div class="row mb-2">
													<div class="col">
														<p class="m-0"><i class="fas fa-circle text-c-yellow f-10 m-r-10"></i>Brazil</p>
													</div>
													<div class="col">
														<p class="m-0">3.2 k</p>
													</div>
													<div class="col">
														<p class="text-c-yellow m-0"><i class="feather icon-arrow-up"></i>4%</p>
													</div>
												</div>
												<div class="row mb-2">
													<div class="col">
														<p class="m-0"><i class="fas fa-circle text-c-purple f-10 m-r-10"></i>Other</p>
													</div>
													<div class="col">
														<p class="m-0">4.2 k</p>
													</div>
													<div class="col">
														<p class="text-c-purple m-0"><i class="feather icon-arrow-up"></i>3%</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-md-12">
								<div class="row">
									<div class="col-xl-6 col-md-6">
										<div class="card bg-primary text-white mrr-card">
											<div class="card-body mb-3">
												<span>Average Support Requests</span>
											</div>
											<div id="average-chart1" class="position-absolute bottom-chart" style="height:145px;width:100%;"></div>
											<div class="card-body">
												<h3 class="mt-1 mb-1 text-white">20</h3>
												<span>Solve: 15</span>
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-md-6">
										<div class="card bg-success text-white mrr-card">
											<div class="card-body mb-3">
												<span>Quick Agent Response</span>
											</div>
											<div id="average-chart2" class="position-absolute bottom-chart" style="height:145px;width:100%;"></div>
											<div class="card-body">
												<h3 class="mt-1 mb-1 text-white">30 min</h3>
												<span>remain: 3</span>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="card">
											<div class="card-body">
												<h6 class="mb-3">Users by time of day [current 1236]</h6>
												<div id="time-user" style="height:460px;width:100%;"></div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-auto">
														<span>Revenue</span>
													</div>
													<div class="col text-right">
														<div class="btn-group">
															<button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">This month</button>
															<div class="dropdown-menu">
																<a class="dropdown-item" href="#!">1 Week</a>
																<a class="dropdown-item" href="#!">2 Month</a>
																<a class="dropdown-item" href="#!">4 Year</a>
															</div>
														</div>
													</div>
												</div>
												<div class="progress mt-4" style="height:10px;">
													<div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<div class="row">
													<div class="col-auto">
														<span class="text-uppercase mt-2 d-block">EARNING</span>
														<h5 class="mb-0">$6.455</h5>
													</div>
													<div class="col text-right">
														<span class="text-uppercase mt-2 d-block">EXPENSE</span>
														<h5 class="mb-0">$3.869</h5>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-auto">
														<span class="text-uppercase d-block">budget</span>
													</div>
													<div class="col text-right">
														<span class="text-uppercase d-block">EARNING</span>
														<h5 class="mb-0">$5,569 of $1,000</h5>
													</div>
												</div>
												<div class="progress mt-2" style="height:10px;">
													<div class="progress-bar bg-success rounded" role="progressbar" style="width: 50%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">40%</div>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<h6 class="mb-0"><i class="feather icon-arrow-down text-c-red"></i>$2,450<span class="float-right"><i class="feather icon-arrow-up text-c-green"></i>$5,420</span></h6>
												<div class="progress mt-1" style="height:6px;">
													<div class="progress-bar bg-danger rounded" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<span class="mt-1 d-block mb-3">This Year<span class="float-right">Previous Year</span></span>
												<span class="mb-2 d-block">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</span>
												<h6 class="text-c-red">Landing page design</h6>

											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12">
								<div class="card table-card">
									<div class="card-header">
										<h5>Site visitors session log</h5>
									</div>
									<div class="card-body px-0 py-0">
										<div class="table-responsive">
											<div class="session-scroll" style="height:356px;position:relative;">
												<table class="table table-hover m-b-0">
													<thead>
														<tr>
															<th><span>CAMPAIGN DATE</span></th>
															<th><span>CLICK <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
															<th><span>COST <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
															<th><span>CTR <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
															<th><span>ARPU <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
															<th><span>ECPI <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
															<th><span>ROI <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
															<th><span>REVENUE <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
															<th><span>CONVERSIONS <a class="help" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="feather icon-help-circle f-16"></i></a></span></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Total and average</td>
															<td>1300</td>
															<td>1025</td>
															<td>14005</td>
															<td>95,3%</td>
															<td>29,7%</td>
															<td>3,25</td>
															<td>2:30</td>
															<td>45.5%</td>
														</tr>
														<tr>
															<td>8-11-2016</td>
															<td>786
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-danger rounded" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>485
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-primary rounded" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>769
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-warning rounded" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>45,3%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-success rounded" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>6,7%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-info rounded" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>8,56
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-danger rounded" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>10:55
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-warning rounded" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>33.8%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-success rounded" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
														</tr>
														<tr>
															<td>15-10-2016</td>
															<td>786
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-danger rounded" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>523
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-primary rounded" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>736
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-warning rounded" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>78,3%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-success rounded" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>6,6%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-info rounded" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>7,56
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-danger rounded" role="progressbar" style="width: 44%;" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>4:30
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-warning rounded" role="progressbar" style="width: 68%;" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>76.8%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
														</tr>
														<tr>
															<td>8-8-2017</td>
															<td>624
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-danger rounded" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>436
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-primary rounded" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>756
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-warning rounded" role="progressbar" style="width: 95%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>78,3%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-success rounded" role="progressbar" style="width: 38%;" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>6,4%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-info rounded" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>9,45
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-danger rounded" role="progressbar" style="width: 41%;" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>9:05
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-warning rounded" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>8.63%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-success rounded" role="progressbar" style="width: 41%;" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
														</tr>
														<tr>
															<td>11-12-2017</td>
															<td>423
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-danger rounded" role="progressbar" style="width: 54%;" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>123
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-primary rounded" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>756
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-warning rounded" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>78,6%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-success rounded" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>45,6%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-info rounded" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>6,85
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-danger rounded" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>7:45
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-warning rounded" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
															<td>33.8%
																<div class="progress mt-1" style="height:4px;">
																	<div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
															</td>
														</tr>

													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>-->
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
</body>

</html>