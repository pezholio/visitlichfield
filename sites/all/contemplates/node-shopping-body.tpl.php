<?php 
global $base_url; 

$category = taxonomy_node_get_terms_by_vocabulary($node, 5);
$categoryid = reset($category)->tid;

$wcategory = reset(taxonomy_node_get_terms_by_vocabulary($node, 18));
$wcategory = $wcategory->tid;
?>
<div id="subnav">
<h1>Shopping</h1>
<p>Select from the list below</p>
<?php buildCats(18, "shopping", $wcategory); ?>
</div>
<div id="itemview">
<a href="<?php echo $base_url; ?>/type/shopping/category/all" class="return">&lt; Return to list</a>
<h2><?php echo $node->title; ?></h2>
<div id="desc">
<?php photoGallery($node->field_photos); ?>
<?php 
if ($node->field_short_listing[0]['value'] != "Short listing?") {
	print html_entity_decode($node->field_longdescription[0]['view']);
} else {
	print "<p>". nl2br($node->field_shortdescription[0]['view']) ."</p>";
}
?>
<div class="clear"></div>

</div>

<div id="venue_info">

<h3 class="head"><span></span>Contact Details and Map</h3>
<div class="panel">
<?php
printLocation($node->locations[0]['street'], $node->locations[0]['additional'], $node->locations[0]['city'], $node->locations[0]['postal_code'], $node->field_tel[0]['view'], $node->field_email[0]['view'], $node->field_website[0]['view'], $node->locations[0]['latitude'], $node->locations[0]['longitude']);
?>
</div>

<?php
if ($node->field_short_listing[0]['value'] != "Short listing?") {
?>

<?php
if (strlen($node->field_roadway[0]['view']) > 0 || strlen($node->field_bus[0]['view']) > 0 || strlen($node->field_station[0]['view']) > 0 || strlen($node->field_taxi[0]['view']) > 0 || strlen($node->field_parking[0]['view']) > 0) {
?>
<h3 class="head"><span></span>Getting here and parking</h3>
<div class="panel">
<?php
printField(html_entity_decode($node->field_gettinghere_freetext[0]['view']));
gettingHere($node->field_roadway[0]['view'], $node->field_bus[0]['view'], $node->field_station[0]['view'], $node->field_taxi[0]['view'], $node->field_parking[0]['view']);
?>
</div>
<?php } ?>

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
$holidays[] = $item['value'];
}
$holidays = ImplodeToEnglish($holidays, "<p>Closed on ", "</p>");
?>
<?php echo $holidays; ?>
</div>

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
if ($node->field_prices[0]['value'] == "Entry fee applies") {
?>
<h3 class="head"><span></span>Prices</h3>
<div class="panel">
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
<?php echo $node->field_costnotes[0]['value']; ?>
</div>
<?php } ?>

<?php
if (strlen($node->field_shopping_payment[0]['value']) > 0) {
?>
<h3 class="head"><span></span>Payment methods</h3>
<div class="panel">
<?php
cck_listview("", $node->field_shopping_payment);
?>
</div>
<?php } ?>

<h3 class="head"><span></span>Accessibility</h3>
<div class="panel">
<?php
printField($node->field_accessibility_freetext[0]['value']);

if (strlen($node->field_access_steps[0]['view']) > 0) {
if ($node->field_access_steps[0]['view'] > 1) {
	printField($node->field_access_steps[0]['view'], "<em>The entrance way has ", " steps </em>");
} else {
	printField($node->field_access_steps[0]['view'], "<em>The entrance way has ", " step </em>");
}
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

<?php } ?>
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
</div>
