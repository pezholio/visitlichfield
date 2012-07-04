<div id="subnav">
<h1>News</h1>
		<ul id="cats">
			<li><a href="/type/accommodation/category/all" class="cat1">Browse all accommodation</a></li>
			<li><a href="/type/events" class="cat2">Browse all events</a></li>
			<li><a href="/type/attractions/category/all" class="cat3">Browse all attractions</a></li>
			<li><a href="/type/eating_and_drinking/category/all" class="cat1">Browse all food and drink</a></li>

			<li><a href="/type/shopping/category/all" class="catall">Browse all shops</a></li>
		</ul>
</div>

<div id="itemview">
<h2><?php echo $node->title; ?></h2>
<p class="date"><?php echo date("l F j", $node->created); ?></p>
<?php echo $node->body; ?>

</div>
