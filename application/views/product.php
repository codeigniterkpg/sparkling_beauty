<?php include("header.php");?>
 <!-- Page Content Wraper -->
        <div class="page-content-wraper">
            <!-- Bread Crumb -->
            <section class="breadcrumb">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav class="breadcrumb-link">
                                <a href="<?php echo base_url('');?>">Home</a>
                                <a href="<?php echo base_url('product-category/').$Cat;?>"><?php echo ucfirst($Cat);?></a>
                                <?php if($Cat2==''){?>
								<span><?php echo ucfirst($Cat1);?></span>
								<?php } else{ ?>
								<a href="<?php echo base_url('product-category/').$Cat.'/'.$Cat1;?>"><?php echo ucfirst($Cat1);?></a>
								<span><?php echo ucfirst($Cat2);?></span>
								<?php } ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bread Crumb -->

            <!-- Page Content -->
            <section class="content-page">
                <div class="container">
				<form id="search_filter_form">
					<input type="hidden" name="search" id="search" value="<?php echo $Search;?>">
					<input type="hidden" name="cat" id="cat" value="<?php echo $Cat;?>">
					<input type="hidden" name="cat1" id="cat1" value="<?php echo $Cat1;?>">
					<input type="hidden" name="cat2" id="cat2" value="<?php echo $Cat2;?>">
                    <div class="row">

                        <!-- Product Content -->
                        <div class="col-md-9 push-md-3">
                            <!-- Title -->
							<?php if(isset($Category)){?>
                            <div class="list-page-title">
                                <h2 class=""><?php echo $Category;?> <small><?php echo sizeof($List); ?> Products</small></h2>
                            </div>
							<?php } ?>
                            <!-- End Title -->

                            <!-- Product Filter -->
                            <div class="product-filter-content">
                                <div class="product-filter-content-inner">

                                 
                                    <!--Product Sort By-->
                                 
                                        <label for="short-by">Sort By</label>
                                        <select name="short_by" id="short_by" class="nice-select-box" onchange="sort_change()">
												<option value="0" selected="selected">Default</option>
												<option value="asc">Name (A - Z) </option>
												<option value="desc">Name (Z - A) </option>
												<option value="plh">Price (Low &gt; High) </option>
												<option value="phl">Price (High &gt; Low) </option>
												<option value="new">Newest </option>
                                        </select>
                                    <!--Product List/Grid Icon-->
                                    <div class="product-view-switcher">
                                        <label>View</label>
                                        <div class="product-view-icon product-grid-switcher product-view-icon-active">
                                            <a class="" href="#"><i class="fa fa-th" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="product-view-icon product-list-switcher">
                                            <a class="" href="#"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Filter -->

                          
                            <!-- Product Grid -->
                            <div class="row product-list-item">
                                <!-- item.1 -->
								<?php if(!empty($List)){foreach($List as $lt){?>
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
                                <div class="product-item-element col-sm-6 col-md-6 col-lg-4">
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
											<?php if(isset($lt['tp_size_category']) && $lt['tp_size_category']>0){?>
                                                <a href="<?php echo base_url('shop/').$lt['tp_slug'];?>" class="js_tooltip" data-mode="bottom" data-tip="Select Option"><i class="fa fa-shopping-bag"></i></a>
											<?php }else{ ?>
												<a href="javascript:void(0)" onclick="add_to_cart(<?php echo $lt['tp_id']?>,'<?php echo $final_price;?>','<?php echo $price;?>','<?php echo $gst_amount?>','<?php echo $lt['tp_gst_type']?>','<?php echo $lt['tp_gst_perce']?>')" class="js_tooltip" data-mode="bottom" data-tip="Add To Cart"><i class="fa fa-shopping-bag"></i></a>
											<?php } ?>
											
											<?php $customer_data=$this->session->userdata('customer_data');
												if(!empty($customer_data)){
													$wish_link="onclick='add_to_wishlist(".$lt['tp_id'].")'";
												}else{
													$wish_link="onclick='go_to_login()'";
												}													
													?>
												<a href="javascript:void(0)" <?php echo $wish_link;?> class="js_tooltip" data-mode="bottom" data-tip="Add To Whishlist"><i class="fa fa-heart"></i></a>
                                                <?php $link = b2b($lt['tp_name'], $lt['tp_id'], $final_price);?>
												<a href="<?= $link;?>" target="_blank" class="js_tooltip" data-mode="top" data-tip="B2B Inquiry"><i class="fa fa-whatsapp"></i></a>
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
                                            <!--<div class="product-rating">
                                                <div class="star-rating" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                                                    <span style="width: 60%"></span>
                                                </div>
                                                <a href="#" class="product-rating-count"><span class="count">3</span> Reviews</a>
                                            </div>-->
                                            <p class="product-description">
                                                <?php echo $lt['tp_desc'];?>
                                            </p>
											
                                            <h5 class="item-price">₹<?php echo $final_price;?></h5>
                                        </div>
                                    </div>
                                    <!-- End Product Item-->
                                </div>
								<?php } }else{?>
								<h3>No product found...</h3>
								<?php } ?>
                            </div>
                            <!-- End Product Grid -->

                            <!--<div class="pagination-wraper">
                                <p>Showing 1 - 15 of 120 results</p>
                                <div class="pagination">
                                    <ul class="pagination-numbers">
                                        <li>
                                            <a href="#" class="prev page-number"><i class="fa fa-angle-double-left"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="page-number current">1</a>
                                        </li>
                                        <li>
                                            <a href="#" class="page-number">2</a>
                                        </li>
                                        <li>
                                            <a href="#" class="page-number">3</a>
                                        </li>
                                        <li>
                                            <span class="page-number dots">...</span>
                                        </li>
                                        <li>
                                            <a href="#" class="page-number">29</a>
                                        </li>
                                        <li>
                                            <a href="#" class="next page-number"><i class="fa fa-angle-double-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>-->

                        </div>
                        <!-- End Product Content -->

                        <!-- Sidebar -->
                        <div class="sidebar-container col-md-3 pull-md-9">
                            <!-- Filter By Price -->
                            <div class="widget-sidebar widget-price-range">
                                <h6 class="widget-title">Filter By Price</h6>
								<div class="price-range-slider"></div>
								<div class="price-range-amount">
									<input id="price_range_min" name="price_range_min" value="" data-min="1" placeholder="Min price" style="display: none;" type="text">
									<input id="price_range_max" name="price_range_max" value="" data-max="<?php echo $MaxPrice;?>" placeholder="Max price" style="display: none;" type="text">
									<div id="price-range-from-to">
									</div>
								</div>
								<button class="btn btn-xs btn-black pull-right" type="button" onclick="sort_change()">Filter</button>
                            </div>
							
                            <!-- Filter By Color -->
                            <div class="widget-sidebar widget-filter-color">
                                <h6 class="widget-title">Filter By Color</h6>
                                <ul class="widget-content" style="height:250px;overflow-y:scroll">
                                    <?php 
									$this->db->group_by('c.tclr_title');
									$this->db->join("tbl_product_data as PD","PD.tpd_color_id=c.tclr_id","INNER");
									$exe_color=$this->db->get('tbl_color as c');
									$color_data=$exe_color->result_array();
									foreach($color_data as $cd){
									?>
									<li><a href='javascript:void(0);' ><label><input type="checkbox" onchange='apply_filter(this,this.value)' name="color_list[]" value="<?php echo $cd['tclr_id'];?>" id="<?php echo $cd['tclr_id'];?>"> <?php echo $cd['tclr_title'];?></label></a></li>
									<?php } ?>
                                </ul>
                            </div>
                            <!-- Filter By Size -->
                            <!--<div class="widget-sidebar widget-filter-color">
                                <h6 class="widget-title">Filter By Size</h6>
                                <ul class="widget-content">
                                    <?php /*
									$this->db->group_by('tsm_size');
									$exe_color=$this->db->get('tbl_size_master');
									$color_data=$exe_color->result_array();
									foreach($color_data as $cd){
									*/?>
									<li><a href='javascript:void(0);' ><label><input type="checkbox" onchange='apply_filter(this,this.value)' name="size_list[]" value="<?php /*echo $cd['tsm_id'];*/?>" id="<?php /*echo $cd['tsm_id'];*/?>"> <?php /*echo $cd['tsm_size'];*/?></label></a></li>
									<?php /*} */?>
                                </ul>
                            </div>-->

                            <!-- Filter By Tag -->
                           

                            <!-- Widget Product -->
                           


                        </div>
                        <!-- End Sidebar -->

                    </div>
					</form>
                </div>
            </section>
            <!-- End Page Content -->

        </div>
        <!-- End Page Content Wraper -->


<?php include("footer.php");?>
<script>
function sort_change(){
	showload();
	load_data(); 
	
	hideload();
}
function apply_filter(ele,vals){
	showload();
	
load_data(); 
	hideload();
}
function load_data()
{
	
 $.ajax({
   url:"<?php echo base_url('Product/loadRecord');?>",
   method:"POST",
   data    : $("#search_filter_form").serialize(),
   cache: false,
   success:function(data)
   {
	   $('.product-list-item').html(data);
   }
 }) 
}
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