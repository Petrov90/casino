<div class="row grid11 grid2">
<?php foreach($worldPopularCasino as $continent){ if(!empty($continent->casinos)){ ?>
   <div class="col-md-4 sdsd">
	   <div class="mid_block midblock1"><!-- <i><img src="<?php //echo GALLERY_IMG_URL.$continent->image; ?>" alt="icon"></i> -->
        <h3><?php echo $continent->name; ?></h3>
		    <ul>			
			<?php $i = 0;
			foreach($continent->casinos as $c){ ?>
				<li>

				<a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'casino_view','casino_view' => $c->slug]); ?>"><?php echo $c->title; ?></a>
				</li>


			<?php  if (++$i == 5) break;}
			$cont_city = array();
			foreach ($worldPopularcities as $arr) {
					if($arr['continent_id'] == $continent->id)
						$cont_city[] = $arr;
				}
				
			$num_city = 1;
			$no_of_cities = $continent->no_of_cities;	
			foreach($cont_city as $cas ) {
				if($num_city <= $no_of_cities) {?>
				<li>
					<a href="<?php echo $cUrl =  $this->Url->build(array('controller' => 'users','action' => 'city_view','country' => $cas['country_slug'],'city' => $cas['city_slug'])); ?>"><?php echo $cas['name'].' Casinos'; ?>
					</a>
				</li><?php 
				} $num_city++;
			} ?>
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