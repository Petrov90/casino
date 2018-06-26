<html>
<body ng-app="">
<?php

$controller	=	$this->request->params['controller'];

$action		=	$this->request->params['action'];

if(!empty($this->request->session()->read('Auth.User.profile_image')) && file_exists(PROFILE_ROOT_PATH.$this->request->session()->read('Auth.User.profile_image'))){

	$url	=	WEBSITE_URL.'image.php?width=34px&height=34px&cropratio=1:1&image='.PROFILE_IMG_URL.$this->request->session()->read('Auth.User.profile_image');

}else if(!empty($this->request->session()->read('Auth.User.facebook_id'))){

	$url	=	 'http://graph.facebook.com/'.$this->request->session()->read('Auth.User.facebook_id').'/picture?type=large';

}else{

	$sex	=	$this->request->session()->read('Auth.User.sex');

	$url	=	WEBSITE_URL.'image.php?width=34px&height=34px&cropratio=1:1&image='.NO_PROFILE_IMAGE.$sex.'.png';

}  ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



<div class="header bignigstatic <?php if(in_array($controller,array('Casinos')) && in_array($action,array('addCasino','casinoView','onlineCasinoView')) || in_array($controller,array('Globalusers')) && in_array($action,array('index')) ||  in_array($controller,array('Users')) && in_array($action,array('addReview','cmsSlug','contactUs'))){

		echo ' header_top  header_inner';

}

/* if(in_array($controller,array('Casinos')) && in_array($action,array('addCasino','casinoView','onlineCasinoView')) || in_array($controller,array('Globalusers')) && in_array($action,array('index')) ||  in_array($controller,array('Users')) && in_array($action,array('addReview','cmsSlug','contactUs'))){

		echo ' header_top  header_inner';

}else{

	/* if($controller == 'Users' && $action == 'index'){

		echo 'indexHeader';

	}else{

	} *

		echo 'header_color_none';

} */ echo 'header_color_none'; ?> ">

	<div class="container">

	   <div class="row">

		  <div class="logo">

				<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'index')); ?>"><img src="<?php echo WEBSITE_IMG_URL; ?>newlogo.svg" alt="Casinoo" class="img-responsive" /></a>

		  </div>

		  <nav class="navbar navbar-inverse inver navbar-right <?php echo ($controller == 'Users' && $action == 'index') ? '' : ''; ?>">

			 <div class="navbar-header">

				 <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">

					<span class="sr-only">Toggle navigation</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

				</button>

			 </div>

			 <div class="collapse navbar-collapse js-navbar-collapse clps">

				<ul class="nav navbar-nav">

				   <li class=" desktop-none search_box <?php echo (!($action == 'index' && $controller == 'Users') && !($action == 'casinoSlug' && $controller == 'Casinos')) ? '' : 'hide ccc'; ?>">

						<!-- <input placeholder="Find Casino" class="headersearch autocomplete " type="text"> -->

						<span><img src="<?php echo WEBSITE_IMG_URL; ?>search_icon.png" alt="img"></span>

					</li>

				   <li class=""><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'locations')); ?>"><?= __('menu.destinations',true); ?></a></li>

				   <li>

				   <a href="<?php echo WEBSITE_URL?>online-casinos">Online Casinos</a>

				 <?php /*  <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'onlineCasino')); ?>"><?=  __('menu.online_casinos',true); ?></a> */?>

				   </li>

				   <li>

				   <a href="<?php echo WEBSITE_URL?>casino-bonus">Bonuses</a>

				   <?php /*<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'promotions','action' => 'promotion')); ?>"><?php echo __('menu.bonuses',true); ?></a> */ ?>



				   </li>

				   <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news')); ?>"><?php echo __('menu.news',true); ?></a></li>

				</ul>

				<div class="signMenu">

				   <?php if($this->request->session()->read('Auth.User')){ ?>

				   <div class="signMenu_dropdown">

					  <span><img height="34" width="34" src="<?php echo $url; ?>" alt="img" /></span><a href="javascript:void(0);" onClick="$('.profileNav').slideToggle();"><?php echo $this->request->session()->read('Auth.User.full_name'); ?> <img src="<?php echo WEBSITE_IMG_URL; ?>droup_icon.png" alt="img" /></a>

					  <ul class="dropList profileNav headerMenu">

						<li><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'globalusers','action' => 'index']) ?>">Dashboard</a></li>

						<li><a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'user_slug','user_slug' => $this->request->session()->read('Auth.User.slug')]) ?>">My profile</a></li>

						 <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'globalusers','action' => 'index')); ?>">My favorites</a></li>

						 <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'globalusers','action' => 'index')); ?>#message">Messages</a></li>

						 <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'globalusers','action' => 'index')); ?>#edit_settings">Settings</a></li>

						 <li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'logout')); ?>"><?php echo __('menu.logout',true); ?></a></li>

					  </ul>

				   </div>

				   <?php }else{ ?>

				   <a href="javascript:void(0)" class="login-pop" data-title="Create Account" data-rel="signup_div"><?php echo __('menu.signup',true); ?></a><a href="javascript:void(0)" class="login-pop margin-right" data-title="Login Form" data-rel="login_div"><?php echo __('menu.login',true); ?></a>

				   <?php } ?>
				   <div class="search-div">
				   	<!-- 	<input style="display: none;" placeholder="Find Casino" class="headersearch autocomplete " type="text" id="search-input"> -->
				   	<!-- <input style="display: none;" type="text" name="seach" placeholder="Find Casino" id="search-input"> -->
				   	<i class="fa fa-search" id="search-div" data-toggle="modal" data-target="#myModal"></i>
				   </div>

	<!-- searching modal start -->

<div id="myModal" class="modal fade search-header" role="dialog">
	<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" style="margin-right: 10px;">&times;</button>
		</div>
		<div class="modal-body">
			<div class="search-back">
			    <div class="top-search ng-scope" >
						<form method = "post" action ="/search/{{city_name}}" name="headerSearch">
			        <input ng-model="city_name" id="city_name" class="autocompletepopup ng-pristine ng-valid ui-autocomplete-input" placeholder="Casino name or destination" autocomplete="off" type="text">
							<input type="submit" name="submit" class="search-back-a" value="Search">
						</form>
			    </div>
			</div>
		</div>

	</div>
	</div>
</div>
<!-- searching modal end -->
				</div>

			 </div>

		  </nav>

	   </div>

	</div>

</div>



<script>

$(document).ready(function(){

    /*$("#search-div").click(function(){

        $("#search-input").hide(1000);

    });*/

    $("#search-div").click(function(){

        $("#search-input").show(600);

    });

});

</script>
<style type="text/css">
	.modal-backdrop{
		display: none !important;
	}
	.search-header .modal-dialog{
		margin: -1px auto 0 !important;
		max-width: 100% !important;
    	width: 100% !important;
	}
	.search-header .modal-content {
    	height: 100px;
    	border-radius: 0;
	}
	.search-header{  padding-right: 0 !important; width: 101% !important }
	.search-header .search-back{ max-width: 80%;margin: 0 auto;display: table;}
	.search-header .search-back-a{font-family: latobold;font-size: 18px; padding: 6px 30px; line-height: 30px;}
	.search-header .search-back input[type="text"]{border-bottom: 1px solid #cccccc; font-size: 20px;}
	.search-header .modal-body {
    position: relative;

    padding: 15px;
	}
	.index-page{
		height: 0 !important;
	}

</style>
