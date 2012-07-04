<?php 
global $base_url; 
$wcategory = reset(taxonomy_node_get_terms_by_vocabulary($node, 14));
$wcategory = $wcategory->tid;

foreach ($node->field_rooms as $room) {
	if (strlen($room['value']['field_room_type'][0]['value']) != 0) {
		$rooms[] = $room['value'];
	} 
}

foreach ($node->field_self_catering as $selfcatering) {
	if (strlen($selfcatering['value']['field_sc_type'][0]['value']) != 0) {
		$selfcaterings[] = $selfcatering['value'];
	} 
}

foreach ($node->field_pitches as $pitch) {
	if (strlen($pitch['value']['field_park_price'][0]['value']) > 0) {
		$pitches[] = $pitch['value'];
	} 
}

?>
<div id="subnav">
		<h1>Accommodation</h1>
		<?php buildCats(14, "accommodation", $wcategory); ?>  
		</div>
<div id="itemview">
<a href="http://www.visitlichfield.co.uk/type/accommodation/category/all" class="return">&lt; Return to list</a>

<h2><?php echo check_plain($node->title); ?></h2>
<div id="desc">
<?php photoGallery($node->field_photos); ?>
<?php echo nl2p($node->field_shortdescription[0]['value']); ?>
<?php 
if (strlen($node->field_ratemyplace[0]['view']) > 0) {
$rmp = str_replace("http://www.ratemyplace.org.uk/view/", "", $node->field_ratemyplace[0]['view']); 
$rmp = explode("/", $rmp);
?>
<div id="rmp">
<script src='http://www.ratemyplace.org.uk/widget.php?id=<?php echo $rmp[0]; ?>' type='text/javascript'> </script>
</div>
<?php } ?>
<div id="awards">
<?php
foreach ($node->field_accommodation_awards as $award) {
echo taxonomy_image_display($award['value']);
}
?>
</div>
</div>

<div id="venue_info">

<h3 class="head"><span></span>Contact Details and Map</h3>
<div class="panel">
<?php
printLocation($node->location['street'], $node->location['additional'], $node->location['city'], $node->location['postal_code'], $node->field_tel[0]['view'], $node->field_email[0]['view'], $node->field_website[0]['view'], $node->location['latitude'], $node->location['longitude']);
?>
</div>

<h3 class="head"><span></span>Getting here and parking</h3>
<div class="panel">
<?php
gettingHere($node->field_roadway[0]['view'], $node->field_bus[0]['view'], $node->field_station[0]['view'], $node->field_taxi[0]['view'], $node->field_parking[0]['view']);
?>
</div>

<h3 class="head"><span></span>Booking</h3>
<div class="panel">
<?php
printField($node->field_bookingemail[0]['value'], "<strong>Email: </strong><a href=\"mailto:".$node->field_bookingemail[0]['value']."\">", "</a></p>");
printField($node->field_bookingtel[0]['value'], "<p><strong>Tel:</strong> ", "</p>");
printField($node->field_outofhours[0]['value'], "<p><strong>Out of hours Telephone:</strong>", "</p>");
cck_listview("Payment facilities", $node->field_acom_payment);

if (strlen($node->field_enjoy_staffordshire[0]['value']) > 0) {
?>
<a href="<?php echo $node->field_enjoy_staffordshire[0]['value']; ?>"><img src="http://www.visitlichfield.co.uk/sites/default/files/book-online-with-es.gif" alt="Book online with Enjoy Staffordshire" /></a>
<?php } ?>
</div>

<?php if ($node->field_onsite_facilities[0]['value'] != NULL) { ?>
<h3 class="head"><span></span>Onsite Facilities</h3>
<div class="panel">
<?php cck_listview("", $node->field_onsite_facilities); ?>
</div>
<?php } ?>

<?php if ($node->field_offsite_facilities[0]['value'] != NULL) { ?>
<h3 class="head"><span></span>Offsite Facilities</h3>
<div class="panel">
<?php cck_listview("", $node->field_offsite_facilities); ?>
</div>
<?php } ?>

