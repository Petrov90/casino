<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Cache\Cache;
use Cake\ORM\TableRegistry;
/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */ $exp_domain= explode(".",env("HTTP_HOST"));
 // pr($exp_domain);
Router::defaultRouteClass('DashedRoute');
Router::extensions(['xlsx']);
Router::extensions(['json']);
Router::extensions('rss');
Router::prefix('admin', function ($routes) {
   
    $routes->connect('/', ['controller' => 'users', 'action' => 'login']);	
    $routes->connect('/dashboard', ['controller' => 'users', 'action' => 'dashboard']);	
    $routes->connect('/edit_profile', array('plugin' => '','controller' => 'users', 'action' => 'edit_profile'));	
    $routes->connect('/logout', array('plugin' => '','controller' => 'users', 'action' => 'logout'));
	
	// $routes->connect('/emailtemplate/index', array('plugin' => 'emailtemplate','controller' => 'email_templates','action' => 'index'));
	$routes->connect('/cms/index', array('plugin' => 'cms','controller' => 'cms_pages','action' => 'index'));
	$routes->connect('/add', array('plugin' => '','controller' => 'users','action' => 'add'));
	 
	$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'InflectedRoute']);
    $routes->connect('/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);
    $routes->connect('/:plugin/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);
	
	$routes->connect('/add', array('plugin' => '','controller' => 'users','action' => 'add'));
	
	// Casino controller
	// $routes->connect('/casino/*', array('plugin' => '','controller' => 'users'));
	
	$routes->plugin('Setting', ['path' => '/setting'], function ($routes) {
        $routes->connect('/:controller/:action/*');
    });
	
	$routes->plugin('EmailTemplate', ['path' => '/email_template'], function ($routes) {
        $routes->connect('/:controller/:action/*');
    });
	$routes->plugin('Master', ['path' => '/master'], function ($routes) {
        $routes->connect('/:controller/:action/*');
    });
	$routes->plugin('TextSetting', ['path' => '/textsetting'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	 });
	 
	$routes->plugin('CityManager', ['path' => '/city_manager'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	  
	$routes->plugin('Cms', ['path' => '/cms'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	 
	$routes->plugin('Block', ['path' => '/block'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('Contact', ['path' => '/contact'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('Slider', ['path' => '/slider'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('Promotion', ['path' => '/promotion'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('Category', ['path' => '/category'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('GuideContent', ['path' => '/guide_content'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('News', ['path' => '/news'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	 $routes->plugin('Custom', ['path' => '/custom'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	
	$routes->plugin('CasinoActivities', ['path' => '/activity'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('UploadImage', ['path' => '/upload'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	 
	
	 $routes->fallbacks('DashedRoute');
});

Router::scope('/', function (RouteBuilder $routes) {
	$online_casino_country	=	'test';
	if (($online_casino_country = Cache::read('online_casino_country','longlong')) === false) {
		$online_casino_country	 =  TableRegistry::get('Categories');
		$online_casino_country	 =	$online_casino_country->find('list', [
				'keyField' => 'slug',
				'valueField' => 'slug'
			])->where(['categorie_type' => 'countries'])->toList();
		$online_casino_country	=	implode($online_casino_country,"|");
		Cache::write('online_casino_country', $online_casino_country,'longlong');
	}	
	
	$routes->connect('/:language', 
		['plugin' => '','controller' => 'users', 'action' => 'index'],
		['language' => 'de|en|es']
	);	
	$routes->connect('/:country', 
		['plugin' => '','controller' => 'Casinos', 'action' => 'onlineCasino'],
		['pass' => ['country'],'country' => $online_casino_country]
	);	
	
	$routes->connect(
		'/:country_view',
		['plugin' => '','controller' => 'Users','action' => 'country_view'],
		['pass' => ['country_view']]
	);
	
	
	$routes->connect('/:language/online-casinos',
		['plugin' => '','controller' => 'casinos', 'action' => 'onlineCasino'],
		['language' => 'de|en|es']
	);
	
	$routes->connect('webroot/admin/',
		['plugin' => '','controller' => 'webroot', 'action' => 'admin']
	);
	
	
    $routes->connect('/', ['plugin' => '','controller' => 'users', 'action' => 'index']);
	
	
    $routes->connect('/feed', ['plugin' => '','controller' => 'news', 'action' => 'feed']);
	
	
	$routes->connect('/online-casinos', ['plugin' => '','controller' => 'casinos', 'action' => 'onlineCasino']);	
	
	$routes->connect('/users/get_reviews', ['plugin' => '','controller' => 'users', 'action' => 'getReviews']);	
	
	$routes->connect('/users/get_all_reviews', ['plugin' => '','controller' => 'users', 'action' => 'getAllReviews']);	
	
	$routes->connect(
		'/:language/about',
		['plugin' => '','controller' => 'users','action' => 'cms_slug','about-us']
	); 
	
	$routes->connect(
		'/about',
		['plugin' => '','controller' => 'users','action' => 'cms_slug','about-us']
	);
		
	$routes->connect(
		'/:language/privacy-policy',
		['plugin' => '','controller' => 'users','action' => 'cms_slug','privacy-policy']
	); 
	$routes->connect(
		'/privacy-policy',
		['plugin' => '','controller' => 'users','action' => 'cms_slug','privacy-policy']
	);
	$routes->connect(
		'/:language/terms-of-use',
		['plugin' => '','controller' => 'users','action' => 'cms_slug','terms-of-use']
	); 
	$routes->connect(
		'/terms-of-use',
		['plugin' => '','controller' => 'users','action' => 'cms_slug','terms-of-use']
	);
	
	
	$routes->connect(
		'/:language/guide/:guide_view',
		['plugin' => '','controller' => 'Users','action' => 'guide_view'],
		['pass' => ['guide_view']]
	);
	
	$routes->connect(
		'/guide/:guide_view',
		['plugin' => '','controller' => 'Users','action' => 'guide_view'],
		['pass' => ['guide_view']]
	);
	
	
	$routes->connect(
		'/:language/news/:news_view',
		['plugin' => '','controller' => 'news','action' => 'news_view'],
		['pass' => ['news_view','language'],'language' => 'de|en|es']
	);
	
	
	
	$routes->connect('/:language/news', ['plugin' => '','controller' => 'news', 'action' => 'news']);
	$routes->connect('/news', ['plugin' => '','controller' => 'news', 'action' => 'news']);
	
	
	
	$routes->connect(
		'/news/:news_view',
		['plugin' => '','controller' => 'news','action' => 'news_view'],
		['pass' => ['news_view','language'],'language' => 'de|en|es']
	);
	
	$routes->connect('/:language/casino-directory', ['plugin' => '','controller' => 'users', 'action' => 'locations']);
	$routes->connect('/casino-directory', ['plugin' => '','controller' => 'users', 'action' => 'locations']);
	
	$routes->connect('/:language/facebook', ['plugin' => '','controller' => 'users', 'action' => 'facebook']);
	$routes->connect('/facebook', ['plugin' => '','controller' => 'users', 'action' => 'facebook']);
	
	$routes->connect('/:language/fbsignup', ['plugin' => '','controller' => 'users', 'action' => 'fbsignup']);
	$routes->connect('/fbsignup', ['plugin' => '','controller' => 'users', 'action' => 'fbsignup']);
	
	$routes->connect('/:language/city_autocomplete/*', ['plugin' => '','controller' => 'users', 'action' => 'city_autocomplete']);
	$routes->connect('/city_autocomplete/*', ['plugin' => '','controller' => 'users', 'action' => 'city_autocomplete']);
	
	
	$routes->connect('/:language/login', ['plugin' => '','controller' => 'users', 'action' => 'login']);
	$routes->connect('/login', ['plugin' => '','controller' => 'users', 'action' => 'login']);
	
	$routes->connect('/:language/logout', ['plugin' => '','controller' => 'users', 'action' => 'logout']);
	$routes->connect('/logout', ['plugin' => '','controller' => 'users', 'action' => 'logout']);
	
	$routes->connect('/:language/signup', ['plugin' => '','controller' => 'users', 'action' => 'signup']);
	$routes->connect('/signup', ['plugin' => '','controller' => 'users', 'action' => 'signup']);
	
	$routes->connect('/:language/forgot_password', ['plugin' => '','controller' => 'users', 'action' => 'forgot_password']);
	$routes->connect('/forgot_password', ['plugin' => '','controller' => 'users', 'action' => 'forgot_password']);
	
	$routes->connect('/:language/reset_password', ['plugin' => '','controller' => 'users', 'action' => 'resetPassword']);
	$routes->connect('/reset_password', ['plugin' => '','controller' => 'users', 'action' => 'resetPassword']);
	
	$routes->connect('/:language/contact', ['plugin' => '','controller' => 'users', 'action' => 'contactUs']);
	$routes->connect('/contact', ['plugin' => '','controller' => 'users', 'action' => 'contactUs']);
	
	$routes->connect('/:language/leaderboard', ['plugin' => '','controller' => 'users', 'action' => 'topUsers']);
	$routes->connect('/leaderboard', ['plugin' => '','controller' => 'users', 'action' => 'topUsers']);
	
	$routes->connect('/:language/new-casino-reviews', ['plugin' => '','controller' => 'users', 'action' => 'newReviews']);
	$routes->connect('/new-casino-reviews', ['plugin' => '','controller' => 'users', 'action' => 'newReviews']);
	
	$routes->connect('/:language/add-casino', ['plugin' => '','controller' => 'casinos', 'action' => 'addCasino']);
	$routes->connect('/add-casino', ['plugin' => '','controller' => 'casinos', 'action' => 'addCasino']);	
	
	$routes->connect('/:language/online-casino-search/online-casino-search', ['plugin' => '','controller' => 'casinos', 'action' => 'onlineCasinoSearch']);
	$routes->connect('/online-casino-search/online-casino-search', ['plugin' => '','controller' => 'casinos', 'action' => 'onlineCasinoSearch']);	
	
	$routes->connect('/:language/bonus-search/bonus-search', ['plugin' => '','controller' => 'promotions', 'action' => 'promotionSearch']);
	$routes->connect('/bonus-search/bonus-search', ['plugin' => '','controller' => 'promotions', 'action' => 'promotionSearch']);
	
	
	$routes->connect('/:language/write-a-review', ['plugin' => '','controller' => 'users', 'action' => 'addReview']);
	$routes->connect('/write-a-review', ['plugin' => '','controller' => 'users', 'action' => 'addReview']);
	
	// pr($routes);
	
	$routes->connect('/online-casinos/sort/:stype/:direction', 
		['plugin' => '','controller' => 'casinos', 'action' => 'onlineCasino'],
		['pass' => ['stype','direction']]
	);	
	$routes->connect('/:language/online-casinos/sort/:stype/:direction', 
		['plugin' => '','controller' => 'casinos', 'action' => 'onlineCasino'],
		['pass' => ['language','stype','direction'],'language' => 'de|en|es']
	);	
	
	
	
	$routes->connect('/:language/online-casinos/:stype', 
		['plugin' => '','controller' => 'casinos', 'action' => 'onlineCasino'],
		['pass' => ['language','stype'],'language' => 'de|en|es']
	);	
	
	
	$routes->connect('/:language/casinos_json/online_casinos_json', ['plugin' => '','controller' => 'casinos', 'action' => 'onlineCasinoJson']);
	$routes->connect('/casinos_json/online_casinos_json', ['plugin' => '','controller' => 'casinos', 'action' => 'onlineCasinoJson']);
	
	$routes->connect('/:language/language', ['plugin' => '','controller' => 'users', 'action' => 'change_lang']);
	$routes->connect('/language', ['plugin' => '','controller' => 'users', 'action' => 'change_lang']);
	
	$routes->connect('/:language/casinos/casino_amenities/*', ['plugin' => '','controller' => 'casinos', 'action' => 'casino_amenities']);
	$routes->connect('/casinos/casino_amenities/*', ['plugin' => '','controller' => 'casinos', 'action' => 'casino_amenities']);
	
	$routes->connect('/casino-by-slug/*', ['plugin' => '','controller' => 'casinos', 'action' => 'casinoBySlug']);
	
	
	$routes->connect('/captcha/*', ['plugin' => '','controller' => 'users', 'action' => 'captcha']);
	
	
	$routes->connect(
		'/:language/search/:casino_slug', 
		['plugin' => '','controller' => 'Casinos', 'action' => 'casino_slug'],
		['pass' => ['casino_slug']]
	);
	
	$routes->connect(
		'/search/:casino_slug',
		['plugin' => '','controller' => 'Casinos', 'action' => 'casino_slug'],
		['pass' => ['casino_slug']]
	);
	
	$routes->connect(
		'/:language/search', 
		['plugin' => '','controller' => 'Casinos', 'action' => 'casino_slug'],
		['pass' => ['casino_slug']]
	);
	
	$routes->connect(
		'/search',
		['plugin' => '','controller' => 'Casinos', 'action' => 'casino_slug'],
		['pass' => ['casino_slug']]
	);
	
	$routes->connect(
		'/:language/cms/:cms_slug',
		['plugin' => '','controller' => 'users','action' => 'cms_slug'],
		['pass' => ['cms_slug']]
	); 
	$routes->connect(
		'/cms/:cms_slug',
		['plugin' => '','controller' => 'users','action' => 'cms_slug'],
		['pass' => ['cms_slug']]
	);
	
	$routes->connect(
		'/:language/city/:city_view',
		['plugin' => '','controller' => 'Users','action' => 'city_view'],
		['pass' => ['city_view']]
	); 
	
	$routes->connect(
		'/city/:city_view',
		['plugin' => '','controller' => 'Users','action' => 'city_view'],
		['pass' => ['city_view']]
	);
	
	
	$routes->connect(
		'/:language/casino/:casino_view',
		['plugin' => '','controller' => 'Casinos','action' => 'casino_view'],
		['pass' => ['casino_view']]
	);
	$routes->connect(
		'/casino/:casino_view',
		['plugin' => '','controller' => 'Casinos','action' => 'casino_view'],
		['pass' => ['casino_view']]
	);
	
	$routes->connect(
		'/:language/online-casinos/:online_casino_view',
		['plugin' => '','controller' => 'Casinos','action' => 'online_casino_view'],
		['pass' => ['online_casino_view']]
	);
	$routes->connect(
		'/online-casinos/:online_casino_view',
		['plugin' => '','controller' => 'Casinos','action' => 'online_casino_view'],
		['pass' => ['online_casino_view']]
	);
	
	$routes->connect(
		'/casinos/review',
		['plugin' => '','controller' => 'Casinos','action' => 'list_reviews']
	);
	
	$routes->connect(
		'/:language/user/:user_slug',
		['plugin' => '','controller' => 'Users','action' => 'user_slug'],
		['pass' => ['user_slug']]
	);
	$routes->connect(
		'/user/:user_slug',
		['plugin' => '','controller' => 'Users','action' => 'user_slug'],
		['pass' => ['user_slug']]
	);
	
	$routes->connect(
		'/:language/continenent/:continenent',
		['plugin' => '','controller' => 'Users','action' => 'continenent'],
		['pass' => ['continenent']]
	);
	$routes->connect(
		'/continenent/:continenent',
		['plugin' => '','controller' => 'Users','action' => 'continenent'],
		['pass' => ['continenent']]
	);
	
	$routes->connect(
		'/:language/north-america-and-caribbean',
		['plugin' => '','controller' => 'Users','action' => 'northAmericaAndCaribbean']
	);	
	$routes->connect(
		'/north-america-and-caribbean',
		['plugin' => '','controller' => 'Users','action' => 'northAmericaAndCaribbean']
	);
	$routes->connect(
		'/:language/europe',
		['plugin' => '','controller' => 'Users','action' => 'europe']
	);
	$routes->connect(
		'/europe',
		['plugin' => '','controller' => 'Users','action' => 'europe']
	);	
	$routes->connect(
		'/:language/asia',
		['plugin' => '','controller' => 'Users','action' => 'asia']
	);
	$routes->connect(
		'/asia',
		['plugin' => '','controller' => 'Users','action' => 'asia']
	);
	$routes->connect(
		'/:language/africa',
		['plugin' => '','controller' => 'Users','action' => 'africa']
	);	
	$routes->connect(
		'/africa',
		['plugin' => '','controller' => 'Users','action' => 'africa']
	);	
	
	$routes->connect(
		'/:language/oceania',
		['plugin' => '','controller' => 'Users','action' => 'Australia']
	);
	$routes->connect(
		'/oceania',
		['plugin' => '','controller' => 'Users','action' => 'Australia']
	);	
	$routes->connect(
		'/:language/south-america',
		['plugin' => '','controller' => 'Users','action' => 'SouthAmerica']
	);
	$routes->connect(
		'/south-america',
		['plugin' => '','controller' => 'Users','action' => 'SouthAmerica']
	);
	
	$routes->connect('/:language/online-gambling-guide', ['plugin' => '','controller' => 'users', 'action' => 'guide']);
	$routes->connect('/online-gambling-guide', ['plugin' => '','controller' => 'users', 'action' => 'guide']);
	
	$routes->connect('/:language/page/article', ['plugin' => '','controller' => 'users', 'action' => 'article']);
	$routes->connect('/page/article', ['plugin' => '','controller' => 'users', 'action' => 'article']);
	
/* 	
	$routes->connect(
		'/:language/:promotion',
		['plugin' => '','controller' => 'Promotions','action' => 'promotion'],
		['pass' => ['promotion']]
	);
	$routes->connect(
		'/:promotion',
		['plugin' => '','controller' => 'Promotions','action' => 'promotion'],
		['pass' => ['promotion']]
	);
	 */
	
	
	$routes->connect('/:language/casino-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'promotion']);
	$routes->connect('/casino-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'promotion']);	
	
	$routes->connect('/:language/welcome-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'welcomeBonuses']);
	$routes->connect('/welcome-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'welcomeBonuses']);
	
	$routes->connect('/:language/free-spins', ['plugin' => '','controller' => 'Promotions', 'action' => 'freeSpins']);
	$routes->connect('/free-spins', ['plugin' => '','controller' => 'Promotions', 'action' => 'freeSpins']);
	
	$routes->connect('/:language/no-deposit-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'noDepoitBonus']);
	$routes->connect('/no-deposit-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'noDepoitBonus']);
	
	$routes->connect('/:language/reload-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'reloadBonus']);
	$routes->connect('/reload-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'reloadBonus']);
	
	$routes->connect('/:language/cash-back-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'cashBackBonus']);
	$routes->connect('/cash-back-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'cashBackBonus']);
	
	$routes->connect('/:language/high-roller-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'highRollerBonus']);
	$routes->connect('/high-roller-bonus', ['plugin' => '','controller' => 'Promotions', 'action' => 'highRollerBonus']);
	
	
	
	
	$routes->connect('/:language/poker', ['plugin' => '','controller' => 'Casinos', 'action' => 'pokers']);
	$routes->connect('/poker', ['plugin' => '','controller' => 'Casinos', 'action' => 'pokers']);
	
	$routes->connect('/:language/bingo', ['plugin' => '','controller' => 'Casinos', 'action' => 'bingos']);
	$routes->connect('/bingo', ['plugin' => '','controller' => 'Casinos', 'action' => 'bingos']);
	
	
	
	$routes->connect('/:language/bingo/sort/:stype/:direction', 
		['plugin' => '','controller' => 'casinos', 'action' => 'bingos'],
		['language' => 'de|en|es','pass' => ['stype']]
	);	
	$routes->connect('/bingo/sort/:stype/:direction', 
		['plugin' => '','controller' => 'casinos', 'action' => 'bingos'],
		['pass' => ['stype']]
	);	
	
	$routes->connect('/:language/sports-betting', ['plugin' => '','controller' => 'Casinos', 'action' => 'sportBettings']);
	$routes->connect('/sports-betting', ['plugin' => '','controller' => 'Casinos', 'action' => 'sportBettings']);
	
	$routes->connect('/:language/ccsr/ccsr1', ['plugin' => '','controller' => 'casinos', 'action' => 'ccsr']);
	$routes->connect('/ccsr/ccsr1', ['plugin' => '','controller' => 'casinos', 'action' => 'ccsr']);
	
	
	
	#### After login ####
	$routes->connect('/:language/globaluser/dashboard', ['plugin' => '','controller' => 'globalusers', 'action' => 'index']);
	$routes->connect('/globaluser/dashboard', ['plugin' => '','controller' => 'globalusers', 'action' => 'index']);
	$routes->connect('/globalusers/updateprofile', ['plugin' => '','controller' => 'globalusers', 'action' => 'updateprofile']);
	$routes->connect('/globalusers/updatepreference', ['plugin' => '','controller' => 'globalusers', 'action' => 'updatepreference']);
	$routes->connect('/globalusers/updateprofilepic', ['plugin' => '','controller' => 'globalusers', 'action' => 'updateprofilepic']);
	
	
	$routes->connect('/users/like', ['plugin' => '','controller' => 'users', 'action' => 'like']);
	$routes->connect('/users/review_delete', ['plugin' => '','controller' => 'users', 'action' => 'review_delete']);
	$routes->connect('/users/add_review_comment', ['plugin' => '','controller' => 'users', 'action' => 'add_review_comment']);
	$routes->connect('/users/delete_review_comment', ['plugin' => '','controller' => 'users', 'action' => 'delete_review_comment']);
	$routes->connect('/users/follow', ['plugin' => '','controller' => 'users', 'action' => 'follow']);

	$routes->connect('/users/facebook2', ['plugin' => '','controller' => 'users', 'action' => 'facebook2']);
	
	
	$routes->connect('/questions/index', ['plugin' => '','controller' => 'questions', 'action' => 'index']);
	$routes->connect('/questions/add', ['plugin' => '','controller' => 'questions', 'action' => 'add']);
	$routes->connect('/questions/add_answer_comment', ['plugin' => '','controller' => 'questions', 'action' => 'addAnswerComment']);
	$routes->connect('/questions/list_all_answer', ['plugin' => '','controller' => 'questions', 'action' => 'listAllAnswer']);
	
	$routes->connect('/questions/questionlikes', ['plugin' => '','controller' => 'questions', 'action' => 'questionlikes']);
	
	$routes->connect('/questions/delete', ['plugin' => '','controller' => 'questions', 'action' => 'delete']);
	$routes->connect('/questions/update', ['plugin' => '','controller' => 'questions', 'action' => 'update']);
	
	$routes->connect('/globalusers/cntributions', ['plugin' => '','controller' => 'globalusers', 'action' => 'cntributions']);
	
	$routes->connect('/globalusers/casinolove', ['plugin' => '','controller' => 'globalusers', 'action' => 'casinolove']);
	
	$routes->connect('/users/usersAutocomplate', ['plugin' => '','controller' => 'users', 'action' => 'usersAutocomplate']);
	
	
	$routes->connect('/globalusers/loadmorevisits', ['plugin' => '','controller' => 'globalusers', 'action' => 'loadmorevisits']);
	$routes->connect('/globalusers/loadmorelikess', ['plugin' => '','controller' => 'globalusers', 'action' => 'loadmorelikess']);
	
	
	$routes->connect('/users/upload_image', ['plugin' => '','controller' => 'users', 'action' => 'upload_image']);
	$routes->connect('/users/report_as_spam', ['plugin' => '','controller' => 'users', 'action' => 'reportAsSpam']);
	$routes->connect('/question/report_as_spam', ['plugin' => '','controller' => 'questions', 'action' => 'reportAsSpam']);
	
	$routes->connect('/globalusers/upload_image', ['plugin' => '','controller' => 'globalusers', 'action' => 'upload_image']);
	$routes->connect('/globalusers/casino_search', ['plugin' => '','controller' => 'globalusers', 'action' => 'casino_search']);

	$routes->connect('/globalusers/casino_like_search', ['plugin' => '','controller' => 'globalusers', 'action' => 'casino_like_search']);
	
	$routes->connect('/globalusers/upload_image_cover', ['plugin' => '','controller' => 'globalusers', 'action' => 'upload_image_cover']);
	$routes->connect('/users/listfollow/:userslug', 
		['plugin' => '','controller' => 'users', 'action' => 'listfollow'],
		['slug' => ['userslug']]
		);
	// 192.168.0.195/casino/users/follow?id=82&rel=yes
	
	$routes->connect('/messages/add', ['plugin' => '','controller' => 'messages', 'action' => 'add']);
	// 192.168.0.195/casino/messages/add
	$routes->connect(
		'/:language/g/:casino_name',
		['plugin' => '','controller' => 'Users','action' => 'casino_name'],
		['pass' => ['casino_name']]
	);
	
	$routes->connect(
		'/g/:casino_name',
		['plugin' => '','controller' => 'users','action' => 'casino_name'],
		['pass' => ['casino_name']]
	);

	$routes->connect(
		'/:language/:country_view',
		['plugin' => '','controller' => 'Users','action' => 'country_view'],
		['pass' => ['country_view'],'language' => 'de|en|es']
	); 
	
	
	$routes->connect('/:language/:country', 
		['plugin' => '','controller' => 'Casinos', 'action' => 'onlineCasino'],
		['pass' => ['country'],'language' => 'de|en|es']
	);
	
	
	$routes->connect('/:country/:city', 
		['plugin' => '','controller' => 'users', 'action' => 'city_view'],
		['pass' => ['country','city']]
	);	
	$routes->connect('/:language/:country/:city', 
		['plugin' => '','controller' => 'users', 'action' => 'city_view'],
		['language' => 'de|en|es','pass' => ['country','city']]
	);	
	
	
    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});
   // Router::extensions('rss');
/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
