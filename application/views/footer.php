       
            <!-- End Instagram -->
        </div>
        <!-- End Page Content Wraper -->

        <!-- Footer Section -------------->
        <footer class="footer ">
            <!-- Footer Info -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 mb-sm-45">
                        <div class="footer-block about-us-block">
                            <img src="<?php echo base_url('front_assets/');?>images/logo.png" width="125" alt="" style="background:#fff">
                            <p>Sparkling beauty provides unique accessories and apparels to the women who give value to comfort, style and versatility. Sparkling beauty is an accessory and clothing store which resides in the heart of beautiful women. </p>
                            <ul class="footer-social-icon list-none-ib">
                                <li><a href="<?php echo $con_data11[0]['ts_facebook'];?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <!--<li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>-->
                                <li><a href="<?php echo $con_data11[0]['ts_twitter'];?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <!--<li><a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>-->
                                <li><a href="<?php echo $con_data11[0]['ts_instagram'];?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 mb-sm-45">
                        <div class="footer-block information-block">
                            <h6>Information</h6>
                            <ul>								
							<?php 							
							$this->db->order_by('cms_id', 'asc');							
							$q1 = $this->db->get('tbl_cms');							
							foreach($q1->result_array() as $cs){							
							?>							
							<li>                                
							<a href="<?php echo base_url().$cs['cms_url'];?>"><?php echo $cs['cms_title']?></a>                            
							</li>							
							<?php } ?>
                                <li><a href="<?php echo base_url('contact-us');?>">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 mb-sm-45">
                        <div class="footer-block links-block">
                            <h6>Shop By Category</h6>
                            <ul>							
							<?php 
							$this->db->where('cat_subcat_id',0);
								$exe_cat=$this->db->get('tbl_category');
							foreach($exe_cat->result_array() as $sc){?>	
                                <li><a href="<?php echo base_url('product-category/').$sc['cat_url_keyword'];?>"><?php echo $sc['cat_name'];?></a></li>							<?php } ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="footer-block contact-block">
                            <h6>Contact</h6>
                           
							<ul>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $con_data11[0]['ts_address'];?></li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo $con_data11[0]['ts_email'];?>"><?php echo $con_data11[0]['ts_email'];?></a></li>
                                <li><i class="fa fa-phone" aria-hidden="true"></i><?php echo $con_data11[0]['ts_mobile'];?></li>
                                <li><i class="fa fa-fax" aria-hidden="true"></i><?php echo $con_data11[0]['ts_phone'];?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Footer Info -->

            <!-- Footer Newsletter -->
            
            <!-- End Footer Newsletter -->

            <!-- Footer Copyright -->
            <div class="container">
                <div class="copyrights">
                    <p class="copyright">&copy; Sparkling Beauty Copyright 2019 All Right Reserved.</p>
                    <p class="payment">
                        <img src="<?php echo base_url('front_assets/');?>images/payment_logos.png" alt="payment">
                    </p>
                </div>
            </div>
            
            <div class="whts_fixed">
               <div class="whts_icon"><a href="https://wa.me/919167672264" target="_blank"><img src="<?php echo base_url('front_assets/');?>images/whs.png" alt="whatsup"></a></li>
            </div>
            
            
            <!-- End Footer Copyright -->
        </footer>
        <!-- End Footer Section -------------->

    </div>
    <!-- End wrapper =============================-->

    <!--==========================================-->
    <!-- JAVASCRIPT -->
    <!--==========================================-->
	<script>
	<?php
		if(isset($MaxPrice)){ ?>
			var max_price=<?php echo $MaxPrice;?>
		<?php }else{?>
			var max_price=0;
		<?php }?>
		</script>
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>js/plugins/jquery-ui.js"></script>
    <!-- jquery library js -->
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>js/plugins/modernizr.js"></script>
    <!--modernizr Js-->
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>plugins/rev_slider/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>plugins/rev_slider/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>plugins/rev_slider/js/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>plugins/rev_slider/js/revolution.extension.parallax.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>plugins/rev_slider/js/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>plugins/rev_slider/js/revolution.extension.layeranimation.min.js"></script>
    <!--Slider Revolution Js File-->
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>js/plugins/tether.min.js"></script>
    <!--Bootstrap tooltips require Tether (Tether Js)-->
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>js/plugins/bootstrap.min.js"></script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>js/plugins/owl.carousel.js"></script>
    <!-- OWL carousel js -->
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>js/plugins/slick.js"></script>
    <!-- Slick Slider js -->
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>js/plugins/plugins-all.js"></script>
	 <script type="text/javascript" src="<?php echo base_url('front_assets/');?>plugins/photoswipe_popup/photoswipe.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>plugins/photoswipe_popup/photoswipe-ui-default.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>plugins/photoswipe_popup/photoswipe-core.js"></script>
    <!-- Plugins All js -->
    <script type="text/javascript" src="<?php echo base_url('front_assets/');?>js/custom.js"></script>
    <!-- custom js -->
    <!-- end jquery -->

	<script type="text/javascript" src="<?php echo base_url();?>front_assets/js/loader/jquery.loading.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>front_assets/js/toast/jquery.toast.js"></script>
 <script>
function SearchProduct(){
	var search=$("#search_txt").val();
	window.location.href="<?php echo base_url('search-product/')?>"+search;
}	
function toast_msg(title,desc,type){
	$.toast({
		heading: title,
		text: desc,
		icon: type,
		stack: 1, 
		hideAfter: 5000,
		position: 'top-right'
	})
}
function toast_msg_postition(title,desc,type,postio){
	$.toast({
		heading: title,
		text: desc,
		icon: type,
		stack: 1, 
		hideAfter: 5000,
		position: postio
	})
}
	  function showload() {

$.showLoading({name: 'circle-turn',allowHide: false});  

}

function hideload() {

$.hideLoading(); 

} 
get_cart_data();
function get_cart_data(){
   	showload();
   	 $.ajax({
   		url: '<?php echo base_url('Cart/CartData');?>',
   		type: "POST",
   		data: {qty:'1'},
   		dataType: 'json',
   		success: function (response) {
   			hideload();
   			
   				$("#cart_data").html(response.message);
   				$("#cart_count").html(response.cart_items);
   				$("#cart_price").html(response.cart_total);
   			
   		}
   	});
   }
  function cart_remove(id,page,ele){
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
   			hideload();
   				get_cart_data();
   				
   		}
   	});
   }else{
	   
   }
   }
	function go_to_login(){
			window.location.href="<?php echo base_url('my-account');?>";
	}
	getWishListCount();	
	function getWishListCount(){
		showload();
		 $.ajax({
			url: '<?php echo base_url('WishList/WishListCount');?>',
			type: "POST",
			data: {qty:'1'},
			dataType: 'json',
			success: function (response) {
				hideload();
				$("#wish_count").html(response.count);
			}
		});
	}
	  </script>
</body>

</html>
