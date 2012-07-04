<?php
drupal_set_header('Content-Type: text/xml; charset=utf-8');
print "<?xml version=\"1.0\"?>
";
$title = ucwords(str_replace("_", " ", $view->args[0]));

	if ($view->args[0] == "eating_and_drinking") {
		$marker = "http://www.visitlichfield.co.uk/sites/all/modules/gmap/markers/restaurant.png";
	} elseif ($view->args[0] == "accommodation") {
		$marker = "http://www.visitlichfield.co.uk/sites/all/modules/gmap/markers/hotel.png";
	} elseif ($view->args[0] == "attractions") {
		$marker = "http://google-maps-icons.googlecode.com/files/info.png";
	} elseif ($view->args[0] == "weddings") {
		$marker = "http://www.visitlichfield.co.uk/sites/all/modules/gmap/markers/wedding.png";
	} elseif ($view->args[0] == "conferences") {
		$marker = "http://www.visitlichfield.co.uk/sites/all/modules/gmap/markers/conference.png";
	} elseif ($view->args[0] == "shopping") {
		$marker = "http://www.visitlichfield.co.uk/sites/all/modules/gmap/markers/shoppingmall.png";
	} 
	

?>
<kml xmlns="http://www.opengis.net/kml/2.2">
	<Document>
	<name><?php echo $title; ?></name>
	<styleUrl>#style1</styleUrl>
	<Style id="style1">
		<IconStyle>
		<Icon>
			<href><?php echo $marker; ?></href>
		</Icon>
		</IconStyle>
	</Style>
	<?php
	foreach ($view->result as $result) {
	?>
	<Placemark>
		<name><![CDATA[<?php echo $result->node_title; ?>]]></name>
		<description><![CDATA[<p><?php echo strip_tags($result->node_data_field_shortdescription_field_shortdescription_value); ?></p><a href="http://www.visitlichfield.co.uk/<?php echo drupal_lookup_path('alias',"node/".$result->nid); ?>">More information...</a>]]></description>
		<styleUrl>#style1</styleUrl>
		<Point>
			<coordinates><?php echo $result->location_longitude;?>, <?php echo $result->location_latitude;?></coordinates>
		</Point>
	</Placemark>
	<?php } ?>
	</Document>
</kml>