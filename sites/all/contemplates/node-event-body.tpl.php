<?php 
global $base_url; 
?>
<div id="subnav">
<h1>Events</h1>
		<ul id="cats">
		  <li><a href="http://www.visitlichfield.org.uk/type/events/this-month" class="cat1">This month</a></li>
		  <li><a href="http://www.visitlichfield.org.uk/type/events/this-week" class="cat2">This week</a></li>
		  <li><a href="http://www.visitlichfield.org.uk/type/events" class="cat3">View all</a></li>
		  </ul>
  <form action="http://www.visitlichfield.co.uk/type/events" accept-charset="UTF-8" method="get" id="views-exposed-form-Events-page-1" class="events">
  <fieldset id="eventsearch">
  <legend>Find Events</legend>
  <p><label for="edit-date-filter-value-datepicker-popup-0">Starting from:<br /></label>
                  <input maxlength="30" name="date_filter[value][date]" id="edit-date-filter-value-datepicker-popup-0" size="20" value="" class="form-text field" type="text" /><br /><small>dd/mm/yyyy</small></p>
                  <p>In the category:<br />
                  <select name="name" class="field">
                  <option value="" selected="selected">All Events</option>
                  <?php
					$cats = taxonomy_get_tree(12, 0, -1, 1);
					$num = 1;
					
					foreach ($cats as $cat) {
				   ?>
				   <option><?php echo $cat->name; ?></option>
				   <?php } ?>
                  </select>
                  </p>
      <p><input id="edit-submit-Events" value="Go!" class="form-submit" type="submit" /></p>
   </fieldset>
</form>
</div>
<div id="itemview">
<h2><?php echo check_plain($node->title); ?></h2>
<div id="desc">
<?php
if (strlen($node->field_eventimage[0]['filepath']) > 0) {
?>
<div id="imagegallery">
<div id="images">
<div>
<?php
$bigpath = imagecache_create_path('mainpage', $node->field_eventimage[0]['filepath']);
echo "<img src=\"". $base_url ."/". $bigpath."\" class=\"pic". $num. "\" alt=\"\" />";
?>
</div>
</div>
</div>
<?php } ?>
<?php
if (strlen($node->field_venue[0]['view']) > 0) {
$venuename = $node->field_venue[0]['view'];
$venue = node_load($node->field_venue[0]['nid']);
} else {
$venuename = $node->field_venuetext[0]['view'];
}
?>
<p><strong>Venue:</strong> <?php echo $venuename; ?></p>
<?php echo nl2p($node->content['body']['#value']); ?>
</div>

<div id="event_info">

<h3 class="head"><span></span>Dates &amp; Times</h3>
<div class="panel">
<table>
<tr>
<th scope="col">Dates</th>
<th scope="col">Times</th>
</tr>
<?php
foreach ($node->field_dates as $date) {
?>
<tr>
<td><?php eventdates($date['value'], $date['value2']); ?></td>
<td><?php eventtimes($date['value'], $date['value2']); ?></td>
</tr>
<?php
} 
?>
</table>
<?php
if (strlen($node->field_notes[0]['view']) > 0) {
?>
<em><?php echo $node->field_notes[0]['view']; ?></em>
<?php
}
?>
</div>

<?php
if (strlen($node->field_price[0]['view']) > 0) {
?>
<h3 class="head"><span></span>Prices</h3>
<div class="panel">
<?php echo $node->field_price[0]['view']; ?>
</div>
<?php } ?>

<h3 class="head"><span></span>Contact Details and Map</h3>
<div class="panel">
<?php
if ($node->field_sameasvenue[0]['view'] == "Contact details same as venue?") {
	$tel = $venue->field_tel[0]['value'];
	$email = $venue->field_email[0]['value'];
	$web = $venue->field_website[0]['value'];
	printField($tel, "<p><strong>Tel: </strong>", "</p>");
	printField($email, "<strong>Email: </strong><a href=\"mailto:".$email."\">", "</a></p>");
	printField($web, "<strong>Web: </strong><a href=\"http://".$web."\">", "</a></p>");
} else {
	$tel = $node->field_eventtel[0]['value'];
	$email = $node->field_eventemail[0]['value'];
	$web = $node->field_eventwebsite[0]['value'];
	printField($tel, "<p><strong>Tel: </strong>", "</p>");
	printField($email, "<strong>Email: </strong><a href=\"mailto:".$email."\">", "</a></p>");
	printField($web, "<strong>Web: </strong><a href=\"http://".$web."\">", "</a></p>");
}

if ($node->field_samelocation[0]['view'] == "Location same as venue?") {
	printLocation($venue->locations[0]['street'], $venue->locations[0]['additional'], $venue->locations[0]['city'], $venue->locations[0]['postal_code'], $venue->field_tel[0]['view'], $venue->field_email[0]['view'], $venue->field_website[0]['view'], $venue->locations[0]['latitude'], $venue->locations[0]['longitude']);
} else {
	printLocation($node->locations[0]['street'], $node->locations[0]['additional'], $node->locations[0]['city'], $node->locations[0]['postal_code'], $node->field_tel[0]['view'], $node->field_email[0]['view'], $node->field_website[0]['view'], $node->locations[0]['latitude'], $node->locations[0]['longitude']);
}
?>
</div>
<!--
<div id="socialmedia">
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(curPageURL()); ?>&amp;layout=standard&amp;show_faces=true&amp;width=225&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:80px; float: left;" allowTransparency="true"></iframe>

<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" style="float: right; text-align: left;">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</div>
-->

</div>

</div>

<?php
$pictotal = 0;

foreach($node->field_eventimage as $photo) {
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
