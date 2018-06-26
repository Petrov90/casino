<?php  use Cake\Core\Configure; 
$level	=	Configure::read('Level'); ?>


<style>

.proseBar span{max-width:100%}

</style>
<div class="pointbox">
  <span class="topSpam">Total Points</span>
  <div class="totalPoint"><span><?php echo $user_points = $loginData->user_points;?></span></div>
  <div class="pointRight">
	 <div class="block pointtag">
		<span class="pull-left">Current level</span>
		<span class="pull-right">Next level</span>
	 </div>
	 <div class="block pointBar">
		<div class="pull-left"><label><span><?php foreach($level as $key => $val){ if($user_points < $val){ echo $key-1; break; }  } ?></span></label></div>
		<?php $startPoint   = Configure::read('Level.'.($key-1)); ?>
		<?php $endPoint = Configure::read('Level.'.($key)); ?>
		<div class="proseBar"><span style="width:<?php $a= $user_points-$startPoint;$b = $endPoint-$startPoint;echo ($a/$b)*100; ?>%;"></span></div>
		<div class="pull-right"><label><span><?php echo $key; ?></span></label></div>
	 </div>
	 <div class="block gotopoint">
		<span><a href="javascript:void(0);"><?php echo $endPoint-$user_points; ?></a> points to go</span>
	 </div>
  </div>
</div>