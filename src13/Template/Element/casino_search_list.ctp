<div class="FilterPost">
	<div class="pull-left">
		<img alt="img" ng-src="{{city_detail.casinoImage}}"/>
	 </div>
	  <div class="clientDetail">
		<h2 class="ng-binding">{{city_detail.name}}</h2>		
		 <div class="block">
			<div class="clientRating"><div class="jrating" data-score="{{city_detail.avg_rating}}"></div></div>
		 </div>		
		<div class="rating_info">
		<ul>
			<li><a>Casinos({{city_detail.count}})</a></li>
		</ul>	
		</div>	
		 <div class="block"><a href="<?php echo $this->Url->build(array('controller' => 'users','action' => 'city_view','city_view' => '')); ?>/{{city_detail.slug}}" class="btn red_btn">View City</a></div>
	  </div>
</div>
<div class="FilterPost" ng-repeat="(key, casino) in casino_list">
	<div class="pull-left">
		<img ng-src="<?php echo CASINO_THUMB_IMG_URL; ?>{{casino.image}}" alt="img" />
	 </div>
	  <div class="clientDetail">
		 <h2>{{casino.title}}</h2>
		 <div ng-bind-html-safe="casino.sdescription">{{casino.sdescription | htmlToPlaintext | limitTo: 200}}</div>
		 <div class="block">
			<div class="clientRating"><div class="jrating" data-score="{{casino.avg_rating}}"></div></div>
		 </div>
		 <div ng-if="casino.single_review" class="clientProfile">
			<div class="clientPort" ng-if="!casino.single_review[0].user.profile_image && casino.single_review[0].user.facebook_id">
				<img alt="img" class="img-responsive" ng-src="http://graph.facebook.com/{{casino.single_review[0].user.facebook_id}}/picture?type=large" alt="img" />
			</div>
			<div class="clientPort" ng-if="casino.single_review[0].user.profile_image">
				<img alt="img" class="img-responsive" ng-src="casino.single_review[0].user.profile_image" alt="img" />
			</div>
			<div class="clientPort" ng-if="!casino.single_review[0].user.profile_image && !casino.single_review[0].user.facebook_id">
				<img src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.NO_PROFILE_IMAGE; ?>" alt="img" class="img-responsive"/>
			</div>
			<p>{{casino.single_review[0].comment | limitTo: 250}}</p>
		 </div>
		 <div class="block">
			<a ng-if="casino.type == 'online'" href="<?php echo $this->Url->build(array('action' => 'online_casino_view','online_casino_view' => '')); ?>/{{casino.slug}}" class="btn red_btn">View Casino</a>
			<a ng-if="casino.type == 'normal'" href="<?php echo $this->Url->build(array('action' => 'casino_view','casino_view' => '')); ?>/{{casino.slug}}" class="btn red_btn">View Casino</a>
		</div>
	  </div>
</div>