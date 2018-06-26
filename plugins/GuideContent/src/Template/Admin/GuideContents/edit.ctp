<?php echo $this->Html->script(array(
    WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js'),
    array('block' =>'bottom')); ?>
<div id="page-wrapper" style="min-height: 140px;">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Edit Guide</h1>
        </div>
        <div class="col-lg-6">
            <?php echo $this->Html->link('Back',array('action' => 'index',$type),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="panel-body">    
        <ul class="nav nav-tabs">
            <?php foreach($lanagauageList as $lanagauage){ ?>
                <li class="<?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?> "><a data-toggle="tab" href="#<?php echo $lanagauage->code; ?>_div" aria-expanded="true"><?php echo $lanagauage->name; ?></a></li>
            <?php } ?>
        </ul>
        <?php echo $this->Form->create($GuideContent,array('role' => 'form','type' => 'file')); ?>     
        <div class="tab-content"><?php 
        foreach($lanagauageList as $lanagauage){
            $code       =   $lanagauage->code;
            $required   =    ($lanagauage->is_default == 1) ? 'required' : '' ;?>
            <div id="<?php echo $lanagauage->code; ?>_div" class="tab-pane <?php echo ($lanagauage->is_default == 1) ? 'active' : '';  ?>">
                <div class="col-lg-12">
                    <h2><?php echo 'Data in '.$lanagauage->name; ?></h2>
                    <div class="form-group">
                        <label>Title</label>
                        <?php echo $this->Form->text('_translations.'.$code.".title",array('class' => 'form-control','placesholder' => 'Title','required' => $required));
                        echo ($lanagauage->is_default == 1) ? $this->Form->error("title") : ''; ?>
                    </div>

                    <div class="form-group">
                        <label>
                        Description
                        </label>

                        <?php  echo $this->Form->textarea('_translations.'.$code.".description",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'body','required' => $required));
                        $this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
                            CKEDITOR.replace( '<?php echo $code;?>body',
                            {} );
                        <?php $this->Html->scriptEnd(); 
                        echo ($lanagauage->is_default == 1) ? $this->Form->error("description") : ''; ?>
                    </div>
					<div class="form-group">
						<label>Second Block</label>
						<?php  echo $this->Form->textarea('_translations.'.$code.".second_description",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'second_description','required' => $required));
						$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
							CKEDITOR.replace( '<?php echo $code;?>second_description',
							{} );
						<?php $this->Html->scriptEnd(); 
						echo ($lanagauage->is_default == 1) ? $this->Form->error("second_description") : ''; ?>
					</div><?php /*
						<div class="form-group">
							<label>Heading title</label>
							<?php echo $this->Form->text('_translations.'.$code.".h1t",array('class' => 'form-control','placesholder' => 'Middle Title','required' => false,'readonly' => false));
							echo ($lanagauage->is_default == 1) ? $this->Form->error("h1t") : ''; ?>
						</div>*/ ?>
						<div class="form-group">
							<label>Description</label>
							<?php  echo $this->Form->textarea('_translations.'.$code.".h1d",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'h1d','required' => $required));
							$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
								CKEDITOR.replace( '<?php echo $code;?>h1d',
								{} );
							<?php $this->Html->scriptEnd(); 
							echo ($lanagauage->is_default == 1) ? $this->Form->error("h1d") : ''; ?>
						</div><?php /*
						<div class="form-group">
							<label>Heading 2 title</label>
							<?php echo $this->Form->text('_translations.'.$code.".h2t",array('class' => 'form-control','placesholder' => 'Middle Title','required' => false,'readonly' => false));
							echo ($lanagauage->is_default == 1) ? $this->Form->error("h2t") : ''; ?>
						</div>
						<div class="form-group">
							<label>Heading 2 Description</label>
							<?php  echo $this->Form->textarea('_translations.'.$code.".h2d",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'h2d','required' => $required));
							$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
								CKEDITOR.replace( '<?php echo $code;?>h2d',
								{} );
							<?php $this->Html->scriptEnd(); 
							echo ($lanagauage->is_default == 1) ? $this->Form->error("h2d") : ''; ?>
						</div>
						<div class="form-group">
							<label>Heading 3 title</label>
							<?php echo $this->Form->text('_translations.'.$code.".h3t",array('class' => 'form-control','placesholder' => 'Middle Title','required' => false,'readonly' => false));
							echo ($lanagauage->is_default == 1) ? $this->Form->error("h3t") : ''; ?>
						</div>
						<div class="form-group">
							<label>Heading 3 Description</label>
							<?php  echo $this->Form->textarea('_translations.'.$code.".h3d",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'h3d','required' => $required));
							$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
								CKEDITOR.replace( '<?php echo $code;?>h3d',
								{} );
							<?php $this->Html->scriptEnd(); 
							echo ($lanagauage->is_default == 1) ? $this->Form->error("h3d") : ''; ?>
						</div>*/ ?>
						<div class="form-group">
							<label>Short Description For Featured Section</label>
							<?php  echo $this->Form->textarea('_translations.'.$code.".sdescription",array('class' => 'form-control','placeholdder' => 'Description','id' =>$code.'sdescription','required' => $required));
							$this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
								CKEDITOR.replace( '<?php echo $code;?>sdescription',
								{} );
							<?php $this->Html->scriptEnd(); 
							echo ($lanagauage->is_default == 1) ? $this->Form->error("sdescription") : ''; ?>
						</div>
                 </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label>Alt Text</label>
                        <?php echo $this->Form->text('_translations.'.$code.".image_alt",array('class' => 'form-control','placesholder' => 'Alt','required' => $required));
                        echo ($lanagauage->is_default == 1) ? $this->Form->error("image_alt") : ''; ?>
                    </div>
                    
                    
                    
                    
                    
                    <?php } ?>
                    
                    
                    
                    
                    
                    

                 <div class="col-lg-12">
           

                <div class="form-group">
                    <label>White Image</label>
                    <?php echo $this->Form->file("image",array('class' => 'form-contro','placesholder' => 'Title','required' => false));
                    echo $this->Form->error("image"); ?><?php 
									if(file_exists(GALLERY_ROOT_PATH.$GuideContent->image)){
										echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$GuideContent->image);
									} ?>
					
                </div>
				<div class="form-group">
                    <label>Black Image</label>
                    <?php echo $this->Form->file("image2",array('class' => 'form-contro','placesholder' => 'Title','required' => false));
                    echo $this->Form->error("image2"); ?><?php 
									if(file_exists(GALLERY_ROOT_PATH.$GuideContent->image2)){
										echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$GuideContent->image2);
									} ?>
					
                </div>
   
            <button class="btn btn-default" type="submit">Save</button>
            <button class="btn btn-default" type="reset">Reset</button>
        </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>