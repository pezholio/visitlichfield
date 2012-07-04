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
 global $tabs;
 if ($fields['counter']->content == 1) {
 	$tabclass = " active";
 } 
?>
<div class="tabContent<?php echo $tabclass; ?>" id="tab<?php echo $fields['counter']->content; ?>">
<?php 
echo $fields['field_photos_fid']->content;
echo $fields['field_eventimage_fid']->content;
?>
</div>
<?php 
$num = $fields['counter']->content;
$tabs[$num]['name'] = $fields['title']->raw; 
$tabs[$num]['link'] = $fields['path']->content; 
$tabs[$num]['num'] = $num; 
if (count($tabs) == 4) {
drupal_add_js("
$(document).ready(function(){
	$('#tabNav .tab').mouseover(function() { 
		$('.tabContent').removeClass('active');
		$('.tab').removeClass('selected');
		curid = this.id.replace('tabs', 'tab');
		$('#' + this.id).addClass('selected');
		$('#' + curid).addClass('active');
	});
	
	if (testMobile(navigator.userAgent||navigator.vendor||window.opera) == true) {
		if (getCookie('optOut') === undefined) {
			if (confirm('Why not try our mobile website, especially designed for mobile devices? Click OK to check it out, or cancel to continue using the main site.')) {
				setCookie('optOut', false, 1);
				window.location = 'http://www.visitlichfield.mobi';
			} else {
				setCookie('optOut', true, 24*30);
			}
		}
	}
});
", 'inline');
?>
<ul id="tabNav">
<?php
	foreach ($tabs as $tab) {
		if ($tab['num'] == 1) {
			$tabsclass = " selected";
		} else {
			$tabsclass = "";
		}
?>
	<li><a href="<?php echo $tab['link']; ?>" class="tab<?php echo $tabsclass; ?>" id="tabs<?php echo $tab['num']; ?>"><?php echo $tab['name']; ?></a></li>
<?php 
	}
?>
</ul>
<?php
} 
?>