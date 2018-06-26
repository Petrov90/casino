<?php echo $this->Html->script(array(
	WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js'),
	array('block' =>'bottom')); ?>
<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header"><?php echo __('Add new '.$heading); ?></h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'index', $type),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
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
		<?php if($type == 'bonus_type'){ ?>
			<?php echo $this->Form->hidden("slug",array('value' => rand(10000000,999999999))); ?>
			<?php echo $this->Form->hidden("page_title",array('value' => rand(10000000,999999999))); ?>
			<?php echo $this->Form->hidden("meta_description",array('value' => rand(10000000,999999999))); ?>
			
		<?php } ?>
		<?php if($type == 'countries'){ ?>
			<div class="col-lg-12">
				<div class="form-group"><br/>
					<label>Select Country</label>
					<?php echo $this->Form->select("country_id",$country,array('class' => 'form-control'));
					echo $this->Form->error("country_id"); ?>
				</div>
			</div>
			<div class="col-lg-12 hide" id="c_title">
				<div class="form-group">
					<label>Url</label>
					<?php echo $this->Form->text("slug",array('class' => 'form-control','id' => 'c_title1','required' => false));
					echo $this->Form->error("slug"); ?>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Page Title</label>
					<?php echo $this->Form->text("page_title",array('class' => 'form-control'));
					echo $this->Form->error("page_title"); ?>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Meta Description</label>
					<?php echo $this->Form->textarea("meta_description",array('class' => 'form-control'));
					echo $this->Form->error("meta_description"); ?>
				</div>
			</div>
		<?php  }
		foreach($lanagauageList as $lanagauage){
			$code		=	$lanagauage->code;
			$required	=	 ($lanagauage->is_default == 1) ? 'false' : 'false' ;?>
			<div id="<?php echo $lanagauage->code; ?>_div" class="tab-pane <?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?>">
				<div class="col-lg-12">
					<h2><?php echo 'Data in '.$lanagauage->name; ?></h2>
					<div class="form-group">
						<label>Title</label>
							<?php 
					if ($lanagauage->is_default == 1){
						echo $this->Form->text('_translations.'.$code.".title",array('class' => 'form-control c_title','placesholder' => 'Title','required' => $required,'autocomplete' => 'off'));
					}else{
						echo $this->Form->text('_translations.'.$code.".title",array('class' => 'form-control','placesholder' => 'Title','required' => $required));
					} 
						echo ($lanagauage->is_default == 1) ? $this->Form->error("title") : ''; 
					?>
					</div>
			<?php if($type1 == 'double_with_image'){ ?>
					<div class="form-group">
						<label>Head First Block</label>
						<?php  echo $this->Form->textarea('_translations.'.$code.".head_first_block",array('class' => 'form-control','placeholdder' => '	head_first_block','id' =>$code.'head_first_block','required' => $required));
						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
							CKEDITOR.replace( '<?php echo $code;?>head_first_block',
							{} );
						<?php $this->Html->scriptEnd(); 
						echo ($lanagauage->is_default == 1) ? $this->Form->error("head_first_block") : ''; ?>
					</div>

					<div class="form-group">
						<label>Head Second Block</label>
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
						<label>Sub Short Description</label>
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
						<label>Middle Short Description</label>
						<?php  echo $this->Form->textarea('_translations.'.$code.".middle_title_description",array('class' => 'form-control','placeholdder' => 'middle_title_description','id' =>$code.'middle_title_description','required' => $required));
						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
							CKEDITOR.replace( '<?php echo $code;?>middle_title_description',
							{} );
						<?php $this->Html->scriptEnd(); 
						echo ($lanagauage->is_default == 1) ? $this->Form->error("middle_title_description") : ''; ?>
					</div>

					<hr style="height:1px; border:none; color:#000; background-color:#000;">
					<?php if($type != 'countries'){ ?>
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
						<label> First Short Description</label>
						<?php  echo $this->Form->textarea('_translations.'.$code.".description",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'body','required' => $required));
						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
							CKEDITOR.replace( '<?php echo $code;?>body',
							{} );
						<?php $this->Html->scriptEnd(); 
						echo ($lanagauage->is_default == 1) ? $this->Form->error("description") : ''; ?>
					</div>
					<div class="form-group">
						<label>Long Description</label>
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

			<div class="col-lg-12">
				<?php if($type1 == 'double_with_image'){ ?>
					<div class="form-group">
						<label><?php if($type == 'countries'){ ?> Image <?php }else{ echo 'Head Image'; } ?></label>
						<?php echo $this->Form->file("head_image",array('class' => 'form-contro','placesholder' => 'head_image','required' => false));
						echo $this->Form->error("head_image"); ?>
					</div>	
					<?php if($type != 'countries'){ ?>
					<div class="form-group">
						<label>Icon Image</label>
						<?php echo $this->Form->file("image",array('class' => 'form-contro','placesholder' => 'image','required' => false));
						echo $this->Form->error("image"); ?>
					</div>
					<div class="form-group">
						<label>Icon Hover image</label>
						<?php echo $this->Form->file("back_image",array('class' => 'form-contro','placesholder' => 'Back Image','required' => false));
						echo $this->Form->error("back_image"); ?>
					</div>
				<?php }
				}  ?>
				<?php if($type == 'countries'){ ?>
					<div class="form-group">
						<label>Show on these page</label>
						<?php echo $this->Form->select("show_on_page",$show_on_page,array('class' => 'form-control','multiple' => true,'required' => true));
						echo $this->Form->error("image"); ?>
					</div>
				<?php } ?>
				</div>			
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