<?php 
echo $this->Html->script(['https://maps.googleapis.com/maps/api/js?v=3&libraries=geometry,places&key&language=en&key=AIzaSyCMhDWSllv2IvaQL40G9rro0aHkeak9GoY'],array('block' =>'custom_script'));
?>
    <script>
  var bounds = new google.maps.LatLngBounds();
  
  var geocoder;
  var map;
  var bounds = new google.maps.LatLngBounds();

  function initialize(title,address,htmladr) {
    locations = [];   
  
    locations.push(['<?php echo $cityDetail->name ?>','<?php echo $cityDetail->name ?>',htmladr]);
    map = new google.maps.Map(
    document.getElementById("map_canvas"), {
      center: new google.maps.LatLng(37.4419, -122.1419),
      zoom: 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    geocoder = new google.maps.Geocoder();

    for (i = 0; i < locations.length; i++) {
    geocodeAddress(locations, i);
    }
  }
  
  function geocodeAddress(locations, i) { 
    var title = locations[i][0];
    var address = locations[i][1];
    var url = locations[i][2];
    geocoder.geocode({
      'address': locations[i][1]
    },
    function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        lt1 = results[0].geometry.location.lat();
      lng1 = results[0].geometry.location.lng();
      var marker = new google.maps.Marker({
        icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
        map: map,
        position: new google.maps.LatLng(lt1 ,lng1),
        title: title,
        center: results[0].geometry.location,
        animation: google.maps.Animation.DROP,
        address: address,
        url: url
      });
      lt1 = results[0].geometry.location.lat();
      lng1 = results[0].geometry.location.lng();
      //alert(lt1); alert(lng1);
      infoWindow(marker, map, title, address, url);
      bounds.extend(marker.getPosition());
      map.fitBounds(bounds);
      map.setZoom(13);
      map.setCenter(new google.maps.LatLng(lt1 ,lng1),);
      
      }
    });
  }

  function infoWindow(marker, map, title, address, url) {
  var htmls = "<div><h4><a href="+url+">" + title + "</a></h4><p>" + address + "<br></div></p></div>";
    google.maps.event.addListener(marker, 'click', function() {
    var html = "<div><h4><a href="+url+">" + title + "</a></h4><p>" + address + "<br></div></p></div>";
    iw = new google.maps.InfoWindow({
      content: html,
      maxWidth: 350
    });
    iw.open(map, marker);
    });
    var infowindow = new google.maps.InfoWindow({
          content: htmls
      });
    infowindow.open(map, marker);
  }

  function createMarker(results) {
    var marker = new google.maps.Marker({
    icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',
    map: map,
    position: results[0].geometry.location,
    title: title,
    animation: google.maps.Animation.DROP,
    address: address,
    url: url
    })
    bounds.extend(marker.getPosition());
    map.fitBounds(bounds);
    infoWindow(marker, map, title, address, url);
    return marker;
  }
    
    </script>
<style type="text/css">
   select {
   background: #fff none repeat scroll 0 0;
   display: inline-block;
   height:28px;
   margin: 0 7px 0 0 !important;
   overflow: hidden;
   position: relative;
   width: 180px !important;
   border: none;
   color: #000 !important;
   }
   /* Custom Select */
   .select {
   position: relative;
   display: block;
   width: 180px !important;
   height: 28px;
   font-size: 12px;
   background: #2c3e50;
   overflow: hidden;
   color: #393838 !important;
   margin: 0 4px 0 0 !important;
   border: 1px solid #dbdbdb;
   }
   select {
   width: 100%;
   margin: 0;
   padding: 0 0 0 .5em;
   color: #fff;
   cursor: pointer;
   }
   select::-ms-expand {
   display: none;
   }
   /* Arrow */
   .select::after {
   content: '\25BC';
   position: absolute;
   top: 4px;
   right: 0;
   bottom: 0;
   padding: 0 1em;
   background: #fff;
   pointer-events: none;
   color: #393838;
   }
   /* Transition */
   .select:hover::after {
   }
   .select::after {
   -webkit-transition: .25s all ease;
   -o-transition: .25s all ease;
   transition: .25s all ease;
   }
   .banner_parg-right > div {
   background: #fff none repeat scroll 0 0;
   float: left;
   margin-left: -15px;
   min-height: 230px;
   padding: 10px 10px 10px 30px;
   border: 1px solid #dbdbdb;
   }
   .center-on-page {
   background: #fff none repeat scroll 0 0;
   display: inline-flex;
   padding: 5px;
   width: 100%;}
   .prev.disabled {
   display: none;
   }
   .online_casino_search_filter {
    background: #012331 none repeat scroll 0 0;
    float: left;
    margin-bottom: -56px;
    width: 100%;
}
.city-page .fil_block{
   padding: 11px 0 !important;
}
</style>

<div class="online_casino_search_filter">
  <div class="banner_info banner_textblock">
  </div>
