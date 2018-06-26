<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">New Uploaded Image List</h1>
			</div>
			<div class="col-lg-6">
				<?php //echo $this->Html->link('Add New Language',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
			</div>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive1">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="10%"><?php echo 'Type & Url'; ?></th>
									<th width="25%"><?php echo 'User Name'; ?></th>
									<th width="25%"><?php echo 'Image'; ?></th>
									<th width="15%"><?php echo 'Caption'; ?></th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($uploadImages as $language):
										$id	=	$language->id; ?>
										<tr>
											<td><?php 
											if($language->type == 'casino'){
												if($language->casino->type == 'online'){
													echo $this->Html->link($language->casino->title,array('prefix' => false,'plugin' => '','controller' => 'casinos','action' => 'online_casino_view','online_casino_view' => $language->casino->slug),array('target' => '_blank'));
												}else{
													echo $this->Html->link($language->casino->title,array('prefix' => false,'plugin' => '','controller' => 'casinos','action' => 'casino_view','casino_view' => $language->casino->slug),array('target' => '_blank'));
												}
											}else if($language->type == 'city'){
												echo $this->Html->link($language->city->name,array('prefix' => false,'plugin' => '','controller' => 'users','action' => 'city_view',$language->city->country->slug,$language->city->slug),array('target' => '_blank'));												
											}else{
												echo $this->Html->link($language->country->name,array('prefix' => false,'plugin' => '','controller' => 'users','action' => 'country_view','country_view' => $language->country->slug),array('target' => '_blank'));
											} ?></td>
											<td><?= h($language->user->full_name) ?></td>
											<td><?php 
									if((CASINO_THUMB_IMG_ROOT_PATH.$language->image)){
										?>
										<a href="<?php echo CASINO_THUMB_IMG_URL.$language->image; ?>" data-lightbox="roadtrip">
										<?php 
										echo $this->Html->image(CASINO_THUMB_IMG_URL.$language->image,['height' => 100,'width' => 100]);
										
									?></a>
									<?php
									} ?></td>
											<td><?= h($language->caption) ?></td>
											<td>
												
												<?php 
												echo $this->Html->link('Approve',array('action' => 'active',$id),array('confirm' => __('Are you sure you want to approve'),'class' => 'btn btn-primary','title' => 'Click to approve')); ?>
												<?php echo  $this->Form->postLink(__('Delete'), ['action' => 'delete', $language->id], ['confirm' => __('Are you sure you want to delete # {0}?', $language->id),'class' => 'btn btn-danger']) ?>
											</td>
										</tr>	
									 <?php endforeach;

								if(!isset($id)){ ?>
								<tr class="odd gradeX">
									<td colspan="5" class="text-center">No record found</td>
								</tr>
									<?php
									
								} ?>
							</tbody>
						</table>
					</div>					
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<!-- /.row -->
	<!-- /.row -->
	<!-- /.row -->
</div>
<?php echo $this->Html->script(array(
		WEBSITE_ADMN_JS_URL.'lightbox.js'
		),
	array('block' =>'bottom')); 
	
	 echo $this->Html->css(array(
		WEBSITE_ADMIN_CSS_URL.'lightbox.css'
		),
	array('block' =>'css')); 
	?>
<?php  $this->Html->scriptStart(array('block' => 'custom_script')); ?>
  lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'disableScrolling': false
    })
<?php $this->Html->scriptEnd(); ?>