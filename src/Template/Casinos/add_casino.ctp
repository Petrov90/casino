<?php use Cake\Core\Configure; 
//echo $this->Html->script(array(
    //WEBSITE_ADMN_JS_URL.'ckeditor/ckeditor.js',
    // WEBSITE_URL.'uploader/assets/js/jquery.js',
    //WEBSITE_URL.'uploader/assets/js/jquery-ui-custom.js',
    //WEBSITE_URL.'uploader/assets/js/fileupload.js',
   // WEBSITE_URL.'uploader/assets/js/lightbox-2.6.min.js',
   // WEBSITE_URL.'uploader/assets/js/custom_js.js',
   // WEBSITE_ADMIN_JS_URL.'autocomplete.js'
   // ),
  //array('block' =>'bottom')); 
   //echo $this->Html->css(array(
    //WEBSITE_ADMIN_CSS_URL.'autocomplete.css',
    //WEBSITE_URL.'uploader/assets/css/style.css',
    //WEBSITE_URL.'uploader/assets/css/lightbox.css'
   // ),
  //array('block' =>'css')); 
  ?>
<div class="mid_wrapper add-casino">
   <div class="request_form">
   		<div class="container">
   			<h2>Information Casino</h2>
			<div class="stepwizard">
			    <div class="stepwizard-row setup-panel">
			        <div class="stepwizard-step finish">
			            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
			        </div>
			        <div class="stepwizard-step">
			            <a href="#step-2" type="button" class="btn btn-default btn-circle">2</a>
			        </div>
			        <div class="stepwizard-step">
			            <a href="#step-3" type="button" class="btn btn-default btn-circle">3</a>
			        </div>
			    </div>
			</div>
			<p class="allfields">All fields marked with (*) are required</p>
			<?php echo $this->Form->create($casino,array('role' => 'form','type' => 'file','novalidate' => true)); ?>
			    <div class="row setup-content" id="step-1">
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Name:*</label>
                              <?php echo $this->Form->text("title",array('class' => 'form-control c_title','placesholder' => 'Title','ng-model' => 'name','ng-required' => "required")); ?>   
                              <?php echo $this->Form->error("title"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class="control-label lbl">Country:*</label>
                           <div class="before-drop-icon">
                              <?php echo $this->Form->select("country_id",$country,array('class' => 'form-control country_id','empty' => 'Select country','id' => 'Countries')); ?>
                              <?php echo $this->Form->error("country_id"); ?>
                              <?php echo $this->Form->hidden("country_name",array('id' => 'country_name')); ?>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">State:</label>
                              <?php echo $this->Form->select("state_name",null,array('class' => 'form-control state_name','empty' => 'Select state','id' => 'state_name')); ?>
                              <?php echo $this->Form->error("state_name"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                     <!--  autocompletecasino -->
                        <div class="colIn">
                           <label for="email" class="control-label lbl">City:*</label>
                           <div class="before-drop-icon">
                            <?php $city = array(); ?>
                              <?php echo $this->Form->text("city_name",array('class' => 'form-control','empty' => false)); ?>
                              <?php echo $this->Form->error("city_name"); ?>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Street, No :</label>
                           <?php echo $this->Form->text("street_no",array('class' => 'form-control')); ?>   
                              <?php echo $this->Form->error("street_no"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Zip Code :</label>
                            <?php echo $this->Form->text("zipcode",array('class' => 'form-control')); ?>   
                              <?php echo $this->Form->error("zipcode"); ?>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="colIn add-casino-col">
                           <label for="email" class=" control-label lbl gambling">Gambling Options :</label>
                             <ul class="gambling-options">
                             	<?php  foreach($gambling_options as $key => $name){    ?>
	                              <li>
	                                 <label for="<?php echo "gambling_options.".$key; ?>"><?php echo $name ?></label>
	                                 <div class="checbox">
	                                    <label>
	                                       <?php echo $this->Form->checkbox("gambling_options.".$key,array( 'class'=>'pr_che','id' => "gambling_options.".$key)); ?>
	                                       <span></span>
	                                    </label>
	                                 </div>
	                              </li><?php
	                              }?>
                             </ul>
                        </div>                           
                     </div>

                    

                     <div class="col-md-12">
                       <div class="images-drop-div">
                        <p>Images:</p>
                         <div class="add-images text-center">
                           <img src="../images/add-img.jpg">
                           <a href="#" class="btn add-imagesbtn">Add</a>
                         </div>
                         <div class="drop-img-div text-center " for="#file-div">
                          <img src="../images/drop-icon1.jpg">
                          <span>Drag your images here</span>
                         </div>
                          <!-- <input type="file" name="file" id="file-div"> -->
                       </div>
                     </div>
                         

                    



                     <div class="btn-group-div text-center">
                       <button class="btn btn-cancel" type="reset">Cancel</button>
                       <button class="btn btn-next btn-primary nextBtn btn-lg" type="button" >Next</button>
                     </div>                  
               </div> 
			    <div class="row setup-content" id="step-2">
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Website:</label>
                            <?php echo $this->Form->text("contact_website",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
                            <?php echo $this->Form->error("contact_website"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Email:</label>
                            <?php echo $this->Form->text("contact_email",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                            <?php echo $this->Form->error("contact_email"); ?>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Phone:</label>
                              <?php echo $this->Form->text("contact_phone",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
                              <?php echo $this->Form->error("contact_phone"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Schedule:</label>
                            <div class="checbox all-days">
                              <label>
                                <?php echo $this->Form->checkbox("contact_schedule"); ?>
                                <span>&nbsp;</span>
                              </label>
                            </div>
                            <span class="all-days">All Days 24 hour</span>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Facebook:</label>
                              <?php echo $this->Form->text("contact_facebook",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("contact_facebook"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Twitter:</label>
                              <?php echo $this->Form->text("contact_twitter",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("contact_twitter"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Table games:</label>
                              <?php echo $this->Form->text("table_games",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("table_games"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Gaming machines:</label>
                              <?php echo $this->Form->text("gaming_machines",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("gaming_machines"); ?>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class="control-label lbl">Selft Parking:</label>
                           <div class="before-drop-icon">
                              <?php echo $this->Form->select("self_parking",array('yes' => 'Yes','no' => 'No'),array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("self_parking"); ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class="control-label lbl">Valet:</label>
                           <div class="before-drop-icon">
                              <?php echo $this->Form->select("valet",array('yes' => 'Yes','no' => 'No'),array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("email"); ?>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Casino sq/ft:</label>
                              <?php echo $this->Form->text("casino_sq_ft",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("casino_sq_ft"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Convention sq/ft:</label>
                              <?php echo $this->Form->text("convention_sq_ft",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("convention_sq_ft"); ?>
                        </div>
                     </div>
                     <div class="block col-md-12">
                       <h2>Poker Room</h2>
                     </div>

                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Website:</label>
                            <?php echo $this->Form->text("poker_website",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
                            <?php echo $this->Form->error("poker_website"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Phone:</label>
                              <?php echo $this->Form->text("poker_phone",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
                              <?php echo $this->Form->error("poker_phone"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Facebook:</label>
                              <?php echo $this->Form->text("poker_facebook",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("poker_facebook"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Twitter:</label>
                              <?php echo $this->Form->text("poker_tw",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("poker_tw"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Schedule:</label>
                            <div class="checbox all-days">
                              <label>
                                <?php echo $this->Form->checkbox("poker_schedule"); ?>
                                <span>&nbsp;</span>
                              </label>
                            </div>
                            <span class="all-days">All Days 24 hour</span>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Email:</label>
                            <?php echo $this->Form->text("poker_email",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                            <?php echo $this->Form->error("poker_email"); ?>
                        </div>
                     </div>
                     <div class="block col-md-12">
                       <h2>Group Sales</h2>
                     </div>

                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Website:</label>
                            <?php echo $this->Form->text("gs_web",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
                            <?php echo $this->Form->error("gs_web"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Phone:</label>
                              <?php echo $this->Form->text("gs_ph",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
                              <?php echo $this->Form->error("gs_ph"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Facebook:</label>
                              <?php echo $this->Form->text("gs_facebook",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("gs_facebook"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Twitter:</label>
                              <?php echo $this->Form->text("gs_tw",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("gs_tw"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Schedule:</label>
                            <div class="checbox all-days">
                              <label>
                                <?php echo $this->Form->checkbox("gs_schedule"); ?>
                                <span>&nbsp;</span>
                              </label>
                            </div>
                            <span class="all-days">All Days 24 hour</span>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Email:</label>
                            <?php echo $this->Form->text("gs_email",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                            <?php echo $this->Form->error("gs_email"); ?>
                        </div>
                     </div>
                     <div class="block col-md-12">
                       <h2>Conferences</h2>
                     </div>

                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Website:</label>
                            <?php echo $this->Form->text("cf_web",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
                            <?php echo $this->Form->error("cf_web"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Phone:</label>
                              <?php echo $this->Form->text("cf_ph",array('class' => 'form-control','placesholder' => 'Phone','required' => false)); ?>
                              <?php echo $this->Form->error("cf_ph"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Facebook:</label>
                              <?php echo $this->Form->text("cf_facebook",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("cf_facebook"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Twitter:</label>
                              <?php echo $this->Form->text("cf_tw",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                              <?php echo $this->Form->error("cf_tw"); ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Schedule:</label>
                            <div class="checbox all-days">
                              <label>
                                <?php echo $this->Form->checkbox("cf_schedule.all_day"); ?>
                                <span>&nbsp;</span>
                              </label>
                            </div>
                            <span class="all-days">All Days 24 hour</span>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="colIn">
                           <label for="email" class=" control-label lbl">Email:</label>
                            <?php echo $this->Form->text("cf_em",array('class' => 'form-control','placesholder' => 'Email','required' => false)); ?>
                            <?php echo $this->Form->error("cf_em"); ?>
                        </div>
                     </div>
                     <div class="btn-group-div text-center">
                       <button class="btn btn-cancel" type="reset">Cancel</button>
                       <button class="btn btn-next btn-primary nextBtn btn-lg" type="button" >Next</button>
                     </div>                  
               </div>
			    <div class="row setup-content" id="step-3">

			       
                   
             <div class="btn-group-div text-center">
               <button class="btn btn-cancel" type="reset">Back</button>
               <button class="btn btn-next btn-primary nextBtn btn-lg" type="submit" >Finish</button>
             </div>
			    </div>
			</form>
		</div>
   </div>
</div>
<script type="text/javascript">
	
$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});

</script>

<?php  $this->Html->scriptStart(array('block' => 'custom_script')); ?>

$("#Countries").change(function(){
   cntryid = $(this).val();
   Countries   =  $("#Countries option:selected").text();
   $("#country_name").val(Countries);
   url1 =  '<?php echo $this->Url->build('/casinos/getStates/') ?>'+cntryid;
      
      $.ajax(
         {
         type   : 'get',
         dataType : 'json',
         url: url1,         
         success: function(data) { 
               $("#state_name").find('option').remove();
            $('<option>').val('').text('Select state').appendTo($("#state_name"));

            $.each(data, function(key, value) { 
               $('<option>').val(key).text(value).appendTo($("#state_name"));
            });
            }
         });  

});

$(".autocompletecasino").autocomplete({ 
    source: function( request, response ) {
      Countries =  $("#Countries").val();
      city = request.term;
      url1 =  '<?php echo $this->Url->build('/casinos/city_autocomplete') ?>';
         $.ajax({
            type   : 'post',
            url: url1,
            dataType : 'json',
            data: {
              q: city+'&'+Countries
            },
            success: function( data ) { alert(data);
               response( data );
           }
         });
      },
      minLength: 1,
      select: function( event, ui ) {

      name  = ui.item.name;
      id    = ui.item.id;
      
      setTimeout(function(){
        $(".autocomplete").val(ui.item.name);
      },100);
       
       $("#city_id").val(id);
     },
      open: function() {
      $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function() {
      $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
  
  }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    
     return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append("<a href=javascript:void(0);>" + item.name + "</a>")
    .appendTo( ul );
  };
  



<?php $this->Html->scriptEnd(); ?>