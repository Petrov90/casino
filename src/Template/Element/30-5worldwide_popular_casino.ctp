<div class="row grid11">
<?php foreach($worldPopularCasino as $continent){ if(!empty($continent->casinos)){ ?>
   <div class="col-md-4 sdsd">
	  <div class="mid_block">
      <h3><?php echo $continent->name; ?></h3>
		 <ul>			
			<?php /* uncomment to show casino
			foreach($continent->casinos as $c){ ?>
				<li>

				<a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'casino_view','casino_view' => $c->slug]); ?>"><?php echo $c->title; ?></a>
				</li>


			<?php }*/
			$cont_city = array();
			foreach ($worldPopularcities as $arr) {
					if($arr['continent_id'] == $continent->id)
					$cont_city[] = $arr;
				}

			foreach($cont_city as $cas ) {?>
			<li>
				<a href="<?php echo $cUrl =  $this->Url->build(array('controller' => 'users','action' => 'city_view','country' => $cas['country_slug'],'city' => $cas['city_slug'])); ?>"><?php echo $cas['name']; ?>
				</a>
			</li><?php
			}

				 ?>
		 </ul>
	  </div>
   </div>
<?php }
} ?>
</div>
<?php
echo $this->Html->script(array('masonry.js'),array('block' =>'footer_script'));

 $this->Html->scriptStart(array('block' => 'custom_script')); ?>
$('.grid11').masonry({
  /* columnWidth: 200, */
  itemSelector: '.sdsd'})
	
<?php $this->Html->scriptEnd(); ?>