<?php
if (strlen($node->field_visitlichfield_offers[0]['value']) > 0) {
?>
<h3 class="head"><span></span>Special Offers</h3>
<div class="panel">
<?php echo $node->field_visitlichfield_offers[0]['value']; ?>
<p><em>You will need a special offers card to qualify for this offer, if you don't have a card yet, please <a href="mailto:info@visitlichfield.com?subject=Special%20Offers%20Card%20Request&amp;body=Please%20supply%20your%20full%20name%20and%20address%3A%0D%0A%0D%0AIf%20you%20would%20like%20to%20receive%20the%20new%20monthly%20offers%20by%20email%20please%20supply%20your%20email%20address%3A">email</a> a member of our team&nbsp;and we will send you a free card in the post.</em></p>
</div>
<?php } ?>


<?php
if (sizeof($rooms) > 0) {
?>
<h3 class="head"><span></span>Rooms</h3>
<div class="panel">
<?php
foreach ($rooms as $room) {
?>
<div class="space">
<?php
if (strlen($room['field_room_photo'][0]['filepath']) > 0) {
$bigpath = imagecache_create_path('spaces', $room['field_room_photo'][0]['filepath']);
echo "<img src=\"". $base_url ."/". $bigpath."\" class=\"spacepic\" alt=\"\" />";
}
printField($room['field_room_name'][0]['value'], "<h4>", "</h4>");
printField($room['field_room_type'][0]['value'], "<p><strong>Room type:</strong> ", "</p>");
printField($room['field_number'][0]['value'], "<p><strong>Number of rooms:</strong> ", "</p>");
printField($room['field_room_details'][0]['value'], "<p><strong>Room details:</strong> ", "</p>");
printField($room['field_room_people'][0]['value'], "<p><strong>Sleeps:</strong> ", "</p>");
?>
<p><strong>Price:</strong>
<?php
printField($room['field_room_min_price'][0]['value'], "&pound;", "");
printField($room['field_room_max_price'][0]['value'], " - &pound;", "");
printField($room['field_room_price_type'][0]['value'], " <em>", "</em>");
?>
</p>
<?php
printField($room['field_room_notes'][0]['value'], "<p><em>", "</em></p>");
cck_listview("Facilities", $room['field_room_facilities'], "value"); 
if ($room['field_room_wheelchair'][0]['value'] == 1) {
echo "<p><em>Room is wheelchair accessible</em></p>";
}
?>
</div>
<?php
}
?>
</div>
<?php } ?>

<?php
if (sizeof($selfcaterings) > 0) {
?>
<h3 class="head"><span></span>Self Catering Units</h3>
<div class="panel">
<?php
foreach ($selfcaterings as $selfcatering) {
?>
<div class="space">
<?php
printField($selfcatering['field_sc_description'][0]['value'], "<p>", "</p>");
printField($selfcatering['field_sc_type'][0]['value'], "<p><strong>Unit type:</strong> ", "</p>");
printField($selfcatering['field_sc_number'][0]['value'], "<p><strong>Number of units:</strong> ", "</p>");
printField($selfcatering['field_sc_occupancy'][0]['value'], "<p><strong>Occupancy range:</strong> ", "</p>");
printField($selfcatering['field_sc_price'][0]['value'], "<p><strong>Price:</strong> &pound;", " ". $room['field_sc_per'][0]['value'] ."</p>");
printField($selfcatering['field_sc_pricing_notes'][0]['value'], "<p>", "</p>");
cck_listview("Facilities", $selfcatering['field_sc_facilities'], "value"); 
if ($selfcatering['field_room_wheelchair'][0]['value'] == 1) {
echo "<p><em>Room is wheelchair accessible</em></p>";
}
?>
</div>
<?php } ?>
</div>
<?php } ?>

<?php
if (sizeof($pitches) > 0) {
?>
<h3 class="head"><span></span>Pitches</h3>
<div class="panel">
<?php
foreach ($pitches as $pitch) {
?>
<div class="space">
<?php
printField($pitch['field_park_description'][0]['value'], "<p>", "</p>");
printField($pitch['field_park_price'][0]['value'], "<p><strong>Price per night:</strong> ", "</p>");
printField($room['field_park_pricingnotes'][0]['value'], "<p>", "</p>");
cck_listview("Facilities", $pitch['field_park_facilities'], "value");
?>
</div>
<?php } ?>
</div>
<?php } ?>

