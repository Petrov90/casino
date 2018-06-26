<?php 
	foreach($casinos as $casino){
		$casino = (object) $casino;
		echo ($this->cell('Inbox::casinosearch',[$casino])); 
	}
	if(!empty($casino)){
		if(isset($isAjax)){
			if($yesIsCheck){ ?>
				<div id="pagination"><?php echo $this->element('pagination2',['modelName' => 'Casinos']); ?></div> 
		<?php }else{ ?>
				<div id="pagination"> <?php echo $this->element('casino_search_pagination_ajax');  ?> </div>			
			<?php
			}
		}else{
			echo $this->element('casino_search_pagination');
		}
	}else{ ?>
		<div class="text-center">No record found</div>
<?php } ?>