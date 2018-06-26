<?php
foreach($allComments as $comments){  
	echo $this->element('question_comment',['comments' => $comments]);
 } ?>