<?php
/**
 * @file views-views-json-style-simple.tpl.php
 * Default template for the Views JSON style plugin using the simple format
 *
 * Variables:
 * - $view: The View object.
 * - $rows: Hierachial array of key=>value pairs to convert to JSON
 * - $options: Array of options for this style
 *
 * @ingroup views_templates
 */

$jsonp_prefix = $options['jsonp_prefix'];
foreach($rows as $key => $value):
	foreach($value as $keyy => $valuee):
		if($keyy == "field" || $keyy == "country") $rows[$key][$keyy]['link'] = url('taxonomy/term/'.$value[$keyy]['tid']);
		if($keyy == "country") $rows[$key][$keyy]['safe_name'] = transliteration_clean_filename($rows[$key][$keyy]['name']);
		if($keyy == "country") {
		  $link = explode("/", $rows[$key][$keyy]['link']);
  		$rows[$key][$keyy]['link'] = "/projects#country=".$link[2];
		}
		if($keyy == "field"){
		  $link = explode("/", $rows[$key][$keyy]['link']);
  		$rows[$key][$keyy]['link'] = "/projects#field=".$link[2];
  		
		}
		if($keyy == "node") $rows[$key][$keyy]['safe_name_country'] = transliteration_clean_filename($rows[$key][$keyy]['country']);
		if($keyy == "node") $rows[$key][$keyy]['safe_name_field'] = transliteration_clean_filename($rows[$key][$keyy]['field']);
	endforeach;
endforeach;

//print_r($rows);

if ($view->override_path) {
  // We're inside a live preview where the JSON is pretty-printed.
  $json = _views_json_encode_formatted($rows);
  if ($jsonp_prefix) $json = "$jsonp_prefix($json)";
  print "<code>$json</code>";
}
else {
  $json = _views_json_json_encode($rows, $bitmask);
  if ($options['remove_newlines']) {
     $json = preg_replace(array('/\\\\n/'), '', $json);
  }

  if (isset($_GET[$jsonp_prefix]) && $jsonp_prefix) {
    $json = $_GET[$jsonp_prefix] . '(' . $json . ')';
  }

  if ($options['using_views_api_mode']) {
    // We're in Views API mode.
    print $json;
  }
  else {
    // We want to send the JSON as a server response so switch the content
    // type and stop further processing of the page.
    $content_type = ($options['content_type'] == 'default') ? 'application/json' : $options['content_type'];
    drupal_add_http_header("Content-Type", "$content_type; charset=utf-8");
    print $json;
    drupal_page_footer();
    exit;
  }
}