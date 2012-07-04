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
<h1><?php echo str_replace("And", "&amp;", $title); ?></h1>
<p>Select from the following categories:</p>
<?php
$tid = taxonomy_get_term_by_name(str_replace("-", " ", $view->args[1]));
$wcategory = $tid[0]->tid;
if ($view->args[0] == "eating_and_drinking") {
buildCats(11, "eating_and_drinking", $wcategory, 0, "/map");
} elseif ($view->args[0] == "attractions") {
buildCats(4, "attractions", $wcategory, 0, "/map");
} elseif ($view->args[0] == "accommodation") {
buildCats(14, "accommodation", $wcategory, 0, "/map");
} elseif ($view->args[0] == "shopping") {
buildCats(18, "shopping", $wcategory, 0, "/map");
} elseif ($view->args[0] == "weddings") {
?>
<ul id="cats">
<li><a href="http://www.enjoyeaststaffs.co.uk/type/weddings/category/all" class="cat1 selected">Weddings</a></li>
<li><a href="http://www.enjoyeaststaffs.co.uk/type/conferences/category/all" class="cat2">Conferences</a></li>
</ul>
<?php
} elseif ($view->args[0] == "conferences") {
?>
<ul id="cats">
<li><a href="http://www.enjoyeaststaffs.co.uk/type/weddings/category/all" class="cat1">Weddings</a></li>
<li><a href="http://www.enjoyeaststaffs.co.uk/type/conferences/category/all" class="cat2 selected">Conferences</a></li>
</ul>
<?php
} 
?>
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
		
		$map[$num]['latitude'] = $item->location_latitude;
		$map[$num]['longitude'] = $item->location_longitude;
		
	} elseif ($item->node_type == "accommodation") {
		$tid = taxonomy_node_get_terms_by_vocabulary(node_load($item->nid),14);
		if (current($tid)->tid == 183) {
		$marker = "camping";
		} else {
		$marker = "hotel";
		}

		$map[$num]['latitude'] = $item->location_latitude;
		$map[$num]['longitude'] = $item->location_longitude;		

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
		
		$map[$num]['latitude'] = $item->location_latitude;
		$map[$num]['longitude'] = $item->location_longitude;		
		
	} elseif ($item->node_type == "weddings") {
		$marker = "weddings";
				
		if ($item->node_data_field_weddingvenue_field_weddingvenue_nid == NULL) {
			$map[$num]['latitude'] = $item->location_latitude;
			$map[$num]['longitude'] = $item->location_longitude;	
		} else {
			$venue = node_load($item->node_data_field_weddingvenue_field_weddingvenue_nid);
			$map[$num]['latitude'] = $venue->location['latitude'];
			$map[$num]['longitude'] = $venue->location['longitude'];	
		}
		
	} elseif ($item->node_type == "conferences") {
		$marker = "conferences";
		
		if ($item->node_data_field_conferencevenue_field_conferencevenue_nid == NULL) {
			$map[$num]['latitude'] = $item->location_latitude;
			$map[$num]['longitude'] = $item->location_longitude;	
		} else {
			$venue = node_load($item->node_data_field_conferencevenue_field_conferencevenue_nid);
			$map[$num]['latitude'] = $venue->location['latitude'];
			$map[$num]['longitude'] = $venue->location['longitude'];	
		}
		
	} elseif ($item->node_type == "shopping") {
		$marker = "shopping";
		
		$map[$num]['latitude'] = $item->location_latitude;
		$map[$num]['longitude'] = $item->location_longitude;

	} 

	$url = "http://". $_SERVER['SERVER_NAME'] . "/". drupal_lookup_path('alias', "node/".$item->nid);
	$map[$num]['text'] = "<strong><a href='". $url ."'>".$item->node_title."</a></strong><p>" . drupalicious_summarise(strip_tags($item->node_data_field_shortdescription_field_shortdescription_value), 20)."</p>";
	$map[$num]['markername'] = $marker;
	$num++;
}

$mymap = array('id' => 'mymap',
             'latitude' => "52.8095",
             'longitude'=> "-1.6437",
             'zoom' => 11,
             'width' => '610px',
             'height' => '610px',
             'type' => 'Satellite',
             'markers' => $map
);

echo theme('gmap', array('#settings' => $mymap));
?>
  
</div>

</div> <?php /* class view */ ?>
