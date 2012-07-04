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
 global $myfields;
?>
<?php
$myfields[] = $fields;

if (count($myfields) == 4) {
?>


<?php
foreach ($myfields as $field) {

if ($field['counter']->content == 1) {
$class = "visible";
} else {
$class = "";
}

?>
<a href="<?php echo $field['path']->content; ?>" class="mainimage <?php echo $class; ?>"
id="image<?php echo $field['counter']->content; ?>">
<img src="<?php echo $field['field_photos_fid']->content; ?>" alt="<?php echo $field['title']->raw; ?>" class="homeimage" />
<span><?php echo $field['title']->raw; ?></span>
</a>
<?php } ?>

<?php
foreach ($myfields as $field) {
?>
<a href="<?php echo $field['path']->content; ?>"><img src="<?php echo $field['field_photos_fid_1']->content; ?>" alt="<?php echo $field['title']->raw; ?>" class="smallhomeimage image<?php echo $field['counter']->content; ?>" title="image<?php echo $field['counter']->content; ?>" /></a>
<?php } ?>

<script type="text/javascript">
$(document).ready(function(){
	$('.smallhomeimage').hover(function() {
		$('.mainimage').removeClass('visible');
		$('#' + this.title).addClass('visible');
	});
});
</script>

<?php
}
?>