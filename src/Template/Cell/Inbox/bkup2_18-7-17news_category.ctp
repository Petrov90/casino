<?php 
$more	=	'';
foreach($news_category as $key => $cat){ 
	if($key < 5){ ?>
	<li id="<?php echo $cat->slug; ?>">
		<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view' ,'news_view' => $cat->slug)); ?>"><?php echo $cat->name ?></a>
	</li>
<?php }else{ $border_none='border_none';
		$more .= '<li id='.$cat->slug.' class='.$border_none.'><a href="'.$this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view' ,'news_view' => $cat->slug)).'">'.$cat->name.'</a></li>';
	}	 
} if(!empty($more)){ ?>
<li class="">
   <div class="signMenu_dropdown2 border_none arrow_drop">       
		<a href="javascript:void(0);" onClick="$('.profileNav2').slideToggle();">More</a>        
		<ul class="dropList profileNav2 drop_new">
			<?php echo $more; ?>
		</ul>
  </div>
</li><?php } ?>