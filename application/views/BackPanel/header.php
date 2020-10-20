<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description"
      content="Elite Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs."/>
<meta name="keywords"
      content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Elite Able, Elite Able bootstrap admin template">
<meta name="author" content="Phoenixcoded"/>
<!-- Favicon icon -->
<link rel="icon" href="http://html.phoenixcoded.net/elite-able/bootstrap/assets/images/favicon.ico" type="image/x-icon">
<!-- fontawesome icon -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/fontawesome/css/fontawesome-all.min.css">
<!-- animation css -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/animation/css/animate.min.css">
<!-- notification css -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/notification/css/notification.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/data-tables/css/datatables.min.css">
<!-- vendor css -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/loader/loading.min.css">
</head>
<body class="">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>

<?php include("sidebar.php"); ?>


<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">

    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
        <a href="index.html" class="b-brand">
            <div class="b-bg">
                S
            </div>
            <span class="b-title">Sparkling Beauty</span>
        </a>
    </div>
    <a class="mobile-menu" id="mobile-header" href="#!">
        <i class="feather icon-more-horizontal"></i>
    </a>
    <div class="collapse navbar-collapse">
        <a href="#!" class="mob-toggler"></a>
        <ul class="navbar-nav mr-auto">
            <li>
                <!-- ============================================================================================= -->
                <!-- remove .page-header div if you want breadcumb in bottom of header -->
                <!-- ============================================================================================= -->
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                </div>
                <!-- [ breadcrumb ] end -->
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon feather icon-settings"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="<?php echo base_url('front_assets/img/noimage.png'); ?>" class="img-radius"
                                 alt="User-Profile-Image">
                            <span>Admin</span>
                            <a href="<?php echo base_url('BackPanel/Dashboard/logout'); ?>" class="dud-logout"
                               title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                        <ul class="pro-body">
                            <!--<li><a href="#!" class="dropdown-item"><i class="feather icon-settings"></i> Settings</a></li>
                            <li><a href="#!" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                            <li><a href="message.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>-->
                            <li><a href="<?php echo base_url('BackPanel/Dashboard/logout'); ?>" class="dropdown-item"><i
                                            class="feather icon-log-out"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>

</header>
<!-- [ Header ] end -->