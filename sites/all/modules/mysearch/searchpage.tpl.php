<?php
// $Id: mysearch.tpl.php
$keys = explode(":", str_replace("type", "", $keys));
$keys[0] = trim($keys[0]);
?>
<div id="subnav">
<h1>Search</h1>
<p>Narrow search by:</p>
<ul id="cats">
	<li><a href="<?php echo $keys[0]; ?>%20type%3Aattractions" class="cat1<?php if ($keys[1] == "attractions") echo " selected"; ?>">Attractions</a></li>
	<li><a href="<?php echo $keys[0]; ?>%20type%3Aeating_and_drinking" class="cat2<?php if ($keys[1] == "eating_and_drinking") echo " selected"; ?>">Eating and Drinking</a></li>
	<li><a href="<?php echo $keys[0]; ?>%20type%3Aevents" class="cat3<?php if ($keys[1] == "events") echo " selected"; ?>">Events</a></li>
	<li><a href="<?php echo $keys[0]; ?>%20type%3Aaccommodation" class="cat1<?php if ($keys[1] == "accommodation") echo " selected"; ?>">Accommodation</a></li>
	<li><a href="<?php echo $keys[0]; ?>%20type%3Aconferences" class="cat2<?php if ($keys[1] == "conferences") echo " selected"; ?>">Conferences</a></li>
	<li><a href="<?php echo $keys[0]; ?>%20type%3Aweddings" class="cat3<?php if ($keys[1] == "weddings") echo " selected"; ?>">Weddings</a></li>
</li>
<!-- <form action="/search/node" accept-charset="UTF-8" method="post" id="search-form" class="search-form">
<fieldset id="eventsearch">
	<legend>Search Again</legend>
	<p><input name="keys" id="edit-search-theme-form-1" type="text" class="field" /> <input id="edit-submit-Events" value="Go!" class="form-submit" type="submit"></p>
</fieldset> -->
</form>
</div>
<div id="itemview">
  <h2><?php print $title ?></h2>
  <div class="content"><?php print $content ?></div>
</div>