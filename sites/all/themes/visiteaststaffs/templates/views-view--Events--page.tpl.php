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
 $cat = str_replace("type/events/category/", "", $_GET['q']);
 $cat = taxonomy_get_term_by_name($cat);
?>
<div class="<?php print $classes; ?>">
<div id="subnav">
<h1>Events</h1>
		<ul id="cats">
		  <li><a href="http://www.enjoyeaststaffs.co.uk/type/events/this-month" class="cat1">This month</a></li>
		  <li><a href="http://www.enjoyeaststaffs.co.uk/type/events/this-week" class="cat2">This week</a></li>
		  <li><a href="http://www.enjoyeaststaffs.co.uk/type/events" class="cat3 selected">View all</a></li>
		  </ul>
  <form action="" accept-charset="UTF-8" method="get" id="views-exposed-form-Events-page-1">
  <fieldset id="eventsearch">
  <legend>Find Events</legend>
  <p><label for="edit-date-filter-value-datepicker-popup-0">Starting from: (dd/mm/yyyy)<br /></label>
                  <input maxlength="30" name="date_filter[value][date]" id="edit-date-filter-value-datepicker-popup-0" size="20" value="" class="form-text field" type="text" /></p>
                  
                  <p><br /><br /></p>
                  
                  <p><label for="eventcat">In the category:<br />
                  <select name="name" class="field" id="eventcat">
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

  <?php if ($rows): ?>
  <table id="eventview">
  <tr>
  	<th>Event</th>
  	<th>Date</th>
  	<th>Category</th>
  </tr>
      <?php print $rows; ?>
  </table>  
  <?php else: ?>
    <div class="view-empty">
      <h2>Sorry!</h2>
      <p>There are no results for your search.</p>
    </div>
  <?php endif; ?>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>
  
</div>

</div> <?php /* class view */ ?>
