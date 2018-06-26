<?php use Cake\Core\Configure;  ?>
<div id="page-wrapper">
	<div class="row">
		<?php  $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header"><?php echo $heading; ?></h1>
			</div>
			<div class="col-lg-6">
				<?php echo $this->Html->link(__('Add new '.$heading),array('action' => 'add',$type),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
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
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-3">
									<div class="dataTables_length">
										<label>
											<?php echo $this->element('paging_info'); ?>
										</label>
									</div>
								</div>
								<div class="col-sm-9">
									<?php echo $this->Form->create($GuideContents,array('type' => 'get')); ?>
									<div class="col-sm-4">
									</div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("title",array('class' =>'form-control','placeholder' => 'Search by title','value' => isset($requestedQuery['title']) ? $requestedQuery['title'] : '')); ?>
									</div>
									<div class="col-sm-4">
										<input type="submit" value="Search" class="btn btn-primary">
										<?php echo $this->Html->link("Reset",array('action' => 'index',$type),array('class' => 'btn btn-default')); ?>
									 </div>
									 <?php echo $this->Form->end(); ?>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<?php if($type == 'aminities' || $type == 'email_notifications'){ ?>
										<th  class="td-head"width="17%">Parent Category</th>
									<?php } ?>
									<th  class="td-head"width="23%"><?php echo $this->Paginator->sort('title','Title'); ?></th>
									<th  class="td-head"width="20%"><?php echo $this->Paginator->sort('description','Description'); ?></th>
									<?php if(in_array($type,Configure::read('image_array'))){ ?>
										<th  class="td-head"width="25%">White Image</th>
									<?php } ?>
									<th  class="td-head"width="25%">Black Image</th>
									<th class="td-head">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($GuideContents as $master){ //pr($master);
										$id	=	$master->id;
										?>
										<tr>
									<?php if($type == 'aminities' || $type == 'email_notifications'){ ?>
										<th  class="td-head"width="25%"><?php echo isset($master->parent_master->name) ?  $master->parent_master->name : ''; ?></th>
									<?php } ?>
											<td><?php echo $master->title; ?></td>
											<td><?php echo $master->description; ?></td>
											<?php if(in_array($type,Configure::read('image_array'))){ ?>
												<th  class="td-head"width="25%">
								<?php 
									if((GALLERY_ROOT_PATH.$master->image)){
										echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$master->image);
									} ?></th>
											<?php } ?>
											<td><?php echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.GALLERY_IMG_URL.$master->image2); ?></td>
											<td>
												<?php echo $this->Html->link('Edit',array('action' => 'edit',$id,$type),array('class' => 'btn btn-primary')); ?>
												 <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $master->id,$type], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $master->id)]) ?>&nbsp;
												 <?php 
												$is_feat	=	($master->isfeat == 1) ? 0 : 1;
												$title		=	($master->isfeat == 1) ? 'Mark As Unfeatured' : 'Mark As Featured';
												$title1		=	($master->isfeat == 1) ? 'Click To Mark As Unfeatured' : 'Click To Mark As Featured For Hommepage';
												$class		=	($master->isfeat == 1) ? 'btn btn-info' : 'btn btn-warning';
												echo $this->Html->link($title, ['action' => 'feat', $master->id,$is_feat],['class' => $class,'title' => $title1]) ?>
											</td>
										</tr>	
										<?php
									}
								if(!isset($id)){
									?>
								<tr class="odd gradeX">
									<td colspan="5" class="text-center">No record found</td>
								</tr>
									<?php
									
								} ?>
							</tbody>
						</table>
						<?php 
					// if(!empty($result)){	
						echo $this->element('pagination');
					// }	?>
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