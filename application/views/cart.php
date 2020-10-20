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
                                <span>Cart</span>
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
                                <form class="cart-form" action="#" method="post">
                                    <div class="cart-product-table-wrap responsive-table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product-remove"></th>
                                                    <th class="product-thumbnail"></th>
                                                    <th class="product-name">Product</th>
                                                    <th class="product-name">Size - Color</th>
                                                    <th class="product-price">Price</th>
                                                    <th class="product-quantity">Quantity</th>
                                                    <th class="product-subtotal">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php $total=0;foreach($CartData as $cd){?>
                                                <tr>
                                                    <td class="product-remove">
                                                        <a onclick="cart_removes(<?php echo $cd['cr_id'];?>,'1',this);" href="javascript:void(0)"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td class="product-thumbnail">
                                                        <?php 
														if(isset($CartImg[$cd['cr_product_id']])){
															$img=base_url("uploads/product/").$CartImg[$cd['cr_product_id']];
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
													<td class="product-name">
													<?php if($cd['cr_size']>0){?>
                                                        <?php echo $cd['tsm_size'];?> - <?php echo $cd['tclr_title'];?>
													<?php }else{ echo "Regular";} ?>
                                                    </td>
                                                    <td class="product-price">
                                                        <span class="product-price-amount amount"><span class="currency-sign">₹</span><?php echo $cd['cr_price'];?></span>
                                                    </td>
                                                    <td>
                                                        <div class="product-quantity">
                                                            <span data-value="+" class="quantity-btn quantityPlus" onclick="update_cart_data(<?php echo $cd['cr_id'];?>,<?php echo $cd['cr_price'];?>,<?php echo $cd['cr_cust_id'];?>,'plus');" ></span>
                                                            <input class="quantity input-lg" step="1" min="1" max="99" name="quantity" id="quantity<?php echo $cd['cr_id'];?>" value="<?php echo $cd['cr_qty'];?>" title="Quantity" type="number" />
                                                            <span data-value="-" class="quantity-btn quantityMinus" onclick="update_cart_data(<?php echo $cd['cr_id'];?>,<?php echo $cd['cr_price'];?>,<?php echo $cd['cr_cust_id'];?>,'minus');"></span>
                                                        </div>
                                                    </td>
                                                    <td class="product-subtotal">
                                                        <span class="product-price-sub_totle amount" id="cart_total_amt<?php echo $cd['cr_id'];?>"><span class="currency-sign">₹</span><?php echo $cd['cr_amount'];?></span>
                                                    </td>
                                                </tr>
                                                <?php $total=$total+$cd['cr_amount'];} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--<div class="row cart-actions">
                                        <div class="col-md-6">
                                            <div class="coupon">
                                                <input class="input-md" id="coupon_code" name="coupon_code" title="Coupon Code" value="" placeholder="Enter Coupon Code" type="text">
                                                <input class="btn btn-md btn-black" name="coupon_code" value="Apply Coupon" type="submit" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <input class="btn btn-md btn-gray" name="update_cart" value="Update cart" disabled="" type="submit">
                                        </div>
                                    </div>-->
                                </form>
                                <div class="cart-collateral">
                                    <div class="cart_totals">
                                        <h3>Cart totals</h3>
                                        <div class="responsive-table">
                                            <table>
                                                <tbody>
                                                    <!--<tr class="cart-subtotal">
                                                        <th>Subtotal</th>
                                                        <td><span class="product-price-amount amount"><span class="currency-sign">$</span>997.00</span></td>
                                                    </tr>
                                                    <tr class="shipping">
                                                        <th>Shipping</th>
                                                        <td>
                                                            <ul id="shipping_method">
                                                                <li>
                                                                    <input name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_flat_rate" value="legacy_flat_rate" class="shipping_method" checked="checked" type="radio">
                                                                    <label for="shipping_method_0_legacy_flat_rate">Flat Rate: <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>12.00</span></label>
                                                                </li>
                                                                <li>
                                                                    <input name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_free_shipping" value="legacy_free_shipping" class="shipping_method" type="radio">
                                                                    <label for="shipping_method_0_legacy_free_shipping">Free Shipping</label>
                                                                </li>
                                                                <li>
                                                                    <input name="shipping_method[0]" data-index="0" id="shipping_method_0_legacy_local_delivery" value="legacy_local_delivery" class="shipping_method" type="radio">
                                                                    <label for="shipping_method_0_legacy_local_delivery">Local Delivery</label>
                                                                </li>
                                                            </ul>
                                                           
                                                        </td>
                                                    </tr>-->
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        <td><span class="product-price-amount amount" id="cart_total"><span class="currency-sign">₹</span><?php echo $total;?></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="product-proceed-to-checkout">
                                            <a class="btn btn-lg btn-color form-full-width" href="<?php echo base_url('checkout');?>">Proceed to checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>

            </section>
            <!-- End Page Content -->

        </div>
        <!-- End Page Content Wraper -->

<?php include("footer.php");?>
<script>
function cart_removes(id,page,ele){
	var r=confirm("Remove product from cart?");
		if (r==true){
		showload();
		 $.ajax({
			url: '<?php echo base_url('Cart/RemoveCartData');?>',
			type: "POST",
			data: {id:id},
			dataType: 'json',
			success: function (response) {
				
				if(page==1){
					 $(ele).closest("tr").remove();
				}
				$.ajax({
					url: '<?php echo base_url('Cart/CartData');?>',
					type: "POST",
					data: {qty:'1'},
					dataType: 'json',
					success: function (response) {
						hideload();
						if(response.cart_items>0){
							$("#cart_data").html(response.message);
							$("#cart_count").html(response.cart_items);
							$("#cart_price").html(response.cart_total);
						}else{
							location.reload();
							
						}
					}
				});
				hideload();
					get_cart_datas();
					
			}
		});
	}
}
function get_cart_datas(){
	showload();
	 $.ajax({
		url: '<?php echo base_url('Cart/CartData');?>',
		type: "POST",
		data: {qty:'1'},
		dataType: 'json',
		success: function (response) {
			hideload();
			if(response.cart_items>0){
				
				$("#cart_total").html('<span class="currency-sign">₹</span>'+response.cart_total);	
			}else{
				location.reload();
				
			}
	 }
	});
   }
function update_cart_data(id, price,cr_cust_id,typ) {
	if(typ=='plus'){
		var qty = parseInt($("#quantity" + id).val())+1;
	}else{
		var qty = parseInt($("#quantity" + id).val())-1;
	}
	
	if (qty > 0) {
		showload();
		$.ajax({
			url: '<?php echo base_url('Cart/UpdateCartData');?> ',			
			type: "POST",			
			data: {id:id,price:price,qty:qty,cr_cust_id:cr_cust_id},			
			dataType: 'json ',			
			success: function (response) {				
				hideload();				
				if(response.status==true){					
					$("#cart_total").html('<span class="currency-sign">₹</span>'+response.cart_total);					
					$("#cart_total_amt"+id).html('<span class="currency-sign">₹</span>'+qty*price);					
					get_cart_data();				
				}								
			}		
		});	
	}
}
</script>