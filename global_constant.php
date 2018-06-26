<?php 

// D:\xampp\htdocs\casino\bin>cake bake all Master.Masters
define('SUBDIR','');
define('SUBDIR_CSS_PATH','');


define('ADMIN_SUBDIR','admin/');

$host = $_SERVER['HTTP_HOST'];



define('JS_URL','js/');
define('CSS_URL','css/');

define('WEBSITE_URL','http://'.$host.'/'.SUBDIR);
define('WEBSITE_ADMIN_URL','http://'.$host.'/'.SUBDIR.ADMIN_SUBDIR);




define('WEBSITE_CSS_URL',WEBSITE_URL.'css/');
define('WEBSITE_JS_URL',WEBSITE_URL.'js/');

// define('WEBSITE_ADMIN_CSS_URL',WEBSITE_URL.'css/admin/');
define('WEBSITE_ADMIN_JS_URL',WEBSITE_URL.'js/admin/');

define('WEBSITE_ADMIN_CSS_URL',WEBSITE_ADMIN_URL.'css/');
define('WEBSITE_ADMN_JS_URL',WEBSITE_ADMIN_URL.'js/');


define('WEBSITE_APP_WEBROOT_ROOT_PATH', ROOT . DS . 'webroot' . DS);

define('APP_WEBROOT_ROOT_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH);


define('APP_UPLOADS_ROOT_PATH', APP_WEBROOT_ROOT_PATH . 'uploads' . DS);
define('WEBSITE_UPLOADS_URL', WEBSITE_URL . 'webroot/uploads/');


define('WEBSITE_IMG_URL',WEBSITE_URL.'img/');
define('COMPLETE_UPLOAD_PATH',WEBSITE_URL.'webroot/uploads/');

define('CASINO_THUMB_IMG_URL',WEBSITE_URL.'files/thumbnail/');
define('CASINO_THUMB_IMG_ROOT_PATH',APP_WEBROOT_ROOT_PATH.'files'.DS.'thumbnail'.DS);

define('CASINO_FULL_IMG_URL',WEBSITE_URL.'webroot/files/');
define('CASINO_FULL_IMG_ROOT_PATH',APP_WEBROOT_ROOT_PATH.'files'.DS);


define('AMENITIES_IMG_URL',COMPLETE_UPLOAD_PATH.'amenities/');
define('AMENITIES_ROOT_PATH',APP_UPLOADS_ROOT_PATH.'amenities'.DS);


define('PROMOTION_CASINO_LOGO_IMG_URL',COMPLETE_UPLOAD_PATH.'promotions/');
define('PROMOTION_CASINO_LOGO_ROOT_PATH',APP_UPLOADS_ROOT_PATH.'promotions'.DS);

define('SLIDER_IMG_URL',COMPLETE_UPLOAD_PATH.'slider/');
define('SLIDER_ROOT_PATH',APP_UPLOADS_ROOT_PATH.'slider'.DS);

define('NO_CASINO_IMG',WEBSITE_URL.'webroot/img/casino2-01.png');
define('NO_ACTIVITY_IMG',WEBSITE_URL.'webroot/img/no_casino.jpg');
define('NO_CITY_IMG',WEBSITE_URL.'webroot/img/city-image.jpg');
define('NO_COUNTRY_IMG',WEBSITE_URL.'webroot/img/country-image.png');
define('NO_PROFILE_IMAGE',WEBSITE_URL.'webroot/img/');
define('NO_PROFILE_IMAGE_FEMALE',WEBSITE_URL.'webroot/img/femail_no_image_found.png');

define('PROFILE_IMG_URL',COMPLETE_UPLOAD_PATH.'profile/');
define('PROFILE_ROOT_PATH',APP_UPLOADS_ROOT_PATH.'profile'.DS);

define('GALLERY_IMG_URL',COMPLETE_UPLOAD_PATH.'gallery/');
define('GALLERY_ROOT_PATH',APP_UPLOADS_ROOT_PATH.'gallery'.DS);

define('ADMIN',1);
define('ADMIN_USER','admin');
define('FRONT_USER','front');

define('ADMIN_ID',423424651);
define('LAT','23.6345');
define('LONG','102.5528');

define('DEFAULT_LANG','en');


define('SORT_MOST_RELEVANT',57);
define('SORT_EVALUTION',58);
define('SORT_DATE',59);
define('SORT_LANGUAGE',60);
$config['language_translate_module']    =    array(
		'homepage'    => 'Homepage',
		'menu'    => 'Header Menu',
		'footer'    => 'Footer',
		'dashboard'    => 'Dashboard',
		'title'    => 'Page Title',
		'metadescription'    => 'Meta Description',
		'online_casinos'    => 'Online Casinos',
		'land_based_casino'    => 'Land based casino'
	);	
	/* $config['allowed_image']    =    array(
			'extensions'    => array('gif','jpeg','png','jpg'),
			'mime_types'     => array('image/gif', 'image/jpeg','image/png')
		);	
		Configure::write('debug', 2); */
$config['preference']    =    array(
	'dashboard.who_can_contact_me'    => array(
		'who_can_contact_me_all_users' => 'dashboard.all_users',
		'who_can_contact_me_followers' => 'dashboard.myfollowers',
		/* 'who_can_contact_me_i_follow_him' => 'dashboard.i_follow_him', */
		 'who_can_contact_me_anyone' 	=> 'dashboard.anyone' 
	),
	'dashboard.who_can_see_things_on_my_profile'    => array(
		'who_can_see_things_on_my_profile_all_users' => 'dashboard.all_users',
		'who_can_see_things_on_my_profile_followers' => 'dashboard.myfollowers',
		/* 'who_can_see_things_on_my_profile_i_follow_him' => 'dashboard.i_follow_him', */
		 'who_can_see_things_on_my_profile_anyone' 	=> 'dashboard.anyone' 
	),
	'dashboard.who_can_follow_me'    => array(
		'who_can_follow_me_all_users' => 'dashboard.all_users',
		'who_can_follow_me_followers' => 'dashboard.myfollowers',
		/* 'who_can_follow_me_i_follow_him' => 'dashboard.i_follow_him', */
		'who_can_follow_me_anyone' 	=> 'dashboard.anyone'
	)
);	

$config['email_preference']    =    array(
	'dashboard.general'    => array(
		'i_haveve_increased_my_expertise_level' => "dashboard.i_haveve_increased_my_expertise_level",
		'send_me_a_weekly_digest_of_recent_of_activity_in_my_account' => "dashboard.send_me_a_weekly_digest_of_recent_of_activity_in_my_account",
		'please_email_me_casinolineup_newsletters_and_updates_on_casinolineup_news_features' => "dashboard.please_email_me_casinolineup_newsletters_and_updates_on_casinolineup_news_features"
	),
	'dashboard.follow'    => array(
		'someone_starts_following_me' => 'dashboard.someone_starts_following_me',
		'someone_iam_following_add_a_review' => "dashboard.someone_iam_following_add_a_review",
		'someone_iam_following_add_a_photo' 	=> "dashboard.someone_iam_following_add_a_photo",
		'someone_iam_following_add_a_casino' 	=> "dashboard.someone_iam_following_add_a_casino",
		'someone_iam_following_add_a_online_casino' 	=> "dashboard.someone_iam_following_add_a_online_casino",
/* 		'someone_i_am_following_add_a_place' 	=> "dashboard.someone_i_am_following_add_a_place", */
		'someone_iam_following_add_a_information' 	=> "dashboard.someone_iam_following_add_a_information"
	),
	'dashboard.likes_and_comments'    => array(
		'someone_marks_my_stuff_as_helpful' => 'dashboard.someone_marks_my_stuff_as_helpful',
		'someone_comments_after_me_on_a_review' => "dashboard.someone_comments_after_me_on_a_review",
		'someone_doesnot_like_my_review'	=> "dashboard.someone_doesnot_like_my_review"
	)
);	
$config['image_array']    =    array('gambling_options','devices','deposit_methods','language','withdrawal_methods','guide','amenities_info');
$config['seo_array']    =    array('news_category');


define('NEWTAB','target="_blank"');
define('FILE_SIZE_IN_KB','1024kb');
define('FILE_SIZE_IN_MB','1MB');

$config['weekday']    =    array(1=>'Monday',2=>'Tuesday',3=>'Wednesday',4=>'Thrusday',5=>'Friday',6=>'Saturday',7=>'Sunday');	
$config['field_type']   =    array('text'=>'Text','email'=>'Email','link'=>'Link','phone'=>'Phone');	
 ?>