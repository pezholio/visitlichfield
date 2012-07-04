<div class="<?php print $classes; ?>">
<div id="subnav">
<ul id="cats">
	<li><a href="/type/accommodation/category/all" class="cat1">Browse all accommodation</a></li>
	<li><a href="/type/events" class="cat2">Browse all events</a></li>
	<li><a href="/type/accommodation/category/all" class="cat3">Browse all attractions</a></li>
	<li><a href="/type/eating_and_drinking/category/all" class="cat1">Browse all food and drink</a></li>
	<li><a href="/type/shopping/category/all" class="catall">Browse all shops</a></li>
</ul>
</div>
<div id="itemview" class="newslist">

<p class="current"><span>News</span></p>

  <?php if ($rows): ?>
    <div class="view-content">
      <?php print $rows; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  
</div>