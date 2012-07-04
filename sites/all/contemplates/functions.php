<?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function nl2p($string)
{
    $string = "<p>" . $string . "</p>";
    $string = preg_replace("/\r\n\r\n/", "</p>\n\n<p>", $string);
    $string = preg_replace("/\r\n/", "<br />", $string);
    return $string;
}  

function ImplodeToEnglish ($array, $prefix="", $suffix="") {
    // sanity check
    if (!$array || !count ($array))
        return '';

    // get last element   
    $last = array_pop ($array);

    // if it was the only element - return it
    if (count($array) == 0) {
    	return $last;
    } elseif (count($array) == 1) {
        return $prefix . $array[0] .' and '. $last . $suffix;  
	} else {
	return $prefix. implode (', ', $array).' and '.$last . $suffix;
	}
} 

function cck_listview($title, $field, $key = "view") {
	if (strlen($field[0][$key]) > 0) {
		if (strlen($title) > 0) {
			echo "<h4>". $title ."</h4>";
		}
		echo "<ul>";
		foreach ($field as $field) {
			echo "<li>". $field[$key] ."</li>";
		}
		echo "</ul>";
	}
}

function tag_echo($tag, $content) {
	if (strlen($content) > 0) {
		echo "<". $tag .">". $content ."</". $tag .">";
	}
}

function restaurant_openingtimes($field, $day) {
	if ($field[0]['value'] != "2010-01-01T00:00:00") {
		if (strlen($field[1]['value']) > 0) {
			$times[] = date("g:ia", strtotime($field[0]['value'])). " - ". date("g:ia", strtotime($field[0]['value2']));
			if ($field[1]['value'] != $field[1]['value2']) {
				$times[] = date("g:ia", strtotime($field[1]['value'])). " - ". date("g:ia", strtotime($field[1]['value2'])) ;
			}
			$times = implode(" / ", $times);
		} else {
			$times = date("g:ia", strtotime($field[0]['value'])). " - ". date("g:ia", strtotime($field[0]['value2']));
		}
		return "<li><strong>".$day."</strong> ". $times."</li>";
	} 
}

function openingtimes($field, $day) {
	if ($field[0]['value'] != $field[0]['value2']) {
		$times = date("g:ia", strtotime($field[0]['value'])). " - ". date("g:ia", strtotime($field[0]['value2']));
		return "<li><strong>".$day."</strong> ". $times."</li>";
	} 
}

function eventtimes($from, $to) {
	$from = date("g:ia", strtotime($from));
	$to = date("g:ia", strtotime($to));
	
	if ($from != "12:00am") {
		if ($from == $to) {
			echo $from;
		} else {
			echo $from." - ". $to;
		}
	}
}

function eventdates($from, $to) {
	$from = date("l jS F Y", strtotime($from));
	$to = date("l jS F Y", strtotime($to));
	
	if ($from == $to) {
		echo $from;
	} else {
		echo $from." - ". $to;
	}
}

function buildCats($taxonomy, $type, $wcategory, $cat = 0, $suffix = "") {
global $base_url; 

echo "<ul id=\"cats\">";
$cats = taxonomy_get_tree($taxonomy, 0, -1, 1);
$num = 1;

	foreach ($cats as $cat) {
		
		if ($wcategory != 0) {
			if ($wcategory == $cat->tid) { 
				$selected = " selected"; 
			} else {
				$selected = "";
			}
		} else {
			if ($cat == $cat->tid) { 
				$selected = " selected"; 
			} else {
				$selected = "";
			}
		}
	
		echo "<li><a href=\"". $base_url. "/type/". $type ."/category/". urlencode(strtolower(str_replace(" ", "-", $cat->name))). $suffix ."\" class=\"cat". $num . $selected ."\">". $cat->name ."</a></li>";
		if ($num == 3) {
			$num = 1;
		} else {
			$num++;
		}
	}
	
$selected = "";

if (strlen($wcategory) == 0) {
	$selected = " selected"; 
}

echo "<li><a href=\"". $base_url ."/type/". $type ."/category/all\" class=\"catall". $selected ."\">View All</a></li>";
echo "</ul>";

}

