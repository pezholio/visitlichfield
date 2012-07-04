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

<ul id="cats">
	<li><a href="/type/accommodation/category/all" class="cat1">Browse all accommodation</a></li>
	<li><a href="/type/events" class="cat2">Browse all events</a></li>
	<li><a href="/type/accommodation/category/all" class="cat3">Browse all attractions</a></li>
	<li><a href="/type/eating_and_drinking/category/all" class="cat1">Browse all food and drink</a></li>
	<li><a href="/type/shopping/category/all" class="catall">Browse all shops</a></li>
</ul>

</div>

<div id="itemview" class="listview">

<p class="current"><span>Top Sights</span></p>

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
