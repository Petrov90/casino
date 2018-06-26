<?php use Cake\Core\Configure;
$twitter	=	Configure::read('FollowUsOn.twitter');
$facebook	=	Configure::read('FollowUsOn.facebook'); 
$linkedin	 =	Configure::read('FollowUsOn.linkedin');
$google		 =	Configure::read('FollowUsOn.g+');

if (false === strpos($twitter, '://')) {
$twitter = 'http://' . $twitter;
}
if (false === strpos($facebook, '://')) {
$facebook = 'http://' . $facebook;
}
if (false === strpos($linkedin, '://')) {
$linkedin = 'http://' . $linkedin;
}

if (false === strpos($google, '://')) {
$google = 'http://' . $google;
} ?><div class="footer"><div class="container"><div class="row"><div class="col-md-3"><div class="footer-content"><div class="block"><span><?= __('footer.company'); ?></span></div><ul><li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms_slug','about-us')); ?>"><?= __('footer.about'); ?></a></li><li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'contactUs')); ?>"><?= __('footer.contact'); ?></a></li></ul></div></div><div class="col-md-3"><div class="footer-content"><div class="block"><span><?= __('footer.community'); ?></span></div><ul><li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'topUsers')); ?>"><?= __('footer.top_users'); ?></a></li><li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'newReviews')); ?>"><?= __('footer.new_reviews'); ?></a></li><li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'casinos','action' => 'addCasino')); ?>"><?= __('footer.add_casino'); ?></a></li></ul></div></div><div class="col-md-3"><div class="footer-content"><div class="block"><span><?= __('footer.legal'); ?></span></div><ul><li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms_slug','terms-of-use')); ?>"><?= __('footer.terms_of_use'); ?></a></li><li><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'users','action' => 'cms_slug','privacy-policy')); ?>"><?= __('footer.privacy_policy'); ?></a></li></ul></div></div><div class="col-md-3"><div class="footer-content"><div class="block"><span><?= __('footer.language'); ?></span></div> <?php echo $this->Form->create('Language');echo $this->Form->select('lan',$languageList,['id' => 'lang_change','default' => $Defaultlanguage]);echo $this->Form->end();?><div class="footer_social"><ul><li><a href="<?php echo $facebook; ?>"></a></li><li class="twit"><a href="<?php echo $twitter; ?>"></a></li><li class="goop"><a href="<?php echo $google; ?>"></a></li> <li class="linkd"><a href="<?php echo $this->Url->build(array('plugin' => '','controller' => 'news', 'action' => 'feed')); ?>"></a></li></ul></div></div></div></div></div><div class="Footer-bottom"><div class="container"><div class="copyright"><p><?php echo Configure::read('Site.copy_write'); ?></p></div></div></div></div>