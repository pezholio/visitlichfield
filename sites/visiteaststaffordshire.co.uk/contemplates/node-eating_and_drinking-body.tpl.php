<?php 
global $base_url; 

$category = taxonomy_node_get_terms_by_vocabulary($node, 5);
$categoryid = reset($category)->tid;

$wcategory = reset(taxonomy_node_get_terms_by_vocabulary($node, 11));
$wcategory = $wcategory->tid;

function myImplodeToEnglish ($array, $prefix="", $suffix="") {
    // sanity check
    if (!$array || !count ($array))
        return '';

    // get last element   
    $last = array_pop ($array);

    // if it was the only element - return it
    if (count($array) == 0) {
    	return $last;
    } elseif (count($array) == 1) {
        return $prefix . $array[0] .' and '. $last . $suffix;  
	} else {
	return $prefix. implode (', ', $array).' and '.$last . $suffix;
	}
} 
?>
<div id="subnav">
<h1>Eating &amp; Drinking</h1>
<p>Select from the list below</p>
<?php buildCats(11, "eating_and_drinking", $wcategory); ?>
</div>
<div id="itemview">
<a href="<?php echo $base_url; ?>/type/eating_and_drinking/category/all" class="return">&lt; Return to list</a>
<h2><?php echo $node->title; ?></h2>

<?php if (strlen($node->field_photos[0]['filepath']) > 0) { ?>
<div id="desc">
<?php } ?>

<?php photoGallery($node->field_photos); ?>
<?php print html_entity_decode($node->field_longdescription[0]['view']) ?>
<?php 
if (strlen($node->field_ratemyplace[0]['view']) > 0) {
$rmp = str_replace("http://www.ratemyplace.org.uk/view/", "", $node->field_ratemyplace[0]['view']); 
$rmp = explode("/", $rmp);
?>
<div id="rmp">
<script src='http://www.ratemyplace.org.uk/widget.php?id=<?php echo $rmp[0]; ?>' type='text/javascript'> </script>
</div>
<?php } ?>

<?php if (strlen($node->field_photos[0]['filepath']) > 0) { ?>
<div class="clear"></div>
</div>
<?php } ?>

<div id="venue_info">

<h3 class="head"><span></span>Contact Details and Map</h3>
<div class="panel">
<?php
printLocation($node->locations[0]['street'], $node->locations[0]['additional'], $node->locations[0]['city'], $node->locations[0]['postal_code'], $node->field_tel[0]['view'], $node->field_email[0]['view'], $node->field_website[0]['view'], $node->locations[0]['latitude'], $node->locations[0]['longitude']);
?>
</div>
<h3 class="head"><span></span>Getting here and parking</h3>
<div class="panel">
<?php
gettingHere($node->field_roadway[0]['view'], $node->field_bus[0]['view'], $node->field_station[0]['view'], $node->field_taxi[0]['view'], $node->field_parking[0]['view']);
?>
</div>

<h3 class="head"><span></span>Opening Times</h3>
<div class="panel">
<ul class="opening">
<?php print restaurant_openingtimes($node->field_monday_lunch, "Monday"); ?>
<?php print restaurant_openingtimes($node->field_tuesday_lunch, "Tuesday"); ?>
<?php print restaurant_openingtimes($node->field_wednesday_lunch, "Wednesday"); ?>
<?php print restaurant_openingtimes($node->field_thursday_lunch, "Thursday"); ?>
<?php print restaurant_openingtimes($node->field_friday_lunch, "Friday"); ?>
<?php print restaurant_openingtimes($node->field_saturday_lunch, "Saturday"); ?>
<?php print restaurant_openingtimes($node->field_sunday_lunch, "Sunday"); ?>
</ul>
</div>

<h3 class="head"><span></span>Menu</h3>
<div class="panel">
<?php
printField($node->field_starters[0]['view'], "<p><strong>Starters start from: </strong>&pound;", "</p>");
printField($node->field_maincourse[0]['view'], "<p><strong>Main courses start from: </strong>&pound;", "</p>");
printField($node->field_sweets[0]['view'], "<p><strong>Sweets start from: </strong>&pound;", "</p>");
printField($node->field_childrensmeals[0]['view'], "<p><strong>Children's meals start from: </strong>&pound;", "</p>");
printField($node->field_wine[0]['view'], "<p><strong>Wine starts from: </strong>&pound;", "</p>");
?>
<p>
<em>
<?php
foreach ($node->field_menuoptions as $options) { 
echo $options['value'] ."<br />";
}
?>
</em>
</p>
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
if (strlen($node->field_access_steps[0]['view']) > 0) {
?>
<em>The entrance way has <?php echo $node->field_access_steps[0]['view'];?> steps </em>
<?php
}
cck_listview("Access, lifts and ramps", $node->field_access_lifts);

if (sizeof($node->field_access_stair_areas) > 0) {

foreach ($node->field_access_stair_areas as $stairea) {
	if ($stairea['value'] != NULL) {
		$staireas[] = $stairea['value'];
	}
}
$stairs = myImplodeToEnglish($staireas);
if (sizeof($staireas) > 0) {
?>
<em><?php echo $stairs; ?> only accessible by stairs</em>
<?php 
}
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