<h3 class="head"><span></span>Catering</h3>
<div class="panel">
<?php
if ($node->field_accomodation_restaurant[0]['view'] == "Yes") {
?>
<p><strong>Restaurant on site</strong></p>
<?php
}


if ($node->field_breakfast[0]['view'] == "Yes") {
?>
<p>Breakfast served <?php printField($node->field_breakfast_serving[0]['view'], "(", ")"); ?></p>
<?php } ?>

<?php
if ($node->field_lunches[0]['view'] == "Yes") {
?>
<p>Lunch served <?php printField($node->field_lunches_serving[0]['view'], "(", ")"); ?></p>
<?php } ?>

<?php
if ($node->field_dinner[0]['view'] == "Yes") {
?>
<p>Evening meals served <?php printField($node->field_dinner_serving[0]['view'], "(", ")"); ?></p>
<?php } ?>

<?php
if ($node->field_roomservice[0]['view'] == "Yes") {
?>
<p><strong>Room Service available</strong> 
<?php printField($node->field_roomservice_serving[0]['view'], "(", ")"); ?>
</p>
<?php } ?>

<?php
cck_listview("Dietary requirements", $node->field_dietary);
?>

<?php
cck_listview("Children's facilities", $node->field_childrenscatering);
?>

</div>

<h3 class="head"><span></span>Accessibility</h3>
<div class="panel">
<?php
cck_listview("Entering the building/attraction", $node->field_access_entry);
if (strlen($node->field_access_lifts[0]['view']) > 0) {
printField($node->field_access_steps[0]['view'], "<em>The entrance way has ", " steps </em>");
}
cck_listview("Access, lifts and ramps", $node->field_access_lifts);
if (sizeof($stairs) > 0) {
$stairs = ImplodeToEnglish($stairs);
?>
<em><?php echo $stairs; ?> only accessible by stairs</em>
<?php 
} 
cck_listview("Main pathways into and around the venue", $node->field_access_pathways);
tag_echo("em", $node->field_access_pathways_notes[0]['view']);
cck_listview("Services for wheelchair users and those with mobility issues", $node->field_access_wheelchairs);
cck_listview("Children and babies", $node->field_access_children);
cck_listview("Services for the hearing impaired", $node->field_access_deaf);
cck_listview("Services for the visually impaired", $node->field_access_blind);
cck_listview("National Accessibility Rating(s)", $node->field_access_ratings);
?>
</div>
<!--
<div id="socialmedia">
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(curPageURL()); ?>&amp;layout=standard&amp;show_faces=true&amp;width=225&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:80px; float: left;" allowTransparency="true"></iframe>

<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" style="float: right; text-align: left;">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</div>
-->

</div>

<?php
$pictotal = 0;

foreach($node->field_photos as $photo) {
	if (strlen($photo['view']) > 0) {
		$pictotal++;
	} else {
		break;
	}
}

drupal_add_js("
$(document).ready(function(){
	$('.panel').addClass('hidden');
	$('.head > span').addClass('closed');
	$('#images')._scrollable();
	
	var num = 1;
	
	$('.head').click(function() { 
		customSlideToggle($(this).next('.panel'));
		$(this).children('span').toggleClass('open');
	});
	
	$('#next').click(function() {
		if (num < ".$pictotal.") {
		num++;
		} else {
		num = 1;
		}
		$('#images').scrollTo($('.pic' + num), 420);
		$('#current').html(num);
		return false;
	});
	
	$('#prev').click(function() {
		if (num == 1) {
		num = ". $pictotal .";
		} else {
		num--;
		}
		$('#images').scrollTo($('.pic' + num), 420);
		$('#current').html(num);
		return false;
	}); 
	
	function customSlideToggle(e) {
	var show = e.hasClass('hidden');
		if (show) {
			 e.hide();
			 e.removeClass('hidden')
			 e.slideDown('slow');
		} else {
			 e.slideUp('slow', function() {
			    e.addClass('hidden');
			    e.show();
			 });
		}
	}

	
});
", 'inline');
?>