</div>
<?php //echo "<pre>"; print_r($cityDetail); die; ?>
<div class="mid_wrapper city-page">
<div class="ed_inf">

    <div class="filter_2N new-block">

      <div class="fil_block new-fil-block">

        <div class="container">

          <div class="row">

            <div class="col-md-12">
              <?php //$countrydetails = $this->SocialShare->countryslug($cityDetail->country_id); 
              // $url1 = $this->Url->build(array('controller' => 'users','action' => 'country_view','country' => $countrydetails->slug,'city' => $cityDetail->slug)); ?>
              <ul>
                <li><a href="<?php echo WEBSITE_URL.$cityDetail->slug; ?>">About <?php echo $cityDetail->name; ?></a></li>

                <li class="active"><a href=""><?php echo $cityDetail->name; ?> Casinos</a></li>

                <li><a href=""><?php echo $cityDetail->name; ?> Hotels</a></li>

              </ul>

              

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>
</div>

<div class="mid_wrapper onlinecasino-mid">
   <div class="casinoSearch casinoSearch1">
      <div class="container">
          <div class="title">
            <h2><?php echo $cityDetail->name; ?>&nbsp;&nbsp;&nbsp;<span style="font-size:14px;"><?php echo $cityDetail->review_count; ?> reviews</span></h2> 
          </div>
          
          <div class="row">
             <div class="col-md-8">
                <div class="filter_2N new-block">
                   <div class="fil_block new-fil-block">
                      <ul>
                          <?php 
                         $page	 	= ($page > 1) ? 'page='.$page.'&' : ''; 
						 $rating1 	= ($rating == 'asc') ? 'rating=desc' : 'rating=asc';  ?>
                         <li><strong>Sort by:</strong></li>
                         <li class="<?php echo ($order == 'avg_rating') ? 'active' : '' ?>"><a  class="<?php echo ($order == 'avg_rating') ? $rating : '' ?>" href="<?php echo $this->Url->build('/'.$cityDetail->slug.'/casinos').'?'.$page.$rating1 ?>">User Rating</a></li>
                         
                         <li class="<?php echo ($order == 'avg_rating') ? 'active' : '' ?>"><a  class="<?php echo ($order == 'avg_rating') ? $rating : '' ?>" href="<?php echo $this->Url->build('/'.$cityDetail->slug.'/casinos').'?'.$page.$rating1 ?>">Recommended</a></li>
                         
                         <li class="<?php echo ($order == 'avg_rating') ? 'active' : '' ?>"><a  class="<?php echo ($order == 'avg_rating') ? $rating : '' ?>" href="<?php echo $this->Url->build('/'.$cityDetail->slug.'/casinos').'?'.$page.$rating1 ?>">Name</a></li>
                      </ul>
                   </div>
                   <p class="casino-list"><?= $this->Paginator->param('count'); ?> Casino listed</p>
                </div>
             </div>
          </div>
          
          <div class="filtrInner">
             <div class="row">
                <div class="col-md-8">
                   <div class="clint_info">
                      <div class="data_div">
                         <?php echo $this->element('country_casino_search_filter'); ?>
                      </div>
                   </div>
                </div>
                <div class="col-md-4">
                   <div class="gamblingBox side_bar_box side_bar_box1">
                   <div class="mapFreme">
                    
                    <h2 style="background-color:#aa1d2d;font-size::15px; text-align:center;color:#fff;padding:6px; margin:0px 0px 1px;">Map</h2>
                    <div id="map_canvas"></div>
                  </div>
                  <form method="post" accept-charset="utf-8" id="pchec" action="/ccsr/ccsr1" class="ng-pristine ng-valid"><div style="display:none"><input type="hidden" name="_method" value="POST"></div><ul class="rightTabs"><li><div class="pptionsBox side_bar_post side_bar_post1"><h2 class="active" style='background-color:#fff;color:#5d5d5d;font-weight:bold;'><img src="http://www.casinoo.com/downarrow.png">&nbsp;&nbsp;&nbsp;&nbsp;Games</h2><div class="pptionsBoxIn side_bar_ptions"><ul><li><div class="checbox"><label><input type="hidden" name="gambling_options[448]" value="0"><input type="checkbox" name="gambling_options[448]" value="1" class="pr_che"><span></span> 21+3</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[572]" value="0"><input type="checkbox" name="gambling_options[572]" value="1" class="pr_che"><span></span> 21+3 Xtreme</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[399]" value="0"><input type="checkbox" name="gambling_options[399]" value="1" class="pr_che"><span></span> 3 card poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[576]" value="0"><input type="checkbox" name="gambling_options[576]" value="1" class="pr_che"><span></span> 3 card poker progressive </label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[413]" value="0"><input type="checkbox" name="gambling_options[413]" value="1" class="pr_che"><span></span> 5 Card Draw Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[544]" value="0"><input type="checkbox" name="gambling_options[544]" value="1" class="pr_che"><span></span> 6 card poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[514]" value="0"><input type="checkbox" name="gambling_options[514]" value="1" class="pr_che"><span></span> 7 Card Stud</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[505]" value="0"><input type="checkbox" name="gambling_options[505]" value="1" class="pr_che"><span></span> 7UP Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[464]" value="0"><input type="checkbox" name="gambling_options[464]" value="1" class="pr_che"><span></span> American Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[510]" value="0"><input type="checkbox" name="gambling_options[510]" value="1" class="pr_che"><span></span> Arizona Hold 'Em Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[524]" value="0"><input type="checkbox" name="gambling_options[524]" value="1" class="pr_che"><span></span> Asia Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[57]" value="0"><input type="checkbox" name="gambling_options[57]" value="1" class="pr_che"><span></span> Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[484]" value="0"><input type="checkbox" name="gambling_options[484]" value="1" class="pr_che"><span></span> Banca Francesa</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[446]" value="0"><input type="checkbox" name="gambling_options[446]" value="1" class="pr_che"><span></span> Big 6</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[538]" value="0"><input type="checkbox" name="gambling_options[538]" value="1" class="pr_che"><span></span> Big Wheel</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[6]" value="0"><input type="checkbox" name="gambling_options[6]" value="1" class="pr_che"><span></span> Bingo</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[7]" value="0"><input type="checkbox" name="gambling_options[7]" value="1" class="pr_che"><span></span> Blackjack</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[419]" value="0"><input type="checkbox" name="gambling_options[419]" value="1" class="pr_che"><span></span> Blackjack - Single Deck </label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[420]" value="0"><input type="checkbox" name="gambling_options[420]" value="1" class="pr_che"><span></span> Blackjack Double Deck</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[438]" value="0"><input type="checkbox" name="gambling_options[438]" value="1" class="pr_che"><span></span> Blackjack Match the Dealer</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[425]" value="0"><input type="checkbox" name="gambling_options[425]" value="1" class="pr_che"><span></span> Blackjack No Bust </label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[477]" value="0"><input type="checkbox" name="gambling_options[477]" value="1" class="pr_che"><span></span> Blackjack Plus</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[551]" value="0"><input type="checkbox" name="gambling_options[551]" value="1" class="pr_che"><span></span> Blackjack Super 7's</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[478]" value="0"><input type="checkbox" name="gambling_options[478]" value="1" class="pr_che"><span></span> Blackjack Switch</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[518]" value="0"><input type="checkbox" name="gambling_options[518]" value="1" class="pr_che"><span></span> Buster Blackjack</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[400]" value="0"><input type="checkbox" name="gambling_options[400]" value="1" class="pr_che"><span></span> Caribbean Stud Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[476]" value="0"><input type="checkbox" name="gambling_options[476]" value="1" class="pr_che"><span></span> Casino Hold'em Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[469]" value="0"><input type="checkbox" name="gambling_options[469]" value="1" class="pr_che"><span></span> Casino War</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[567]" value="0"><input type="checkbox" name="gambling_options[567]" value="1" class="pr_che"><span></span> Chase the Flush</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[530]" value="0"><input type="checkbox" name="gambling_options[530]" value="1" class="pr_che"><span></span> Chuck A Luck</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[506]" value="0"><input type="checkbox" name="gambling_options[506]" value="1" class="pr_che"><span></span> Commission Free Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[503]" value="0"><input type="checkbox" name="gambling_options[503]" value="1" class="pr_che"><span></span> Community / Multi-Player Slots</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[58]" value="0"><input type="checkbox" name="gambling_options[58]" value="1" class="pr_che"><span></span> Craps</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[561]" value="0"><input type="checkbox" name="gambling_options[561]" value="1" class="pr_che"><span></span> Craps No More</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[450]" value="0"><input type="checkbox" name="gambling_options[450]" value="1" class="pr_che"><span></span> Crazy 4 Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[570]" value="0"><input type="checkbox" name="gambling_options[570]" value="1" class="pr_che"><span></span> Crazy 4 Poker Progressive</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[581]" value="0"><input type="checkbox" name="gambling_options[581]" value="1" class="pr_che"><span></span> Crazy Pineapple</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[557]" value="0"><input type="checkbox" name="gambling_options[557]" value="1" class="pr_che"><span></span> Criss Cross Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[483]" value="0"><input type="checkbox" name="gambling_options[483]" value="1" class="pr_che"><span></span> Cussec</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[569]" value="0"><input type="checkbox" name="gambling_options[569]" value="1" class="pr_che"><span></span> Deuces Wild</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[516]" value="0"><input type="checkbox" name="gambling_options[516]" value="1" class="pr_che"><span></span> Dice</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[439]" value="0"><input type="checkbox" name="gambling_options[439]" value="1" class="pr_che"><span></span> Double Action Blackjack</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[496]" value="0"><input type="checkbox" name="gambling_options[496]" value="1" class="pr_che"><span></span> Double Attack Blackjack</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[444]" value="0"><input type="checkbox" name="gambling_options[444]" value="1" class="pr_che"><span></span> Double Draw Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[560]" value="0"><input type="checkbox" name="gambling_options[560]" value="1" class="pr_che"><span></span> Double Hand Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[445]" value="0"><input type="checkbox" name="gambling_options[445]" value="1" class="pr_che"><span></span> Double Up Blackjack</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[552]" value="0"><input type="checkbox" name="gambling_options[552]" value="1" class="pr_che"><span></span> Dragon Bonus Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[475]" value="0"><input type="checkbox" name="gambling_options[475]" value="1" class="pr_che"><span></span> Dragon Elements Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[563]" value="0"><input type="checkbox" name="gambling_options[563]" value="1" class="pr_che"><span></span> Draw Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[491]" value="0"><input type="checkbox" name="gambling_options[491]" value="1" class="pr_che"><span></span> Easy Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[472]" value="0"><input type="checkbox" name="gambling_options[472]" value="1" class="pr_che"><span></span> Electronic Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[481]" value="0"><input type="checkbox" name="gambling_options[481]" value="1" class="pr_che"><span></span> Electronic Bingo</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[427]" value="0"><input type="checkbox" name="gambling_options[427]" value="1" class="pr_che"><span></span> Electronic Blackjack</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[442]" value="0"><input type="checkbox" name="gambling_options[442]" value="1" class="pr_che"><span></span> Electronic Craps</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[435]" value="0"><input type="checkbox" name="gambling_options[435]" value="1" class="pr_che"><span></span> Electronic Keno</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[579]" value="0"><input type="checkbox" name="gambling_options[579]" value="1" class="pr_che"><span></span> Electronic Mini-Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[436]" value="0"><input type="checkbox" name="gambling_options[436]" value="1" class="pr_che"><span></span> Electronic Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[504]" value="0"><input type="checkbox" name="gambling_options[504]" value="1" class="pr_che"><span></span> Electronic Sic Bo</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[401]" value="0"><input type="checkbox" name="gambling_options[401]" value="1" class="pr_che"><span></span> Electronic Tables</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[573]" value="0"><input type="checkbox" name="gambling_options[573]" value="1" class="pr_che"><span></span> Emperors Challenge</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[417]" value="0"><input type="checkbox" name="gambling_options[417]" value="1" class="pr_che"><span></span> Emperor's Challenge Pai Gow Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[463]" value="0"><input type="checkbox" name="gambling_options[463]" value="1" class="pr_che"><span></span> European Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[424]" value="0"><input type="checkbox" name="gambling_options[424]" value="1" class="pr_che"><span></span> EZ Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[423]" value="0"><input type="checkbox" name="gambling_options[423]" value="1" class="pr_che"><span></span> EZ Pai Gow</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[402]" value="0"><input type="checkbox" name="gambling_options[402]" value="1" class="pr_che"><span></span> Fan Tan</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[59]" value="0"><input type="checkbox" name="gambling_options[59]" value="1" class="pr_che"><span></span> Financials</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[497]" value="0"><input type="checkbox" name="gambling_options[497]" value="1" class="pr_che"><span></span> Flop Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[526]" value="0"><input type="checkbox" name="gambling_options[526]" value="1" class="pr_che"><span></span> Fortune 3 Card Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[554]" value="0"><input type="checkbox" name="gambling_options[554]" value="1" class="pr_che"><span></span> Fortune Asia Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[416]" value="0"><input type="checkbox" name="gambling_options[416]" value="1" class="pr_che"><span></span> Fortune Pai Gow Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[580]" value="0"><input type="checkbox" name="gambling_options[580]" value="1" class="pr_che"><span></span> Fortune Pai Gow Progressive</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[428]" value="0"><input type="checkbox" name="gambling_options[428]" value="1" class="pr_che"><span></span> Four Card Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[479]" value="0"><input type="checkbox" name="gambling_options[479]" value="1" class="pr_che"><span></span> Free Bet Blackjack</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[482]" value="0"><input type="checkbox" name="gambling_options[482]" value="1" class="pr_che"><span></span> French Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[522]" value="0"><input type="checkbox" name="gambling_options[522]" value="1" class="pr_che"><span></span> Genting Stud Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[493]" value="0"><input type="checkbox" name="gambling_options[493]" value="1" class="pr_che"><span></span> GranDice</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[441]" value="0"><input type="checkbox" name="gambling_options[441]" value="1" class="pr_che"><span></span> Greyhounds</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[558]" value="0"><input type="checkbox" name="gambling_options[558]" value="1" class="pr_che"><span></span> Harness Racing</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[553]" value="0"><input type="checkbox" name="gambling_options[553]" value="1" class="pr_che"><span></span> Heads Up Hold'em</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[536]" value="0"><input type="checkbox" name="gambling_options[536]" value="1" class="pr_che"><span></span> hello test yogi</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[437]" value="0"><input type="checkbox" name="gambling_options[437]" value="1" class="pr_che"><span></span> High Card Flush</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[574]" value="0"><input type="checkbox" name="gambling_options[574]" value="1" class="pr_che"><span></span> Hit &amp; Run 21</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[433]" value="0"><input type="checkbox" name="gambling_options[433]" value="1" class="pr_che"><span></span> Horseracing</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[565]" value="0"><input type="checkbox" name="gambling_options[565]" value="1" class="pr_che"><span></span> In Bet</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[511]" value="0"><input type="checkbox" name="gambling_options[511]" value="1" class="pr_che"><span></span> Jai Alai</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[60]" value="0"><input type="checkbox" name="gambling_options[60]" value="1" class="pr_che"><span></span> Keno</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[403]" value="0"><input type="checkbox" name="gambling_options[403]" value="1" class="pr_che"><span></span> Let It Ride</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[431]" value="0"><input type="checkbox" name="gambling_options[431]" value="1" class="pr_che"><span></span> Let It Ride Bonus Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[545]" value="0"><input type="checkbox" name="gambling_options[545]" value="1" class="pr_che"><span></span> Limit Holdem</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[515]" value="0"><input type="checkbox" name="gambling_options[515]" value="1" class="pr_che"><span></span> Limit Hold'em</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[527]" value="0"><input type="checkbox" name="gambling_options[527]" value="1" class="pr_che"><span></span> Live Dealer eBaccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[61]" value="0"><input type="checkbox" name="gambling_options[61]" value="1" class="pr_che"><span></span> Live Games</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[10]" value="0"><input type="checkbox" name="gambling_options[10]" value="1" class="pr_che"><span></span> Lottery</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[421]" value="0"><input type="checkbox" name="gambling_options[421]" value="1" class="pr_che"><span></span> Lucky Lucky Blackjack</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[556]" value="0"><input type="checkbox" name="gambling_options[556]" value="1" class="pr_che"><span></span> Lunar Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[539]" value="0"><input type="checkbox" name="gambling_options[539]" value="1" class="pr_che"><span></span> Mahjong</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[492]" value="0"><input type="checkbox" name="gambling_options[492]" value="1" class="pr_che"><span></span> Midi Punto Banco</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[499]" value="0"><input type="checkbox" name="gambling_options[499]" value="1" class="pr_che"><span></span> Midi-Baccarat </label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[507]" value="0"><input type="checkbox" name="gambling_options[507]" value="1" class="pr_che"><span></span> Midi-Dice</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[422]" value="0"><input type="checkbox" name="gambling_options[422]" value="1" class="pr_che"><span></span> Mini-Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[447]" value="0"><input type="checkbox" name="gambling_options[447]" value="1" class="pr_che"><span></span> Mississippi Stud</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[548]" value="0"><input type="checkbox" name="gambling_options[548]" value="1" class="pr_che"><span></span> Mixed Games</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[457]" value="0"><input type="checkbox" name="gambling_options[457]" value="1" class="pr_che"><span></span> Money Wheel</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[517]" value="0"><input type="checkbox" name="gambling_options[517]" value="1" class="pr_che"><span></span> Mystery Card Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[578]" value="0"><input type="checkbox" name="gambling_options[578]" value="1" class="pr_che"><span></span> NL Holdem</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[582]" value="0"><input type="checkbox" name="gambling_options[582]" value="1" class="pr_che"><span></span> NL Texas Hold'em</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[562]" value="0"><input type="checkbox" name="gambling_options[562]" value="1" class="pr_che"><span></span> No Craps Craps</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[546]" value="0"><input type="checkbox" name="gambling_options[546]" value="1" class="pr_che"><span></span> No Limit Holdem</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[513]" value="0"><input type="checkbox" name="gambling_options[513]" value="1" class="pr_che"><span></span> No Limit Texas Hold'em</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[520]" value="0"><input type="checkbox" name="gambling_options[520]" value="1" class="pr_che"><span></span> Off-track betting</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[512]" value="0"><input type="checkbox" name="gambling_options[512]" value="1" class="pr_che"><span></span> Omaha</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[547]" value="0"><input type="checkbox" name="gambling_options[547]" value="1" class="pr_che"><span></span> Omaha 8 or Better</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[577]" value="0"><input type="checkbox" name="gambling_options[577]" value="1" class="pr_che"><span></span> Omaha Hi</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[414]" value="0"><input type="checkbox" name="gambling_options[414]" value="1" class="pr_che"><span></span> Omaha Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[404]" value="0"><input type="checkbox" name="gambling_options[404]" value="1" class="pr_che"><span></span> Pai Gow Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[405]" value="0"><input type="checkbox" name="gambling_options[405]" value="1" class="pr_che"><span></span> Pai Gow Tiles</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[555]" value="0"><input type="checkbox" name="gambling_options[555]" value="1" class="pr_che"><span></span> Panda 8 Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[519]" value="0"><input type="checkbox" name="gambling_options[519]" value="1" class="pr_che"><span></span> Pechanga Craps</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[62]" value="0"><input type="checkbox" name="gambling_options[62]" value="1" class="pr_che"><span></span> Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[564]" value="0"><input type="checkbox" name="gambling_options[564]" value="1" class="pr_che"><span></span> Poker Plus</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[501]" value="0"><input type="checkbox" name="gambling_options[501]" value="1" class="pr_che"><span></span> Pontoon</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[550]" value="0"><input type="checkbox" name="gambling_options[550]" value="1" class="pr_che"><span></span> Pot Limit Omaha</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[509]" value="0"><input type="checkbox" name="gambling_options[509]" value="1" class="pr_che"><span></span> Power Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[494]" value="0"><input type="checkbox" name="gambling_options[494]" value="1" class="pr_che"><span></span> Progressive 3-Card Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[480]" value="0"><input type="checkbox" name="gambling_options[480]" value="1" class="pr_che"><span></span> Progressive Blackjack</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[440]" value="0"><input type="checkbox" name="gambling_options[440]" value="1" class="pr_che"><span></span> Progressive Pai Gow Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[542]" value="0"><input type="checkbox" name="gambling_options[542]" value="1" class="pr_che"><span></span> Progressive Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[523]" value="0"><input type="checkbox" name="gambling_options[523]" value="1" class="pr_che"><span></span> Progressive Texas Hold'em</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[541]" value="0"><input type="checkbox" name="gambling_options[541]" value="1" class="pr_che"><span></span> Pula puti</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[418]" value="0"><input type="checkbox" name="gambling_options[418]" value="1" class="pr_che"><span></span> Pull tabs</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[465]" value="0"><input type="checkbox" name="gambling_options[465]" value="1" class="pr_che"><span></span> Punto Banco</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[430]" value="0"><input type="checkbox" name="gambling_options[430]" value="1" class="pr_che"><span></span> Racebook</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[490]" value="0"><input type="checkbox" name="gambling_options[490]" value="1" class="pr_che"><span></span> Raise 'Em Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[540]" value="0"><input type="checkbox" name="gambling_options[540]" value="1" class="pr_che"><span></span> Raise'Em Poker Progressive Jackpot</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[468]" value="0"><input type="checkbox" name="gambling_options[468]" value="1" class="pr_che"><span></span> Rapid Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[467]" value="0"><input type="checkbox" name="gambling_options[467]" value="1" class="pr_che"><span></span> Rapid Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[531]" value="0"><input type="checkbox" name="gambling_options[531]" value="1" class="pr_che"><span></span> Red dog</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[22]" value="0"><input type="checkbox" name="gambling_options[22]" value="1" class="pr_che"><span></span> Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[525]" value="0"><input type="checkbox" name="gambling_options[525]" value="1" class="pr_che"><span></span> Russian Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[406]" value="0"><input type="checkbox" name="gambling_options[406]" value="1" class="pr_che"><span></span> Sands Stud Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[63]" value="0"><input type="checkbox" name="gambling_options[63]" value="1" class="pr_che"><span></span> Scratchcards</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[487]" value="0"><input type="checkbox" name="gambling_options[487]" value="1" class="pr_che"><span></span> Sharpshooter </label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[408]" value="0"><input type="checkbox" name="gambling_options[408]" value="1" class="pr_che"><span></span> Sic Bo</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[498]" value="0"><input type="checkbox" name="gambling_options[498]" value="1" class="pr_che"><span></span> Simulcasting</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[508]" value="0"><input type="checkbox" name="gambling_options[508]" value="1" class="pr_che"><span></span> Singapore Stud Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[488]" value="0"><input type="checkbox" name="gambling_options[488]" value="1" class="pr_che"><span></span> Single Zero Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[549]" value="0"><input type="checkbox" name="gambling_options[549]" value="1" class="pr_che"><span></span> Sit-n-go</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[8]" value="0"><input type="checkbox" name="gambling_options[8]" value="1" class="pr_che"><span></span> Slot machines</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[409]" value="0"><input type="checkbox" name="gambling_options[409]" value="1" class="pr_che"><span></span> Spanish 21</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[9]" value="0"><input type="checkbox" name="gambling_options[9]" value="1" class="pr_che"><span></span> Sports Betting</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[429]" value="0"><input type="checkbox" name="gambling_options[429]" value="1" class="pr_che"><span></span> Sportsbook</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[434]" value="0"><input type="checkbox" name="gambling_options[434]" value="1" class="pr_che"><span></span> Squeeze Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[571]" value="0"><input type="checkbox" name="gambling_options[571]" value="1" class="pr_che"><span></span> Straight Jack Progressive</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[415]" value="0"><input type="checkbox" name="gambling_options[415]" value="1" class="pr_che"><span></span> Strip Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[489]" value="0"><input type="checkbox" name="gambling_options[489]" value="1" class="pr_che"><span></span> Stud Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[500]" value="0"><input type="checkbox" name="gambling_options[500]" value="1" class="pr_che"><span></span> Super Fun 21</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[543]" value="0"><input type="checkbox" name="gambling_options[543]" value="1" class="pr_che"><span></span> Super Six</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[537]" value="0"><input type="checkbox" name="gambling_options[537]" value="1" class="pr_che"><span></span> Swim Up Gaming</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[575]" value="0"><input type="checkbox" name="gambling_options[575]" value="1" class="pr_che"><span></span> Texas Hold'em</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[495]" value="0"><input type="checkbox" name="gambling_options[495]" value="1" class="pr_che"><span></span> Texas Hold'em Bonus</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[449]" value="0"><input type="checkbox" name="gambling_options[449]" value="1" class="pr_che"><span></span> Texas Shootout</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[474]" value="0"><input type="checkbox" name="gambling_options[474]" value="1" class="pr_che"><span></span> Three Card Baccarat</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[443]" value="0"><input type="checkbox" name="gambling_options[443]" value="1" class="pr_che"><span></span> Three Card Blackjack</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[502]" value="0"><input type="checkbox" name="gambling_options[502]" value="1" class="pr_che"><span></span> Three Pictures</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[521]" value="0"><input type="checkbox" name="gambling_options[521]" value="1" class="pr_che"><span></span> Tournaments</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[466]" value="0"><input type="checkbox" name="gambling_options[466]" value="1" class="pr_che"><span></span> Trente et Quarante</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[412]" value="0"><input type="checkbox" name="gambling_options[412]" value="1" class="pr_che"><span></span> Ultimate Texas Hold'em</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[566]" value="0"><input type="checkbox" name="gambling_options[566]" value="1" class="pr_che"><span></span> Ultimate Texas Hold'em Progressive</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[426]" value="0"><input type="checkbox" name="gambling_options[426]" value="1" class="pr_che"><span></span> Video Keno</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[410]" value="0"><input type="checkbox" name="gambling_options[410]" value="1" class="pr_che"><span></span> Video Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[411]" value="0"><input type="checkbox" name="gambling_options[411]" value="1" class="pr_che"><span></span> Wheel of Fortune</label></div></li></ul></div></div></li><li><div class="pptionsBox side_bar_post"><h2 class="active"  style='background-color:#fff;color:#5d5d5d;font-weight:bold;'><img src="http://www.casinoo.com/downarrow.png">&nbsp;&nbsp;&nbsp;&nbsp;Evaluation</h2><div class="pptionsBoxIn side_bar_ptions"><ul><li><div class="checbox"><label><input name="rating[5]" type="checkbox" class="pr_che" value="5"><span></span><samp><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></samp></label></div></li><li><div class="checbox"><label><input name="rating[4]" type="checkbox" class="pr_che" value="4"><span></span><samp><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></samp></label></div></li><li><div class="checbox"><label><input name="rating[3]" type="checkbox" class="pr_che" value="3"><span></span><samp><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></samp></label></div></li><li><div class="checbox"><label><input name="rating[2]" type="checkbox" class="pr_che" value="2"><span></span><samp><i class="fa fa-star"></i><i class="fa fa-star"></i></samp></label></div></li><li><div class="checbox"><label><input name="rating[1]" type="checkbox" class="pr_che" value="1"><span></span><samp><i class="fa fa-star"></i></samp></label></div></li></ul></div></div></li><li><div class="pptionsBox side_bar_post"><h2 class="active"  style='background-color:#fff;color:#5d5d5d;font-weight:bold;'><img src="http://www.casinoo.com/downarrow.png">&nbsp;&nbsp;&nbsp;&nbsp;Parking</h2><div class="pptionsBoxIn side_bar_ptions"><ul><li><div class="checbox"><label><input type="hidden" name="gambling_options[448]" value="0"><input type="checkbox" name="gambling_options[448]" value="1" class="pr_che"><span></span> Self Parking</label></div></li><li><div class="checbox"><label><input type="hidden" name="gambling_options[572]" value="0"><input type="checkbox" name="gambling_options[572]" value="1" class="pr_che"><span></span> Valet Parking</label></div></li></li></ul></div></div></li><!-- <li><div class="pptionsBox side_bar_post"><h2 class="active">Parking</h2><div class="pptionsBoxIn side_bar_ptions"><ul><li><div class="checbox"><label><input type="hidden" name="aminities[45]" value="0"/><input type="checkbox" name="aminities[45]" value="1" class="pr_che"><span></span> Bank</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[42]" value="0"/><input type="checkbox" name="aminities[42]" value="1" class="pr_che"><span></span> Bar</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[48]" value="0"/><input type="checkbox" name="aminities[48]" value="1" class="pr_che"><span></span> Barber shop</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[49]" value="0"/><input type="checkbox" name="aminities[49]" value="1" class="pr_che"><span></span> Beauty Salon</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[31]" value="0"/><input type="checkbox" name="aminities[31]" value="1" class="pr_che"><span></span> Bingo</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[36]" value="0"/><input type="checkbox" name="aminities[36]" value="1" class="pr_che"><span></span> Bowling</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[43]" value="0"/><input type="checkbox" name="aminities[43]" value="1" class="pr_che"><span></span> Cafeteria</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[52]" value="0"/><input type="checkbox" name="aminities[52]" value="1" class="pr_che"><span></span> Car rental</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[32]" value="0"/><input type="checkbox" name="aminities[32]" value="1" class="pr_che"><span></span> Electronic games</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[35]" value="0"/><input type="checkbox" name="aminities[35]" value="1" class="pr_che"><span></span> Fitness Center</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[39]" value="0"/><input type="checkbox" name="aminities[39]" value="1" class="pr_che"><span></span> Garden</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[40]" value="0"/><input type="checkbox" name="aminities[40]" value="1" class="pr_che"><span></span> Golf</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[51]" value="0"/><input type="checkbox" name="aminities[51]" value="1" class="pr_che"><span></span> Hotel</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[47]" value="0"/><input type="checkbox" name="aminities[47]" value="1" class="pr_che"><span></span> Internet</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[33]" value="0"/><input type="checkbox" name="aminities[33]" value="1" class="pr_che"><span></span> Lottery</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[44]" value="0"/><input type="checkbox" name="aminities[44]" value="1" class="pr_che"><span></span> Money exchange</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[50]" value="0"/><input type="checkbox" name="aminities[50]" value="1" class="pr_che"><span></span> Parking</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[29]" value="0"/><input type="checkbox" name="aminities[29]" value="1" class="pr_che"><span></span> Poker</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[41]" value="0"/><input type="checkbox" name="aminities[41]" value="1" class="pr_che"><span></span> Restaurant</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[30]" value="0"/><input type="checkbox" name="aminities[30]" value="1" class="pr_che"><span></span> Roulette</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[37]" value="0"/><input type="checkbox" name="aminities[37]" value="1" class="pr_che"><span></span> Shopping</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[38]" value="0"/><input type="checkbox" name="aminities[38]" value="1" class="pr_che"><span></span> Show</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[46]" value="0"/><input type="checkbox" name="aminities[46]" value="1" class="pr_che"><span></span> Spa</label></div></li><li><div class="checbox"><label><input type="hidden" name="aminities[34]" value="0"/><input type="checkbox" name="aminities[34]" value="1" class="pr_che"><span></span> Sport betting</label></div></li></ul></div></div></li> --></ul></form>
                   <?php //echo $this->cell('Inbox::citycasinosearchpage');  ?>
                   </div>
                </div>
             </div>
          </div>

      </div>
  </div>
