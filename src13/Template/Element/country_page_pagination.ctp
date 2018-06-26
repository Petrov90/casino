<?php $paginator = $this->request->params['paging']['Casinos'];
/* pr( $this->request->query); */

$search	=	(isset($this->request->query['search']) && !empty($this->request->query['search'])) ? 'search='.$this->request->query['search'].'&' : '';
 $current_page =  $paginator['page'];
 $url = $url.'?'.$search.'page=';
 
 $total_pages = $paginator['pageCount'];
 
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
	$pagination .= '<li class="select" ><a class="select" href="'.$url . $current_page . ' "> ' . $current_page . '</a></li>';
  } elseif ($current_page == $total_pages) { //if it's the last active link
	$pagination .= '<li class="active"><a class="select" href="'.$url  . $current_page . ' "> ' . $current_page . '</a></li>';
  } else { //regular current link
	$pagination .= '<li class="active"><a class="select" href="'.$url  . $current_page . ' "> ' . $current_page . '</a></li>';
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
?>