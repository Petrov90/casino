<?php echo $this->Html->script(array(
		/* WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js', */
		// WEBSITE_URL.'uploader/assets/js/jquery.js',
		WEBSITE_URL.'uploader/assets/js/jquery-ui-custom.js',
		WEBSITE_URL.'uploader/assets/js/fileupload.js',
		WEBSITE_URL.'uploader/assets/js/lightbox-2.6.min.js',
		WEBSITE_URL.'uploader/assets/js/custom_js.js',
		// WEBSITE_ADMIN_JS_URL.'autocomplete.js'
		),
	array('block' =>'bottom')); 
	 echo $this->Html->css(array(
		// WEBSITE_ADMIN_CSS_URL.'autocomplete.css',
		WEBSITE_URL.'uploader/assets/css/style.css',
		WEBSITE_URL.'uploader/assets/css/lightbox.css',
		),
	array('block' =>'css')); 
	?>
<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header">Edit country</h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'index'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<?php foreach($lanagauageList as $lanagauage){ ?>
				<li class="<?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?> "><a data-toggle="tab" href="#<?php echo $lanagauage->code; ?>_div" aria-expanded="true"><?php echo $lanagauage->name; ?></a></li>
			<?php } ?>
		</ul>
		<?php echo $this->Form->create($country,array('role' => 'form','type' => 'file')); ?>
		<div class="tab-content">			
			<div class="col-lg-12 form-group" id="c_title">
				<label>Slug</label>
				<?php echo $this->Form->text("slug",array('class' => 'form-control','id' => 'c_title1','required' => false));
				echo $this->Form->error("slug"); ?>
			</div>	
			<?php 	
			foreach($lanagauageList as $lanagauage){
				$code		=	$lanagauage->code;
				$required	=	 ($lanagauage->is_default == 1) ? 'required' : '' ; ?>
				<div id="<?php echo $lanagauage->code; ?>_div" class="tab-pane <?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?>">
					<div class="col-lg-12">
						<div class="form-group">
							<label>Name</label>
							<?php 
							if($lanagauage->is_default == 1){
								$val 		=	 (!empty($country->_translations[$code]->name)) ? $country->_translations[$code]->name : $country->name;
								echo $this->Form->text('_translations.'.$code.".name",array('class' => 'form-control c_title','placesholder' => 'Name','required' => $required, 'value' => $val));
							}else{
								echo $this->Form->text('_translations.'.$code.".name",array('class' => 'form-control','placesholder' => 'Name','required' => $required));
							}
							echo ($lanagauage->is_default == 1) ? $this->Form->error("name") : ''; ?>
						</div>	
						<div class="form-group" style="display:none">
							<label>Description</label>
							<?php 
							 // echo $this->Form->textarea('_translations.'.$code.".description",array('class' => 'form-control','placeholdder' => 'Description','id' =>'body'.$code)); 
							/*  $this->Html->scriptStart(array('inline' => false,'block' => 'custom_script')); ?>
								CKEDITOR.replace( 'body<?php echo $code; ?>',{} );
							<?php $this->Html->scriptEnd(); */
							echo ($lanagauage->is_default == 1) ? $this->Form->error("description") : ''; ?>
						</div>	
					</div>
				</div>
			<?php } ?>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Flag</label>
					<?php echo $this->Form->file("image",array('required' => false)); ?>
					<span>Please upload 100X100 px image</span>
					<?php echo $this->Form->error("image"); ?>
					<?php 
					if(!empty($country->flag) && file_exists(AMENITIES_ROOT_PATH.$country->flag)){
						echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.AMENITIES_IMG_URL.$country->flag);
					} ?>
				</div>
				<div class="form-group">
					<label>Continent</label>
					<?php echo $this->Form->select("continent_id",$Continents,array('empty' => 'Select Continent','class' => 'form-control')); ?>
					<?php echo $this->Form->error("continent_id"); ?>
				</div>
				
				<div class="form-group">
					<label>Image</label>
					 <div id="container">
						<?php 
						$object_id = rand(999999999,9999999999);
						if(!empty($country->object_id)){
							$object_id = $country->object_id;
						}
						$user_id = ADMIN_ID;   
						$type_id = 1;
						
						add_uploader($object_id , $user_id, $type_id);
						echo $this->Form->hidden("object_id",array("value" => $object_id)); ?> 
					</div>
					<?php echo $this->Form->error("object_id"); ?>
				</div><div class="cnt_img form-group"><label>Mark As Default</label><ul class="files"><?php
						foreach($c_images as $img){ ?>
							<li class="dflt_cntry_img " itmid="<?php echo $country->id;?>" imgid="<?php echo $img->id?>"itm_name="<?php echo $img->file;?>" slgname="<?php echo $country->slug?>" id=""><img alt="img" src="<?php echo WEBSITE_URL.'image.php?width=150px&height=75px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$img->file ?>" />
                        <i id="icn_<?php echo $img->id?>" class="fa fa-check ck_icn"></i>
							</li>
						<?php } ?>
					</ul></div>
				<button class="btn btn-default" type="submit">Save</button>
				<button class="btn btn-default" type="reset">Reset</button>
			</div>
		</form>
	</div>
</div>
<?php  $this->Html->scriptStart(array('block' => 'custom_script')); ?>
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

$(".dflt_cntry_img").click(function(){
	    cid = $(this).attr("itmid");
		img_name = $(this).attr("itm_name");
		slug = $(this).attr("slgname");
		imgid = $(this).attr("imgid");
		url1=  "<?php echo $this->Url->build('/Users/updt_cntry/') ?>"+slug+"/"+cid+"/"+img_name;
		$.ajax(
			{
			type 	 : 'get',
			dataType : 'html',
			url: url1,    	    
    		success: function() { 
    		alert('Country image has been marked');   		

      		}
      	});
	});

<?php $this->Html->scriptEnd(); ?>

<script>
/*
	$(".dflt_cntry_img").click(function(){
		alert('innn');
		cid = $(this).attr("itmid");
		img_name = $(this).attr("itm_name");
		slug = $(this).attr("slgname");
		imgid = $(this).attr("imgid");
		icn = "'#icn_'+imgid+";*/
	//	url1=  "<?php //echo $this->Url->build('/Users/updt_cntry/') ?>"+slug+"/"+cid+"/"+img_name;
	/*	$.ajax(
			{
			type 	 : 'get',
			dataType : 'html',
			url: url1,    	    
    		success: function() {    		
        		notice('Success','Country image has been marked','success');
      		}
      	});*/
	/*});*/

</script>