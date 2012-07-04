<?php 
global $base_url; 

$category = taxonomy_node_get_terms_by_vocabulary($node, 5);
$categoryid = reset($category)->tid;

$wcategory = reset(taxonomy_node_get_terms_by_vocabulary($node, 4));
$wcategory = $wcategory->tid;?>
<div id="subnav">
<?php buildCats(4, "attractions", $wcategory); ?>
<p>Select from list above</p>
</div>
<div id="itemview">
<a href="<?php echo $base_url; ?>/type/attractions/category/all" class="return">&lt; Return to list</a>
<h2><?php echo $node->title; ?></h2>

<?php if (strlen($node->field_photos[0]['filepath']) > 0) { ?>
<div id="desc">
<?php } ?>

<?php photoGallery($node->field_photos); ?>
<?php print html_entity_decode($node->field_longdescription[0]['view']) ?>

<?php if (strlen($node->field_photos[0]['filepath']) > 0) { ?>
<div class="clear"></div>
</div>
<?php } ?>

<div id="venue_info">

<h3 class="head"><span></span>Contact Details and Map</h3>
<div class="panel">
<?php
printLocation($node->locations[0]['street'], $node->locations[0]['additional'], $node->locations[0]['city'], $node->locations[0]['postal_code'], $node->field_tel[0]['view'], $node->field_email[0]['view'], $node->field_website[0]['view'], $node->locations[0]['latitude'], $node->locations[0]['longitude']);
printField($node->field_facebook[0]['value'], "<p><a href='", "'>Visit on Facebook</a></p>");
printField($node->field_twitter[0]['value'], "<p><a href='", "'>Follow on Twitter</a></p>");
?>
</div>

<h3 class="head"><span></span>Getting here and parking</h3>
<div class="panel">
<?php
gettingHere($node->field_roadway[0]['view'], $node->field_bus[0]['view'], $node->field_station[0]['view'], $node->field_taxi[0]['view'], $node->field_parking[0]['view']);
?>
</div>

<h3 class="head"><span></span>Times</h3>
<div class="panel">
<h4>Opening Hours</h4>
<ul class="opening">
<?php print openingtimes($node->field_monday, "Monday"); ?>
<?php print openingtimes($node->field_tuesday, "Tuesday"); ?>
<?php print openingtimes($node->field_wednesday, "Wednesday"); ?>
<?php print openingtimes($node->field_thursday, "Thursday"); ?>
<?php print openingtimes($node->field_friday, "Friday"); ?>
<?php print openingtimes($node->field_saturday, "Saturday"); ?>
<?php print openingtimes($node->field_sunday, "Sunday"); ?>
</ul>
<?php
printField($node->field_openingtimes_text[0]['value']);
?>
<?php
foreach ($node->field_publicholidays as $item) {
$holidays[] = $item['view'];
}
$holidays = ImplodeToEnglish($holidays, "(except ", ")");
?>
<?php if ($node->field_allyearround[0]['view'] == "Yes") { ?>
<p><strong>Open all year round</strong> <?php echo $holidays; ?></p>
<?php } elseif ($node->field_allyearround[0]['view'] == "No") { ?>
<p><strong>Open from <?php echo date("F j Y", strtotime($node->field_seasonbegin[0]['value'])); ?> to <?php echo date("F j Y", strtotime($node->field_seasonbegin[0]['value2'])); ?></strong> <?php echo $holidays; ?></p>
<?php } ?>
</div>

<h3 class="head"><span></span>Prices</h3>
<div class="panel">
<?php
if ($node->field_prices[0]['value'] == "Entry fee applies") {
?>
<?php
printField($node->field_childentry[0]['value'], "<p><strong>Children:</strong> &pound;", "</p>");
printField($node->field_adultentry[0]['value'], "<p><strong>Adults:</strong> &pound;", "</p>");
printField($node->field_concessionentry[0]['value'], "<p><strong>Concessions:</strong> &pound;", "</p>");
printField($node->field_studententry[0]['value'], "<p><strong>Students:</strong> &pound;", "</p>");
printField($node->field_familyentry[0]['value'], "<p><strong>Family Ticket:</strong> &pound;", " <em>". $node->field_familyinfo[0]['value'] ."</em> </p>");
if ($node->field_groupdiscounts[0]['value'] == "Yes") {
?>
<p>Group Discounts available</p>
<?php } ?>
<?php
} else {
?>
<p>Free Entry</p>
<?php } ?>
<?php echo $node->field_costnotes[0]['value']; ?>
</div>

<?php
if (strlen($node->field_visitlichfield_offers[0]['value']) > 0) {
?>
<h3 class="head"><span></span>Special Offers</h3>
<div class="panel">
<?php echo $node->field_visitlichfield_offers[0]['value']; ?>
</div>
<?php } ?>

<?php
$facilities = taxonomy_node_get_terms_by_vocabulary($node, 1);
if (sizeof($facilities) > 0) {
?>
<h3 class="head"><span></span>Facilities</h3>
<div class="panel">
<ul>
<?php
foreach ($facilities as $facility) {
?>
<li><?php echo $facility->name; ?></li>
<?php } ?>
</ul>
</div>
<?php } ?>

<?php
$awards = taxonomy_node_get_terms_by_vocabulary($node, 8);
if (sizeof($awards) > 0) {
?>
<h3 class="head"><span></span>Awards</h3>
<div class="panel">
<ul>
<?php
foreach ($awards as $award) {
?>
<li><?php echo $award->name; ?></li>
<?php } ?>
</ul>
</div>
<?php } ?>

<?php
$schools = taxonomy_node_get_terms_by_vocabulary($node, 7);
if (sizeof($schools) > 0) {
?>
<h3 class="head"><span></span>Schools and education</h3>
<div class="panel">
<ul>
<?php
foreach ($schools as $school) {
?>
<li><?php echo $school->name; ?></li>
<?php } ?>
</ul>
</div>
<?php } ?>

<?php
$guides = taxonomy_node_get_terms_by_vocabulary($node, 6);
if (sizeof($guides) > 0) {
?>
<h3 class="head"><span></span>Guides, tours and information</h3>
<div class="panel">
<ul>
<?php
foreach ($guides as $guide) {
?>
<li><?php echo $guide->name; ?></li>
<?php } ?>
</ul>
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

<?php
if (strlen($node->field_events[0]['view']) > 0) {
?>
<h3 class="head"><span></span>Events at this venue</h3>
<div class="panel">
<?php
echo $node->field_events[0]['view'];
?>
</div>
<?php
}
?>

<?php
if (strlen($node->field_attractions[0]['view']) > 0) {
?>
<h3 class="head"><span></span>Also at this venue</h3>
<div class="panel">
<ul>
<?php
foreach($node->field_attractions as $also) {
?>
<li><?php echo $also['view']; ?></li>
<?php } ?>
</ul>
</div>
<?php } ?>

<div id="socialmedia">
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(curPageURL()); ?>&amp;layout=standard&amp;show_faces=true&amp;width=225&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:80px; float: left;" allowTransparency="true"></iframe>

<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" style="float: right; text-align: left;">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</div>

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
	$('.head').addClass('closed');
	$('#images')._scrollable();
	
	var num = 1;
	
	$('.head').click(function() { 
		customSlideToggle($(this).next('.panel'));
		$(this).toggleClass('open');
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
			 e.removeClass('hidden');
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
</div>
