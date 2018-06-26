<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-6">
				<h1 class="page-header">Popular Casino</h1>
			</div>
			<div class="col-lg-6">
				<?php echo $this->Html->link('Add New',array('action' => 'add'),array('class' => 'btn btn-primary','style' => array('float: right; margin-top: 58px;'))); ?>
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
									<div class="col-sm-5"> <?php echo $this->Form->text("text",array('class' =>'form-control','placeholder' => 'Search by title','value' => isset($requestedQuery['text']) ? $requestedQuery['text'] : '')); ?></div>
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
									<th width="40%"><?php echo $this->Paginator->sort('text','Name'); ?></th>
									<th width="40%"><?php echo 'Image'; ?></th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($Promotionss as $Promotions):
										$id	=	$Promotions->id;
										?>
										<tr>
											<td><?= h($Promotions->text) ?></td>
											<td>
											<?php 
										if(!empty($Promotions->logo) && (PROMOTION_CASINO_LOGO_ROOT_PATH.$Promotions->logo)){
											echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.PROMOTION_CASINO_LOGO_IMG_URL.$Promotions->logo);
										} ?></td>
											<td>
										<div class="btn-group">
										  <button type="button" class="btn btn-danger">Action</button>
										  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu">
												<li><?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $Promotions->id],['class1' => 'btn-primary']) ?></li>
												<li><?php 
												$is_feat	=	($Promotions->isfeat == 1) ? 0 : 1;
												$title		=	($Promotions->isfeat == 1) ? 'Mark As Unfeatured' : 'Mark As Featured';
												$title1		=	($Promotions->isfeat == 1) ? 'Click To Mark As Unfeatured' : 'Click To Mark As Featured For Hommepage';
												$class		=	($Promotions->isfeat == 1) ? 'btn-info' : 'btn-warning';
												echo $this->Html->link($title, ['action' => 'feat', $Promotions->id,$is_feat],['class1' => $class,'title' => $title1]) ?></li>
												
												  <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $Promotions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $Promotions->id),'class1' => 'btn-danger']) ?></li>
												
												  <li><?php 
												$is_feat	=	($Promotions->is_main_promotion == 1) ? 0 : 1;
												$title		=	($Promotions->is_main_promotion == 1) ? 'Main Promotion' : 'Mark As Main Promotion';
												$title1		=	($Promotions->is_main_promotion == 1) ? '' : 'Click To Mark As Main Promotion';
												$class		=	($Promotions->is_main_promotion == 1) ? 'btn btn-info' : ' btn-warning';
												// echo $this->Html->link($title,($Promotions->is_main_promotion == 1) ? 'javascript:void(0);' : ['action' => 'is_main_promotion',$Promotions->id,$is_feat],['class1' => $class,'title' => $title1]);
												?></li>
												 </ul>
										</div>
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