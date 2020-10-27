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
                                <span>Wishlist</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bread Crumb -->

            <!-- Page Content -->
           <section class="content-page">
                <div class="container mb-80">
                    <div class="row">
                        <div class="col-sm-12">
                            <article class="post-8">
									<?php if(!empty($List)){?>
                                    <div class="cart-product-table-wrap responsive-table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product-remove"></th>
                                                    <th class="product-thumbnail"></th>
                                                    <th class="product-name">Product</th>
                                                    <th class="product-price">Price</th>
													<th class="product-remove"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php foreach($List as $cd){
													$this->db->where('tpd_product_id',$cd['tw_product_id']);
													$this->db->order_by('tpd_id','asc');
													$this->db->limit('1');
													$exe_size=$this->db->get('tbl_product_data');
													$Sizes=$exe_size->result_array();
													if(!empty($Sizes)){
														$price=$Sizes[0]['tpd_price'];
													}else{
														$price=$cd['tp_price'];
													}
													if(!empty($Sizes)){
														if($Sizes[0]['tpd_gst_type']==2){
															$final_price=$price;
														}else{
															$final_price=$price+$Sizes[0]['tpd_gst_amount'];
														}
														$gst_amount=$Sizes[0]['tpd_gst_amount'];
														$gst_type=$Sizes[0]['tpd_gst_type'];
														$gst_perce=$Sizes[0]['tpd_gst_perce'];
													}else{
														$final_price=$price;
														$gst_amount=$cd['tp_gst_amount'];
														$gst_type=$cd['tp_gst_type'];
														$gst_perce=$cd['tp_gst_perce'];
													}
													?>
                                                <tr>
                                                    <td class="product-remove">
                                                        <a onclick="wish_removes(<?php echo $cd['tw_id'];?>,'1',this);" href="javascript:void(0)"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td class="product-thumbnail">
                                                        <?php 
														if(isset($ImgList[$cd['tw_product_id']])){
															$img=base_url("uploads/product/").$ImgList[$cd['tw_product_id']];
														}else{
															$img=base_url('front_assets/img/noimage.png');
														}
														
														?>
														<a href="<?php echo base_url('shop/').$cd['tp_slug'];?>" target="_blank">
                                                            <img src="<?php echo $img;?>" alt="" />
														</a>
                                                    </td>
                                                    <td class="product-name">
                                                        <a href="<?php echo base_url('shop/').$cd['tp_slug'];?>" target="_blank"><?php echo $cd['tp_name'];?></a>
                                                    </td>
                                                    <td class="product-price">
                                                        <span class="product-price-amount amount"><span class="currency-sign">₹</span><?php echo $final_price;?></span>
                                                    </td>
                                                   <td>
                                                       <button type="button" onclick="add_to_cart(<?php echo $cd['tp_id']?>,'<?php echo $final_price;?>','<?php echo $price;?>','<?php echo $gst_amount;?>','<?php echo $gst_type;?>','<?php echo $gst_perce;?>')" class="btn btn-lg btn-black"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
                                                   </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
									<?php }else{ ?>
									<p>No product in your wishlist.</p>
									<?php } ?>
                               
                            </article>
                        </div>
                    </div>
                </div>

            </section>
			
            <!-- End Page Content -->

        </div>
        <!-- End Page Content Wraper -->

<?php include("footer.php");?>
	<script type="text/javascript" src="<?php echo base_url('front_assets/js');?>/jquery.validate.js"></script>
<script>
function wish_removes(id,page,ele){
	var r=confirm("Remove product from wishlist?");
		if (r==true){
		showload();
		 $.ajax({
			url: '<?php echo base_url('WishList/RemoveWishListData');?>',
			type: "POST",
			data: {id:id},
			dataType: 'json',
			success: function (response) {
				if(page==1){
					 $(ele).closest("tr").remove();
				}
				hideload();
					getWishListCount();
					
			}
		});
	}
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
</script>