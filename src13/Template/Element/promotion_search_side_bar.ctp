<?php echo $this->Form->create('Promotion',['id' => 'pchec','url' => $url]); ?>
<ul class="rightTabs">
   <li>
      <div class="pptionsBox side_bar_post">
         <h2 class="active">Bonus Type</h2>
         <div class="pptionsBoxIn side_bar_ptions">
            <ul>
				<?php foreach($allCatSideBar as $cat){ //pr($cat); ?>
               <li>
                  <div class="checbox">
                     <label>
                     <?php echo $this->Form->checkbox('categories.'.$cat->id,['class' => 'pr_che']); ?>
                     <span></span> <?php echo $cat->title; ?></label>
                  </div>
               </li>
				<?php } ?>
            </ul>
         </div>
      </div>
   </li>
   <li>
      <div class="pptionsBox side_bar_post">
         <h2 class="active">Devices</h2>
         <div class="pptionsBoxIn side_bar_ptions">
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
         <h2>Deposit Methods</h2>
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
         <h2 class="">Language</h2>
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
         <h2 class="">Withdrawal Methods</h2>
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
      <div class="pptionsBox side_bar_post">
         <h2 class="">Currencies</h2>
         <div class="pptionsBoxIn side_bar_ptions hide">
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
         <h2 class="">Withdrawal limit</h2>
         <div class="pptionsBoxIn side_bar_ptions hide">
            <ul>
				<?php foreach($WithdrawalLimit as $cat){ ?>
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
<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>
	$(".pr_che").change(function(){
		 /* if($(this).is(":checked")) { */
			 form_id	=	'pchec';
			 $(".data_div").html('<div class="text-center"><img src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>');
			var options = {
				type: 'post',
				success:function(r){					
					data		=	JSON.parse(r) ;
					$(".data_div").html(data.data);
						$('.readonly').raty({
						readOnly : true,
						score: function() {
							return $(this).attr('data-score');
						}
					});
				},
				resetForm:false
			}; 
			$("form#"+form_id).ajaxSubmit(options);			
        /* } */
	}); 
 $(".side_bar_post > h2").click(function(){
	 var class1	=	$(this).attr('class');
	 if(class1=='active'){
		$(this).next('.side_bar_ptions').addClass('hide');
		$(this).removeClass('active');
	 }else{
		$(this).next('.side_bar_ptions').removeClass('hide');
		$(this).addClass('active');		 
	 }
 });
 
<?php $this->Html->scriptEnd(); ?>
