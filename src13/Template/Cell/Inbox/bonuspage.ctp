<?php 
echo $this->Form->create('Promotion',['id' => 'pchec','url' => $this->Url->build(['plugin' => '','controller' => 'promotions','action' => 'promotionSearch'])]); ?>
<ul class="rightTabs">
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="active">Bonus Type</h3>
	 <div class="pptionsBoxIn side_bar_ptions">
		<ul>
			<?php foreach($allCatSideBar as $cat){ ?>
		   <li>
			  <div class="checbox">
				 <label>
				 <?php echo $this->Form->checkbox('categories.'.$cat->id,['class' => 'pr_che','id' => $cat->id]); ?>
				 <span></span> <?php echo !empty($cat->icon_title) ? $cat->icon_title : $cat->title; ?></label>
			  </div>
		   </li>
			<?php } ?>
		</ul>
	 </div>
  </div>
</li>
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="active">Games</h3>
	 <div class="pptionsBoxIn side_bar_ptions">
		<ul><?php foreach($gambling_options as $cat){ ?>
		   <li><div class="checbox"><label><?php echo $this->Form->checkbox('gambling_options.'.$cat->id,['class' => 'pr_che']); ?><span></span><?php echo $cat->name; ?></label>
			  </div>
		   </li>
			<?php } ?>
		</ul>
	 </div>
  </div>
</li>
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="active">Currencies</h3>
	 <div class="pptionsBoxIn side_bar_ptions">
		<ul>
			<?php foreach($currencies as $cat){ ?>
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
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="">Software</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($software as $cat){ ?>
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
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="">Allowed Countries</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($country as $cat){ ?>
		   <li>
			  <div class="checbox">
				 <label>
				 <?php echo $this->Form->checkbox('allowed_country.'.$cat->id,['class' => 'pr_che']); ?>
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
	 <h3 class="">Devices</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($devices as $cat){ ?>
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
<li>
  <div class="pptionsBox side_bar_post">
	 <h3>Deposit Methods</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($depositMethods as $cat){ ?>
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
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="">Withdrawal Methods</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($withdrawalMethods as $cat){ ?>
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
<li>
  <div class="pptionsBox side_bar_post counting_in">
	 <h3 class="">Payout Speed</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<div id="slider-range"  class="payout_percentages"></div>
		<span id="p_min_html"  class="p_min_html2"></span><span id="p_max_html" class="p_min_html3"></span>
		 <?php echo $this->Form->hidden('p_min',['id' => 'p_min']); ?>
		 <?php echo $this->Form->hidden('p_max',['id' => 'p_max']); ?>
	 </div>
  </div>
</li>
<li>
  <div class="pptionsBox side_bar_post counting_in">
	 <h3 class="">Payout Percentage</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<div id="payout_percentages" class="payout_percentages"></div>
		<span id="payout_percentageh" class="p_min_html2"></span><span id="payout_percentageh_max" class="p_min_html3"></span>
		 <?php echo $this->Form->hidden('payout_percentage',['id' => 'payout_percentage']); ?>
		 <?php echo $this->Form->hidden('payout_percentage_max',['id' => 'payout_percentage_max']); ?>
	 </div>
  </div>
</li>
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="">Licencing Jurisdiction</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($licences as $cat){ ?>
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
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="">Language</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($language as $cat){ ?>
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
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="">Restricted Countries</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($country as $cat){ ?>
		   <li>
			  <div class="checbox">
				 <label>
				 <?php echo $this->Form->checkbox('restricted_country.'.$cat->id,['class' => 'pr_che']); ?>
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
	 <h3 class="">Established</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php for($i = (date('Y')-30) ; $i <= date('Y'); $i++){ ?>
		   <li>
			  <div class="checbox">
				 <label>
				 <?php echo $this->Form->checkbox('established.'.$i,['class' => 'pr_che']); ?>
				 <span></span> <?php echo $i; ?></label>
			  </div>
		   </li>
			<?php } ?>
		</ul>
	 </div>
  </div>
</li>
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="">Manual flushing</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($manual_flushing as $cat){ ?>
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
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="">Customer Service</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($live_chat as $cat){ ?>
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
<li>
  <div class="pptionsBox side_bar_post">
	 <h3 class="">Owner</h3>
	 <div class="pptionsBoxIn side_bar_ptions hide">
		<ul>
			<?php foreach($owner as $id =>  $owner){
		if(!empty($owner)){ ?>
		   <li>
			  <div class="checbox">
				 <label>
				 <?php echo $this->Form->checkbox('owner.'.base64_encode($owner),['class' => 'pr_che']); ?>
				 <span></span> <?php echo $owner; ?></label>
			  </div>
		   </li>
			<?php } 
			} ?>
		</ul>
	 </div>
  </div>
</li>
</ul>
<?php echo $this->Form->end(); ?>