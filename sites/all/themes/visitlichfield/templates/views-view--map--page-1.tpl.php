<?php
// $Id: views-view.tpl.php,v 1.13.2.2 2010/03/25 20:25:28 merlinofchaos Exp $
/**
 * @file views-view.tpl.php
 * Main view template
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 * - $admin_links: A rendered list of administrative links
 * - $admin_links_raw: A list of administrative links suitable for theme('links')
 *
 * @ingroup views_templates
 */
 global $base_url;
 $title = ucwords(str_replace("_", " ", $view->args[0]));
?>
<div class="<?php print $classes; ?>">
<div id="subnav">
<h1>Map</h1>
<ul id="key">
	<li class="heading">
	Attractions
		<ul>
			<li class="key adventure">Adventure and Excitement</li>
			<li class="key history">History and Heritage</li>
			<li class="key outdoor">The Great Outdoors</li>
			<li class="key art">Arts and Entertainment</li>
		</ul>
	</li>
	<li class="heading">
	Eating and Drinking
		<ul>
			<li class="key coffee">Coffee Shops</li>
			<li class="key bars">Pubs and Bars</li>
			<li class="key restaurants">Restaurants</li>
		</ul>
	</li>
	<li class="key heading shopping">
	Shopping
	</li>
	<li class="heading">
	Accommodation
		<ul>
			<li class="key camping">Camping and Caravanning</li>
			<li class="key hotels">Hotels and B&Bs</li>
		</ul>
	</li>
</ul>

</div>

<div id="itemview">

<?php
$view = views_get_current_view();
$num = 0;
foreach ($view->result as $item) {

	if ($item->node_type == "eating_and_drinking") {
		$tid = taxonomy_node_get_terms_by_vocabulary(node_load($item->nid),11);
		if (current($tid)->tid == 138) {
		$marker = "coffee";
		} elseif (current($tid)->tid == 139) {
		$marker = "bar";
		} else {
		$marker = "restaurant";
		}
	} elseif ($item->node_type == "accommodation") {
		$tid = taxonomy_node_get_terms_by_vocabulary(node_load($item->nid),14);
		if (current($tid)->tid == 183) {
		$marker = "camping";
		} else {
		$marker = "hotel";
		}
	} elseif ($item->node_type == "attractions") {
		$tid = taxonomy_node_get_terms_by_vocabulary(node_load($item->nid),4);
		if (current($tid)->tid == 45) {
		$marker = "excitement";
		} elseif (current($tid)->tid == 50) {
		$marker = "outdoor";
		} elseif (current($tid)->tid == 41) {
		$marker = "history";
		} elseif (current($tid)->tid == 248) {
		$marker = "art";
		}
	} elseif ($item->node_type == "shopping") {
		$marker = "shopping";
	} 

	$url = "http://". $_SERVER['SERVER_NAME'] . "/". drupal_lookup_path('alias', "node/".$item->nid);
	$map[$num]['text'] = "<strong><a href='". $url ."'>".$item->node_title."</a></strong><p>" . drupalicious_summarise(strip_tags($item->node_data_field_shortdescription_field_shortdescription_value), 20)."</p>";
	$map[$num]['latitude'] = $item->location_latitude;
	$map[$num]['longitude'] = $item->location_longitude;
	$map[$num]['markername'] = $marker;
	$num++;
}

$mymap = array('id' => 'mymap',
             'latitude' => $lat,
             'longitude'=> $lng,
             'zoom' => 11,
             'width' => '610px',
             'height' => '610px',
             'markers' => $map
);

echo theme('gmap', array('#settings' => $mymap));
?>
  
</div>

</div> <?php /* class view */ ?>
