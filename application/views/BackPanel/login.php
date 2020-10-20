<!DOCTYPE html>

<html lang="en">

<head>



	<title>Sparkling Beauty</title>

	

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<meta name="description" content="Elite Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />

	<meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Elite Able, Elite Able bootstrap admin template">

	<meta name="author" content="Phoenixcoded" />



	<!-- Favicon icon -->

	<link rel="icon" href="http://html.phoenixcoded.net/elite-able/bootstrap/assets/images/favicon.ico" type="image/x-icon">

	<!-- fontawesome icon -->

	<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/fontawesome/css/fontawesome-all.min.css">

	<!-- animation css -->

	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/animation/css/animate.min.css">





	<!-- auth-signup1 css -->

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/pages/new-signup/base.css" />



	<!-- vendor css -->

	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/loader/loading.min.css">

	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/notification/css/notification.min.css">





</head>



<!-- [ auth-signup1 ] start -->

<div class="auth-wrapper aut-bg-img-side cotainer-fiuid align-items-stretch">

	<div class="row align-items-center w-100 align-items-stretch bg-white">

		<div class="d-none d-lg-flex col-md-8 aut-bg-img d-md-flex justify-content-center content content--side">

			<div class="poster" style="background-image:url(<?php echo base_url();?>assets/images/auth-bg-big.jpg)"></div>

			<div class="canvas-wrap">

				<canvas></canvas>

			</div>

		</div>



		<div class="col-md-4 align-items-stret h-100 ad-flex justify-content-center content content--side px-5">

			

			<div class="head-block">

				<img src="<?php echo base_url();?>assets/images/logoS.png" alt="" class="img-fluid mb-4">

				<h4 class="mb-3 f-w-400">Login</h4>

			</div>



			<form class="form m-0" id="login_form">

				<div class="form__item">

					<label class="form__label" for="email">User Name</label>

					<input class="form__input form-control" type="text" name="name" id="name">

				</div>

				

				<div class="form__item">

					<label class="form__label" for="password">Password</label>

					<div class="form__input-wrap">

						<input class="form__input form-control" type="password" name="password" id="password">

						<p class="form__password-strength" id="strength-output"></p>

					</div>

				</div>

				<div class="form__item form__item--actions">

					

					<input class="form__button btn btn-primary" type="submit" name="signup" value="Login">

				</div>

			</form>

		</div>

	</div>

</div>

<!-- [ auth-signup1 ] end -->



<!-- new-signup js -->

<script src="<?php echo base_url();?>assets/js/pages/new-signup/imagesloaded.pkgd.min.js"></script>

<script src="<?php echo base_url();?>assets/js/pages/new-signup/zxcvbn.js"></script>

<script src="<?php echo base_url();?>assets/js/pages/new-signup/demo1.js"></script>



<!-- Required Js -->

<script src="<?php echo base_url();?>assets/js/vendor-all.min.js"></script>

<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>



<script type="text/javascript" src="<?php echo base_url();?>assets/js/loader/jquery.loading.min.js"></script>

<script src="<?php echo base_url();?>assets/plugins/notification/js/bootstrap-growl.min.js"></script>

<script src="<?php echo base_url();?>assets/js/pages/ac-notification.js"></script>

<script type="text/javascript">

	

		function showload() {



		$.showLoading({name: 'circle-turn',allowHide: false});  



		}



		function hideload() {



		$.hideLoading(); 



		} 

		$("#login_form").submit(function(e) {



			 e.preventDefault();



			showload();



			$.ajax({



				url:'<?php echo base_url('BackPanel/Login/check_login');?>',



				method:'post',



				dataType:'json',



				data: $("#login_form").serialize(),



				success:function(d){ 



					hideload();



					if(d.status==true){



						window.location.href = "<?php echo base_url("BackPanel/Dashboard");?>";



					}else{

					 custom_notify(d.message, "danger");



					}



						 



				}	



			});	 



		 });



      //Collapse menu



      



  



</script>









</body>

</html>

