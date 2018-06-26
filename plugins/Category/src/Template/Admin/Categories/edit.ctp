<?php echo $this->Html->script(array(

	WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js'),

	array('block' =>'bottom')); ?>

<div id="page-wrapper" style="min-height: 140px;">

<div class="row">

		<?php echo $this->Flash->render(); ?>

	</div>

	<div class="row">

		<div class="col-lg-6">

			<h1 class="page-header"><?php 

			if($bonus == 'bonus'){

				echo $blockPage->title;

			}else{

				echo __('Update '.$heading);

			} ?></h1>

		</div>

		<div class="col-lg-6">

			<?php if($bonus != 'bonus') echo $this->Html->link('Back',array('action' => 'index', $type),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>

		</div>

		<!-- /.col-lg-12 -->

	</div>

	<div class="panel-body">	

		<ul class="nav nav-tabs">

			<?php foreach($lanagauageList as $lanagauage){ ?>

				<li class="<?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?> "><a data-toggle="tab" href="#<?php echo $lanagauage->code; ?>_div" aria-expanded="true"><?php echo $lanagauage->name; ?></a></li>

			<?php } ?>

		</ul>

		<?php echo $this->Form->create($blockPage,array('role' => 'form','type' => 'file')); ?>

		<div class="tab-content">

		<?php if($type == 'countries'){ ?>

			<div class="col-lg-12">

				<div class="form-group"><br/>

					<label>Select Country</label>

					<?php echo $this->Form->select("country_id",$country,array('class' => 'form-control'));

					echo $this->Form->error("country_id"); ?>

				</div>

			</div>



			<div class="col-lg-12">

				<div class="form-group">

					<label>Url</label>

					<?php echo $this->Form->text("slug",array('class' => 'form-control','id' => 'c_title1'));

					echo $this->Form->error("slug"); ?>

				</div>

			</div>

		<?php } if($type == 'countries' || $type == 'online_casino' || $type == 'bonus_type' || $id == 48 || $id == 74){ 



			$class = ($type == 'bonus_type' && empty($blockPage->icon_title)) ? 'hide' : 'show';

			?>

			<div class="col-lg-12 <?php echo $class; ?>">

				<div class="form-group">

					<label>Page Title</label>

					<?php echo $this->Form->text("page_title",array('class' => 'form-control'));

					echo $this->Form->error("page_title"); ?>

				</div>

			</div>

			<div class="col-lg-12 <?php echo $class; ?>">

				<div class="form-group">

					<label>Meta Description</label>

					<?php echo $this->Form->textarea("meta_description",array('class' => 'form-control'));

					echo $this->Form->error("meta_description"); ?>

				</div>

			</div>	

		<?php  } 

		foreach($lanagauageList as $lanagauage){

			$code		=	$lanagauage->code;

			$required	=	 ($lanagauage->is_default == 1) ? 'false' : '' ;?>

			<div id="<?php echo $lanagauage->code; ?>_div" class="tab-pane <?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?>">

				<div class="col-lg-12">

					<h2><?php echo 'Data in '.$lanagauage->name; ?></h2>

					<div class="form-group">

						<label>Title</label>

						<?php 	echo $this->Form->text('_translations.'.$code.".title",array('class' => 'form-control c_title','placesholder' => 'Title','required' => $required,'autocomplete' => 'off'));



						echo ($lanagauage->is_default == 1) ? $this->Form->error("title") : ''; ?>

					</div>

					<div class="form-group">



						<label>City Title</label>

						<?php echo $this->Form->text('_translations.'.$code.".city_title",array('class' => 'form-control','value' => $blockPage->city_title));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("city_title") : ''; ?>

					</div>
					<div class="form-group">



						<label>Online gambling title</label>

						<?php echo $this->Form->text('_translations.'.$code.".online_gambling_title",array('class' => 'form-control','value' => $blockPage->online_gambling_title));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("online_gambling_title") : ''; ?>

					</div>
					
					<div class="form-group">



						<label>Most Casinos</label>

						<?php echo $this->Form->text('_translations.'.$code.".most_casino",array('class' => 'form-control','value' => $blockPage->most_casino));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("most_casino") : ''; ?>

					</div>
					

					

			<?php if($blockPage->type == 'double_with_image'){ ?>

					<div class="form-group">

						<label>

								Head First Block

						</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".head_first_block",array('class' => 'form-control','placeholdder' => '	head_first_block','id' =>$code.'head_first_block','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>head_first_block',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("head_first_block") : ''; ?>

					</div>



					<div class="form-group">

						<label>

								Head Second Block

						</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".head_second_block",array('class' => 'form-control','placeholdder' => '	head_second_block','id' =>$code.'head_second_block','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>head_second_block',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("head_second_block") : ''; ?>

					</div>

					<br>

					<hr style="height:1px; border:none; color:#000; background-color:#000;">

					<div class="form-group">



						<label>Sub Title</label>

						<?php echo $this->Form->text('_translations.'.$code.".sub_title",array('class' => 'form-control','placesholder' => 'Sub Title','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("sub_title") : ''; ?>

					</div>



					<div class="form-group">

						<label>

						<label>		

							Sub Short Description

						</label>

							

						</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".sub_title_description",array('class' => 'form-control','placeholdder' => 'Sub title Description','id' =>$code.'sub_title_description','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>sub_title_description',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("sub_title_description") : ''; ?>

					</div>







				<hr style="height:1px; border:none; color:#000; background-color:#000;">

	

					<div class="form-group">

						<label>Middle Title</label>

						<?php echo $this->Form->text('_translations.'.$code.".middle_title",array('class' => 'form-control','placesholder' => 'Middle Title','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("middle_title") : ''; ?>

					</div>



					<div class="form-group">

						<label>

							Middle Short Description

						</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".middle_title_description",array('class' => 'form-control','placeholdder' => 'middle_title_description','id' =>$code.'middle_title_description','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>middle_title_description',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("middle_title_description") : ''; ?>

					</div>



					<hr style="height:1px; border:none; color:#000; background-color:#000;">

					<?php if($bonus != 'bonus' && $type != 'countries'){ ?>

					<div class="form-group">

						<label>Icon Title</label>

						<?php echo $this->Form->text('_translations.'.$code.".icon_title",array('class' => 'form-control','placesholder' => 'Icon Title','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("sub_title") : ''; ?>

					</div>

					<?php } ?>

					<div class="form-group">

						<label>Footer Title</label>

						<?php echo $this->Form->text('_translations.'.$code.".footer_main_title",array('class' => 'form-control','placesholder' => 'Icon Title','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("footer_main_title") : ''; ?>

					</div>

					<div class="form-group">

						<label>First Short Description</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".description",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'body','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>body',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("description") : ''; ?>

					</div>

					<div class="form-group">

							<label>

								Long Description 		

							</label>

							</label>

							<?php  echo $this->Form->textarea('_translations.'.$code.".second_description",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'second_description','required' => $required));

							$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

								CKEDITOR.replace( '<?php echo $code;?>second_description',

								{} );

							<?php $this->Html->scriptEnd(); 

							echo ($lanagauage->is_default == 1) ? $this->Form->error("second_description") : ''; ?>

						</div>

						<?php if($type == 'countries'){ ?>

					<hr style="height:1px; border:none; color:#000; background-color:#000;">

					<div class="form-group">

						<label>Preview title</label>

						<?php  echo $this->Form->text('_translations.'.$code.".preview_title",array('class' => 'form-control','placeholdder' => 'Description','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("preview_title") : ''; ?>

					</div>

					<div class="form-group">

						<label>Preview url title</label>

						<?php  echo $this->Form->text('_translations.'.$code.".preview_url_title",array('class' => 'form-control','placeholdder' => 'Description','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("preview_url_title") : ''; ?>

					</div>

					<div class="form-group">

						<label>Short Preview text</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".preview_text",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'preview_text','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>preview_text',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("preview_text") : ''; ?>

					</div>

					<?php } ?>

					<?php } ?>

				</div>

			</div>

	<?php } ?>



	<br>

	<div class="col-lg-12">
	<?php if($blockPage->id == '74'){ ?>
		<div class="form-group">

			<label>Faq Title</label>

			<?php echo $this->Form->text("faq_mn_title",array('class' => 'form-control'));

			echo $this->Form->error("faq_mn_title"); ?>

			</div>
			<div class="form-group">

			<label>

			Faq Heading

			</label>

			<?php  echo $this->Form->textarea('faq_title',array('class' => 'form-control','placeholdder' => '','id' =>$code.'faq_title','required' => $required));

			$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

			CKEDITOR.replace( '<?php echo $code;?>faq_title',

			{} );

			<?php $this->Html->scriptEnd(); 

			echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_title") : ''; ?>

			</div>
			<?php
	}?>
	<?php if($blockPage->id == '48'){ ?>
		<div class="form-group">

			<label>Faq Title</label>

			<?php echo $this->Form->text("faq_mn_title",array('class' => 'form-control'));

			echo $this->Form->error("faq_mn_title"); ?>

			</div>
			<div class="form-group">

			<label>

			Faq Heading

			</label>

			<?php  echo $this->Form->textarea('faq_title',array('class' => 'form-control','placeholdder' => '','id' =>$code.'faq_title','required' => $required));

			$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

			CKEDITOR.replace( '<?php echo $code;?>faq_title',

			{} );

			<?php $this->Html->scriptEnd(); 

			echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_title") : ''; ?>

			</div>
			<?php
	}?>
	<?php if($blockPage->type == 'double_with_image' &&  $blockPage->id != '74'/*  && $bonus != 'bonus' || $blockPage->id == '46' || $blockPage->id == '48' */){ ?>
			<div class="form-group">
				<label>Head Image alt tag</label>
				<?php echo $this->Form->text("head_image_alt",array('class' => 'form-control'));
				echo $this->Form->error("head_image_alt"); ?>
			</div>
			<div class="col-lg-12">

			   <div class="form-group">

				  <label>Head Image</label>

				  <?php echo $this->Form->file("head_image",array('class' => 'form-contro','placesholder' => 'head_image','required' => false));

				echo $this->Form->error("head_image"); ?>

				  <?php

					

					 if(!empty($blockPage->head_image) && file_exists(GALLERY_ROOT_PATH.$blockPage->head_image)){

						echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$blockPage->head_image);

					 } ?>

			   </div>

			</div>

			<!-- new section staarts here-->
			<!--Best Casino -->
			<div class="form-group">
				<label>Best Casino Title</label>
				<?php echo $this->Form->text("best_casino_title",array('class' => 'form-control'));
				echo $this->Form->error("best_casino_title"); ?>
			</div>
			<?php if($blockPage->id == '48'){ ?>
				<div class="form-group">
					<label>Reviews</label>
						<?php echo $this->Form->text("best_casino_reviews",array('class' => 'form-control'));
						echo $this->Form->error("best_casino_reviews"); ?>
				</div>
				<div class="form-group">
					<label>Location</label>
						<?php echo $this->Form->text("best_casino_location",array('class' => 'form-control'));
						echo $this->Form->error("best_casino_location"); ?>
				</div>
				<div class="form-group">
					<label>Earnings</label>
						<?php echo $this->Form->text("best_casino_earnings",array('class' => 'form-control'));
						echo $this->Form->error("best_casino_earnings"); ?>
				</div>
				<div class="form-group">
					<label>Welcome Bonuses</label>
						<?php echo $this->Form->text("best_casino_bonuses",array('class' => 'form-control'));
						echo $this->Form->error("best_casino_bonuses"); ?>
				</div>
				<div class="form-group">
					<label>Payout Times</label>
						<?php echo $this->Form->text("best_casino_times",array('class' => 'form-control'));
						echo $this->Form->error("best_casino_times"); ?>
				</div>
			
			<?php
			}?>
			<div class="form-group">
				<label>	Best Casino Heading </label>

				<?php  echo $this->Form->textarea('best_casino_des',array('class' => 'form-control','placeholdder' => '','id' =>$code.'best_casino_des','required' => $required));
				$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
				CKEDITOR.replace( '<?php echo $code;?>best_casino_des',
				{} );
				<?php $this->Html->scriptEnd(); 
				echo ($lanagauage->is_default == 1) ? $this->Form->error("best_casino_des") : ''; ?>
			</div>


			<?php if($blockPage->id != '48'){ ?>

			<div class="form-group">

					<label>Faq Title</label>

					<?php echo $this->Form->text("faq_mn_title",array('class' => 'form-control'));

					echo $this->Form->error("faq_mn_title"); ?>

			</div>

            

            <!--<div class="form-group">

					<label>Alt Text</label>

					<?php echo $this->Form->text("faq_alt",array('class' => 'form-control'));

					echo $this->Form->error("faq_alt"); ?>

			</div>-->

            <div class="form-group">

				<label>

						Faq Heading

				</label>

				<?php  echo $this->Form->textarea('faq_title',array('class' => 'form-control','placeholdder' => '','id' =>$code.'faq_title','required' => $required));

				$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

					CKEDITOR.replace( '<?php echo $code;?>faq_title',

					{} );

				<?php $this->Html->scriptEnd(); 

				echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_title") : ''; ?>

			</div>
			<?php } ?>
		

			<!--<div class="form-group">

					<label>Faq First Question</label> 

					<?php echo $this->Form->text("faq_ques1",array('class' => 'form-control'));

					echo $this->Form->error("faq_ques1"); ?>

			</div>

		

			 <div class="form-group">

				<label>

						Faq First Description

				</label>

				<?php  echo $this->Form->textarea('faq_desc1',array('class' => 'form-control','placeholdder' => '','id' =>$code.'faq_desc1','required' => $required));

				$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

					CKEDITOR.replace( '<?php echo $code;?>faq_desc1',

					{} );

				<?php $this->Html->scriptEnd(); 

				echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_desc1") : ''; ?>

			</div>

			<div class="form-group">

					<label>Faq Second Question</label>

					<?php echo $this->Form->text("faq_ques2",array('class' => 'form-control'));

					echo $this->Form->error("faq_ques2"); ?>

			</div>

		

			<div class="form-group">

				<label>

						Faq Second Description

				</label>

				<?php  echo $this->Form->textarea('faq_desc2',array('class' => 'form-control','placeholdder' => '','id' =>$code.'faq_desc2','required' => $required));

				$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

					CKEDITOR.replace( '<?php echo $code;?>faq_desc2',

					{} );

				<?php $this->Html->scriptEnd(); 

				echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_desc2") : ''; ?>

			</div>						



			<div class="form-group">

					<label>Faq Third Question</label>

					<?php echo $this->Form->text("faq_ques3",array('class' => 'form-control'));

					echo $this->Form->error("faq_ques3"); ?>

			</div>

		

			<div class="form-group">

				<label>

						Faq Third Description

				</label>

				<?php  echo $this->Form->textarea('faq_desc3',array('class' => 'form-control','placeholdder' => '','id' =>$code.'faq_desc3','required' => $required));

				$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

					CKEDITOR.replace( '<?php echo $code;?>faq_desc3',

					{} );

				<?php $this->Html->scriptEnd(); 

				echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_desc3") : ''; ?>

			</div> -->

			

<!-- new section ends here-->



		<?php if($type != 'countries' && $blockPage->id != '46' && $blockPage->id != '48'){ ?>

			<div class="col-lg-12">

			   <div class="form-group">

				  <label>Icon Image</label>

				  <?php echo $this->Form->file("image",array('class' => 'form-contro','placesholder' => 'image','required' => false));

				echo $this->Form->error("image"); ?>

			

				  <?php

					 if(!empty($blockPage->image) && file_exists(GALLERY_ROOT_PATH.$blockPage->image)){

					 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$blockPage->image);

					 } ?>

			   </div>

			</div>

			<div class="col-lg-12">

			   <div class="form-group">

				  <label>Icon Hover Image</label>

				  

				<?php echo $this->Form->file("back_image",array('class' => 'form-contro','placesholder' => 'Back Image','required' => false));

				echo $this->Form->error("back_image"); ?>

				  <?php

					 if(!empty($blockPage->back_image) && file_exists(GALLERY_ROOT_PATH.$blockPage->back_image)){

					 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$blockPage->back_image);

					 } ?>

			   </div>

			</div>

	<?php } ?>



		<?php } ?>

			<?php if($type == 'countries'){ //pr($show_on_page); ?>

					<div class="form-group">

						<label>Show on these page</label>

						<?php echo $this->Form->select("show_on_page1",$show_on_page,array('default' => $def,'class' => 'form-control','multiple' => true,'required' => true));

						echo $this->Form->error("image"); ?>

					</div>

				<?php } ?>

				<!--Start  New changing (04/08/17) by kp shekhawat -->

				<div id="ddd">

				<?php

				if(isset($FaqQuestions1) && !empty($FaqQuestions1)){ 

					//echo "<pre>"; print_r($FaqQuestions1); die;

					$tt	=	json_decode($FaqQuestions);

					//pr($tt); 

					$a =0;

					foreach($FaqQuestions1 as $text){ ?>

					<!-- <div class="row">

						<div class="form-group">

							<label>Faq Question</label>

							<?php echo $this->Form->text("faq.faq_title[]",array('class' => 'form-control', 'required' => 'required','value' => $text['faq_title'])); ?>

                            <?php echo $this->Form->text("faq.faq_alt[]",array('class' => 'form-control', 'required' => 'required','value' => $text['faq_alt'])); ?>

						</div>

						<div class="form-group">

							<label>Faq Description</label>

							<?php  echo $this->Form->textarea('faq.faq_description[]',array('class' => 'form-control','placeholdder' => '','id' =>'faq_desc3','required' => 'required','value' => $text['faq_description']));?>

						</div>

						<div class="col-lg-2">

						<a href="javascript:void(0)" class="remove">Delete</a>

						</div>

					</div> -->

					<div class="row">

						<div class="form-group">

							<label>Faq Question</label>

							<?php echo $this->Form->text("faq.faq_title[]",array('class' => 'form-control', 'required' => 'required','value' => $text['faq_title'])); ?>

						</div>

                        

                        

                        <div class="form-group">

							<label>Alt Text</label>

							<?php echo $this->Form->text("faq.faq_alt[]",array('class' => 'form-control', 'required' => 'required','value' => $text['faq_alt'])); ?>

						</div>

					<div class="form-group">

						<label>Faq Description</label>

						<?php  echo $this->Form->textarea('faq.faq_description[]',array('class' => 'form-control','placeholdder' => '','id' =>$a.'faq_desc3','value' => $text['faq_description'],'required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $a;?>faq_desc3',

							{} );

							<?php $this->Html->scriptEnd(); 

							echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_description[]") : ''; ?>

					</div> 

					<div class="col-lg-2">

						<a href="javascript:void(0)" class="remove">Delete</a>

						</div>

					</div>

				<?php $a++; } 

			}?>

            

            

            <?php

			if(isset($GuideConntents) && !empty($GuideConntents)){ 

			

			$a =0;

			foreach($GuideConntents as $text){

			//print_r($GuideConntents);

			 ?>

		

			

				

					<div class="row">

						<div class="form-group">

							<label>Guide Title</label>

							<?php echo $this->Form->text("guide.guide_title[]",array('class' => 'form-control', 'required' => 'required','value' => $text['title'])); ?>

						</div>

                        

                        

                        <div class="form-group">

							<label>Alt Text</label>

							<?php echo $this->Form->text("guide.guide_alt[]",array('class' => 'form-control', 'required' => 'required','value' => $text['image_alt'])); ?>

						</div>

                        

                        

					<div class="form-group">

						<label>Description</label>

						<?php  echo $this->Form->textarea('guide.guide_first_block[]',array('class' => 'form-control','placeholdder' => '','id' =>$a.'guide_desc0','value' => $text['description'],'required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $a;?>guide_desc0',

							{} );

							<?php $this->Html->scriptEnd(); 

							echo ($lanagauage->is_default == 1) ? $this->Form->error("description[]") : ''; ?>

					</div> 

					

					

                    <div class="form-group">

						<label>Second Block</label>

						<?php  echo $this->Form->textarea('guide.guide_second_block[]',array('class' => 'form-control','placeholdder' => '','id' =>$a.'guide_desc1','value' => $text['second_description'],'required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $a;?>guide_desc1',

							{} );

							<?php $this->Html->scriptEnd(); 

							echo ($lanagauage->is_default == 1) ? $this->Form->error("second_description[]") : ''; ?>

					</div> 

                    

                    

                     <div class="form-group">

						<label>Description</label>

						<?php  echo $this->Form->textarea('guide.guide_description[]',array('class' => 'form-control','placeholdder' => '','id' =>$a.'guide_desc2','value' => $text['h1d'],'required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $a;?>guide_desc2',

							{} );

							<?php $this->Html->scriptEnd(); 

							echo ($lanagauage->is_default == 1) ? $this->Form->error("h1d[]") : ''; ?>

					</div> 

                    

                    

                     <div class="form-group">

						<label>Short Description For Featured Section</label>

						<?php  echo $this->Form->textarea('guide.guide_description_feature[]',array('class' => 'form-control','placeholdder' => '','id' =>$a.'guide_desc3','value' => $text['sdescription'],'required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $a;?>guide_desc3',

							{} );

							<?php $this->Html->scriptEnd(); 

							echo ($lanagauage->is_default == 1) ? $this->Form->error("sdescription[]") : ''; ?>

					</div> 

					

                <div class="form-group imagess">

                    <label>White Image</label>

                    <?php echo $this->Form->file("guide.image1[]",array('class' => 'form-contro','placeholder' => 'Title','' => false));

                    echo $this->Form->error("image"); ?><?php 

									if(file_exists(GALLERY_ROOT_PATH.$text['image'])){

										echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$text['image']);

										

									} ?>

									<style>

									.imagess img {background-color:#f1f1f1;}

									

									</style>

									<input type="hidden" name="guide[image1_guides][]" value="<?=$text['image']?>" >

					

                </div>

				<div class="form-group">

                    <label>Black Image</label>

                    <?php echo $this->Form->file("guide.image2[]",array('class' => 'form-contro','placeholder' => 'Title','' => false));

                    echo $this->Form->error("image2"); ?><?php 

									if(file_exists(GALLERY_ROOT_PATH.$text['image2'])){

										echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$text['image2']);

									} ?>

									

									<input type="hidden" name="guide[image2_guides][]" value="<?=$text['image2']?>" >

					

                </div>

                    	 <div class="col-lg-2">

						<a href="javascript:void(0)" class="remove">Delete</a>

						</div>

					

					<?php $a++;

			} }

			

			?>

				<span style="color:red" id="errrr"></span>

			</div>

			

		</div>

        

        

        <label>Faq Question <a href="javascript:void(0);" class="addd">Add more</a> </label><br>

            <label>Guide content <a href="javascript:void(0);" class="addd_guide_content" id="addd_guide_content">Add more</a> </label><br>

			<!--End  New changing (04/08/17) by kp shekhawat -->



			<button class="btn btn-default" type="submit">Save</button>

			<button class="btn btn-default" type="reset">Reset</button>

		</div>

		<?php echo $this->Form->end(); ?>

	</div>

</div>

<?php if($type == 'countries'){ ?>

<?php  

 $this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>



 var slug = function(str) {

    var $slug = '';

    var trimmed = $.trim(str);

    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').

    replace(/-+/g, '-').

    replace(/^-|-$/g, '');

    return $slug.toLowerCase();

}

$(".c_title").keyup(function(){

	$('#c_title').removeClass('hide');	

	$('#c_title1').val(slug($(this).val()));	

});

<?php $this->Html->scriptEnd(); 

} ?>

<?php 



 

$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>





$(function () {	

$("#addd_guide_content").click(function(){

alert();

});





	$(".addd").click(function(){ 

		var len 	=	$("#ddd .row").size(); alert(len);

		$("#ddd").append("<div class='row'><div class='form-group'><label>Faq Question</label><input name='faq[faq_title][]' class='form-control' required='required' type='text'></div><?php echo $this->Html->script(array(

	WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js'),

	array('block' =>'bottom')); ?>

<div id="page-wrapper" style="min-height: 140px;">

<div class="row">

		<?php echo $this->Flash->render(); ?>

	</div>

	<div class="row">

		<div class="col-lg-6">

			<h1 class="page-header"><?php 

			if($bonus == 'bonus'){

				echo $blockPage->title;

			}else{

				echo __('Update '.$heading);

			} ?></h1>

		</div>

		<div class="col-lg-6">

			<?php if($bonus != 'bonus') echo $this->Html->link('Back',array('action' => 'index', $type),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>

		</div>

		<!-- /.col-lg-12 -->

	</div>

	<div class="panel-body">	

		<ul class="nav nav-tabs">

			<?php foreach($lanagauageList as $lanagauage){ ?>

				<li class="<?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?> "><a data-toggle="tab" href="#<?php echo $lanagauage->code; ?>_div" aria-expanded="true"><?php echo $lanagauage->name; ?></a></li>

			<?php } ?>

		</ul>

		<?php echo $this->Form->create($blockPage,array('role' => 'form','type' => 'file')); ?>

		<div class="tab-content">

		<?php if($type == 'countries'){ ?>

			<div class="col-lg-12">

				<div class="form-group"><br/>

					<label>Select Country</label>

					<?php echo $this->Form->select("country_id",$country,array('class' => 'form-control'));

					echo $this->Form->error("country_id"); ?>

				</div>

			</div>



			<div class="col-lg-12">

				<div class="form-group">

					<label>Url</label>

					<?php echo $this->Form->text("slug",array('class' => 'form-control','id' => 'c_title1'));

					echo $this->Form->error("slug"); ?>

				</div>

			</div>

		<?php } if($type == 'countries' || $type == 'online_casino' || $type == 'bonus_type' || $id == 48 || $id == 74){ 



			$class = ($type == 'bonus_type' && empty($blockPage->icon_title)) ? 'hide' : 'show';

			?>

			<div class="col-lg-12 <?php echo $class; ?>">

				<div class="form-group">

					<label>Page Title</label>

					<?php echo $this->Form->text("page_title",array('class' => 'form-control'));

					echo $this->Form->error("page_title"); ?>

				</div>

			</div>

			<div class="col-lg-12 <?php echo $class; ?>">

				<div class="form-group">

					<label>Meta Description</label>

					<?php echo $this->Form->textarea("meta_description",array('class' => 'form-control'));

					echo $this->Form->error("meta_description"); ?>

				</div>

			</div>	

		<?php  } 

		foreach($lanagauageList as $lanagauage){

			$code		=	$lanagauage->code;

			$required	=	 ($lanagauage->is_default == 1) ? 'false' : '' ;?>

			<div id="<?php echo $lanagauage->code; ?>_div" class="tab-pane <?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?>">

				<div class="col-lg-12">

					<h2><?php echo 'Data in '.$lanagauage->name; ?></h2>

					<div class="form-group">

						<label>Title</label>

						<?php 	echo $this->Form->text('_translations.'.$code.".title",array('class' => 'form-control c_title','placesholder' => 'Title','required' => $required,'autocomplete' => 'off'));



						echo ($lanagauage->is_default == 1) ? $this->Form->error("title") : ''; ?>

					</div>

			<?php if($blockPage->type == 'double_with_image'){ ?>

					<div class="form-group">

						<label>

								Head First Block

						</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".head_first_block",array('class' => 'form-control','placeholdder' => '	head_first_block','id' =>$code.'head_first_block','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>head_first_block',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("head_first_block") : ''; ?>

					</div>



					<div class="form-group">

						<label>

								Head Second Block

						</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".head_second_block",array('class' => 'form-control','placeholdder' => '	head_second_block','id' =>$code.'head_second_block','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>head_second_block',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("head_second_block") : ''; ?>

					</div>

					<br>

					<hr style="height:1px; border:none; color:#000; background-color:#000;">

					<div class="form-group">





						<label>Sub Title</label>

						<?php echo $this->Form->text('_translations.'.$code.".sub_title",array('class' => 'form-control','placesholder' => 'Sub Title','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("sub_title") : ''; ?>

					</div>



					<div class="form-group">

						<label>

						<label>		

							Sub Short Description

						</label>

							

						</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".sub_title_description",array('class' => 'form-control','placeholdder' => 'Sub title Description','id' =>$code.'sub_title_description','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>sub_title_description',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("sub_title_description") : ''; ?>

					</div>







				<hr style="height:1px; border:none; color:#000; background-color:#000;">

	

					<div class="form-group">

						<label>Middle Title</label>

						<?php echo $this->Form->text('_translations.'.$code.".middle_title",array('class' => 'form-control','placesholder' => 'Middle Title','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("middle_title") : ''; ?>

					</div>



					<div class="form-group">

						<label>

							Middle Short Description

						</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".middle_title_description",array('class' => 'form-control','placeholdder' => 'middle_title_description','id' =>$code.'middle_title_description','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>middle_title_description',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("middle_title_description") : ''; ?>

					</div>



					<hr style="height:1px; border:none; color:#000; background-color:#000;">

					<?php if($bonus != 'bonus' && $type != 'countries'){ ?>

					<div class="form-group">

						<label>Icon Title</label>

						<?php echo $this->Form->text('_translations.'.$code.".icon_title",array('class' => 'form-control','placesholder' => 'Icon Title','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("sub_title") : ''; ?>

					</div>

					<?php } ?>

					<div class="form-group">

						<label>Footer Title</label>

						<?php echo $this->Form->text('_translations.'.$code.".footer_main_title",array('class' => 'form-control','placesholder' => 'Icon Title','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("footer_main_title") : ''; ?>

					</div>

					<div class="form-group">

						<label>First Short Description</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".description",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'body','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>body',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("description") : ''; ?>

					</div>

					<div class="form-group">

							<label>

								Long Description 		

							</label>

							</label>

							<?php  echo $this->Form->textarea('_translations.'.$code.".second_description",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'second_description','required' => $required));

							$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

								CKEDITOR.replace( '<?php echo $code;?>second_description',

								{} );

							<?php $this->Html->scriptEnd(); 

							echo ($lanagauage->is_default == 1) ? $this->Form->error("second_description") : ''; ?>

						</div>

						<?php if($type == 'countries'){ ?>

					<hr style="height:1px; border:none; color:#000; background-color:#000;">

					<div class="form-group">

						<label>Preview title</label>

						<?php  echo $this->Form->text('_translations.'.$code.".preview_title",array('class' => 'form-control','placeholdder' => 'Description','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("preview_title") : ''; ?>

					</div>

					<div class="form-group">

						<label>Preview url title</label>

						<?php  echo $this->Form->text('_translations.'.$code.".preview_url_title",array('class' => 'form-control','placeholdder' => 'Description','required' => $required));

						echo ($lanagauage->is_default == 1) ? $this->Form->error("preview_url_title") : ''; ?>

					</div>

					<div class="form-group">

						<label>Short Preview text</label>

						<?php  echo $this->Form->textarea('_translations.'.$code.".preview_text",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'preview_text','required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $code;?>preview_text',

							{} );

						<?php $this->Html->scriptEnd(); 

						echo ($lanagauage->is_default == 1) ? $this->Form->error("preview_text") : ''; ?>

					</div>

					<?php } ?>

					<?php } ?>

				</div>

			</div>

	<?php } ?>



	<br>

	<div class="col-lg-12">
	
	<?php if($blockPage->type == 'double_with_image' &&  $blockPage->id != '74'/*  && $bonus != 'bonus' || $blockPage->id == '46' || $blockPage->id == '48' */){ ?>

			<div class="col-lg-12">

			   <div class="form-group">

				  <label>Head Image</label>

				  <?php echo $this->Form->file("head_image",array('class' => 'form-contro','placesholder' => 'head_image','required' => false));

				echo $this->Form->error("head_image"); ?>

				  <?php

					

					 if(!empty($blockPage->head_image) && file_exists(GALLERY_ROOT_PATH.$blockPage->head_image)){

						echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$blockPage->head_image);

					 } ?>

			   </div>

			</div>

			<!-- new section staarts here-->

			
			<div class="form-group">

					<label>Faq Title</label>

					<?php echo $this->Form->text("faq_mn_title",array('class' => 'form-control'));

					echo $this->Form->error("faq_mn_title"); ?>

			</div>

            

            <!--<div class="form-group">

					<label>Alt Text</label>

					<?php echo $this->Form->text("faq_alt",array('class' => 'form-control'));

					echo $this->Form->error("faq_alt"); ?>

			</div>-->

            <div class="form-group">

				<label>

						Faq Heading

				</label>

				<?php  echo $this->Form->textarea('faq_title',array('class' => 'form-control','placeholdder' => '','id' =>$code.'faq_title','required' => $required));

				$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

					CKEDITOR.replace( '<?php echo $code;?>faq_title',

					{} );

				<?php $this->Html->scriptEnd(); 

				echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_title") : ''; ?>

			</div>

		

			<!--<div class="form-group">

					<label>Faq First Question</label> 

					<?php echo $this->Form->text("faq_ques1",array('class' => 'form-control'));

					echo $this->Form->error("faq_ques1"); ?>

			</div>

		

			 <div class="form-group">

				<label>

						Faq First Description

				</label>

				<?php  echo $this->Form->textarea('faq_desc1',array('class' => 'form-control','placeholdder' => '','id' =>$code.'faq_desc1','required' => $required));

				$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

					CKEDITOR.replace( '<?php echo $code;?>faq_desc1',

					{} );

				<?php $this->Html->scriptEnd(); 

				echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_desc1") : ''; ?>

			</div>

			<div class="form-group">

					<label>Faq Second Question</label>

					<?php echo $this->Form->text("faq_ques2",array('class' => 'form-control'));

					echo $this->Form->error("faq_ques2"); ?>

			</div>

		

			<div class="form-group">

				<label>

						Faq Second Description

				</label>

				<?php  echo $this->Form->textarea('faq_desc2',array('class' => 'form-control','placeholdder' => '','id' =>$code.'faq_desc2','required' => $required));

				$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

					CKEDITOR.replace( '<?php echo $code;?>faq_desc2',

					{} );

				<?php $this->Html->scriptEnd(); 

				echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_desc2") : ''; ?>

			</div>						



			<div class="form-group">

					<label>Faq Third Question</label>

					<?php echo $this->Form->text("faq_ques3",array('class' => 'form-control'));

					echo $this->Form->error("faq_ques3"); ?>

			</div>

		

			<div class="form-group">

				<label>

						Faq Third Description

				</label>

				<?php  echo $this->Form->textarea('faq_desc3',array('class' => 'form-control','placeholdder' => '','id' =>$code.'faq_desc3','required' => $required));

				$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

					CKEDITOR.replace( '<?php echo $code;?>faq_desc3',

					{} );

				<?php $this->Html->scriptEnd(); 

				echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_desc3") : ''; ?>

			</div> -->

			

<!-- new section ends here-->



		<?php if($type != 'countries' && $blockPage->id != '46' && $blockPage->id != '48'){ ?>

			<div class="col-lg-12">

			   <div class="form-group">

				  <label>Icon Image</label>

				  <?php echo $this->Form->file("image",array('class' => 'form-contro','placesholder' => 'image','required' => false));

				echo $this->Form->error("image"); ?>

			

				  <?php

					 if(!empty($blockPage->image) && file_exists(GALLERY_ROOT_PATH.$blockPage->image)){

					 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$blockPage->image);

					 } ?>

			   </div>

			</div>

			<div class="col-lg-12">

			   <div class="form-group">

				  <label>Icon Hover Image</label>

				  

				<?php echo $this->Form->file("back_image",array('class' => 'form-contro','placesholder' => 'Back Image','required' => false));

				echo $this->Form->error("back_image"); ?>

				  <?php

					 if(!empty($blockPage->back_image) && file_exists(GALLERY_ROOT_PATH.$blockPage->back_image)){

					 echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$blockPage->back_image);

					 } ?>

			   </div>

			</div>

	<?php } ?>



		<?php } ?>

			<?php if($type == 'countries'){ //pr($show_on_page); ?>

					<div class="form-group">

						<label>Show on these page</label>

						<?php echo $this->Form->select("show_on_page1",$show_on_page,array('default' => $def,'class' => 'form-control','multiple' => true,'required' => true));

						echo $this->Form->error("image"); ?>

					</div>

				<?php } ?>

				<!--Start  New changing (04/08/17) by kp shekhawat -->

				<!--<div id="ddd">

				<?php

				if(isset($FaqQuestions1) && !empty($FaqQuestions1)){ 

					//echo "<pre>"; print_r($FaqQuestions1); die;

					$tt	=	json_decode($FaqQuestions);

					//pr($tt); 

					$a =0;

					foreach($FaqQuestions1 as $text){ ?>

					 <div class="row">

						<div class="form-group">

							<label>Faq Question</label>

							<?php echo $this->Form->text("faq.faq_title[]",array('class' => 'form-control', 'required' => 'required','value' => $text['faq_title'])); ?>

                            

                            	<?php echo $this->Form->text("faq.faq_alt[]",array('class' => 'form-control', 'required' => 'required','value' => $text['faq_alt'])); ?>

						</div>

						<div class="form-group">

							<label>Faq Description</label>

							<?php  echo $this->Form->textarea('faq.faq_description[]',array('class' => 'form-control','placeholdder' => '','id' =>'faq_desc3','required' => 'required','value' => $text['faq_description']));?>

						</div>

						<div class="col-lg-2">

						<a href="javascript:void(0)" class="remove">Delete</a>

						</div>

					</div> 

					<div class="row">

						<div class="form-group">

							<label>Faq Question</label>

							<?php echo $this->Form->text("faq.faq_title[]",array('class' => 'form-control', 'required' => 'required','value' => $text['faq_title'])); ?>

						</div>

                        <div class="form-group">

							<label>Alt Text</label>

							<?php echo $this->Form->text("faq.faq_alt[]",array('class' => 'form-control', 'required' => 'required','value' => $text['faq_alt'])); ?>

						</div>

                        

					<div class="form-group">

						<label>Faq Description</label>

						<?php  echo $this->Form->textarea('faq.faq_description[]',array('class' => 'form-control','placeholdder' => '','id' =>$a.'faq_desc3','value' => $text['faq_description'],'required' => $required));

						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

							CKEDITOR.replace( '<?php echo $a;?>faq_desc3',

							{} );

							<?php $this->Html->scriptEnd(); 

							echo ($lanagauage->is_default == 1) ? $this->Form->error("faq_description[]") : ''; ?>

					</div> 

					<div class="col-lg-2">

						<a href="javascript:void(0)" class="remove">Delete</a>

						</div>

					</div>

				<?php $a++; } 

			}?>

				<span style="color:red" id="errrr"></span>

			</div>-->

			<label>Faq Question <a href="javascript:void(0);" class="addd">Add more</a> </label><br>

         <!-- <br />  Guide Content <a href="javascript:void(0);" class="addd_guide_content">Add more</a><br>-->

			<!--End  New changing (04/08/17) by kp shekhawat -->



			<button class="btn btn-default" type="submit">Save</button>

			<button class="btn btn-default" type="reset">Reset</button>

		</div>

		</div>

		<?php echo $this->Form->end(); ?>

	</div>

</div>

<?php if($type == 'countries'){ ?>

<?php  

 $this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>



 var slug = function(str) {

    var $slug = '';

    var trimmed = $.trim(str);

    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').

    replace(/-+/g, '-').

    replace(/^-|-$/g, '');

    return $slug.toLowerCase();

}

$(".c_title").keyup(function(){

	$('#c_title').removeClass('hide');	

	$('#c_title1').val(slug($(this).val()));	

});

<?php $this->Html->scriptEnd(); 

} ?>

<?php  

$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>

$(function () {	





$("#addd_guide_content").click(function(){

	var len 	=	$("#ddd .row .content").size(); 

		$("#ddd").append("<div class='row content'><div class='form-group'><label>Guide Title</label><input name='guide[guide_title][]' class='form-control' placeholder='title' required='required' type='text'></div><div class='form-group'><label>Alt Text</label><input placeholder='Alt Text' name='guide[guide_alt][]' class='form-control' required='required' type='text'></div><div class='form-group'><label>Description</label><textarea id= '"+len+"9faq_desc3_guide_0' class='form-control' name='guide[guide_first_block][]' placeholdder='' required='required' rows='5'></textarea></div><div class='form-group'><label>Second Block</label><textarea id= '"+len+"9faq_desc3_guide_1' class='form-control' name='guide[guide_second_block][]' placeholdder='' required='required' rows='5'></textarea></div><div class='form-group'><label>Description</label><textarea id= '"+len+"9faq_desc3_guide_2' class='form-control' name='guide[guide_description][]' placeholdder='' required='required' rows='5'></textarea></div><div class='form-group'><label>Short Description For Featured Section</label><textarea id= '"+len+"9faq_desc3_guide_3' class='form-control' name='guide[guide_description_feature][]' placeholdder='' required='required' rows='5'></textarea></div><div class='form-group'><label>White Image</label><input name='guide[image1][]' class='form-control'  type='file'><input type='hidden' name='guide[image1_guides][]' value=''><input type='hidden' name='guide[image2_guides][]' value=''></div><div class='form-group'><label>Black Image</label><input name='guide[image2][]' class='form-control'  type='file'></div><div class='col-lg-2'><a href='javascript:void(0)' class='remove'>Delete</a></div></div>");

		



CKEDITOR.replace( len+'9faq_desc3_guide_0',

	

	

{} );	



CKEDITOR.replace( len+'9faq_desc3_guide_1',

	

	

{} );	



CKEDITOR.replace( len+'9faq_desc3_guide_2',

	

	

{} );	



CKEDITOR.replace( len+'9faq_desc3_guide_3',

	

	

{} );	







});





	$(".addd").click(function(){ 

		var len 	=	$("#ddd .row").size(); 

		$("#ddd").append("<div class='row'><div class='form-group'><label>Faq Question</label><input name='faq[faq_title][]' class='form-control' required='required' type='text'></div><div class='form-group'><label>Alt Text</label><input name='faq[faq_alt][]' class='form-control' required='required' type='text'></div><div class='form-group'><label>Faq Description</label><textarea id= '"+len+"9faq_desc3' class='form-control' name='faq[faq_description][]' placeholdder='' required='required' rows='5'></textarea></div><div class='col-lg-2'><a href='javascript:void(0)' class='remove'>Delete</a> </div></div>");

		CKEDITOR.replace( len+'9faq_desc3',

{} );

	});



	$(document).on('click', '.remove', function(e) {

		

		$(this).parent().parent().remove();

		

	});

});









<?php $this->Html->scriptEnd(); ?>

 <div class='form-group'><label>Faq Description</label><textarea id= '"+len+"9faq_desc3' class='form-control' name='faq[faq_description][]' placeholdder='' required='required' rows='5'></textarea></div><div class='col-lg-2'><a href='javascript:void(0)' class='remove'>Delete</a></div></div>");

		CKEDITOR.replace( len+'9faq_desc3',

{} );

	});



	$(document).on('click', '.remove', function(e) {

		

		$(this).parent().parent().remove();

		

	});

});

<?php $this->Html->scriptEnd(); ?>

 