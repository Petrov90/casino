<?php use Cake\Core\Configure;
if (!empty($reviewList)){
	foreach($reviewList as $comments){ 
		echo $this->element('review_comments',['comments' => $comments,'reviewId' => $comments->review_id]);
	} 
} ?>