<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// echo 23;
function pr($data){
	echo '<pre>';
		print_r($data);
	echo '</pre>';
}
	include_once('simple_html_dom.php');
	include_once("Curl.php");
	
	$c      =    new Net_curl(); 
	
	$url	=	"https://www.worldcasinodirectory.com/alabama/casino-list";		
	
	$c->Net_Curl($url, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0');
	$jt    =$c->execute();

	$html  =str_get_html($jt); 
	
	// pr($html->plaintext);
	// $html->find(".city-casino-list-table",0)->plaintext;
	$arra	=	array();
	$k=0;
	foreach($html->find(".city-casino-list-table",0)->find(".casino-row") as $prodtab)
	{
		$i = 0;
		foreach($prodtab->find('td') as $cell) {
		/* foreach($prodtab as $prodtab1)
		{ */
			if($i == 0){
			   $href	=		$cell->find("a",0)->href; 
			   
			   
			   echo $url	=		$href;
	
	
			$c->Net_Curl($url, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0');
			echo $jt    =    $c->execute();
		
			echo $html  		=	str_get_html($jt); 
			try{
			$p = 0;
			foreach($html->find("#content",0)->find(".row") as $prodtab1)
	                {
	                 if($p == 3){
			      $gender 	=	$prodtab1->find("a",0)->href;
			      $arra[$k]['website']	=  $gender;
			   }
			   $p++;
			}
			}   
			  
			  catch(Exception $e){
				 $arra[$k]['email']	=  '';
			}
			   
			   $arra[$k]['name']	=	$cell->plaintext;
			}
			
			if($i == 2){
			   $arra[$k]['phone']	=	$cell->plaintext;
			}
			if($i == 3){
			   $arra[$k]['address']	=	$cell->plaintext;
			}
			$i++;
		} 
			$k++;
	}
	pr($arra);
	exit;
?>