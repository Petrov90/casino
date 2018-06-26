<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">Casino List</h1>
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
								<div class="col-sm-12">
									<?php echo $this->Form->create($model,array('type' => 'get')); ?>
									<div class="col-sm-3"> <?php echo $this->Form->text("title",array('class' =>'form-control','placeholder' => 'Search by title','value' => isset($requestedQuery['title']) ? $requestedQuery['title'] : '')); ?></div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("country_name",array('class' =>'form-control','placeholder' => 'Search by country name','value' => isset($requestedQuery['country_name']) ? $requestedQuery['country_name'] : '')); ?>
									</div>
									<div class="col-sm-3">
										<?php echo $this->Form->text("state_name",array('class' =>'form-control','placeholder' => 'Search by state name','value' => isset($requestedQuery['state_name']) ? $requestedQuery['state_name'] : '')); ?>
									</div>
									<div class="col-sm-3">
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
									<th width="20%"><?php echo $this->Paginator->sort('title','Title'); ?></th>
									<th width="25%"><?php echo $this->Paginator->sort('address','Address'); ?></th>
									<th width="15%"><?php echo $this->Paginator->sort('phone','Phone'); ?></th>
									<th width="15%"><?php echo $this->Paginator->sort('country_name','Country name'); ?></th>
									<th width="15%"><?php echo $this->Paginator->sort('state_name','State name'); ?></th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($realCasinos as $casino):
										$id	=	$casino->id;
										?>
										<tr>
											<td><?= h($casino->title) ?></td>
											<td><?= h($casino->address) ?></td>
											<td><?= h($casino->phone) ?></td>
											<td><?= h($casino->country_name) ?></td>
											<td><?= h($casino->state_name) ?></td>											
											<td>
												<?= $this->Html->link(__('Edit'), ['action' => 'edit', $casino->id],['class' => 'btn btn-primary']) ?>
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
						<?php
    $paginator    =    $this->Paginator;	
 ?>
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
