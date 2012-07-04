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
<?php
$tid = taxonomy_get_term_by_name(str_replace("-", " ", $view->args[1]));
$wcategory = $tid[0]->tid;
if ($view->args[0] == "eating_and_drinking") {
buildCats(11, "eating_and_drinking", $wcategory);
} elseif ($view->args[0] == "attractions") {
buildCats(4, "attractions", $wcategory);
} elseif ($view->args[0] == "accommodation") {
buildCats(14, "accommodation", $wcategory);
} elseif ($view->args[0] == "shopping") {
buildCats(18, "shopping", $wcategory);
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
<p>Select from list above</p>

<a href="<?php echo $view->args[1]; ?>/map"><img src="http://www.enjoyeaststaffs.co.uk/sites/all/themes/visiteaststaffs/images/interactivemap.png" alt="View on map" id="listmap" /></a>

</div>

<div id="itemview" class="listview">

<p class="current"><span><?php echo title_case(str_replace("-", " ", $view->args[1])); ?></span></p>

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

</div> <?php /* class view */ ?>
