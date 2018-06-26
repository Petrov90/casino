<?php 
use Cake\Core\Configure;

$here = $this->request->here();

$canonical = $this->Url->build($here, true);

 $plugin        =   $this->request->params['plugin'];

 $controller    =   $this->request->params['controller'];

 $action        =   $this->request->params['action'];  ?>

<!DOCTYPE html>

<html lang="<?php echo (!empty($Defaultlanguage)) ? $Defaultlanguage :'en'; ?>">

<head>

<?php echo $this->Html->charset(); ?>

<title><?php echo isset($pageTitle) ? $pageTitle : __('title.homepage');

    $metaDescription    =   (isset($metaDescription) ? $metaDescription : __('metadescription.homepage')); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">



    <?php /*<meta property="og:url" content="<?php echo $canonical; ?>" />

    <meta property="og:type" content="article" />

    <meta property="og:title" content="<?php echo $pageTitle; ?>" />

    <meta property="og:description" content="<?php echo $metaDescription; ?>" />

    <meta property="og:site_name" content="CasinoLineup" />

    <meta property="fb:app_id" content="1069561843098094" />



    <meta itemprop="name" content="<?php echo $pageTitle; ?>"/>

    <meta itemprop="description" content="<?php echo $metaDescription; ?>"/>



    <meta name="twitter:card" content="summary"/>  <!-- Card type -->

    <meta name="twitter:site" content="CasinoLineup"/>

    <meta name="twitter:title" content="<?php echo $pageTitle; ?>">

    <meta name="twitter:description" content="<?php echo $metaDescription; ?>"/>

    <meta name="twitter:creator" content="CasinoLineup"/>

    <meta name="twitter:domain" content="<?php echo WEBSITE_URL; ?>"/>

    <?php if(isset($shareImage)){ ?>

        <meta name="twitter:image:src" content="<?php echo $shareImage; ?>"/>

        <meta property="og:image" content="<?php echo $shareImage; ?>" />

        <meta itemprop="image" content="<?php echo $shareImage; ?>"/>

    <?php } */ ?>

<?php if(SUBDIR ==''){ ?>

<meta name="google-site-verification" content="DW0n9hlh9qppmoXsjIlnOHbzW54AwOA0jskLJC6EU7g" />

<?php }

        echo $this->fetch('css1');

    echo $this->Html->meta('description',$metaDescription);

    /* if(Configure::read('debug')){ */

        echo $this->Html->css(array('bootstrap.css','custom.css','font-awesome.css','autocomplete.css','jquery.raty.css','pnotify.custom.min.css','stylesheet.css','bootstrap-select.css'),array('block' =>'css'));

    /* }else{

        echo $this->element('home_page_css',[],['cache' => true]);

    }    */

    echo $this->fetch('meta');

    echo $this->fetch('css');

    ?>

    <link rel="stylesheet" href="<?php echo WEBSITE_CSS_URL ?>font.css"/>



</head>

<body>





<?php if(SUBDIR ==''){ ?>

<script>

!function(e,t,a,n,c,s,o){e.GoogleAnalyticsObject=c,e[c]=e[c]||function(){(e[c].q=e[c].q||[]).push(arguments)},e[c].l=1*new Date,s=t.createElement(a),o=t.getElementsByTagName(a)[0],s.async=1,s.src=n,o.parentNode.insertBefore(s,o)}(window,document,"script","https://www.google-analytics.com/analytics.js","ga"),ga("create","UA-84809368-1","auto"),ga("send","pageview");

</script>

<?php }else{ ?>

    <script>

// !function(e,t,a,n,c,s,o){e.GoogleAnalyticsObject=c,e[c]=e[c]||function(){(e[c].q=e[c].q||[]).push(arguments)},e[c].l=1*new Date,s=t.createElement(a),o=t.getElementsByTagName(a)[0],s.async=1,s.src=n,o.parentNode.insertBefore(s,o)}(window,document,"script","https://www.google-analytics.com/analytics.js","ga"),ga("create","UA-90022735-1","auto"),ga("send","pageview");

</script>

<?php } ?>

<div id="ajax-loader" class="loading-indicator fancy hide"><div class="clock"><div class="hand minute"></div><div class="hand hour"></div></div></div>

<?php echo $this->element('header_menu'); ?>

<script>WEBSITE_UPLOADS_URL ='<?php echo WEBSITE_URL; ?>';</script>

<?php

echo  $this->fetch('content');

echo $this->element('footer');