function printField($field, $pre = "", $post = "") {
	if (strlen($field) > 0) {
		echo $pre . $field . $post;
	}
}

function printLocation($street, $additional, $city, $postcode, $tel, $email, $website, $lat, $lng) {
$address[] = $street;
$address[] = $additional;
$address[] = $city;
$address[] = $postcode;
$address = implode("<br />", array_filter($address));
echo "<p>" . $address ."</p>";

if (strlen($tel) > 0) {
echo "<p><strong>Tel: </strong>". $tel ."</p>";
}

if (strlen($email) > 0) { 
echo "<p><strong>Email: </strong><a href=\"mailto:". $email ."\">". $email ."</a></p>";
}

if (strlen($website) > 0) { 
echo "<p><strong>Website: </strong><a href=\"http://". $website ."\">". $website ."</a></p>";
}

if (strlen($lat) > 0) {
$mymap = array('id' => 'mymap',
             'latitude' => $lat,
             'longitude'=> $lng,
             'zoom' => 15,
             'width' => '610px',
             'height' => '270px',
             'type' => 'Satellite',
             'markers' => array(
             		0 => array(
             		'latitude' => $lat,
             		'longitude'=> $lng,
             		)
             )
);

echo theme('gmap', array('#settings' => $mymap));
}
}

function photoGallery($photos) {
	global $base_url; 
	if (strlen($photos[0]['filepath']) > 0) {
		echo "<div id=\"imagegallery\">";
		echo "<div id=\"images\">";
		$num = 1;
		
		foreach ($photos as $photo) {
			if (strlen($photo['filepath']) > 0) {
				$bigpath = imagecache_create_path('mainpage', $photo['filepath']);
				echo "<div>";
				echo "<img src=\"". $base_url ."/". $bigpath."\" class=\"pic". $num. "\" alt=\"\" />";
				$num++;
				echo "</div>";
			}
		}
		
		echo "</div>";
		
		if ($num > 2) {
			$total = $num - 1;
			echo "<div id=\"carousel\">";
			echo "<p>Photo <span id=\"current\">1</span> of ". $total ." <span id=\"mover\"><a href=\"#\" id=\"prev\"> - Prev</a><a href=\"#\" id=\"next\">Next +</a></span></span></p>";
			echo "</div>";
		}
		echo "</div>";
	}
}

function gettingHere($road, $bus, $train, $taxi, $parking) {

if (strlen($road) > 0) {
	echo "<h4>By Road</h4>";
	echo "<p>". strip_tags(html_entity_decode($road)) ."</p>";
}

if (strlen($bus) > 0) {
	echo "<h4>Local Bus Services</h4>";
	echo "<p>". strip_tags(html_entity_decode($bus)) ."</p>";
}

if (strlen($train) > 0) {
	echo "<h4>Nearest Train Station</h4>";
	echo "<p>". strip_tags(html_entity_decode($train)) ."</p>";
}

if (strlen($taxi) > 0) {
	echo "<h4>Local Taxi Services</h4>";
	echo "<p>". strip_tags(html_entity_decode($taxi)) ."</p>";
}

if (strlen($parking) > 0) {
	echo "<h4>Parking Facilities</h4>";
	echo "<p>". strip_tags(html_entity_decode($parking)) ."</p>";
}

}

function drupalicious_summarise($paragraph, $limit)
{
       $textfield = strtok($paragraph, " ");
       while($textfield)
       {
           $text .= " $textfield";
           $words++;
           if(($words >= $limit) && ((substr($textfield, -1) == "!")||(substr($textfield, -1) == ".")))
               break;
           $textfield = strtok(" ");
       }
       return ltrim($text);
    } 
    
function phptemplate_preprocess_page(&$vars) {
  if (module_exists('path')) {
    $alias = drupal_get_path_alias(str_replace('/edit','',$_GET['q']));
    if ($alias != $_GET['q']) {
      $template_filename = 'page';
      foreach (explode('/', $alias) as $path_part) {
        $template_filename = $template_filename . '-' . $path_part;
        $vars['template_files'][] = $template_filename;
      }
    }
  }
}
?>