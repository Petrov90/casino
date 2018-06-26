<?php 

$paginator    =    $this->Paginator; ?>
<div class="Pagination_nav pagi-new">
	<ul>	
	<?php
		echo $paginator->prev(__('<i class="fa fa-caret-left"></i>', true),
			array(
				'id'=> 'p_prev',
				'tag'=> 'li',
				'escape'=>false
			),
			null,
			array(
				'class'=>'pagination',
				'escape'=>false,
			   'tag'=> 'li',
				'disabledTag'=>'a'
			)
		);
		echo $paginator->numbers(array(
		   'tag'=> 'li',
			'span'=>false,
			'currentClass' => 'pagination',
			'currentTag' => 'a',
			'separator' => false,
			'class' => "pagination"
			
		));    
		echo $paginator->next(__('<i class="fa fa-caret-right"></i>', true),
			array(
				'id'=> 'p_next',
				'tag'=> 'li',
				'escape'=>false
			),
			null,
			array(
				'class'=>'pagination',
				'escape'=>false,
			   'tag'=> 'li',
				'disabledTag'=>'a'
			)
		);
	?>
	</ul>
</div>