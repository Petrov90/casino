<?php echo $this->Form->create('Casino',['id' => 'pchec','url' => $this->Url->build(array('controller' => 'casinos','action' => 'ccsr'))]); ?>
<ul class="rightTabs">
<li>
  <div class="pptionsBox side_bar_post side_bar_post1">
	 <h2 class="active">Gambling Options</h2>
	 <div class="pptionsBoxIn side_bar_ptions">
		<ul>
			<?php foreach($gamblingOptions as $cat){ ?>
		   <li>
			  <div class="checbox">
				 <label><?php echo $this->Form->checkbox($cat->type.'.'.$cat->id,['class' => 'pr_che']); ?>
				 <span></span> <?php echo $cat->name; ?></label>
			  </div>
		   </li>
			<?php } ?>
		</ul>
	 </div>
  </div>
</li>
<li>
  <div class="pptionsBox side_bar_post">
	 <h2 class="active">User Evaluation</h2>
	 <div class="pptionsBoxIn side_bar_ptions">
		 <ul>
			<?php for($i = 5; $i >= 1; $i--){; ?>
			<li>
			   <div class="checbox">
				  <label>
				  <input name="rating[<?php echo $i; ?>]" type="checkbox" class="pr_che"  value="<?php echo $i; ?>"/>
				  <span></span><samp><?php for($k = 1; $k <= $i; $k++){ ?><i class="fa fa-star"></i><?php } ?></samp>
				 </label>
				 </div>
			</li>
			<?php } ?>
		 </ul>
	 </div>
  </div>
</li>
<li>
  <div class="pptionsBox side_bar_post">
	 <h2 class="active">Amenities</h2>
	 <div class="pptionsBoxIn side_bar_ptions">
		<ul>
			<?php foreach($amenities as $cat){ ?>
		   <li>
			  <div class="checbox">
				 <label>
				 <?php echo $this->Form->checkbox($cat->type.'.'.$cat->id,['class' => 'pr_che']); ?>
				 <span></span> <?php echo $cat->name; ?></label>
			  </div>
		   </li>
			<?php } ?>
		</ul>
	 </div>
  </div>
</li>
</ul>
<?php echo $this->Form->end(); ?>