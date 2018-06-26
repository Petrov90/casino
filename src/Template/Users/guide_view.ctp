<div class="banner_inner banner_back_top  img_block6">
   <div class="banner_info banner_textblock">
      <div class="container">
	  
	  <?php
	  
	  
	  //print_r($guideContent);
	  
	  ?>
	  
         <h3><?php echo $headBlock->title;?></h3>
         <div class="banner_post">
            <div class="col-md-6">
               <?php echo $headBlock->description;?>
            </div>
            <div class="col-md-6">
               <?php echo $headBlock->second_description;?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="mid_wrapper">
<div class="container">
  <div class="casino_articulo_info">
	 <div class="casino_articulo">
		<div><?php echo $headBlock->h1d; ?></div>
	 </div><?php /*
	 <div class="casino_articulo">
		<h2><?php echo $headBlock->h2t; ?></h2>
		<div><?php echo $headBlock->h2d; ?></div>
	 </div>
	
	 <div class="casino_articulo">
		<h2><?php echo $headBlock->h3t; ?></h2>
		<div><?php echo $headBlock->h3d; ?></div>
	 </div>*/?>
</div>
	 
 </div>
<div class="beginners_info casino_articulo_post">
  <div class="container">
	 <?php echo $this->element('guide_casinos'); ?>
  </div>
</div>
</div>


