<?php
drupal_set_header('Content-Type: text/xml; charset=utf-8');
$links = array();
print "<?xml version=\"1.0\"?>\r\n";
?>
<rss version="2.0">
<channel>
        <title><?php echo drupal_get_title(); ?></title>
        <link>http://www.visitlichfield.co.uk</link>
		<?php print $rows; ?>
</channel>
</rss>