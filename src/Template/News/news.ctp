<div class="banner_inner banner_back_top  img_block10 New_details">
  <div class="banner_info banner_textblock">
    <div class="container bannerNews">
      <h1>Casino News</h1>
    </div>
  </div>
</div>
<div class="mid_wrapper">
<div class="main_tabs">
  <div class="container">
    <div class="row">
      <div class="topics_info1">
        <ul>     
          <?php echo $this->cell('Inbox::news_category'); ?>
        </ul>
      </div>
    </div>
  </div>
</div>


  <div class="casinoSearch">
    <div class="container">
      <?php if(!empty($mainNews)){ ?>
      <div class="newsInfo">
        <div class="row">
          <div class="col-md-6">
            <div class="CAsino_derails_info">
              <div class="CAsino_derails">
                <h3><?php echo $mainNews->title; ?></h3>
                <p> <span><?php echo $mainNews->created->format('F d, Y');  ?></span></p>
              </div>
              <div class="newsPera"><?php echo $mainNews->sdescription; ?><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view','news_view' => $mainNews->slug)); ?>">more...</a>
                     </div>
            </div>
          </div>
          <div class="col-md-6">
                  <div class="imageBox"><a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $mainNews->slug)); ?>"><?php 
           if(!empty($mainNews->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$mainNews->image)){
            echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=578px&height=320px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$mainNews->image,['alt' => 'Image','height'=>320, 'width'=>578]);
           } ?></a></div>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="filtrInner">
        <div class="newsList">
          <ul>
           <?php 
            foreach($result as $records){ ?>
            <li>
              <div class="pull-left">
                <a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $records->slug)); ?>"><?php 
                if(!empty($records->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$records->image)){
                echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=272px&height=154px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$records->image,['alt' => 'Image','height'=>154, 'width'=>272]);
                } ?>
                </a>
              </div>
              <div class="newsDetail">
                <h2>
                  <a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $records->slug)); ?>">
                  <?php echo $records->title; ?>
                  </a>
                </h2>
                <div class="block">
                  <span><?php 
                  echo $records->created->format('F d, Y'); ?>
                  </span>
                  <!-- &nbsp;/ by: <?php echo $records->user->name; ?> -->
                </div>
                <div class="newsPera"><?php echo $records->sdescription; ?>
                  <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news','action' => 'news_view','news_view' => $records->slug)); ?>">more...
                  </a>  
                </div>
                <div class="block comment">
                  <span class="pull-right"><?php echo $records->question_count; ?>     comments
                  </span> 
                </div>
              </div>
            </li>
            <?php 
            } 
            if($result->isEmpty()){ ?>
            <li class="text-center">
              No Record found
            </li><?php
            } ?>
          </ul>
          <!-- <div class="block orderNews on_btn">
            <div class="pull-right"><a href="" class="btn red_btn">Older news <i class="fa fa-caret-right"></i></a></div>
          </div> -->
          <div class="pagination_box"><?php echo $this->element('pagination2',['modelName' => 'News']); ?></div>
        </div>
        <div class="newsaws_info">
          <div class="newsaws_post">
              <?php echo $this->Form->create('News',['url' => '/news']); ?>
              <div class="search_boxDetails newsSearch">
              <?php echo $this->Form->text('search',['placeholder' => 'Search news']); ?>
              <button type="Submit"><img src="<?php echo WEBSITE_IMG_URL; ?>search_img.png" alt="img" /></button>
              </div>  
              <?php echo $this->Form->end(); ?>
              <?php echo $this->cell('Inbox::news_right_side_bar_index', [], ['cache' => ['config' => 'longlong', 'key' => 'news_index_'.$Defaultlanguage]]); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<style type="text/css">
 .on_btn{display:none;}
.pagination_box{width:100%; float:left; text-align:center; margin:40px 0}
.pagination_box .pagination li{width:auto !important; border:none; padding:0; float:none; display:inline-block; margin: 2px;}
.pagination_box .pagination li a{float:none; padding:8px 16px; color:#274451;  font-family: "latosemibold";}
.pagination_box .pagination .active a{background:#274451; color:#fff}
.pagination_box .pagination li a:hover{background:#274451; color:#fff;}
.pagination_box .pagination li:last-child a{border-radius:0px;}
.pagination_box .pagination li:first-child a{border-radius:0px;}
.main_tabs{width:100%; border-bottom:1px solid #dbdbdb;}
.main_tabs .topics_info1{float:left; width:100%}
.main_tabs .topics_info1 ul .active{display:inline-block;}
.main_tabs .topics_info1 ul li{display:inline-block !important; float:none !important; line-height:inherit; margin:0 14px; position:relative}
.main_tabs .topics_info1 ul li:after{border-bottom:2px solid #ab1d2d; content:""; display:block; width:100%; position:relative; display:none;}
.main_tabs .topics_info1 ul .active:after{display:block;}
.main_tabs .topics_info1 ul li:before{border-right: 1px solid #dbdbdb;
height: 15px;
content: "";
display: inline-block;
top: 32%;
position: absolute;
right: -15px;}
.main_tabs .topics_info1 ul{margin:0; float:left;}
.main_tabs .topics_info1 ul li a{color:#272727 !important; display:block; padding:10px;}

.signMenu_dropdown2 a{color:#787878}
.signMenu_dropdown2 a i{color:#787878; }
.signMenu_dropdown2 a:after{border-bottom:none;}
.signMenu_dropdown2{float: right;  position: relative;
padding: 10px 17px;}
.signMenu_dropdown2 ul{padding:0;}
.signMenu_dropdown2 ul li{margin:0 !important;}
.signMenu_dropdown2 ul li:after{border:none !important;}
.prev.disabled {
    display: none !important;
}
</style>