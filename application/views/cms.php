<?php include("header.php");?>



 <!-- Page Content Wraper -->

        <div class="page-content-wraper">

            <!-- Bread Crumb -->

            <section class="breadcrumb">

                <div class="container">

                    <div class="row">

                        <div class="col-12">

                            <nav class="breadcrumb-link">

                                <a href="<?php echo base_url();?>">Home</a>

                                <span><?php echo $Data[0]['cms_title'];?></span>

                            </nav>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Bread Crumb -->



            <!-- Page Content -->

            <section class="content-page">

                <div class="container">

                    <div class="row">
						
						<?php if($Data[0]['cms_image']!=''){?>
						<div class="col-sm-12">
                        <h2 style="text-align: center;"><?php echo $Data[0]['cms_title'];?></h2>
						<img src="<?php echo base_url('uploads/cms/').$Data[0]['cms_image'];?>">
						</div>
						<?php } ?>
						<?php if($Data[0]['cms_image']!=''){?>
						<div class="col-sm-12">
							<p><?php echo $Data[0]['cms_description'];?></p>
						</div>
						<?php }else{ ?>
						<div class="col-sm-12">
							<p><?php echo $Data[0]['cms_description'];?></p>
						</div>
						<?php } ?>
                    </div>

                </div>

            </section>

			

            <!-- End Page Content -->



        </div>

        <!-- End Page Content Wraper -->



<?php include("footer.php");?>

<script type="text/javascript" src="<?php echo base_url('front_assets/js');?>/jquery.validate.js"></script>

