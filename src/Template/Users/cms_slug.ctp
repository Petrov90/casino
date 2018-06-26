<?php use Cake\Core\Configure; if($slug == 'about-us'){ ?>

<div class="mid_wrapper">
   <div class="aboutInfo banner_textblock">
      <div class="container">
         <div class="title">
            <h1>About Us</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
               <?php /*<span></span>*/ ?>
         </div>
      </div>
      <div class="dommyabout">
         <div class="container">
            <div class="title2">
               <h2>Company</h2>
               <?php /*<span></span>*/ ?>
            </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
               took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
               It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
               versions of Lorem Ipsum.
            </p>
         </div>
      </div>
      <div class="Whatyou">
         <div class="container">
            <div class="title2">
               <h2>What you want is here</h2>
               <?php /*<span></span>*/ ?>
            </div>
            <div class="row clearfix">
               <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="WhatyouBox">
                     <div class="block"><img src="<?php echo WEBSITE_IMG_URL; ?>Nimg3.png" alt="img" /></div>
                     <h2>Casinos</h2>
                     <p>Lorem Ipsum is simply dummy text of the printing 
                        and typesetting industry. Lorem Ipsum has been the 
                        industry's standard dummy text ever since the 1500s.
                     </p>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="WhatyouBox">
                     <div class="block"><img src="<?php echo WEBSITE_IMG_URL; ?>Nimg4.png" alt="img" /></div>
                     <h2>Online casinos</h2>
                     <p>Lorem Ipsum is simply dummy text of the printing 
                        and typesetting industry. Lorem Ipsum has been the 
                        industry's standard dummy text ever since the 1500s.
                     </p>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="WhatyouBox">
                     <div class="block"><img src="<?php echo WEBSITE_IMG_URL; ?>Nimg5.png" alt="img" /></div>
                     <h2>Places</h2>
                     <p>Lorem Ipsum is simply dummy text of the printing 
                        and typesetting industry. Lorem Ipsum has been the 
                        industry's standard dummy text ever since the 1500s.
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="Aboutoursite">
         <div class="container">
            <div class="title2">
               <h2>What you want is here</h2>
               <?php /*<span></span>*/ ?>
            </div>
            <div class="row clearfix">
               <div class="col-lg-6 col-md-6">
                  <div class="Aboutourbox">
                     <div class="pull-left"><i><img src="<?php echo WEBSITE_IMG_URL; ?>Nic10.png" alt="Icon" /></i></div>
                     <div class="AboutourRig">
                        <h2>Casinos</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing 
                           and typesetting industry. Lorem Ipsum has been the 
                           industry's standard dummy text ever since the 1500s.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="Aboutourbox">
                     <div class="pull-left"><i><img src="<?php echo WEBSITE_IMG_URL; ?>Nic11.png" alt="Icon" /></i></div>
                     <div class="AboutourRig">
                        <h2>Reliable</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing 
                           and typesetting industry. Lorem Ipsum has been the 
                           industry's standard dummy text ever since the 1500s.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="Aboutourbox">
                     <div class="pull-left"><i><img src="<?php echo WEBSITE_IMG_URL; ?>Nic12.png" alt="Icon" /></i></div>
                     <div class="AboutourRig">
                        <h2>Disposal</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing 
                           and typesetting industry. Lorem Ipsum has been the 
                           industry's standard dummy text ever since the 1500s.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="Aboutourbox">
                     <div class="pull-left"><i><img src="<?php echo WEBSITE_IMG_URL; ?>Nic13.png" alt="Icon" /></i></div>
                     <div class="AboutourRig">
                        <h2>Usable</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing 
                           and typesetting industry. Lorem Ipsum has been the 
                           industry's standard dummy text ever since the 1500s.
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php }else{ ?>
<div class="mid_wrapper">
	<div class="aboutCacino">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="title">
						<h1><?php echo $result->title ?></h1>
						<span></span> 
					</div>
					
					<div class="aboutContant"><?php /*
						<div class="aboutPort"><img class="img-responsive" src="<?php echo WEBSITE_IMG_URL ?>banner.png" alt="img" /></div>*/?>
						<?php echo $result->description ?>				
					</div>			  
				</div>		  
				<div class="col-md-4">
		<?php echo $this->cell('Inbox::cms_side_bar'); /*
					  <div class="detail_map">
						<h2>Map</h2>
						<?php echo Configure::read('Site.map');  ?>
						</div>*/ ?>				  
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>