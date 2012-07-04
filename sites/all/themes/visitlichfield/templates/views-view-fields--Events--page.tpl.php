<tr>
<?php
if (strlen($fields['field_venue_nid']->content) > 0) {
$venue = $fields['field_venue_nid']->content;
} else {
$venue = $fields['field_venuetext_value']->content;
}
?>
<td class="event"><?php echo $fields['title']->content; ?> at <?php echo $venue; ?></td>
<td class="date"><?php echo $fields['field_dates_value']->content; ?></td>
<td class="category"><?php echo $fields['name']->content; ?></td>
</tr>