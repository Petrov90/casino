<div id="page-wrapper" style="min-height: 140px;">
	<div class="row">
		<div class="col-lg-6">
			<h1 class="page-header"><?php echo __('Edit '.$heading); ?></h1>
		</div>
		<div class="col-lg-6">
			<?php echo $this->Html->link('Back',array('action' => 'index',$type),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo $this->Form->create($master,array('role' => 'form','type' => 'file')); 
							?>								
								<div class="form-group">
									<label>Name</label>
									<?php echo $this->Form->text("name",array('class' => 'form-control','placesholder' => 'Nmae','required' => false)); 									
									echo $this->Form->hidden("type",array('value' => $type)); ?>
									<?php echo $this->Form->error("name"); ?>
								</div>
								<?php if($type == 'gambling_options'){ ?>
									<div class="form-group">
										<label>Image</label>
										<?php echo $this->Form->file("image",array('required' => false)); ?>
										<span>Please upload 100X100 px image</span>
										<?php echo $this->Form->error("image"); ?>
										<?php 
									if((AMENITIES_ROOT_PATH.$master->image)){
										echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.AMENITIES_IMG_URL.$master->image);
									} ?>
									</div>
								<?php } ?>
								<button class="btn btn-default" type="submit">Save</button>
								<button class="btn btn-default" type="reset">Reset</button>
							</form>
						</div>
						<!-- /.col-lg-6 (nested) -->
					</div>
					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>