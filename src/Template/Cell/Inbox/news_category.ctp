<?php 

$more	=	'';

$actv = '';$type = '';

if(empty($this->request->params['pass'])) {

	$actv = 'active';

}

else {

	$type = $this->request->params['pass'][0];

}

?>

<li class="<?php echo $actv;?>" id="al1">

	<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news')); ?>">All</a>

</li>

<?php

foreach($news_category as $key => $cat){ 

	if($key < 5){ ?>

	<li id="<?php echo $cat->slug; ?>" class="<?php if($type == $cat->slug) echo 'active';?>">

		<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view' ,'news_view' => $cat->slug)); ?>"><?php echo $cat->name ?></a>

	</li>

<?php }else{ 

				$border_none='border_none';

				$mact = '';

				if($type == $cat->slug){

	   				$mact='active';

				}



		$more .= '<li id='.$cat->slug.' class='.$border_none.'><a href="'.$this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view' ,'news_view' => $cat->slug)).'">'.$cat->name.'</a></li>';

	}	 

} if(!empty($more)){ ?>
	<!-- <li class="<?php echo $mact;?>"> -->
	<div class="signMenu_dropdown2"> <a href="javascript:void(0);" onClick="$('.profileNav2').slideToggle();">More <i class="fa fa-caret-down"></i></a>
      <ul class="dropList profileNav2">
        <?php echo $more; ?>
      </ul>
    </div>
    <!-- </li> -->

	<!-- <li class="<?php echo $mact;?>">
		<div class="signMenu_dropdown2 border_none arrow_drop">       
			<a href="javascript:void(0);" onClick="$('.profileNav2').slideToggle();">More</a>        
			<ul class="dropList profileNav2 drop_new">
				<?php echo $more; ?>
			</ul>
		</div>
	</li> -->
<?php } ?>

