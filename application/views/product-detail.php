<?php include("header.php");?>
<!--Facebook Start-->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v8.0" nonce="yTZDuUbh"></script>
<!--Facebook Stop-->

 <!-- Page Content Wraper -->
        <div class="page-content-wraper">
            <!-- Bread Crumb -->
            <section class="breadcrumb">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav class="breadcrumb-link">
                                <a href="<?php echo base_url();?>">Home</a>
                                <a href="#"><?php echo ucfirst(isset($Detail) ? $Detail[0]['cat_name'] : '');?></a>
                                <span><?php echo $Detail[0]['tp_name'];?></span>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bread Crumb -->

            <!-- Page Content -->
            <section id="product-ID_XXXX" class="content-page single-product-content">

                <!-- Product -->
                <div id="product-detail" class="container">
                    <div class="row">
                        <!-- Product Image -->
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                            <div class="product-page-image">
                                <!-- Slick Image Slider -->
                                <div class="product-image-slider product-image-gallery" id="product-image-gallery" data-pswp-uid="3">
                                    <?php
                                    if (isset($Images)) {
									foreach($Images as $img){?>
									<div class="item">
                                        <a class="product-gallery-item" href="<?php echo base_url('uploads/product/').$img['tpi_image'];?>" data-size="" data-med="<?php echo base_url('uploads/product/').$img['tpi_image'];?>" data-med-size="">
                                            <img src="<?php echo base_url('uploads/product/').$img['tpi_image'];?>" alt="image 1" />
                                        </a>
                                    </div>
									<?php } }?>
                                </div>
                                <!-- End Slick Image Slider -->

                                <a href="javascript:void(0)" id="zoom-images-button" class="zoom-images-button"><i class="fa fa-expand" aria-hidden="true"></i></a>


                            </div>

                            <!-- Slick Thumb Slider -->
                            <div class="product-image-slider-thumbnails">
                                <?php foreach($Images as $img){?>
								<div class="item">
                                    <img src="<?php echo base_url('uploads/product/').$img['tpi_image'];?>" alt="image 1" />
                                </div>
                                <?php } ?>
                            </div>
                            <!-- End Slick Thumb Slider -->
                        </div>
                        <!-- End Product Image -->

                        <!-- Product Content -->
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                            <div class="product-page-content">
                                <h2 class="product-title"><?php echo $Detail[0]['tp_name'];?></h2>
                                
                                <div class="product-price">
								<?php 
								if(!empty($Sizes)){
                                    $prices=$Sizes[0]['tpd_price'];
                                    $promotion_price = $Sizes[0]['promotion_price'];
                                }else{
                                    $prices=$Detail[0]['tp_price'];
                                    $promotion_price = 0;
								}
								if($Detail[0]['tp_gst_type']==2){
                                    $gst_amount=round($prices*$Detail[0]['tp_gst_perce']/100);
                                    $final_price=$prices;
                                    $final_promotion_price = $promotion_price;
                                }else{
                                    $gst_amount=round($prices*$Detail[0]['tp_gst_perce']/100);
                                    $final_price=$prices+$gst_amount;
                                    $promotion_price_gst = round($promotion_price*$Detail[0]['tp_gst_perce']/100);
                                    $final_promotion_price = $promotion_price + $promotion_price_gst;
                                }
								
									?>
                                    <span class="product-price-sign">₹</span><span class="product-price-text" id="pro_price"><?php echo $final_price;?></span> <span ><?php echo $final_price < $final_promotion_price ? ('<s style="font-size: 20px !important;">'.$final_promotion_price.'</s>') : ''?></span>
									<input type="hidden" id="price_product" value="<?php echo $final_price;?>">
									<input type="hidden" id="gst_type" value="<?php echo $Detail[0]['tp_gst_type'];?>">
									<input type="hidden" id="gst_perce" value="<?php echo $Detail[0]['tp_gst_perce'];?>">
									<input type="hidden" id="gst_amount" value="<?php echo $gst_amount;?>">
									<input type="hidden" id="product_price" value="<?php echo $prices;?>">
							   </div>
                                <p class="product-description">
                                    <?php echo $Detail[0]['tp_desc'];?>
                                </p>

                                <form class="single-variation-wrap">
                                    <div class="product-quantity">
                                        <span data-value="+" class="quantity-btn quantityPlus"></span>
                                        <input id="prod_qty" class="quantity input-lg" step="1" min="1" max="9" name="quantity" value="1" title="Quantity" type="number" />
                                        <span data-value="-" class="quantity-btn quantityMinus"></span>
                                    </div>
                                    <!--add_to_cart(<?php /*echo $Detail[0]['tp_id'];*/?>)-->
                                    <button type="button" onclick="return add_to_cart(<?php echo $Detail[0]['tp_id']?>,'<?php echo $final_price;?>','<?php echo $prices;?>','<?php echo $gst_amount?>','<?php echo $Detail[0]['tp_gst_type']?>','<?php echo $Detail[0]['tp_gst_perce']?>')" class="btn btn-lg btn-black"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Add to cart 1</button>
                                    <?php $link = b2b($Detail[0]['tp_name'], $Detail[0]['tp_id'], $final_price);?>
                                    <a href="<?= $link;?>" target="_blank" class="btn-lg text-white" style="background: #0000cc; padding: 8px 20px !important; border-radius: 30px;"><i class="fa fa-whatsapp"></i>B2B Inquiry</a>
                                    <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                                </form>
                                <div class="single-add-to-wrap">
								<?php $customer_data=$this->session->userdata('customer_data');
												if(!empty($customer_data)){
													$wish_link="onclick='add_to_wishlist(".$Detail[0]['tp_id'].")'";
												}else{
													$wish_link="onclick='go_to_login()'";
												}													
													?>
                                    <a class="single-add-to-wishlist" <?php echo $wish_link;?> href="javascript:void(0)"><i class="fa fa-heart left" aria-hidden="true"></i><span>Add to Wishlist</span></a>

                                </div>
                                <div class="product-meta">
                                    <span>SKU : <span class="sku" itemprop="sku"><?php echo $Detail[0]['tp_sku'];?></span></span>
                                    <span>Category : <span class="category" itemprop="category"><?php echo ucfirst($Detail[0]['cat_name']);?></span></span>
                                    <?php if($Detail[0]['tp_fabric']!=''){?>
									<span>Fabric : <span class="category" itemprop="category"><?php echo $Detail[0]['tp_fabric'];?></span></span>
									<?php } ?>
                                </div>
                                <!--<div class="product-share">
                                    <span>Share :</span>
                                    <ul>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=http://nileforest.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="http://twitter.com/share?url=http://nileforest.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="http://plus.google.com/share?url=http://nileforest.com/" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="mailto:?subject=Check this http://nileforest.com/" target="_blank"><i class="fa fa-envelope"></i></a></li>
                                        <li><a href="http://pinterest.com/pin/create/button/?url=http://nileforest.com/exampleImage.jpg" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                    </ul>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Product -->

                <!-- Product Content Tab -->
                <div class="product-tabs-wrapper container">
                    <ul class="product-content-tabs nav nav-tabs" role="tablist">

                        <li class="nav-item">
                            <a class="active" href="#tab_description" role="tab" data-toggle="tab">Description</a>
                        </li>

                        <li class="nav-item">
                            <a class="" href="#tab_reviews" role="tab" data-toggle="tab">Reviews (<span><?php echo isset($Review) ? sizeof($Review) : 0;?></span>)</a>
                        </li>
                        <li class="nav-item">
                            <a class="" href="#importantNoticeBox" role="tab" data-toggle="tab">Important Notice Box</a>
                        </li>
                     

                    </ul>
                    <div class="product-content-Tabs_wraper tab-content container">
                        <div id="tab_description" role="tabpanel" class="tab-pane fade in active">
                            <!-- Accordian Title -->
                            <h6 class="product-collapse-title" data-toggle="collapse" data-target="#tab_description-coll">Description</h6>
                            <!-- End Accordian Title -->
                            <!-- Accordian Content -->
                            <div id="tab_description-coll" class="shop_description product-collapse collapse container">
                                <div class="row">
                                   <p><?php echo $Detail[0]['tp_long_desc'];?></p>
                                </div>
                            </div>
                            <!-- End Accordian Content -->
                        </div>

                        <div id="importantNoticeBox" role="tabpanel" class="tab-pane fade">

                            <!-- End Accordian Title -->
                            <!-- Accordian Content -->
                            <div id="tab_description-coll" class="shop_description product-collapse collapse container">
                                <div class="row">
                                    <p class="text-danger"><?php echo $Detail[0]['tp_ImportantNoticeBox'];?></p>
                                </div>
                            </div>
                            <!-- End Accordian Content -->
                        </div>

                        <div id="tab_reviews" role="tabpanel" class="tab-pane fade">
                            <!-- Accordian Title -->
                            <h6 class="product-collapse-title" data-toggle="collapse" data-target="#tab_reviews-coll">Reviews (<?php echo sizeof($Review);?>)</h6>
                            <!-- End Accordian Title -->
                            <!-- Accordian Content -->
                            <div id="tab_reviews-coll" class=" product-collapse collapse container">
                                <div class="row">
                                    
                                    <div class="comments col-md-6">
                                        <h6 class="review-title">Customer Reviews</h6>
                                        <!--<p class="review-blank">There are no reviews yet.</p>-->
                                        <ul class="commentlist">
                                            <?php foreach($Review as $rv){
												$rating=$rv['tr_rating']*20;
												?>
											<li id="comment-101" class="comment-101">
                                                <img src="<?php echo base_url('front_assets/');?>img/avtar.png" class="avatar" alt="author" />
                                                <div class="comment-text">
                                                    <div class="star-rating" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                                                        <span style="width: <?php echo $rating;?>%"></span>
                                                    </div>
                                                    <p class="meta">
                                                        <strong itemprop="author"><?php echo $rv['tc_name'];?></strong>
                                                        &nbsp;&mdash;&nbsp;
                                                    <time itemprop="datePublished" datetime=""><?php echo date('F d, Y',strtotime($rv['tr_date']));?></time>
                                                    </p>
                                                    <div class="description" itemprop="description">
                                                        <p><?php echo $rv['tr_review'];?></p>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Accordian Content -->
                        </div>
                    
                    </div>
                </div>
                <!-- End Product Content Tab -->

                <!-- Product Carousel -->
                <div class="container product-carousel">
                    <h2 class="page-title">Related Products</h2>
                    <div id="new-tranding" class="product-item-4 owl-carousel owl-theme nf-carousel-theme1">
                        <!-- item.1 -->
                        
                         <?php 
						 $this->db->where('tp_category_id',$Detail[0]['tp_category_id']);
						 $this->db->where('tp_id !=',$Detail[0]['tp_id']);
						 $exe_rela=$this->db->get('tbl_product');
						 $Related=$exe_rela->result_array();
						 
						 foreach($Related as $lt){?>
								<?php if(isset($Sizess[$lt['tp_id']])){
												$price=$Sizess[$lt['tp_id']];
											}else{
												$price=$lt['tp_price'];
											}
										if($lt['tp_gst_type']==2){
											$gst_amount=round($price * $lt['tp_gst_perce']/100);
											$final_price=$price;
										}else{

											$gst_amount=round(floatval($price[0]) * floatval($lt['tp_gst_perce']) / 100);
											$final_price = floatval($price[0]) + $gst_amount;
										}
											?>
                                
                                    <!--Product Item-->
                                    <div class="product-item">
                                        <div class="product-item-inner">
                                            <div class="product-img-wrap">
												<?php if(isset($Imagess[$lt['tp_id']])){?>
													<img src="<?php echo base_url('uploads/product/').$Imagess[$lt['tp_id']];?>" alt="">
												<?php }else{?>
													<img src="<?php echo base_url('front_assets/img/noimage.png');?>" alt="">
												<?php } ?>
                                            </div>
                                            <div class="product-button">
											<?php if(isset($lt['tp_size_category']) && $lt['tp_size_category']>0){?>
                                                <a href="<?php echo base_url('shop/').$lt['tp_slug'];?>" class="js_tooltip" data-mode="bottom" data-tip="Select Option"><i class="fa fa-shopping-bag"></i></a>
											<?php }else{ ?>
												<a href="javascript:void(0)" onclick="add_to_cart_related(<?php echo $lt['tp_id']?>,'<?php echo $final_price;?>','<?php echo $price[0];?>','<?php echo $gst_amount?>','<?php echo $lt['tp_gst_type']?>','<?php echo $lt['tp_gst_perce']?>')" class="js_tooltip" data-mode="bottom" data-tip="Add to Cart"><i class="fa fa-shopping-bag"></i></a>
											<?php } ?>
											<?php $customer_data=$this->session->userdata('customer_data');
												if(!empty($customer_data)){
													$wish_link="onclick='add_to_wishlist(".$lt['tp_id'].")'";
												}else{
													$wish_link="onclick='go_to_login()'";
												}													
													?>
												<a href="javascript:void(0)" <?php echo $wish_link;?> class="js_tooltip" data-mode="bottom" data-tip="Wishlist"><i class="fa fa-heart"></i></a>
                                                
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
                <!-- End Product Carousel -->

            </section>
            <!-- End Page Content -->

        </div>
        <!-- End Page Content Wraper -->

<?php include("footer.php");?>
<script type="text/javascript">
    function add_to_cart(id, price, mrp, gst_amount, gst_type, gst_perce) {
        var qty = 1;
        var sz = 0;
        var color = 0;
        showload();
        $.ajax({
            url: '<?php echo base_url('Cart/AddCart');?>',
            type: "POST",
            data: {
                id: id,
                price: price,
                qty: qty,
                sz: sz,
                color: color,
                mrp: mrp,
                gst_amount: gst_amount,
                gst_type: gst_type,
                gst_perce: gst_perce
            },
            dataType: 'json',
            success: function (response) {
                hideload();
                if (response.status == true) {
                    get_cart_data();
                    toast_msg("Success", response.message, "success");
                } else {
                    get_cart_data();
                    toast_msg("Error", response.message, "error");
                }
            }
        });
    }
function add_to_cart_related(id,price,mrp,gst_amount,gst_type,gst_perce){
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


function getColors(id,prod){
	showload();
	$.ajax({
	  url: '<?php echo base_url('Product/GetProdColors');?>',
	  type: "POST",
	  data: {id:id,prod:prod},
	  success: function (response) {
		hideload();
		$("#select-color").html(response);
		$("#select-color").niceSelect("update");
		
	  }
    });
}
function getPrice(id,prod){
	showload();
	var sz=$("#select-size").val();
	$.ajax({
	  url: '<?php echo base_url('Product/GetProdPrice');?>',
	  type: "POST",
	  dataType: 'json',
	  data: {id:id,prod:prod,sz:sz},
	  success: function (response) {
		hideload();
		$("#pro_price").html(response.final_price);
		$("#price_product").val(response.final_price);
		$("#gst_type").val(response.gst_type);
		$("#gst_perce").val(response.gst_perce);
		$("#gst_amount").val(response.gst_amount);
		$("#product_price").val(response.product_price);
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