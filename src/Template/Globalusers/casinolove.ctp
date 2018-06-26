<h2 class="deshtitle">Casinos I Love</h2>
   <div class="reviewsTabs">
		<ul>
			<li ng-class="loveToplay ? 'active' : ''"><a href="javascript:void(0);" ng-click="casinoIvisites1();">Casino I visited ({{casinoIvisites}})</a></li>
			<li ng-class="!loveToplay ? 'active' : ''"><a href="javascript:void(0);" ng-click="casinoILikes1()">I love to play online at ({{casinoILikes}})</a></li>
		</ul>
   </div>
	<div class="mapLoction">
		<div class="mapListcol">
			 <ul id="CasinoVisits" ng-show="loveToplay"><br/>
				<div class="findCasino"><input ng-model="keywords" ng-change="CasinoVisitsSearch()" type="text" placeholder="Find your casino...." /></div>
				 <?php
				 /*<div ng-show="huu==20">
				 if(!$allCasinos->isEmpty()){
					$count =  $allCasinos->count();
					foreach($allCasinos as $key => $casino){  ?>						    
					  <li id="li_<?php echo $casino->id; ?>" class="phpli">
						 <div class="pull-left"><a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug]); ?>" target="_blank" class="colCasinoHeading">
						 <?php if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){ ?>
							<img  src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image; ?>" class="img-responsive lazy" />
						 <?php }else{ ?>
							 <img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_CASINO_IMG; ?>" class="img-responsive lazy" />
					<?php } ?></a>
						</div>
						 <div class="locatnDet">
							<a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'casino_view','casino_view' => $casino->slug]); ?>" target="_blank" class="colCasinoHeading"><?php echo $casino->title; ?></a>
							 <div class="editBtns">
								 <a href="javascript:void(0);" ng-click="beenHere(<?php echo $casino->id; ?>);" class="btn red_btn">Been here</a>
							  </div>
						 </div>
					  </li>
				 <?php 
					}
				 } 
				 </div>*/ ?>
				<li ng-show="casinoIvisitesAllCasino == 0 ">
					 <div class="text-center">No Casino found</div>
				</li>
				<li class="preiv" style="display:none"></li>
				<li ng-repeat="casinor in casinos" id="li_{{casinor.id}}">
					 <div class="pull-left">
						<a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'casino_view','casino_view' => '']); ?>/{{casinor.slug}}" target="_blank" class="colCasinoHeading"><img ng-src="{{casinor.image}}" class="img-responsive" /></a>
					</div>
					 <div class="locatnDet">
						<a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'casino_view','casino_view' => '']); ?>/{{casinor.slug}}" target="_blank" class="colCasinoHeading">{{casinor.title}}</a>
						 <div class="editBtns">
							 <a href="javascript:void(0);" ng-click="beenHere(casinor.id);" class="btn red_btn">Been here</a>
						  </div>
					 </div>
				</li>
				<li ng-show="LoadMoreVisitsCount == 20 " style="list-style:none" class="text-center"><a href="javascript:void(0);" ng-click="LoadMoreVisits();" class="btn red_btn">LoadMore</a></li>
			 </ul>
					
		</div>
		<div class="mapListcol"  ng-show="!loveToplay">
			 <ul id="CasinoLikes">
			 <br/>
				<div class="findCasino"><input ng-model="likeskeywords" ng-change="CasinoLikesSearch()" type="text" placeholder="Find your casino...." /></div>
				 <?php /*
			 if(!$allLikesCasinos->isEmpty()){ 
				foreach($allLikesCasinos as $casino){?>						    
				  <li id="likes_<?php echo $casino->id; ?>">
					 <div class="pull-left"><a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>" target="_blank" class="colCasinoHeading">
					 <?php if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){ ?>
						<img src="<?php echo  WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image; ?>" class="img-responsive lazy" />
					 <?php }else{ ?>
						 <img src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_CASINO_IMG; ?>" class="img-responsive lazy" />
				<?php } ?></a>
					</div>
					 <div class="locatnDet">
						<a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>" target="_blank" class="colCasinoHeading"><?php echo $casino->title; ?></a>
						 <div class="editBtns">
							 <a href="javascript:void(0);" ng-click="LikeThis(<?php echo $casino->id; ?>);" class="btn red_btn">Been here</a>
						  </div>
					 </div>
				  </li>
			 <?php 
				}
			 }*/ ?>							
				<li ng-show="casinoILikesAllCasino == 0 ">
					 <div class="text-center">No Casino found</div>
				</li>
				
				<li class="preivl" style="display:none"></li>
				<li ng-repeat="casinol in casinosLike" id="likes_{{casinol.id}}">
					 <div class="pull-left">
						<a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' =>'']); ?>/{{casinol.slug}}" target="_blank" class="colCasinoHeading"><img ng-src="{{casinol.image}}" class="img-responsive" /></a>
					</div>
					 <div class="locatnDet">
						<a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' =>'']); ?>/{{casinol.slug}}" target="_blank" class="colCasinoHeading">{{casinol.title}}</a>
						 <div class="editBtns">
							 <a href="javascript:void(0);" ng-click="LikeThis(casinol.id);" class="btn red_btn">Been here</a>
						  </div>
					 </div>
				</li>
				<li ng-show="LoadMoreLikesCount == 20 " style="list-style:none" class="text-center"><a href="javascript:void(0);" ng-click="LoadMoreLikes();" class="btn red_btn">LoadMore</a></li>
			 </ul>
		</div>
		<div class="mapFreme" ng-show="showMap">
			<div class="mapaddres">
				<div class="mapListcol">
					<ul>
						<li style="width:100%">
						   <div class="pull-left">
								<img ng-src="{{imgsrc}}" class="img-responsive" />
						   </div>
							<div class="locatnDet">
							  <div class="col">
								 <a href="#" class="colCasinoHeading">{{title}}</a>
									<div class="ratingmap"><span class="readonly" data-score="{{score}}"></span>
									<span>{{reviews}} Reviews</span> 
									</div>
								 <p>Ranked#1: <a href="">{{city}} Casino</a></p>
							  </div>
							  <div class="pull-right">
								 <div class="mapView">
									<a href="javascript:void(0)" ng-click="showMap = false">Back</a>
								 </div>
							  </div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div id="map_canvas_dashboard"></div>
		</div>
		<div class="mapFreme" id="visitedId" ng-show="loveToplay && !showMap"  dynamic="html">
		   <div class="mapaddres">
			  <div class="mapListcol">
				 <ul id="visitedId11">
					<?php if(!empty($casinoIvisites)){ foreach($casinoIvisites as $result){
						?>
						<li id="my_vis_<?php echo $result->id ?>">
						   <div class="pull-left">
							   <a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'casino_view','casino_view' => $result->casino->slug]); ?>" target="_blank" class="colCasinoHeading">
								<?php if(!empty($result->casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$result->casino->image)){ ?>
										<img src="<?php echo $imgsrc = WEBSITE_UPLOADS_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$result->casino->image; ?>" class="img-responsive lazy" />
									<?php 
									}else{ ?>				
										<img src="<?php echo $imgsrc = WEBSITE_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.NO_CASINO_IMG; ?>" class="img-responsive" />
									<?php } ?>
								</a>
						   </div>
						   <div class="locatnDet">
							  <div class="col">
								 <a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'casino_view','casino_view' => $result->casino->slug]); ?>" target="_blank" class="colCasinoHeading"><?php echo $result->casino->title; ?></a>
									<div class="ratingmap"><span class="readonly" data-score="<?php echo $result->casino->avg_rating; ?>"></span>
									</div>
								 <p>Ranked#1: <a target="_blank" href="<?php echo $this->Url->build(['controller' => 'users','action' => 'city_view','country' =>$result->casino->city->country->slug,'city' => $result->casino->city->slug]); ?>"><?php echo $result->casino->city->name; ?> Casinos</a></p>
							  </div>
							  <div class="pull-right">
								 <p><a href="javascript:void(0);" ng-click="remove('<?php echo $result->id ?>','CasinoVisits','my_vis_<?php echo $result->id ?>')" class="remove">X</a></p>
								 <div class="mapView">
									<a href="javascript:void(0)" city="<?php echo $result->casino->city->name; ?>" score="<?php echo $result->casino->avg_rating; ?>" imgsrc="<?php echo $imgsrc; ?>" title="<?php echo $result->casino->title; ?>" address="<?php echo $result->casino->address; ?>" ng-click="showMapF($event)"><i class="fa fa-map-marker"></i> View Map</a>
								 </div>
							  </div>
						   </div>
						</li>
					<?php
					} } ?>
					
				 </ul>
					<div ng-show="casinoIvisites == 0 ">
						<div class="text-center">No Visited Casino Added</div>
					</div>
			  </div>
		   </div>
		</div>
		<div id="likeId"  ng-show="!loveToplay" class="mapFreme">
		   <div class="mapaddres iloveplay">
			  <div class="mapListcol">
				 <ul id="likeId11">
				<?php foreach($casinoILikes as $result){  ?>
					<li id="my_lis_<?php echo $result->id ?>">
					   <div class="pull-left"><a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $result->casino->slug]); ?>" target="_blank" class="colCasinoHeading">
					<?php if(!empty($result->casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$result->casino->image)){ ?>
						<img src="<?php echo WEBSITE_UPLOADS_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$result->casino->image; ?>" class="img-responsive lazy" />
					<?php 
					}else{ ?>				
						<img src="<?php echo WEBSITE_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.NO_CASINO_IMG; ?>" class="img-responsive lazy" />
					<?php } ?></a>
					</div>
					   <div class="locatnDet">
						  <div class="col">
							<a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $result->casino->slug]); ?>" target="_blank" class="colCasinoHeading"><?php echo $result->casino->title; ?></a>
						  </div>
						  <div class="pull-right">
							 <a  rel="nofollow" data-title="<?php echo $result->title ?>" data-url="<?php echo $result->slug ?>"  <?php echo NEWTAB ?>  href="<?php 
								$url	=	$result->casino->main_promotion->slug;
								echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $url))  ?>" class="btn red_btn">Play</a>
                                <span class="imgColseIcon">
							 <a ng-click="remove('<?php echo $result->id ?>','CasinoLikes','my_lis_<?php echo $result->id ?>')" href="javascript:void(0);" class="remove colseIcone colseIcone2">X</a>
                             <a  href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $result->casino->slug]); ?>" target="_blank" class="eyeIcon"><img src="../images/eye_icon.png" alt="img" /></a></span>
						  </div>
					   </div>
					</li>
				<?php } ?>
				 </ul>
					<div ng-show="casinoILikes == 0 ">
						<div class="text-center">No Casino Added</div>
					</div>
			  </div>
		   </div>
		</div>
   </div>
            