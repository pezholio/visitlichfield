<?php
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<div class="field">
<h2><?php echo $fields['title']->content; ?></h2>
<?php
if (strlen($fields['field_visitlichfield_offers_value']->content) > 0) {
?>
<img src="http://www.visitlichfield.org.uk/sites/all/themes/visitlichfield/images/specialoffers.png" id="special" />
<?php } ?>
<div id="awards">
<?php
$awards = explode("</div>", $fields['field_accommodation_awards_value']->content);

foreach ($awards as $award) {
	if (stristr($award, "star") != FALSE) {
		$term = taxonomy_get_term_by_name(strip_tags($award));
		echo taxonomy_image_display($term[0]->tid);
	}
}
?>
</div>
<?php
if (substr($fields['field_photos_fid']->content, -1) != "/") {
?>
<img src="<?php echo $fields['field_photos_fid']->content; ?>" alt="<?php echo $fields['title']->raw; ?>" />
<?php } ?>
<p><?php echo strip_tags(html_entity_decode($fields['field_shortdescription_value']->content)); ?></p>
</div>