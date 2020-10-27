<?php 
$CI =& get_instance();
$CI->load->model('Home_model');
/* $rsPanels = $CI->Sidemenu_model->getPanel();
$rsAssignModules = $CI->Sidemenu_model->getAssignModule(); */
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sparkling Beauty</title>
    <meta name="description" content="Sparkling Beauty" />
    <meta name="keywords" content="Sparkling Beauty">
    <meta name="author" content="Sparkling Beauty" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- Favicone Icon -->
    <link rel="shortcut icon" type="<?php echo base_url('front_assets/');?>image/x-icon" href="img/icon.ico">
    <link rel="icon" type="img/png" href="<?php echo base_url('front_assets/');?>img/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo base_url('front_assets/');?>img/favicon.png">

    <!-- CSS -->
    <link href="<?php echo base_url('front_assets/');?>css/plugins/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap css -->
    <link href="<?php echo base_url('front_assets/');?>css/plugins/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- fontawesome css -->
    <link href="<?php echo base_url('front_assets/');?>css/plugins/animate.css" rel="stylesheet" type="text/css" />
	
	 <link href="<?php echo base_url('front_assets/');?>css/plugins/nice-select.css" rel="stylesheet" type="text/css" />
    <!-- animate css -->
    <link href="<?php echo base_url('front_assets/');?>css/style.css" rel="stylesheet" type="text/css" />
    <!-- template css -->
    <link href="<?php echo base_url('front_assets/');?>plugins/rev_slider/css/settings-ver.5.3.1.css" rel="stylesheet" type="text/css" />
    <!-- Slider Revolution Css Setting -->
	
	 <link href="<?php echo base_url('front_assets/');?>plugins/photoswipe_popup/photoswipe.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('front_assets/');?>plugins/photoswipe_popup/default-skin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>front_assets/css/loader/loading.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>front_assets/css/toast/jquery.toast.css">
