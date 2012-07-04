<?php 
global $base_url; 
$venue = node_load($node->field_conferencevenue[0]['nid']);
?>
<div id="subnav">
		<h1>Weddings and <br />conferences</h1>
		  <ul id="cats">
		  <li><a href="http://www.enjoyeaststaffs.co.uk/type/weddings/category/all" class="cat1">Weddings</a></li>
		  <li><a href="http://www.enjoyeaststaffs.co.uk/type/conferences/category/all" class="cat2 selected">Conferences</a></li>
		  </ul></div>
<div id="itemview">
<a href="http://www.enjoyeaststaffs.co.uk/type/conferences/category/alll" class="return">&lt; Return to list</a>

<h2><?php echo check_plain($node->title); ?></h2>
<div id="desc">

<?php photoGallery($node->field_photos); ?>
<?php echo nl2p($node->field_shortdescription[0]['value']); ?>
<?php
$licences = taxonomy_node_get_terms_by_vocabulary($node, 13);
if (sizeof($licences) > 0) {
?>
<ul>
<?php
foreach ($licences as $licence) {
?>
<li><?php echo $licence->name; ?></li>
<?php } ?>
</ul>
<?php } ?>

</div>

<div id="venue_info">

<?php
if ($node->field_planner[0]['value'] == 1) {
?>
<h3 class="head"><span></span>Conference planning service</h3>
<div class="panel">
<?php
printField($node->field_planner_name[0]['value'], "<p><strong>Planner's name:</strong>", "</p>");
printField($node->field_planner_tel[0]['value'], "<p><strong>Planner's telephone number:</strong>", "</p>");
printField($node->field_planner_email[0]['value'], "<p><strong>Planner's email:</strong>", "</p>");
?>
</div>
<?php }?>

<h3 class="head"><span></span>Catering</h3>
<div class="panel">
<?php cck_listview("Catering", $node->field_catering); ?>
<?php cck_listview("Food and menus", $node->field_food); ?>
</div>

<h3 class="head"><span></span>Contact Details and Map</h3>
<div class="panel">
<?php
if ($node->field_conferencevenue[0]['nid'] == NULL) {
printLocation($node->location['street'], $node->location['additional'], $node->location['city'], $node->location['postal_code'], $node->field_tel[0]['value'], $node->field_email[0]['value'], $node->field_website[0]['value'], $node->location['latitude'], $node->location['longitude']);
} else {
$venue = node_load($node->field_conferencevenue[0]['nid']);
printLocation($venue->location['street'], $venue->location['additional'], $venue->location['city'], $venue->location['postal_code'], $venue->field_tel[0]['value'], $venue->field_email[0]['value'], $venue->field_website[0]['value'], $venue->location['latitude'], $venue->location['longitude']);

}
?>
</div>

<h3 class="head"><span></span>Rooms / Spaces</h3>
<div class="panel">
<?php
foreach ($node->field_conferencespaces as $space) {
?>
<div class="space">
<?php
if (strlen($space['value']['field_photo'][0]['filepath']) > 0) {
$bigpath = imagecache_create_path('spaces', $space['value']['field_photo'][0]['filepath']);
echo "<img src=\"". $base_url ."/". $bigpath."\" class=\"spacepic\" alt=\"\" />";
}
printField($space['value']['field_spacename'][0]['value'], "<h4>", "</h4>");
printField($space['value']['field_space_description'][0]['value'], "<p>", "</p>");
printField($space['value']['field_width'][0]['value'], "<p><strong>Size:</strong> ", "m x ". $space['value']['field_length'][0]['value'] ."m</p>");
printField($space['value']['field_max_seating'][0]['value'], "<p><strong>Maximum seating:</strong> ", "</p>");
printField($space['value']['field_min_seating'][0]['value'], "<p><strong>Minimum seating:</strong> ", "</p>");
if ($space['value']['field_callcost'][0]['value'] != 0) {
?>
<p><em>Call for pricing information</em></p>
<?php
} else {
printField($space['value']['field_day_hire'][0]['value'], "<p><strong>Day hire:</strong> ", "</p>");
printField($space['value']['field_halfday_hire'][0]['value'], "<p><strong>Half Day hire:</strong> ", "</p>");
printField($space['value']['field_perhead'][0]['value'], "<p><strong>Minimum cost per head:</strong> ", "</p>");
}
cck_listview("Available seating arrangements", $space['value']['field_seating']);
cck_listview("Facilities", $space['value']['field_room_facilities']);
cck_listview("Entering the venue", $space['value']['field_access_entry']);
printField($space['value']['field_access_steps'][0]['value'], "<p>There are ", " steps leading to the venue</p>");
cck_listview("Access, lifts and ramps", $space['value']['field_access_lifts']);

?>
</div>
<?php
}
?>
</div>

<?php
if (strlen($node->field_visitlichfield_offers[0]['value']) > 0) {
?>
<h3 class="head"><span></span>Special Offers</h3>
<div class="panel">
<?php echo $node->field_visitlichfield_offers[0]['value']; ?>
</div>
<?php } ?>

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


<div id="socialmedia">
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(curPageURL()); ?>&amp;layout=standard&amp;show_faces=true&amp;width=225&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:80px; float: left;" allowTransparency="true"></iframe>

<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" style="float: right; text-align: left;">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</div>

</div>

<?php
drupal_add_js("
$(document).ready(function(){
	$('.panel').addClass('hidden');
	$('.head').addClass('closed');
	$('#images')._scrollable();
	
	var num = 1;
	
	$('.head').click(function() { 
		customSlideToggle($(this).next('.panel'));
		$(this).toggleClass('open');
	});
	
	$('#next').click(function() {
		if (num < ".count($node->field_photos).") {
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
		num = ". count($node->field_photos) .";
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
