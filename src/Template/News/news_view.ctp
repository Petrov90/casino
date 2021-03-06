<div class="banner_inner banner_back_top  img_block10 New_details">

  <div class="banner_info banner_textblock">

    <div class="container bannerNews">

         <h1><?php echo $result->master->name; ?> News</h1>



    </div>

  </div>

</div>



<!--news section ends here-->



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

      <div class="filtrInner">

        <div class="CAsino_derails_post">

          <div class="CAsino_derails_info">

            <div class="CAsino_derails">

              <h2><?php echo $result->title; ?></h2>

              <p><span><?php echo $result->created->format('F d, Y'); ?></span> / by:  <?php echo $result->user->name; ?></p>

            </div>

          </div>

          <?php if(!empty($casinoImage)){ ?>

          <div class="detail_banner"> 

			<div class="flexslider banner_slide"  id="photoslider" >

				<ul class="slides">

					<?php

					foreach($casinoImage as $image)

					{ 

						if(file_exists(CASINO_FULL_IMG_ROOT_PATH.$image->file)){ ?>

							<li class="w449">

								<?php echo $this->Html->image(CASINO_FULL_IMG_URL.$image->file,['class' => 'img-responsive','alt' => 'Image']); ?>

							</li>

						<?php 

						}

					} ?>

				</ul>

			</div>

			<?php if($casinoImage->count() > 1){ ?>

				<span class="left-span"><a href="javascript:void(0);" class="prev"><img src="<?php echo WEBSITE_IMG_URL ?>left-arrow.png" class="img-responsive" /></a></span> 

				<span class="right-span"><a href="javascript:void(0);" class="next"><img src="<?php echo WEBSITE_IMG_URL ?>right-arrow.png" class="img-responsive" /></a></span>

			<?php } ?>

			</div><?php if(!empty($result->image_by)){ ?>

            <div class="by_images">

				<span>Image By: <?php echo $result->image_by; ?></span>

            </div>

		  <?php } } ?>

          <div class="Deartils_Block">

            <div><?php echo $result->description; ?></div>

            <div class="block"><span>Tagged with:  <?php echo $result->master->name; ?></span></div>

            <div class="Related_News">

              <h3>Related News</h3>

              <div class="item_Gallery">

			  <?php foreach($relatedNews as $news){ ?>

                <div class="item_News">

					<div class="newsBox">

						<a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $news->slug)); ?>"><?php 

					 if(!empty($news->image) && file_exists(CASINO_THUMB_IMG_ROOT_PATH.$news->image)){

						echo $this->Html->image(WEBSITE_UPLOADS_URL.'image.php?width=264px&height=152px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$news->image,['alt' => 'Image','height'=>152, 'width'=>264]);

					 } ?></a>

					</div>

                  <span><a href="<?php echo $this->Url->build(array('controller' => 'news','action' => 'news_view','news_view' => $news->slug)); ?>"><?php echo $news->title; ?></a></span>

                  <p><?php echo $result->created->format('M d,Y'); ?></p>

                  <p class="comment_block"><?php echo $news->comment_count; ?> comments</h6>

                </div>

			  <?php } ?>

              </div>

            </div>

			<?php //pr($result); 

			echo $this->element('question_answer_json',['name' => $result->title,'type' => 'news','count' => $result->question_count,'avg_rating' => $result->avg_rating,'id' => $result->id]);

			/*?>

            <div class="member_review inNews">

              <div class="member_bord">

                <div class="member">

                  <h2>Comments (3)</h2>

                </div>

                <div class="sort_search"> <span>Sort By :</span>

                  <select id="country">

                    <option id="101" value="Lorem">Lorem</option>

                    <option id="102" value="Ipsum">Ipsum</option>

                    <option id="103" value="Dummy">Dummy</option>

                    <option id="104" value="Contrary">Contrary</option>

                    <option id="105" selected="selected" value="Spanish">Most Relevant</option>

                  </select>

                </div>

              </div>

              <div class="AddReviewBtn">

                <div class="pull-right"><a href="" class="btn red_btn">Add comments</a></div>

              </div>

              <div class="member_info">

                <div class="block">

                  <div class="member_detail">

                    <div class="mamber_col">

                      <div class="mem_img"> <img src="<?php echo WEBSITE_IMG_URL; ?>hd.png" class="img-responsive" alt="img"></div>

                      <h2>Mr. Khanna NK</h2>

                      <span>London,UK</span> 

					 </div>

                    <div class="memberRiver addQuiton">

                      <div class="revi_memb">

                        <p><span>Nov 25, 2016</span></p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                      </div>

                      <div class="cment_sect">

                        <div class="pull-left rerpo_btn"><a href="" class="btn red_btn">Respond</a></div>

                        <div class="pull-right"><a href=""><img src="<?php echo WEBSITE_IMG_URL; ?>ic17.png" class="img-responsive" alt="img"></a></div>

                      </div>

                      <div class="allAnswer"><a href="">Show all answers(3)</a></div>

                      <div class="member_detail">

                        <div class="mamber_col">

                          <div class="mem_img"> <img src="<?php echo WEBSITE_IMG_URL; ?>gd.png" class="img-responsive" alt="img"> </div>

                          <h2>Mr. Khanna NK</h2>

                          <span>London,UK</span> 

						</div>

                        <div class="memberRiver addQuiton">

                          <div class="revi_memb">

                            <p><span>Nov 25, 2016</span></p>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                          </div>

                        </div>

                      </div>

                      <div class="member_detail">

                        <div class="allAnswer"><a href=""></a></div>

                        <div class="mamber_col">

                          <div class="mem_img"> <img src="<?php echo WEBSITE_IMG_URL; ?>gd.png" class="img-responsive" alt="img"> </div>

                          <h2>Mr. Khanna NK</h2>

                          <span>London,UK</span> </div>

                        <div class="memberRiver addQuiton">

                          <div class="revi_memb">

                            <p><span>Nov 25, 2016</span></p>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                  <div class="member_detail">

                    <div class="mamber_col">

                      <div class="mem_img"> <img src="<?php echo WEBSITE_IMG_URL; ?>hd.png" class="img-responsive" alt="img"></div>

                      <h2>Mr. Khanna NK</h2>

                      <span>London,UK</span> </div>

                    <div class="memberRiver addQuiton">

                      <div class="revi_memb">

                        <p><span>Nov 25, 2016</span></p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                      </div>

                      <div class="cment_sect">

                        <div class="pull-left rerpo_btn"><a href="" class="btn red_btn">Respond</a></div>

                        <div class="pull-right"><a href=""><img src="<?php echo WEBSITE_IMG_URL; ?>ic17.png" class="img-responsive" alt="img"></a></div>

                      </div>

                    </div>

                  </div>

                  <div class="member_detail">

                    <div class="mamber_col">

                      <div class="mem_img"> <img src="<?php echo WEBSITE_IMG_URL; ?>hd.png" class="img-responsive" alt="img"></div>

                      <h2>Mr. Khanna NK</h2>

                      <span>London,UK</span> </div>

                    <div class="memberRiver addQuiton">

                      <div class="revi_memb">

                        <p><span>Nov 25, 2016</span></p>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                      </div>

                      <div class="cment_sect">

                        <div class="pull-left rerpo_btn"><a href="" class="btn red_btn">Respond</a></div>

                        <div class="pull-right"><a href=""><img src="<?php echo WEBSITE_IMG_URL; ?>ic17.png" class="img-responsive" alt="img"></a></div>

                      </div>

                    </div>

                  </div>

                </div>

                <div class="block alinCent"> <a href="" class="btn trans_btn">View more</a> </div>

              </div>

            </div>

         */?> </div>

        </div>

		<?php echo $this->cell('Inbox::news_right_side_bar', [], ['cache' => ['config' => 'longlong', 'key' => 'news_right_side_bar_'.$Defaultlanguage]]); ?>

	  </div>

    </div>

  </div>

</div>

<?php 

// echo $this->element('add_review_popup');

/* echo $this->Html->css(array(

		WEBSITE_CSS_URL.'flexslider.css'

	),array('block' =>'css'));

 */

	/* echo $this->Html->script(array(WEBSITE_JS_URL.'jquery.flexslider.js'),array('block' =>'footer_script')); */

	

	$this->Html->scriptStart(array('block' => 'custom_script'));

	?>

	 $('#photoslider').flexslider({

            animation: 'fade',

            controlsContainer: '.flex-container',

			controlNav: false,

			directionNav: false



        });

		

		$("#<?php echo $result->master->slug ?>").addClass('active');

		

		

		$(".prev").click(function() {

			$('#photoslider').flexslider("prev")

		});

		$(".next").click(function() {

			$('#photoslider').flexslider("next")

		});

<?php $this->Html->scriptEnd(); ?>

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