</head>
<body>
	 <?php 
	$exe11=$this->db->get('tbl_site_setting');
	$con_data11=$exe11->result_array();
	?>
    <!-- Newsletter Popup ---------------------------------------------------->
    <section id="nlpopup" data-expires="30" data-delay="10">
        <!--Close Button-->
        <a href="javascript:void(0)" class="nlpopup_close nlpopup_close_icon">
            <img src="<?php echo base_url('front_assets/');?>img/close-icon-white.png" alt="Newsletter Close" /></a>
        <!--End Close Button-->

        <h3 class="mb-40">Join Our Mailing List </h3>
        <p class="black mb-20">
            But I must explain to you how all this mistaken<br />
            idea of denouncing pleasure pain.
        </p>
        <form>
            <input class="input-md" name="footeremail" title="Enter Email Address.." placeholder="example@domain.com" type="email">
            <button class="btn btn-md btn-color">Subscribe</button>
        </form>
        <label class="mt-20">
            Sign up For Exclusive Updates, New Arrivals<br />
            And Insider-Only Discount.</label>
        <a class="nlpopup_close nlpopup_close_link mt-40">&#10006; Close</a>
    </section>
    <!-- Overlay -->
    <div id="nlpopup_overlay"></div>
    <!-- End Newsletter Popup ------------------------------------------------>

    <!-- Sidebar Menu (Cart Menu) ------------------------------------------------>
    <section id="sidebar-right" class="sidebar-menu sidebar-right">
        <div class="cart-sidebar-wrap">

            <!-- Cart Headiing -->
            <div class="cart-widget-heading">
                <h4>Shopping Cart</h4>
                <!-- Close Icon -->
                <a href="javascript:void(0)" id="sidebar_close_icon" class="close-icon-white"></a>
                <!-- End Close Icon -->
            </div>
            <!-- End Cart Headiing -->

            <!-- Cart Product Content -->
            <div id="cart_data">
            </div>
            <!-- Cart Footer -->
        </div>
    </section>
    <!--Overlay-->
    <div class="sidebar_overlay"></div>
    <!-- End Sidebar Menu (Cart Menu) -------------------------------------------->

    <!-- Search Overlay Menu ----------------------------------------------------->
    <section class="search-overlay-menu">
        <!-- Close Icon -->
        <a href="javascript:void(0)" class="search-overlay-close"></a>
        <!-- End Close Icon -->
        <div class="container">
            <!-- Search Form -->
            <form role="search" id="searchform" action="#" method="post">
                <div class="search-icon-lg">
                    <img src="<?php echo base_url('front_assets/');?>img/search-icon-lg.png" alt="" />
                </div>
                <label class="h6 normal search-input-label" for="search-query">Enter keywords to Search Product</label>
                <input value="" name="q" id="search_txt" type="search" placeholder="Search..." />
                <button type="button" onclick="SearchProduct()"> 
                    <img src="<?php echo base_url('front_assets/');?>img/search-lg-go-icon.png" alt="" />
                </button>
            </form>
            <!-- End Search Form -->

        </div>
    </section>
    <!-- End Search Overlay Menu ------------------------------------------------>

    <!--==========================================-->
    <!-- wrapper -->
    <!--==========================================-->
    <div class="wraper">
        <!-- Header -->
        <header class="header">
            <!--Topbar-->
            <div class="header-topbar">
                <div class="header-topbar-inner">
                    <!--Topbar Left-->
                    <div class="topbar-left">
                        <div class="phone"><i class="fa fa-phone left" aria-hidden="true"></i>Customer Support : <b><?php echo $con_data11[0]['ts_phone'];?></b> | <i class="fa fa-whatsapp left" aria-hidden="true"></i>For Bulk Inquiries Call or Whatsapp on : <b><?php echo $con_data11[0]['ts_whats_app_number'];?></div>

                    </div>
                    <!--End Topbar Left-->

                    <!--Topbar Right-->
                    <div class="topbar-right">
                        <ul class="list-none">
							<?php $customer_data=$this->session->userdata('customer_data');
                                    if(!empty($customer_data)){?>
									<li class="dropdown-nav">
										<a href="#">My Account<i class="fa fa-angle-down right" aria-hidden="true"></i></a>
										<!--Dropdown-->
										<div class="dropdown-menu">
											<ul>
												<li><a href="<?php echo base_url('my-account');?>">Profile</a></li>
												<li><a href="<?php echo base_url('change-password');?>">Change Password</a></li>
												<li><a href="<?php echo base_url('my-orders');?>">My Orders</a></li>
												<li><a href="<?php echo base_url('User/logout');?>">Logout</a></li>
											</ul>
										</div>
										<!--End Dropdown-->
									</li>
									<?php }else{ ?>
									<li>
										<a href="<?php echo base_url('my-account');?>">
											<i class="fa fa-lock left" aria-hidden="true"></i>
											<span class="">Login / Register</span>
										</a>
									</li>
									<?php } ?>
                            
                            <!--<li class="dropdown-nav">
                                <a href="#">About Us<i class="fa fa-angle-down right" aria-hidden="true"></i></a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li><a href="#">Company Overview</a></li>
                                        <li><a href="#">Vision</a></li>
                                        <li><a href="#">Mission</a></li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="about.html">About</a>
                            </li>-->
                            <li>
                                <a href="<?php echo base_url('contact-us');?>">Contact us</a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Topbar Right -->
                </div>
            </div>
            <!--End Topbart-->

            <!-- Header Container -->
            <div id="header-sticky" class="header-main">
                <div class="header-main-inner">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="<?php echo base_url();?>">
                            <img src="<?php echo base_url('front_assets/');?>images/logo.png" alt="Philos" />
                        </a>
                    </div>
                    <!-- End Logo -->


                    <!-- Right Sidebar Nav -->
                    <div class="header-rightside-nav">
                        <!-- Login-Register Link -->
                      
                        <!-- End Login-Register Link -->

                        <!-- Sidebar Icon -->
                        <div class="sidebar-icon-nav">
                            <ul class="list-none-ib">
                                <!-- Search-->
                                <li><a id="search-overlay-menu-btn"><i aria-hidden="true" class="fa fa-search"></i></a></li>

                                <!-- Whishlist-->
                                <li><a class="js_whishlist-btn" href="<?php echo base_url('wishlist')?>"><i aria-hidden="true" class="fa fa-heart"></i><span class="countTip" id="wish_count">0</span></a></li>

                                <!-- Cart-->
                                <li><a id="sidebar_toggle_btn">
                                    <div class="cart-icon">
                                        <i aria-hidden="true" class="fa fa-shopping-bag"></i>
                                    </div>

                                    <div class="cart-title">
                                        <span class="cart-count" id="cart_count">0</span> / ₹<span class="cart-price strong" id="cart_price"></span>
                                    </div>
                                </a></li>
                            </ul>
                        </div>
                        <!-- End Sidebar Icon -->
                    </div>
                    <!-- End Right Sidebar Nav -->


                    <!-- Navigation Menu -->
                    <nav class="navigation-menu">
                        <ul>
                            <li>
                                <a href="<?php echo base_url();?>">Home</a>
                            </li>
                            <?php 
							$this->db->where('cat_subcat_id', '0');
							$this->db->where('cat_status', '1');
							$q = $this->db->get('tbl_category');
							foreach($q->result_array() as $md){
							?>
							<li>
                                <a href="<?php echo base_url('product-category/').$md['cat_url_keyword'];?>"><?php echo $md['cat_name'];?></a>
								
                                <ul class="nav-dropdown js-nav-dropdown">
                                    <li class="container">
                                        <ul class="row">
											<?php $CI->Home_model->getMenu($md['cat_id'],$md['cat_url_keyword']);?>
                                            <!--<li class="nav-dropdown-grid">
                                                <h6>New In</h6>
                                                <ul>
                                                    <li><a href="#">New In Clothing</a></li>
                                                    <li><a href="#">New In Shoes<span class="new-label">New</span></a></li>
                                                    <li><a href="#">New In Bags</a></li>
                                                    <li><a href="#">New In Watches</a></li>
                                                    <li><a href="#">New In Accesories</a></li>
                                                </ul>
                                            </li>-->
                                        </ul>
                                    </li>
                                </ul>
                            </li>
							<?php } ?>
							<?php /*
							$this->db->order_by('cms_id', 'asc');
							$q1 = $this->db->get('tbl_cms');
							foreach($q1->result_array() as $cs){
							*/?><!--
							<li>
                                <a href="<?php /*echo base_url().$cs['cms_url'];*/?>"><?php /*echo $cs['cms_title']*/?></a>
                            </li>
							--><?php /*} */?>
                        </ul>
                    </nav>
                    <!-- End Navigation Menu -->

                </div>
            </div>
            <!-- End Header Container -->
        </header>
        <!-- End Header -->

        <!-- Page Content Wraper -->
        <div class="page-content-wraper">