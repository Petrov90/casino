<?php use Cake\Core\Configure; ?>
  <div class="withmessage">
	 <h2><?php echo $messageDetails->sender->full_name; ?></h2>
	 <a href=""><?php echo $messageDetails->sender->email; ?></a>
  </div>
  <div class="messageVBox">
	<?php echo $messageDetails->message; ?>
  </div>


