<?php 
if(!$result->isEmpty()){
	foreach($result as $key => $casino){ ?>
		<div class="clint_info_post">
		
			<div class="clint_post client_post1"> 
				<div class="clint_item clint_item_new">
					<a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>"><?php 
						 
							if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
							echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=242px&height=129px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$casino->image,['alt' => $casino->title.' review','height'=>129, 'width'=>242]);
							}else{
								?>
								<img src="http://www.casinoo.com/webroot/uploads/image.php?width=239px&amp;height=120px&amp;cropratio=2:1&amp;image=http://www.casinoo.com/webroot/img/city-image.jpg" alt="Image">
								<?php
							}
					    ?><?php
						 $paginator = $this->request->params['paging']['Casinos'];

						
						$page =  $paginator['page'] - 1;

					     ?>
				   </a><div class="col_list cl_num1"><span><?php echo (($page*10) + ($key+1)); ?></span></div>
				</div>
	            <div class="clint_post_right">
					<div class="block casino_block">
						<a href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>"><span><?php echo $casino->title; ?></span></a>
					</div>
					<div class="clientRating clientRating1 readonly" data-score="<?php echo $casino->avg_rating; ?>"></div>
					 <span class="op_txt1">
                                 <?php
                                 echo $casino->review_count + 1;
                                 if($casino->review_count   > 1)
                                    echo ' reviews';
                                 else
                                    echo ' review';?>
                    </span>
					
<!--new contetn-->

<!--new contetn-->
				</div>
				<div class="sbumit_block3">
					<div class="more_info_btn ">
						<!-- <a rel="nofollow" data-title="<?php echo $casino->title ?>" data-url="<?php echo $casino->slug ?>" class="paly_now" <?php echo NEWTAB ?> href="<?php $slug	=	$casino->main_promotion->slug; echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'casino_name' ,'casino_name' => $slug)); ?>">Play Now</a> -->
						<a class="more_btn" href="<?php echo $this->Url->build(['controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $casino->slug]); ?>">More info</a>
					</div>
				</div>
				<div>
				<?php
				$countrydetails = $this->SocialShare->countryslug($casino->country_id);
				echo $casino->city_name.", ".$countrydetails->name; 
				?>
				</div>
			</div>
		</div><?php 
	}
$pageCount = $this->Paginator->param('count');

 $current_page =  $this->Paginator->param('page');
 $url = $this->Url->build('/'.$cityDetail->slug.'/casinos').'?page=';
 $total_pages = ceil($pageCount/$limit);
 $pagination = '';
 if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
  $pagination .= '<div class="Pagination_nav">
      <ul>';

  $right_links = $current_page + 5;
  $previous = $current_page - 1; //previous link
  $next = $current_page + 4; //next link
  $first_link = true; //boolean var to decide our first link

  /* if ($current_page > 1) { */
   $previous_link = ($previous == 0) ? 1 : $previous;
   
   // $pagination .= '<li><a href="'.$url.'1" data-page="1" title="First">&laquo;</a></li>'; //first link
   $pagination .= '<li class="prev"><a href="'.$url . $previous_link . '" data-page="' . $previous_link . '" title="Previous"><i class="fa fa-caret-left"></i></a></li>'; //previous link
 
	for ($i = ($current_page - 4); $i < $current_page; $i++) { //Create left-hand side links
		if ($i > 0) {
			$pagination .= '<li><a href="'.$url  . $i . '" data-page="' . $i . '" title="Page' . $i . '">' . $i . '</a></li>';
		}
   }
	$first_link = false; //set first link to false
  /* } */

  if ($first_link) { //if current active page is first link
	$pagination .= '<li class="select" ><a class="" href="'.$url . $current_page . ' "> ' . $current_page . '</a></li>';
  } elseif ($current_page == $total_pages) { //if it's the last active link
	$pagination .= '<li class="active"><a class="" href="'.$url  . $current_page . ' "> ' . $current_page . '</a></li>';
  } else { //regular current link
	$pagination .= '<li class="active"><a class="" href="'.$url  . $current_page . ' "> ' . $current_page . '</a></li>';
  }

  if($current_page < 5){
	  $right_links	=	10;
  }
  for ($i = $current_page + 1; $i < $right_links; $i++) { //create right-hand side links
	   if ($i <= $total_pages) {
			$pagination .= '<li><a href="' .$url . $i . '"   title="Page ' . $i . '">' . $i . '</a></li>';
	   }
  }
  if ($current_page < $total_pages) {
		$next_link = $current_page+1;
		$pagination .= '<li class="next"><a href="' .$url . $next_link . '" data-page="' . $next_link . '" title="Next"><i class="fa fa-caret-right"></i></a></li>'; //next link
   // $pagination .= '<li ><a href="'.$url  . $total_pages . '" data-page="' . $total_pages . '" title="Last">&raquo;</a></li>'; //last link
  }

  $pagination .= '</ul>
     </div>';
 }
 echo $pagination;

if(isset($isAjax)){ ?><div id="pagination"> <?php }
// echo $this->element('pagination3');
if(isset($isAjax)){ ?> </div> <?php }
}else{ ?>
<div class="text-center">No record found</div>
<?php } ?>


<style type="text/css">
.clint_post.client_post1.mostcasino {
   background: #edecbf !important;
}
</style>