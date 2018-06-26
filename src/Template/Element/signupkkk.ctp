<?php 
 $plugin    = $this->request->params['plugin'];
 $controller  = $this->request->params['controller'];
 $action    = $this->request->params['action']; 
$this->Html->scriptStart(array('block' => 'custom_script')); ?>
$(function(){$(".login-pop").click(function(){rel=$(this).attr("data-rel"),title=$(this).attr("data-title"),$("#header-title").html(title),$("#login-modal .login-modal").addClass("hide"),$("#"+rel).removeClass("hide"),$("#login-modal").modal("show")}),$(".s-gn").click(function(i){rel=$(this).attr("data-rel"),title=$(this).attr("data-title"),$("#header-title").html(title),$("#signup-form_error_div").hide(),$("#login-form_error_div").hide(),$("#forgot_password-form_error_div").hide(),"signup_div"==rel?($("#forgot_div").addClass("hide"),$("#signup_div").removeClass("hide"),$("#login_div").addClass("hide")):"forgot_div"==rel?($("#forgot_div").removeClass("hide"),$("#login_div").addClass("hide"),$("#signup_div").addClass("hide")):($("#forgot_div").addClass("hide"),$("#signup_div").addClass("hide"),$("#login_div").removeClass("hide"))});$(".l-submit").click(function(e){e.preventDefault();form_id = $(this).attr('data-rel');$("#ajax-loader").removeClass('hide');var options={type: 'post',success:function(r){$("#ajax-loader").addClass('hide');data=JSON.parse(r) ;if(data.success){<?php if($controller == 'Users' && $action == 'index'){ ?>window.location='<?php echo $this->Url->build(array('plugin' => '','controller' => 'globalusers','action' => 'index')); ?>';<?php }else{?>location.reload();<?php } ?>}else{data = data.errors;var error_div_id=form_id+'_error_div';$('#login-modal').animate({ scrollTop: 0 }, 'slow');var error_div=$("#"+error_div_id);var error='<ul class="client-side-error">';$.each(data,function(index,html){ error +=  '<li>'+html+'</li>';});error  +=  '</ul>';error_msg = '<div class="alert alert-danger alert-dismissible site-color" style="padding-left: 0;" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+error+'</div>';error_div.html(error_msg);error_div.show();}return false;},resetForm:false};$("form#"+form_id).ajaxSubmit(options);});});
<?php $this->Html->scriptEnd(); ?><div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content loginForm"><div class="modal-header login_div"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><div class="modal-title">

<!-- <span id="header-title">Login</span> -->

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <script src="https://apis.google.com/js/api:client.js"></script>
  <script>
  var googleUser = {};
  var startApp = function() {
    gapi.load('auth2', function(){
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '58011067132-irgcgslk3746l2hlq2cr139kt562k5kv.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        //scope: 'additional_scope'
      });
      attachSignin(document.getElementById('customBtn'));
    });
  };

  function attachSignin(element) {
    console.log(element.id);
    auth2.attachClickHandler(element, {},
        function(googleUser) {
          var Id = googleUser.getBasicProfile().getId(); 
          var Email = googleUser.getBasicProfile().getEmail();
          var Name = googleUser.getBasicProfile().getName();
           //document.getElementById('name').innerText = "Signed in: " +
            // googleUser.getBasicProfile().getEmail();
             $.ajax({
               type: 'POST',
                url: '<?php echo $this->Url->build('/users/like'); ?>',
                data: { 'id': Id, 'email': Email, 'name': Name },
                success: function(data){  
                    window.location.reload();                                               
                }
            });
        }, function(error) {
          //alert(JSON.stringify(error, undefined, 2));
        });
  }
  </script>
  <div class="fblogin">
    <span class="">
      <a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'facebook')); ?>">
        <img alt="" src="images/FB_POP_ICN.png">
        <span class="f-name">Facebook</span>
      </a>
    </span>
    </div>

    <!-- <div id="" class="fbicn">
      <span class="icon"><img src="images/FB_POP_ICN.png"></span>
      <span class="buttonText">Facebook</span>
    </div> -->

    <div id="gSignInWrapper" class="gplus">
      <div id="customBtn" class="customGPlusSignIn">
        <span class="icon"><img src="img/google_logo1600.png"></span>
        <span class="buttonText">Google</span>
      </div>
    </div>

  <div id="name"></div>
  <script>startApp();</script>




<span class="pull-right "></span>
</div>
</div>
<div class="modal-body login-modal" id="login_div">
 <!--  <p>Please Login if you have a user</p> -->
 <div class="pop-line">
   <hr>
<span>OR</span>
 </div>
    <?php echo $this->Form->create('User',['url' => ['plugin' => '','controller' => 'users','action' => 'login'],'id' => 'login-form','class' => 'css-form']); ?>
  <div id="login-form_error_div"></div>
  <div class="fildlogin"><div class="form-group">
  <label>Email Address<span class="red-star">*</span></label>
  <?php echo $this->Form->email('email',['class' => 'form-control login-field']); ?></div><div class="form-group"><label>Password<span class="red-star">*</span></label><?php echo $this->Form->password('password',['class' => 'form-control login-field']); ?></div></div><div class="remembre"><div class="pull-left"><div class="checbox">
  <label><?php echo $this->Form->checkbox('remember_me',['label' => false,'div' => false]); ?><span></span> Remember Me</label></div></div><div class="pull-right"><a data-title="Forgot Password" data-rel="forgot_div" class="s-gn" href="javascript:void(0);">Forgot Your Password?</a></div></div><div class="loginfooter"><input type="submit" value="Login" class="btn red_btn l-submit" data-rel="login-form"/><p>Don't have an account?   <a data-title="Create Account" data-rel="signup_div" class="s-gn" href="javascript:void(0);">Sign up</a></p></div><?php echo $this->Form->end(); ?></div><div class="modal-body login-modal" id="forgot_div"><h3>Get your password</h3><?php echo $this->Form->create('User',['url' => ['plugin' => '','controller' => 'users','action' => 'forgot_password'],'id' => 'forgot_password-form','class' => 'css-form']); ?><div id="forgot_password-form_error_div"></div><div class="fildlogin"><div class="form-group"><label>Email Address<span class="red-star">*</span></label><?php echo $this->Form->email('email',['class' => 'form-control login-field']); ?></div></div><div class="loginfooter"><input type="submit" value="Submit" class="btn red_btn l-submit" data-rel="forgot_password-form"/><p>Already registered? <a data-title="Login" data-rel="login_div" class="s-gn" href="javascript:void(0);">Log in</a></p></div><?php echo $this->Form->end(); ?></div><div class="modal-body login-modal" id="signup_div" >

  <!-- <p>Please fillup the form bellow in order</p> -->
<div class="pop-line">
   <hr>
<span>OR</span>
 </div>
  <?php echo $this->Form->create('User',['url' => ['plugin' => '','controller' => 'users','action' => 'signup'],'id' => 'signup-form','class' => 'css-form']); ?><div id="signup-form_error_div"></div><div class="fildlogin">
<div class="form-group">
  <label><!-- Sex<span class="red-star">*</span> --></label>
  <div class="label_name1 label_name lab_ver">
    <?php echo $this->Form->radio(
    'sex',
    [
        ['value' => 'male', 'text' => 'Male'],
        ['value' => 'female', 'text' => 'Female']
    ]
); ?>
  </div>
</div>           
<div class="form-group"><label>Full Name<span class="red-star">*</span></label><?php echo $this->Form->text('full_name',['class' => 'form-control login-field']); ?></div><div class="form-group"><label>Email<span class="red-star">*</span></label><?php echo $this->Form->email('email',['class' => 'form-control login-field']); ?></div><div class="form-group"><label>Password<span class="red-star">*</span></label><?php echo $this->Form->password('password',['class' => 'form-control login-field']); ?></div><div class="form-group"><label>Confirm Password<span class="red-star">*</span></label><?php echo $this->Form->password('c_password',['class' => 'form-control login-field']); ?></div></div>


<div class="sign_para">
  
 <p>By clicking Create Account you agree to our <a target="_blank" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms_slug','cms_slug' =>'terms-of-use')); ?>">Terms </a>and that you have read our <a target="_blank" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms_slug','cms_slug' =>'terms-of-use')); ?>">Data Police, </a>including our <a target="_blank" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms_slug','cms_slug' =>'terms-of-use')); ?>">Cookie Use , </a> You may recive SMS Notifaction from Facebook and can opt out at any time.</p> 
</div>
<div class="loginfooter"><input type="submit" value="Create Account" class="btn red_btn l-submit" data-rel="signup-form"/>
<!-- <p>By clicking on ‘Sign up’ above, You confirm that you accept the <a target="_blank" href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms_slug','cms_slug' =>'terms-of-use')); ?>">Terms of use</a></p><p>Already registered? <a data-title="Login" data-rel="login_div" class="s-gn" href="javascript:void(0);">Log in</a></p> -->

</div><?php echo $this->Form->end(); ?></div></div></div></div>


  <style type="text/css">
    #customBtn {
      display: inline-block;
      background: white;
      color: #444;
      width: 190px;
      border-radius: 5px;
      border: thin solid #888;
      box-shadow: 1px 1px 1px grey;
      white-space: nowrap;
    }
    #customBtn:hover {
      cursor: pointer;
    }
    span.label {
      font-family: serif;
      font-weight: normal;
    }
    span.icon {
      /*background: url('/img/google_logo1600.png') transparent 5px 50% no-repeat;*/
      display: inline-block;
      vertical-align: middle;
      width: 42px;
      height: 42px;
    }
    span.buttonText {
      display: inline-block;
      vertical-align: middle;
      padding-left: 42px;
      padding-right: 42px;
      font-size: 14px;
      font-weight: bold;
      /* Use the Roboto font that is loaded in the <head> */
      font-family: 'Roboto', sans-serif;
    }
    .icon > img {
    width: 100%;
}
#gSignInWrapper {
    text-align: center;
}
#customBtn {
    background: white none repeat scroll 0 0;
    border: thin solid #888;
    border-radius: 5px;
    box-shadow: 1px 1px 1px grey;
    color: #444;
    display: inline-block;
    margin: 0 9px;
    padding: 5px 11px;
    text-align: center;
    white-space: nowrap;
    width: 151px;
}
span.icon {
    display: inline-block;
    float: left;
    height: 20px;
    margin: 6px 0 0;
    vertical-align: top;
    width: 20px;
}
span.buttonText {
    display: inline-block;
    font-family: "Roboto",sans-serif;
    font-size: 14px;
    font-weight: bold;
    margin: 6px 0 0;
    vertical-align: top;
    padding-right: 0 ;
    padding-left: 0 ;
}
.icon > img {
    vertical-align: top;
    width: 100%;
}
.fbicn{background:#3b5998 !important; }
.fbicn span{color: #fff;}
.pop-line {
    position: relative;
    text-align: center;
}
.pop-line > span {
    background: #fff none repeat scroll 0 0;
    left: 0;
    margin: 0 auto;
    position: absolute;
    right: 0;
    top: -9px;
    width: 34px;
}
.lab_ver {
    margin: 0 !important;
    width: 247px;
}
.lab_ver label {
    float: left;
    margin: 0 18px 0 0;
    width: 42%;
}
.lab_ver label input {
    margin: 5px 12px 0 0;
    width: auto;
}
.sign_para > p {
    border-bottom: medium none;
    font-size: 13px;
    margin: 0;
    padding: 0;
}
.sign_para {
    background: #f1f1f1 none repeat scroll 0 0;
    float: left;
    padding: 20px;
    width: 100%;
}
.fblogin{ background:#3b5998 !important;
    border: thin solid #888;
    border-radius: 5px;
    box-shadow: 1px 1px 1px grey;
    color: #fff;
    display: inline-block;
    margin: 0 9px;
    padding: 5px 11px;
    text-align: center;
    white-space: nowrap;
    width: 151px; float: left;}
.fblogin a {
    margin: 0 !important;
    width: 100%;
}
.fblogin a img{vertical-align: top; margin: 6px 0 0; float: left;}
 .fblogin a span { display: inline-block;
    font-family: "Roboto",sans-serif;
    font-size: 14px;
    color: #fff;
    font-weight: bold;
    margin: 6px 0 0;
    padding-left: 0;
    padding-right: 0;
    vertical-align: top;}
  </style>}
}

}
