<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to STARTERKIT_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: STARTERKIT_breadcrumb()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */

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

	if ($field[0]['value'] == $field[0]['value2']) {
		return "<li><strong>". $day ."</strong> Closed</strong></li>";
	} else {
		if ($field[0]['value'] != "2010-01-01T00:00:00") {
			if (strlen($field[1]['value']) > 0) {
			
				if (date("g:ia", strtotime($field[0]['value2'])) == "11:59pm") {
					$end = "Midnight";
				} else {
					$end = date("g:ia", strtotime($field[0]['value2']));	
				}
			
				$times[] = date("g:ia", strtotime($field[0]['value'])). " - ". $end;
				if ($field[1]['value'] != $field[1]['value2']) {
				
					if (date("g:ia", strtotime($field[1]['value2'])) == "11:59pm") {
						$end = "Midnight";
					} else {
						$end = date("g:ia", strtotime($field[1]['value2']));
					}
				
					$times[] = date("g:ia", strtotime($field[1]['value'])). " - ". $end ;
				}
				$times = implode(" / ", $times);
			} else {
			
				if (date("g:ia", strtotime($field[0]['value2'])) == "11:59pm") {
					$end = "Midnight";
				} else {
					$end = date("g:ia", strtotime($field[0]['value2']));	
				}
			
				$times = date("g:ia", strtotime($field[0]['value'])). " - ". $end;
			}
			return "<li><strong>".$day."</strong> ". $times."</li>";
		} 
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
             'width' => '530px',
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
	echo html_entity_decode($road);
}

if (strlen($bus) > 0) {
	echo "<h4>Local Bus Services</h4>";
	echo html_entity_decode($bus);
}

if (strlen($train) > 0) {
	echo "<h4>Nearest Train Station</h4>";
	echo html_entity_decode($train);
}

if (strlen($taxi) > 0) {
	echo "<h4>Local Taxi Services</h4>";
	echo html_entity_decode($taxi);
}

if (strlen($parking) > 0) {
	echo "<h4>Parking Facilities</h4>";
	echo html_entity_decode($parking);
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

function visitlichfield_content_view_multiple_field($items, $field, $values) {
  if ($field['field_name'] != 'field_accommodation_awards_value') {
    // If this is not my tuned field, then use original theme function directly.
    return theme_content_view_multiple_field($items, $field, $values);
  }

  // Separate item values with my favorite separator.
  $separator = ', ';
  $array = array();
  foreach ($items as $item) {
    if (!empty($item) || $item == '0') {
      $array[] = $item;
    }
  }
  return implode($separator, $array);
}

function visiteaststaffs_preprocess_node(&$vars, $hook) {
  $vars['template_files'][] = 'node-'.$vars['node']->nid;
}

function title_case($title) { 
    $smallwordsarray = array('of','a','the','and','an','or','nor','but','is','if','then', 'else','when', 'at','from','by','on','off','for','in','out','over','to','into','with'); 

    $words = explode(' ', $title); 
    foreach ($words as $key => $word) 
    { 
        if ($key == 0 or !in_array($word, $smallwordsarray)) 
        $words[$key] = ucwords(strtolower($word)); 
    } 

    $newtitle = implode(' ', $words); 
    return $newtitle; 
} 

/**
 * Implementation of HOOK_theme().
 */
function STARTERKIT_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_page(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');

  // To remove a class from $classes_array, use array_diff().
  //$vars['classes_array'] = array_diff($vars['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $vars['node']->type;
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */
