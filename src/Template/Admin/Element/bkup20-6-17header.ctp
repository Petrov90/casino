<?php  use Cake\Core\Configure; ?><!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?php echo $this->Url->build('/admin/dashboard') ?>"><b><?php echo Configure::read('Site.title'); ?></b></a>
	</div>
	<ul class="nav navbar-top-links navbar-right">
		 <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li><a href="<?php echo $this->Url->build('/admin/edit_profile'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
				</li>
				<li class="divider"></li>
				<li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'logout')); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				</li>
			</ul>
			<!-- /.dropdown-user -->
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->
	<?php $plugin		=	$this->request->params['plugin'];
	$controller	=	trim($this->request->params['controller']);
	$action		=	$this->request->params['action']; 
	$slug			=	isset($this->request->params['pass'][0]) ? $this->request->params['pass'][0] : ''; ?>
	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li>
					<a class="<?php echo ($controller == 'users' && $action == 'dashboard') ? 'active' : ''; ?>" href="<?php echo $this->Url->build('/admin/dashboard'); ?>"><i class="fa  <?php echo ($controller == 'users' && $action == 'dashboard') ? 'fa-cog fa-spin' : 'fa-dashboard'; ?> fa-fw"></i> Dashboard</a>
				</li>
				<li>
					<a class="<?php echo ($controller == 'users' && $action == 'dashboard') ? 'active' : ''; ?>" href="<?php echo $this->Url->build('/admin/users/index'); ?>"><i class="fa  <?php echo ($controller == 'users' && $action == 'dashboard') ? 'fa-cog fa-spin' : 'fa-user fa-fw'; ?> fa-fw"></i> User Management</a>
				</li>
				<li class="<?php echo ($controller == 'Casinos' || $slug == 'aminities' || $slug == 'gambling_options' ) ? 'active' : ''; ?>">
					<a class="bbt" href="#"><i class="fa <?php echo ($controller == 'Casinos' || $slug == 'aminities' || $slug == 'gambling_options') ? 'fa-cog fa-spin' : ' fa-life-ring '; ?>  fa-fw"></i> Casino<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($controller == 'Casinos' || $slug == 'aminities' || $slug == 'gambling_options' ) ? 'collapse in' : 'collapse'; ?>">
						<li>
							<a href="<?php echo $this->Url->build('/admin/casinos/index'); ?>">Real Casino</a>
						</li> 
						 <li>
							<a href="<?php echo $this->Url->build('/admin/casinos/casino'); ?>">Online Casino</a>
						</li> <?php /*
						 <li>
							<a href="<?php echo $this->Url->build('/admin/real_casinos/index'); ?>">Fetched Real Casino</a>
						</li>*/ ?>
						<li>
							<a href="<?php  echo $this->Url->build(array('plugin' => 'promotion','controller' => 'popular_casinos','action' => 'index')); ?>">Popular Casino</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/gambling_options'); ?>">Gambling Options</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/amenities_info'); ?>">Aminities Info</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/activity/casinoActivities/index'); ?>">Aminities</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/devices'); ?>">Devices</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/software'); ?>">Software</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/deposit_methods'); ?>">Deposit methods</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/currencies'); ?>">Currencies</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/language'); ?>">Language</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/withdrawal_methods'); ?>">Withdrawal methods</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/withdrawal_limit'); ?>">Withdrawal limit</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/live_chat'); ?>">Live chat(Customer service)</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/licences'); ?>">Licences</a>
						</li>						
					</ul> 
				</li>
				<li>
					<a class="<?php echo ($controller == 'categories' && $action == 'edit') ? 'active' : ''; ?>" href="<?php echo $this->Url->build('/admin/category/categories/edit/74/bonus'); ?>"><i class="fa  <?php echo ($controller == 'categories' && $action == 'edit') ? 'fa-cog fa-spin' : 'fa-user fa-fw'; ?> fa-fw"></i> Land Based Casinos Page</a>
				</li>
				<li class="<?php echo ($controller == 'promotions' || $controller == 'Categories' || $slug == 'bonus_type') ? 'active' : ''; ?>">
					<a class="bbt" href="#"><i class="fa <?php echo ($controller == 'promotions' || $slug == 'bonus_type') ? 'fa-cog fa-spin' : ' fa-bullhorn '; ?>  fa-fw"></i> Promotion<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($controller == 'promotions' || $controller == 'Categories'  || $slug == 'bonus_type') ? 'collapse in' : 'collapse'; ?>">
						<li>
							<a href="<?php  echo $this->Url->build(array('plugin' => 'promotion','controller' => 'promotions','action' => 'index')); ?>">Promotion</a>
						</li> 
						<li>
							<a href="<?php echo $this->Url->build('/admin/category/categories/index/bonus_type'); ?>">Bonus Type</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/category/categories/edit/46/bonus'); ?>">Bonus Page Content</a>
						</li> 
					</ul> 
				</li>
				<li>
					<a class="bbt" href="#"><i class="fa <?php echo ($controller == 'promotions' || $slug == 'bonus_type') ? 'fa-cog fa-spin' : ' fa-bullhorn '; ?>  fa-fw"></i> Online casino content<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($controller == 'promotions' || $controller == 'Categories'  || $slug == 'bonus_type') ? 'collapse in' : 'collapse'; ?>">
						<li>
							<a href="<?php echo $this->Url->build('/admin/category/categories/index/online_casino'); ?>">Page Category</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/category/categories/edit/48/bonus'); ?>">Online casino page content</a>
						</li> 
						<li>
							<a href="<?php echo $this->Url->build('/admin/guide_content/guide-contents/index/guide'); ?>">Guide content</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/category/categories/index/countries'); ?>">Popular Countries Casino</a>
						</li> 
					</ul> 
				</li>
				<li class="<?php echo ($plugin == 'emailtemplate' || $slug == 'FollowUsOn'|| $plugin == 'slider'|| $plugin == 'cms') ? 'active' : ''; ?>">
					<a class="bbt" href="#"><i class="fa <?php echo ($plugin == 'emailtemplate' || $slug == 'FollowUsOn'|| $plugin == 'slider'|| $plugin == 'cms') ? 'fa-cog fa-spin' : 'fa-cogs'; ?>  fa-fw"></i> Management<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($plugin == 'emailtemplate' || $slug == 'FollowUsOn'|| $plugin == 'slider'|| $plugin == 'cms') ? 'collapse in' : 'collapse'; ?>">
						 <li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'setting','controller' => 'settings','action' => 'view','Site')); ?>"> Site Settings</a>
						</li> 
						 <li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'setting','controller' => 'settings','action' => 'view','Date')); ?>"> Date Format</a>
						</li> 
						<li>
							 <a  href="<?php echo $this->Url->build('/admin/email_template/email-templates/index'); ?>"> Email Templates</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'setting','controller' => 'settings','action' => 'view','FollowUsOn')); ?>"> Follow Us On</a>
						</li> 
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'cms','controller' => 'cms-pages','action' => 'index')); ?>"> Cms Pages</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'block','controller' => 'blocks','action' => 'index')); ?>"> Blocks</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'contact','controller' => 'contacts','action' => 'index')); ?>"> Contact Us</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'slider','controller' => 'sliders','action' => 'index')); ?>">Homepage slider</a>
						</li>
						
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/report_as_spam'); ?>">Report as spam</a>
						</li>
					</ul>
					<!-- /.nav-second-level -->
				</li>
				<li class="<?php echo ($plugin == 'textsetting') ? 'active' : ''; ?>">
					<a class="bbt" href="#"><i class="fa <?php echo ($plugin == 'textsetting') ? 'fa-cog fa-spin' : 'fa-language'; ?>  fa-fw"></i> Language Setting<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($plugin == 'textsetting') ? 'collapse in' : 'collapse'; ?>">	<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'textsetting','controller' => 'languages','action' => 'index')); ?>">Languages</a>
						</li> 
						 <li>
							<a href="<?php echo $this->Url->build('/admin/textsetting/text-settings/index'); ?>">Language Translate</a>
						</li>
					</ul> 
				</li>
				<li class="<?php echo ($plugin == 'city_manager') ? 'active' : ''; ?>">
					<a class="bbt" href="#"><i class="fa <?php echo ($plugin == 'city_manager') ? 'fa-cog fa-spin' : 'fa-map-marker'; ?>  fa-fw"></i>City Manager<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($plugin == 'city_manager') ? 'collapse in' : 'collapse'; ?>">	
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'city_manager','controller' => 'continents','action' => 'index')); ?>">Continent</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'city_manager','controller' => 'country','action' => 'index')); ?>">Country</a>
						</li> <?php /*
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'city_manager','controller' => 'state','action' => 'index')); ?>">State</a>
						</li> */?>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'city_manager','controller' => 'city','action' => 'index')); ?>">City</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/city_manager/lan-page-city/index'); ?>">Land based casino city</a>
						</li>
					</ul> 
				</li> 
				<li class="<?php echo ($plugin == 'news') ? 'active' : ''; ?>">
					<a class="bbt" href="#"><i class="fa <?php echo ($plugin == 'news') ? 'fa-cog fa-spin' : 'fa-map-marker'; ?>  fa-fw"></i>News Manager<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level <?php echo ($plugin == 'news') ? 'collapse in' : 'collapse'; ?>">	
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/news_category'); ?>">News Category</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build('/admin/master/masters/index/news_user'); ?>">News User</a>
						</li>
						<li>
							<a href="<?php echo $this->Url->build(array('plugin' => 'news','controller' => 'news','action' => 'index')); ?>">News</a>
						</li>
					</ul> 
				</li> 
				<li>
					<a class="<?php echo ($controller == 'upload-images') ? 'active' : ''; ?>" href="<?php echo $this->Url->build('/admin/upload/upload-images/index'); ?>"><i class="fa  <?php echo ($controller == 'upload-images') ? 'fa-cog fa-spin' : 'fa-user fa-fw'; ?> fa-fw"></i>Image Approval Request</a>
				</li>
				<li>
					<a class="<?php echo ($controller == 'reviews') ? 'active' : ''; ?>" href="<?php echo $this->Url->build('/admin/reviews/index'); ?>"><i class="fa  <?php echo ($controller == 'reviews') ? 'fa-cog fa-spin' : 'fa-user fa-fw'; ?> fa-fw"></i>All Reviews</a>
				</li>
				<li>
					<a class="<?php echo ($controller == 'review_spams') ? 'active' : ''; ?>" href="<?php echo $this->Url->build('/admin/review_spams/index'); ?>"><i class="fa  <?php echo ($controller == 'review_spams') ? 'fa-cog fa-spin' : 'fa-user fa-fw'; ?> fa-fw"></i>Review Spam Request</a>
				</li>
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
</nav>
