<?php  include("header.php");?>

        <!-- Intro -->
            <section id="intro" class="intro">
                <!-- Revolution Slider -->
                <div id="rev_slider_1078_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-source="gallery" style="background-color: transparent; padding: 0px;">
                    <!-- START REVOLUTION SLIDER 5.3.0.2 fullwidth mode -->
                    <div id="rev_slider_1078_1" class="rev_slider fullwidthabanner" style="display: none;" data-version="5.3.0.2">
                        <ul>
                            <!--<li class="dark-bg" data-index="rs-1" data-transition="random" data-slotamount="7" data-masterspeed="500" data-thumb="" data-saveperformance="off" data-title="01">
                               
                                <img src="<?php echo base_url('front_assets/');?>img/slide-img/slide_bg1.jpg" alt="h" title="home-1-slide-1" width="1920" height="1100" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="6" class="rev-slidebg" data-no-retina />

                                <h1 class="tp-caption NotGeneric-Title tp-resizeme text-center" style="letter-spacing: 0px; line-height: 60px;"
                                    data-x="140"
                                    data-y="center"
                                    data-hoffset=""
                                    data-voffset="-100"
                                    data-transform_idle="o:1;"
                                    data-width="['auto','auto','auto','auto']"
                                    data-height="['auto','auto','auto','auto']"
                                    data-transform_in="y:50px;opacity:0;s:700;e:Power3.easeOut;"
                                    data-transform_out="s:500;e:Power3.easeInOut;s:500;e:Power3.easeInOut;"
                                    data-start="500"
                                    data-speed="500"
                                    data-endspeed="500"
                                    data-splitin="none"
                                    data-splitout="none"
                                    data-responsive_offset="on">New Look<br />
                                    Fashion 2017
                                </h1>
                                <h3 class="tp-caption NotGeneric-Title tp-resizeme h3 normal text-center" style="letter-spacing: 0px;"
                                    data-x="195"
                                    data-y="center"
                                    data-hoffset=""
                                    data-voffset="0"
                                    data-transform_idle="o:1;"
                                    data-width="['auto','auto','auto','auto']"
                                    data-height="['auto','auto','auto','auto']"
                                    data-transform_in="y:50px;opacity:0;s:700;e:Power3.easeOut;"
                                    data-transform_out="s:500;e:Power3.easeInOut;s:500;e:Power3.easeInOut;"
                                    data-start="800"
                                    data-speed="500"
                                    data-endspeed="500"
                                    data-splitin="none"
                                    data-splitout="none"
                                    data-responsive_offset="on">What's Tranding Fashion?
                                </h3>
                                <a class="tp-caption NotGeneric-Title tp-resizeme btn btn-md btn-color"
                                    data-x="245"
                                    data-y="center"
                                    data-hoffset=""
                                    data-voffset="75"
                                    data-transform_idle="o:1;"
                                    data-width="['auto','auto','auto','auto']"
                                    data-height="['auto','auto','auto','auto']"
                                    data-transform_in="y:50px;opacity:0;s:700;e:Power3.easeOut;"
                                    data-transform_out="s:500;e:Power3.easeInOut;s:500;e:Power3.easeInOut;"
                                    data-start="1100"
                                    data-speed="500"
                                    data-endspeed="500"
                                    data-splitin="none"
                                    data-splitout="none"
                                    data-responsive_offset="on">See More
                                </a>


                            </li>-->
                            <?php foreach($HomeSlider as $hs){?>
								<li class="dark-bg" data-transition="random" data-slotamount="7" data-masterspeed="500" data-thumb="" data-saveperformance="off" data-title="01">
									<img src="<?php echo base_url('uploads/slider/').$hs['s_img'];?>" alt="h" title="home-1-slide-1"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="6" class="rev-slidebg" data-no-retina />
									<?php if($hs['s_title']!=''){?>
                            
								<h1 class="tp-caption NotGeneric-Title tp-resizeme text-center" style="letter-spacing: 0px; line-height: 60px;"
                                    data-x="140"
                                    data-y="center"
                                    data-hoffset=""
                                    data-voffset="-100"
                                    data-transform_idle="o:1;"
                                    data-width="['auto','auto','auto','auto']"
                                    data-height="['auto','auto','auto','auto']"
                                    data-transform_in="y:50px;opacity:0;s:700;e:Power3.easeOut;"
                                    data-transform_out="s:500;e:Power3.easeInOut;s:500;e:Power3.easeInOut;"
                                    data-start="500"
                                    data-speed="500"
                                    data-endspeed="500"
                                    data-splitin="none"
                                    data-splitout="none"
                                    data-responsive_offset="on"><?php echo $hs['s_title'];?>
                                </h1>
								<?php } ?>
								<?php if($hs['s_url']!=''){?>
                                <a href="<?php echo $hs['s_url'];?>" target="_blank" class="tp-caption NotGeneric-Title tp-resizeme btn btn-md btn-color"
                                    data-x="245"
                                    data-y="center"
                                    data-hoffset=""
                                    data-voffset="75"
                                    data-transform_idle="o:1;"
                                    data-width="['auto','auto','auto','auto']"
                                    data-height="['auto','auto','auto','auto']"
                                    data-transform_in="y:50px;opacity:0;s:700;e:Power3.easeOut;"
                                    data-transform_out="s:500;e:Power3.easeInOut;s:500;e:Power3.easeInOut;"
                                    data-start="1100"
                                    data-speed="500"
                                    data-endspeed="500"
                                    data-splitin="none"
                                    data-splitout="none"
                                    data-responsive_offset="on">See More
                                </a><?php }?>
								</li>
							<?php } ?>
                        </ul>
                    </div>
                </div>

                <!-- End Revolution Slider -->
            </section>
            <!-- End Intro -->

            <!-- Brnad Logo -->
            <section id="brand-logo" class="section-padding brand-logo">
                <div class="container">
                    <ul class="list-none-ib brand-logo-carousel owl-carousel owl-theme">
                        <?php foreach($BrandLogo as $bl){?>
                        <li class="brand-item">
                            <a href="javascript:void(0)">
                                <img src="<?php echo base_url('uploads/brand_logo/').$bl['tbl_image'];?>" alt="Sparkling Beauty" />
                            </a>
                        </li>
						<?php }?>
					   
                    </ul>

                </div>
            </section>
            <!-- End Brnad Logo -->
      

            <!-- Promo Banner -->
            <section id="promo-banner" class="section-padding-b">
                <div class="container">
                    <div class="row">
                        <!--Left Side-->
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12 mb-30">									
                                    <!-- banner No.1 -->									<?php if(isset($HomeCat[0]['thc_id'])){?>
                                    <div class="">									
                                        <a href="<?php echo base_url('product-category/').$HomeCat[0]['cat_url_keyword'];?>" class="promo-image-wrap">
                                            <img src="<?php echo base_url('uploads/home_category/').$HomeCat[0]['thc_image'];?>" alt="Accesories" />
                                        </a>
                                    </div>									<?php } ?>


                                </div>
                                <div class="col-12 mb-sm-30">
                                    <!-- banner No.2 promo-banner-wrap-->
                                    <?php if(isset($HomeCat[2]['thc_id'])){?>                                    
										<div class="">									                                        
											<a href="<?php echo base_url('product-category/').$HomeCat[2]['cat_url_keyword'];?>" class="promo-image-wrap">                                            
											<img src="<?php echo base_url('uploads/home_category/').$HomeCat[2]['thc_image'];?>" alt="Accesories" />                                        
											</a>                                    </div>									<?php } ?>


                                </div>
                            </div>
                        </div>

                        <!--Right Side-->
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12 mb-30">
                                    <!-- banner No.3 -->
                                    <?php if(isset($HomeCat[1]['thc_id'])){?>                                    <div class="">									                                        <a href="<?php echo base_url('product-category/').$HomeCat[1]['cat_url_keyword'];?>" class="promo-image-wrap">                                            <img src="<?php echo base_url('uploads/home_category/').$HomeCat[1]['thc_image'];?>" alt="Accesories" />                                        </a>                                    </div>									<?php } ?>
                                </div>
                                <div class="col-12 mb-sm-30">
                                    <!-- banner No.4 -->
                                    <?php if(isset($HomeCat[3]['thc_id'])){?>                                    <div class="">									                                        <a href="<?php echo base_url('product-category/').$HomeCat[3]['cat_url_keyword'];?>" class="promo-image-wrap">                                            <img src="<?php echo base_url('uploads/home_category/').$HomeCat[3]['thc_image'];?>" alt="Accesories" />                                        </a>                                    </div>									<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Promo Banner -->

            <!-- Product (Tab with Slider) -->
            <section class="section-padding-b">
                <div class="container">
                    <h2 class="page-title">Top Attraction</h2>
                </div>
                <div class="container">
                    <ul class="product-filter nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#latest" role="tab" data-toggle="tab">New Fashion Style</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#best-sellar" role="tab" data-toggle="tab">Premium Seller</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features" role="tab" data-toggle="tab">Tradition</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Tab1 - Latest Product -->
                        <div id="latest" role="tabpanel" class="tab-pane fade in active">
                            <div id="new-product" class="product-item-4 owl-carousel owl-theme nf-carousel-theme1">
                                <!-- item.1 -->
                                <?php foreach($Attraction1 as $lt){?>
								<?php if(isset($Sizes[$lt['tp_id']])){
												$price=$Sizes[$lt['tp_id']];
											}else{
												$price=$lt['tp_price'];
											}
										if($lt['tp_gst_type']==2){
											$gst_amount=round($price*$lt['tp_gst_perce']/100);
											$final_price=$price;
										}else{
											$gst_amount=round($price*$lt['tp_gst_perce']/100);
											$final_price=$price+$gst_amount;
										}
											?>
                                
                                    <!--Product Item-->
                                    <div class="product-item">
                                        <div class="product-item-inner">
                                            <div class="product-img-wrap">
												<?php if(isset($Images[$lt['tp_id']])){?>
													<img src="<?php echo base_url('uploads/product/').$Images[$lt['tp_id']];?>" alt="">
												<?php }else{?>
													<img src="<?php echo base_url('front_assets/img/noimage.png');?>" alt="">
												<?php } ?>
                                            </div>
                                            <div class="product-button">
											<?php if($lt['tp_size_category']>0){?>
                                                <a href="<?php echo base_url('shop/').$lt['tp_slug'];?>" class="js_tooltip" data-mode="bottom" data-tip="Select Option"><i class="fa fa-shopping-bag"></i></a>
											<?php }else{ ?>
												<a href="javascript:void(0)" onclick="add_to_cart(<?php echo $lt['tp_id']?>,'<?php echo $final_price;?>','<?php echo $price;?>','<?php echo $gst_amount?>','<?php echo $lt['tp_gst_type']?>','<?php echo $lt['tp_gst_perce']?>')" class="js_tooltip" data-mode="bottom" data-tip="Add to Cart"><i class="fa fa-shopping-bag"></i></a>
											<?php } ?>
											<?php $customer_data=$this->session->userdata('customer_data');
												if(!empty($customer_data)){
													$wish_link="onclick='add_to_wishlist(".$lt['tp_id'].")'";
												}else{
													$wish_link="onclick='go_to_login()'";
												}													
													?>
												<a href="javascript:void(0)" <?php echo $wish_link;?> class="js_tooltip" data-mode="bottom" data-tip="Wishlist"><i class="fa fa-heart"></i></a>
                                                <!--<a href="#" class="js_tooltip" data-mode="top" data-tip="Quick&nbsp;View"><i class="fa fa-eye"></i></a>-->
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <p class="product-title"><a href="<?php echo base_url('shop/').$lt['tp_slug'];?>">
											<?php 
											$string = strip_tags($lt['tp_name']);
											  if (strlen($string) > 50) {
												  $stringCut = substr($string, 0,50);
												  $endPoint = strrpos($stringCut, ' ');
												  $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
												  $string .= '...';
											  }
											  echo $string;?>
											</a></p>
                                           
                                            <p class="product-description">
                                                <?php echo $lt['tp_desc'];?>
                                            </p>
											
                                            <h5 class="item-price">₹<?php echo $final_price;?></h5>
                                        </div>
                                    </div>
                                    <!-- End Product Item-->
								<?php } ?>
                                

                            </div>
                        </div>

                        <!-- Tab2 - Best Sellar -->
                        <div id="best-sellar" role="tabpanel" class="tab-pane fade">
                            <div id="popular-product" class="product-item-4 owl-carousel owl-theme nf-carousel-theme1">
                                 <?php foreach($Attraction2 as $lt1){?>
								<?php if(isset($Sizes[$lt1['tp_id']])){
												$price=$Sizes[$lt1['tp_id']];
											}else{
												$price=$lt1['tp_price'];
											}
										if($lt1['tp_gst_type']==2){
											$gst_amount=round($price*$lt1['tp_gst_perce']/100);
											$final_price=$price;
										}else{
											$gst_amount=round($price*$lt1['tp_gst_perce']/100);
											$final_price=$price+$gst_amount;
										}
											?>
                                
                                    <!--Product Item-->
                                    <div class="product-item">
                                        <div class="product-item-inner">
                                            <div class="product-img-wrap">
												<?php if(isset($Images[$lt1['tp_id']])){?>
													<img src="<?php echo base_url('uploads/product/').$Images[$lt1['tp_id']];?>" alt="">
												<?php }else{?>
													<img src="<?php echo base_url('front_assets/img/noimage.png');?>" alt="">
												<?php } ?>
                                            </div>
                                            <div class="product-button">
											<?php if($lt1['tp_size_category']>0){?>
                                                <a href="<?php echo base_url('shop/').$lt1['tp_slug'];?>" class="js_tooltip" data-mode="bottom" data-tip="Select Option"><i class="fa fa-shopping-bag"></i></a>
											<?php }else{ ?>
												<a href="javascript:void(0)" onclick="add_to_cart(<?php echo $lt1['tp_id']?>,'<?php echo $final_price;?>','<?php echo $price;?>','<?php echo $gst_amount?>','<?php echo $lt1['tp_gst_type']?>','<?php echo $lt1['tp_gst_perce']?>')" class="js_tooltip" data-mode="bottom" data-tip="Add to cart"><i class="fa fa-shopping-bag"></i></a>
											<?php } ?>
											
											<?php $customer_data=$this->session->userdata('customer_data');
												if(!empty($customer_data)){
													$wish_link="onclick='add_to_wishlist(".$lt1['tp_id'].")'";
												}else{
													$wish_link="onclick='go_to_login()'";
												}													
													?>
												<a href="javascript:void(0)" <?php echo $wish_link;?> class="js_tooltip" data-mode="bottom" data-tip="Wishlist"><i class="fa fa-heart"></i></a>
                                                <!--<a href="#" class="js_tooltip" data-mode="top" data-tip="Quick&nbsp;View"><i class="fa fa-eye"></i></a>-->
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <p class="product-title"><a href="<?php echo base_url('shop/').$lt1['tp_slug'];?>">
											<?php 
											$string = strip_tags($lt1['tp_name']);
											  if (strlen($string) > 50) {
												  $stringCut = substr($string, 0,50);
												  $endPoint = strrpos($stringCut, ' ');
												  $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
												  $string .= '...';
											  }
											  echo $string;?>
											</a></p>
                                           
                                            <p class="product-description">
                                                <?php echo $lt1['tp_desc'];?>
                                            </p>
											
                                            <h5 class="item-price">₹<?php echo $final_price;?></h5>
                                        </div>
                                    </div>
                                    <!-- End Product Item-->
								<?php } ?>


                            </div>
                        </div>

                        <!-- Tab3 - Features -->
                        <div id="features" role="tabpanel" class="tab-pane fade">
                            <div id="features-product" class="product-item-4 owl-carousel owl-theme nf-carousel-theme1">
                                 <?php foreach($Attraction3 as $lt2){?>
								<?php if(isset($Sizes[$lt2['tp_id']])){
												$price=$Sizes[$lt2['tp_id']];
											}else{
												$price=$lt2['tp_price'];
											}
										if($lt2['tp_gst_type']==2){
											$gst_amount=round($price*$lt2['tp_gst_perce']/100);
											$final_price=$price;
										}else{
											$gst_amount=round($price*$lt2['tp_gst_perce']/100);
											$final_price=$price+$gst_amount;
										}
											?>
                                
                                    <!--Product Item-->
                                    <div class="product-item">
                                        <div class="product-item-inner">
                                            <div class="product-img-wrap">
												<?php if(isset($Images[$lt2['tp_id']])){?>
													<img src="<?php echo base_url('uploads/product/').$Images[$lt2['tp_id']];?>" alt="">
												<?php }else{?>
													<img src="<?php echo base_url('front_assets/img/noimage.png');?>" alt="">
												<?php } ?>
                                            </div>
                                            <div class="product-button">
											<?php if($lt2['tp_size_category']>0){?>
                                                <a href="<?php echo base_url('shop/').$lt2['tp_slug'];?>" class="js_tooltip" data-mode="bottom" data-tip="Select Option"><i class="fa fa-shopping-bag"></i></a>
											<?php }else{ ?>
												<a href="javascript:void(0)" onclick="add_to_cart(<?php echo $lt2['tp_id']?>,'<?php echo $final_price;?>','<?php echo $price;?>','<?php echo $gst_amount?>','<?php echo $lt2['tp_gst_type']?>','<?php echo $lt2['tp_gst_perce']?>')" class="js_tooltip" data-mode="bottom" data-tip="Add to Cart"><i class="fa fa-shopping-bag"></i></a>
											<?php } ?>
											
											<?php $customer_data=$this->session->userdata('customer_data');
												if(!empty($customer_data)){
													$wish_link="onclick='add_to_wishlist(".$lt2['tp_id'].")'";
												}else{
													$wish_link="onclick='go_to_login()'";
												}													
													?>
												<a href="javascript:void(0)" <?php echo $wish_link;?> class="js_tooltip" data-mode="bottom" data-tip="Wishlist"><i class="fa fa-heart"></i></a>
                                                <!--<a href="#" class="js_tooltip" data-mode="top" data-tip="Quick&nbsp;View"><i class="fa fa-eye"></i></a>-->
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <p class="product-title"><a href="<?php echo base_url('shop/').$lt2['tp_slug'];?>">
											<?php 
											$string = strip_tags($lt2['tp_name']);
											  if (strlen($string) > 50) {
												  $stringCut = substr($string, 0,50);
												  $endPoint = strrpos($stringCut, ' ');
												  $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
												  $string .= '...';
											  }
											  echo $string;?>
											</a></p>
                                          
                                            <p class="product-description">
                                                <?php echo $lt2['tp_desc'];?>
                                            </p>
											
                                            <h5 class="item-price">₹<?php echo $final_price;?></h5>
                                        </div>
                                    </div>
                                    <!-- End Product Item-->
								<?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Product (Tab with Slider) -->

            <!-- Categories -->
            <section class="">
                <div class="section-padding container-fluid bg-image text-center overlay-light90" data-background-img="img/bg/bg_5.jpg" data-bg-position-x="center center">
                    <div class="container">
                        <h2 class="page-title">Shop by Categories</h2>
                    </div>
                </div>
                <div class="container container-margin-minus-t">
                    <div class="row">
                        <?php foreach($Categories as $sc){?>
							<div class="col-md-3">
								<div class="categories-box">
									<div class="categories-image-wrap">
										<?php if($sc['cat_icon']!=''){?>
										<img src="<?php echo base_url('uploads/category/').$sc['cat_icon'];?>" alt="" />
										<?php }else{ ?>
										<img src="<?php echo base_url('front_assets/img/noimage.png');?>" alt="">
										<?php } ?>
									</div>
									<div class="categories-content">
										<a href="<?php echo base_url('product-category/').$sc['cat_url_keyword'];?>">
											<div class="categories-caption">
												<h6 class="normal"><?php echo $sc['cat_name'];?></h6>
											</div>
										</a>
									</div>
								</div>
							</div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <!-- End Categories -->

            <!-- New Product -->
			<?php if(!empty($Hot)){?>
            <section class="section-padding">
                <div class="container">
                    <h2 class="page-title">Sparkling Hot</h2>
                </div>
                <div class="container">
                    <div id="new-tranding" class="product-item-4 owl-carousel owl-theme nf-carousel-theme1">
                        <!-- item.1 -->
                        <?php foreach($Hot as $lt3){?>
								<?php if(isset($Sizes[$lt3['tp_id']])){
												$price=$Sizes[$lt3['tp_id']];
											}else{
												$price=$lt3['tp_price'];
											}
										if($lt3['tp_gst_type']==2){
											$gst_amount=round($price*$lt3['tp_gst_perce']/100);
											$final_price=$price;
										}else{
											$gst_amount=round($price*$lt3['tp_gst_perce']/100);
											$final_price=$price+$gst_amount;
										}
											?>
                                
                                    <!--Product Item-->
                                    <div class="product-item">
                                        <div class="product-item-inner">
                                            <div class="product-img-wrap">
												<?php if(isset($Images[$lt3['tp_id']])){?>
													<img src="<?php echo base_url('uploads/product/').$Images[$lt3['tp_id']];?>" alt="">
												<?php }else{?>
													<img src="<?php echo base_url('front_assets/img/noimage.png');?>" alt="">
												<?php } ?>
                                            </div>
                                            <div class="product-button">
											<?php if($lt3['tp_size_category']>0){?>
                                                <a href="<?php echo base_url('shop/').$lt3['tp_slug'];?>" class="js_tooltip" data-mode="bottom" data-tip="Select Option"><i class="fa fa-shopping-bag"></i></a>
											<?php }else{ ?>
												<a href="javascript:void(0)" onclick="add_to_cart(<?php echo $lt3['tp_id']?>,'<?php echo $final_price;?>','<?php echo $price;?>','<?php echo $gst_amount?>','<?php echo $lt3['tp_gst_type']?>','<?php echo $lt3['tp_gst_perce']?>')" class="js_tooltip" data-mode="bottom" data-tip="Add to Cart"><i class="fa fa-shopping-bag"></i></a>
											<?php } ?>
											
											<?php $customer_data=$this->session->userdata('customer_data');
												if(!empty($customer_data)){
													$wish_link="onclick='add_to_wishlist(".$lt3['tp_id'].")'";
												}else{
													$wish_link="onclick='go_to_login()'";
												}													
													?>
												<a href="javascript:void(0)" <?php echo $wish_link;?> class="js_tooltip" data-mode="bottom" data-tip="Wishlist"><i class="fa fa-heart"></i></a>
                                                <!--<a href="#" class="js_tooltip" data-mode="top" data-tip="Quick&nbsp;View"><i class="fa fa-eye"></i></a>-->
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <p class="product-title"><a href="<?php echo base_url('shop/').$lt3['tp_slug'];?>">
											<?php 
											$string = strip_tags($lt3['tp_name']);
											  if (strlen($string) > 50) {
												  $stringCut = substr($string, 0,50);
												  $endPoint = strrpos($stringCut, ' ');
												  $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
												  $string .= '...';
											  }
											  echo $string;?>
											</a></p>
                                         
                                            <p class="product-description">
                                                <?php echo $lt3['tp_desc'];?>
                                            </p>
											
                                            <h5 class="item-price">₹<?php echo $final_price;?></h5>
                                        </div>
                                    </div>
                                    <!-- End Product Item-->
								<?php } ?>

                    </div>
                </div>
            </section>
			<?php } ?>
            <!-- End New Product -->

            <!-- Like & Share Banner -->
            <section id="like-share" class="like-share">
                <div class="container">
                    <div class="like-share-inner ">
                        <h3>Like And Share Our Page</h3>
                        <ul class="social-icon">
                            <li><a href="https://wa.me/919167672264" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                            <li><a href="<?php echo $con_data11[0]['ts_facebook'];?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <!--<li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>-->
                                <li><a href="<?php echo $con_data11[0]['ts_twitter'];?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <!--<li><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>-->
                                <li><a href="<?php echo $con_data11[0]['ts_instagram'];?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- End Like & Share Banner -->

           

            <!-- Newsletter -->

            

            <!-- Newsletter -->

            <!-- About blocks -->
            <section class="ab_block">
                <div class="container container-margin-minus-t">
                    <div class="home-about-blocks">
                        <div class="col-12 about-blocks-wrap">
                            <div class="row">
                                <!--Customer Say-->
                                <div class="col-sm-6 col-md-6 customer-say">
                                    <div class="about-box-inner">
                                        <h4 class="mb-25">Customer Say</h4>

                                        <!--Customer Carousel-->
                                        <div class="testimonials-carousel owl-carousel owl-theme nf-carousel-theme1">
                                            <?php foreach($CustomerSays as $cs){?>
											<div class="product-item">
                                                <p class="large quotes"><?php echo $cs['tcs_desc'];?></p>
                                                <h6 class="quotes-people">- <?php echo $cs['tcs_name'];?></h6>
                                            </div>
											<?php } ?>
                                        </div>
                                        <!--End Customer Carousel-->
                                    </div>
                                </div>

                                <!--About Shop-->
                                <div class="col-sm-6 col-md-6 about-shop">
                                    <div class="about-box-inner">
                                        <h4 class="mb-25">About Sparkling Beauty</h4>
                                        <p class="mb-20"><b class="black">Sparkling beauty</b> provides unique accessories and apparels to the women who give value to comfort, style and versatility. Sparkling beauty is an accessory and clothing store which resides in the heart of beautiful women. </p>
                                        <a href="<?php echo base_url('about-us');?>" class="btn btn-xs btn-black">More <i class="fa fa-angle-right right"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End About blocks -->
<?php include("footer.php");?>
<script>
function add_to_cart(id,price,mrp,gst_amount,gst_type,gst_perce){
	var qty=1;
	var sz=0;
	var color=0;
    showload();
     $.ajax({
      url: '<?php echo base_url('Cart/AddCart');?>',
      type: "POST",
      data: {id: id,price:price,qty:qty,sz:sz,color:color,mrp:mrp,gst_amount:gst_amount,gst_type:gst_type,gst_perce:gst_perce},
      dataType: 'json',
      success: function (response) {
        hideload();
        if (response.status == true) {
          get_cart_data();
          toast_msg("Success",response.message,"success");
        } else {
          get_cart_data(); 
          toast_msg("Error",response.message,"error");
        }
      }
    });
}

function add_to_wishlist(id){
    showload();
     $.ajax({
      url: '<?php echo base_url('WishList/AddWishList');?>',
      type: "POST",
      data: {id:id},
      dataType: 'json',
      success: function (response) {
        hideload();
        if (response.status == true) {
          toast_msg("Success",'Product added to your wishlist.',"success");
        } else if (response.status == 'login') {
          toast_msg("Error",'Please login.',"error");
        }else if (response.status == 'already') {
          toast_msg("Info",'This product already added in your wishlist',"info");
        }else {
          toast_msg("Error",'An unexpected error has been occurred',"error");
        }
		getWishListCount();
      }
    });
}
</script>