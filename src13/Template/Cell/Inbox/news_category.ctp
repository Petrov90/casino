<?php 
$more	=	'';
foreach($news_category as $key => $cat){ 
	if($key < 5){ ?>
	<li id="<?php echo $cat->slug; ?>">
		<a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view' ,'news_view' => $cat->slug)); ?>"><?php echo $cat->name ?></a>
	</li>
<?php }else{
		$more .= '<li id='.$cat->slug.'><a href="'.$this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view' ,'news_view' => $cat->slug)).'">'.$cat->name.'</a></li>';
	}	 
} if(!empty($more)){ ?>
<li>
   <div class="signMenu_dropdown2">       
		<a href="javascript:void(0);" onClick="$('.profileNav2').slideToggle();">More</a>        
		<ul class="dropList profileNav2">
			<?php echo $more; ?>
		</ul>
  </div>
</li><?php } ?>