<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">User List</h1>
			</div>
			<div class="col-lg-6">
				<?php //echo $this->Html->link('Add New Casino',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
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
									<?php echo $this->Form->create($model,array('type' => 'get')); ?>
									<div class="col-sm-5"> <?php echo $this->Form->text("full_name",array('class' =>'form-control','placeholder' => 'Search by name','value' => isset($requestedQuery['full_name']) ? $requestedQuery['full_name'] : '')); ?></div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("email",array('class' =>'form-control','placeholder' => 'Search by email','value' => isset($requestedQuery['email']) ? $requestedQuery['email'] : '')); ?>
									</div>
									<div class="col-sm-4">
										<input type="submit" value="Search" class="btn btn-primary">
										<?php echo $this->Html->link("Reset",array('action' => 'index'),array('class' => 'btn btn-default')); ?>
									 </div>
									 <?php echo $this->Form->end(); ?>
								</div>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="20%"><?php echo $this->Paginator->sort('full_name','Name'); ?></th>
									<th width="15%"><?php echo $this->Paginator->sort('email','Email'); ?></th>
									<th><?php echo 'Image'; ?></th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($casinos as $casino):
										$id	=	$casino->id;
										?>
										<tr>
											<td><?= h($casino->full_name) ?></td>
											<td><?= h($casino->email) ?></td>
											<td>
											<?php 
									if(!empty($casino->profile_image) && file_exists(PROFILE_ROOT_PATH.$casino->profile_image)){
										$url	=	PROFILE_IMG_URL.$casino->profile_image;					
									}else if(!empty($casino->facebook_id)){
										$url	=	 'http://graph.facebook.com/'.$casino->facebook_id.'/picture?type=large'; 
									}else{  
										$url	=	WEBSITE_URL.'image.php?width=150px&height=150px&cropratio=1:1&image='.NO_PROFILE_IMAGE;
									} 
										echo $this->Html->image($url,['height' => 100,'width' => 100]);
									 ?></td>
											<td>
												<?php //echo $this->Html->link(__('Edit'), ['action' => 'edit', $casino->id],['class' => 'btn btn-primary']) ?>
												<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $casino->id], ['confirm' => __('Are you sure you want to delete # {0}?', $casino->id),'class' => 'btn btn-danger']) ?>
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
						<?php $paginator    =    $this->Paginator; ?>
						<div class="row">
							<div class="col-sm-12 text-right">
								<ul class="pagination">	
								<?php
									echo $paginator->prev(__('Prev', true),
										array(
											'id'=> 'p_prev',
											'tag'=> 'li',
											'escape'=>false
										),
										null,
										array(
											'class'=>'pagination',
											'escape'=>false,
										   'tag'=> 'li',
											'disabledTag'=>'a'
										)
									);
									echo $paginator->numbers(array(
									   'tag'=> 'li',
										'span'=>false,
										'currentClass' => 'pagination',
										'currentTag' => 'a',
										'separator' => false,
										'class' => "pagination"
										
									));    
									echo $paginator->next(__('Next', true),
										array(
											'id'=> 'p_next',
											'tag'=> 'li',
											'escape'=>false
										),
										null,
										array(
											'class'=>'pagination',
											'escape'=>false,
										   'tag'=> 'li',
											'disabledTag'=>'a'
										)
									);
								?>
								</ul>
							</div>
						 </div>
					</div>					
				</div>				
			</div>			
		</div>		
	</div>
</div>