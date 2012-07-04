<?php
drupal_set_header('Content-Type: text/xml; charset=utf-8');
print "<?xml version=\"1.0\"?>\r\n";
?>
<events>
	<?php print $rows; ?>
</events>