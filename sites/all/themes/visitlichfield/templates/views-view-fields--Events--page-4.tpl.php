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
<event>
	<name><![CDATA[<?php echo strip_tags($fields['title']->raw); ?>]]></name>
	<description><![CDATA[<?php echo strip_tags($fields['body']->raw); ?>]]></description>
	<from><?php echo strtotime($fields['field_dates_value']->raw); ?></from>
	<to><?php echo strtotime($fields['field_dates_value2']->raw); ?></to>
	<notes><![CDATA[<?php echo strip_tags($fields['field_notes_value']->raw); ?>]]></notes>
	<price><![CDATA[<?php echo strip_tags($fields['field_price_value']->raw); ?>]]></price>
	<?php 
	if (strlen($fields['field_venuetext_value']->raw) > 0) {
		$venue = node_load($fields['nid']->content);
		$venuename = $fields['field_venuetext_value']->raw;
	} else { 
		$venue = node_load($fields['field_venue_nid']->raw);
		$venuename = $venue->title;
	}
	
	$tel = $venue->field_tel[0]['value'];
	$email = $venue->field_email[0]['value'];
	$web = $venue->field_website[0]['value'];	

	?>
	<venue>
		<name><![CDATA[<?php echo strip_tags($venuename); ?>]]></name>
		<tel><?php echo $tel; ?></tel>
		<email><?php echo $email; ?></email>
		<web><?php echo $web; ?></web>
		<lat><?php echo $venue->locations[0]['latitude']; ?></lat>
		<lng><?php echo $venue->locations[0]['longitude']; ?></lng>
		<address>
			<address1><?php echo $venue->locations[0]['street']; ?></address1>
			<address2><?php echo $venue->locations[0]['additional']; ?></address2>
			<city><?php echo $venue->locations[0]['city']; ?></city>
			<postal_code><?php echo $venue->locations[0]['postal_code']; ?></postal_code>
		</address>
	</venue>
	<category><![CDATA[<?php echo strip_tags($fields['name']->raw); ?>]]></category>
	<url><?php echo $fields['path']->content; ?></url>
</event>