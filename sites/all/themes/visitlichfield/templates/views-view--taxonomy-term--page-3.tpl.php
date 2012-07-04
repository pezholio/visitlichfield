<?php
drupal_set_header('Content-Type: text/xml; charset=utf-8');
print "<?xml version=\"1.0\"?>\r\n";
?>
<<?php echo $view->args[0]; ?>>
	<?php print $rows; ?>
</<?php echo $view->args[0]; ?>>