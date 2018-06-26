<li id="my_vis_<?php echo $id ?>">
   <div class="pull-left"><a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'casino_view','casino_view' => $result->slug]); ?>" target="_blank" class="colCasinoHeading">
    <?php if(!empty($result->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$result->image)){ ?>
			<?php echo $imgUrl = $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$result->image,['class' => 'img-responsive']); ?>
		<?php 
		}else{ ?>				
			<img src="<?php echo $imgUrl =  WEBSITE_URL.'image.php?width=70px&height=70px&cropratio=1:1&image='.NO_CASINO_IMG; ?>" class="img-responsive" />
			<?php } ?></a>
   </div>
   <div class="locatnDet">
      <div class="col">
         <a href="<?php echo $this->Url->build(['plugin'=>'','controller' => 'casinos','action' => 'casino_view','casino_view' => $result->slug]); ?>" target="_blank" class="colCasinoHeading"><?php echo $result->title; ?></a>
			<div class="ratingmap">
				<span class="readonly" data-score="<?php echo $result->avg_rating; ?>"></span>				
				<span><?php echo $result->review_count; ?> Reviews</span> 
			</div>
         <p>Ranked#1: <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'city_view','country' =>$result->city->country->slug,'city' => $result->city->slug]); ?>"><?php echo $result->city->name; ?> Casinos</a></p>
      </div>
      <div class="pull-right">
         <p><a  ng-click="remove('<?php echo $id ?>','CasinoVisits','my_vis_<?php echo $id ?>')" href="javascript:void(0);">X</a></p>
         <div class="mapView">
			<a href="javascript:void(0)" city="<?php echo $result->city->name; ?>" score="<?php echo $result->avg_rating; ?>" imgsrc="<?php echo $imgUrl; ?>" title="<?php echo $result->title; ?>" address="<?php echo $result->address; ?>" ng-click="showMapF($event)"><i class="fa fa-map-marker"></i> View Map</a>
         </div>
      </div>
   </div>
</li>