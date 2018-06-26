  <section class="beginners">
    <div class="container">
      <div class="beginners-content">
        <h3>Beginners Guide to Casinos</h3>
        <ul>
          <?php
          foreach($GuideContents1 as $contents)
          {
            ?>
            <li>
            <?php 
              if(!empty($contents['image']) && file_exists(GALLERY_ROOT_PATH.$contents['image'])){
              echo $this->Html->image(WEBSITE_URL.'image.php?width=95px&height=95px&cropratio=1:1&image='.GALLERY_IMG_URL.$contents['image'],['class' => 'img-responsive','alt' => $contents['image_alt']]);
              } ?>
              <!-- <img src="../images/beginners-img1.png"> -->
            <div class="content-title">
              <span>
              <a href="<?php echo $this->Url->build(['plugin' => '','controller' => 'users','action' => 'guide_view','guide_view' => $contents['slug']]); ?>">
              <?php echo (!empty($contents['title'])) ? $contents['title'] : $contents['title'] ; ?>
              </a>
              <p><?php echo $this->App->force_balance_tags((!empty($contents['sdescription'])) ? $contents['sdescription'] : $contents['sdescription']) ; ?></p></span>
            </div>
            </li>
           <?php
          }
          ?>
          </ul>
          <div class="view-all"><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'guide')); ?>" class="view-more text-center">View All Guide </a></div>
      </div>

    </div>
    
      
  </section>