</div>
<?php 

// $title = $cityDetail->name;
// $address = $title." ".$cityDetail->country_name;
// $countrydetails1 = $this->SocialShare->countryslug($cityDetail->country_id);
// $htmlurl1 = $this->Url->build(array('controller' => 'users','action' => 'city_view','country' => $countrydetails1->slug,'city' => $cityDetail->slug));
//echo "<pre>"; print_r($cityDetail); die; ?>
<?php $this->Html->scriptStart(array('block' => 'custom_script')); ?>

initialize('<?php echo str_replace("'","",$title); ?>','<?php echo str_replace("'","",$address); ?>','<?php echo str_replace("'","",$htmlurl1); ?>');

<?php $this->Html->scriptEnd(); ?>

<?php 

echo $this->Html->css(['jquery-ui.min.css'],array('block' =>'css1'));
echo $this->Html->script(['jqueryslider.js'],array('block' =>'footer_script')); 

$this->Html->scriptStart(array('block' => 'custom_script')); ?>

function casino_search(){ 
   form_id  = 'pchec';
 var data = {},
        fdata = [],
        loc = $('<a>', {href:window.location})[0];
    $('input[type="checkbox"]').each(function(i){
      if(this.checked){
        if(!data.hasOwnProperty(this.name)){
          data[this.name] = [];
        }
        name  = this.name;
        name = name.replace(/[[]]/g, "");
        console.log(name);
        data[this.name].push(this.value);
      }
    });
    /* $.each(data, function(k, v){
        fdata[k] = [v.join(',')];
    }); */
    // fdata = fdata.join('&');

    if(history.pushState){
        // history.pushState(null, null, loc.pathname+'?'+fdata);
    }
   $(".data_div").html('<div class="text-center"><img src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>');
   $('html, body').animate({scrollTop: ($(".data_div").offset().top - 200)}, 'slow');
  var options = {
    type: 'post',
    success:function(r){
      data    = JSON.parse(r) ;
      $(".data_div").html(data.data);
      $('html, body').animate({scrollTop: ($(".data_div").offset().top - 200)}, 'slow');
      $('.readonly').raty({
        readOnly : true,
        score: function() {
          return $(this).attr('data-score');
        }
      });
    },
    resetForm:false
  }; 
  $("form#"+form_id).ajaxSubmit(options);
}

$(function(){
  $('.readonly').raty({
    readOnly : true,
    score: function() {
      return $(this).attr('data-score');
    }
  });
  
  $(document).on('click', '#pagination a', function(e) {
    e.preventDefault();     
    var target = $(this).attr('href');
    if(target != ''){
       $(".data_div,#pagination a").css({'cursor' : 'wait'});
      /* $(".data_div").html('<div class="text-center"><img src="<?php echo WEBSITE_IMG_URL.'ajax-loading.gif'; ?>" /></div>'); */
      $.get(target, function(r){
        $(".data_div,#pagination a").css({'cursor' : 'default'});
        $(".data_div").html(r.data);
        $('.readonly').raty({
          readOnly : true,
          score: function() {
            return $(this).attr('data-score');
          }
        });
      }, 'json');
    }
  });
  $(".pr_che").change(function(){
    casino_search();
  });
   $(".side_bar_post > h3").click(function(){
     var class1 = $(this).attr('class');
     if(class1=='active'){
      $(this).next('.side_bar_ptions').addClass('hide');
      $(this).removeClass('active');
     }else{
      $(this).next('.side_bar_ptions').removeClass('hide');
      $(this).addClass('active');    
     }
   });
    $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 300,
    values: [ 0, 300 ],
    slide: function( event, ui ) {
      $( "#p_min" ).val(ui.values[ 0 ]);
      $( "#p_min_html" ).html(ui.values[ 0 ]+'H');
      $( "#p_max" ).val(ui.values[ 1 ]);
      $( "#p_max_html" ).html(ui.values[ 1 ]+'H');
    },
    change: function( event, ui ) {
      casino_search();
    }
    });
  $( "#p_min" ).val(0);
  $( "#p_max" ).val(300);
  $( "#p_min_html" ).html('0H');  
  $( "#p_max_html" ).html('300H');
  
  $( "#payout_percentage" ).val(0);
  $( "#payout_percentage_max" ).val(100);
  $( "#payout_percentageh" ).html('0%');
  $( "#payout_percentageh_max" ).html('100%');
  
    $( "#payout_percentages" ).slider({
    range: true,
    min: 0,
    max: 100,
    values: [ 0,100],
    slide: function( event, ui ) {
      $( "#payout_percentage" ).val(ui.values[ 0 ]);
      $( "#payout_percentage_max" ).val(ui.values[ 1 ]);
      $( "#payout_percentageh" ).html(ui.values[ 0 ]+'%');
      $( "#payout_percentageh_max" ).html(ui.values[ 1 ]+'%');
    },
    change: function( event, ui ) {
      casino_search();
    }
    }); 
  <?php if(!empty($selectedId)){ ?>
  setTimeout(function(){
    $("#<?php echo $selectedId; ?>").prop('checked', true);
  },2000);
  <?php } ?>  
});


<?php $this->Html->scriptEnd(); ?>