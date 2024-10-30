<?php
//  This does the server side processing for wp-digg-conditional
//  The script is called by the prototype.js AJAX request

//  'permalink' is sent as a parameter.  This is the link to the article that we are
//    checking for.

//  minDiggs is an optional parameter.  This is the threshhold that we use to check
//    if an article is popular enough to have the Digg badge displayed.
    
    
    if (isset($_GET['permalink'])) {
    	$permalink = $_GET['permalink'];
    } else {
    	die('');
    }
	
	//  Change $minDiggs to the number of Diggs you want an article to have before
	//    the badge appears.  Default is 10.
	if (isset($_GET['minDiggs'])) {
		$minDiggs = $_GET['minDiggs'];
	} else {
		$minDiggs = 10;
	}
	
	//  Get the response from the Digg API server
	$info = queryDigg($permalink);
	
	//  Return the Digg link if the article is ok.  Otherwise blank.
	if ($info['diggs'] > $minDiggs) {
		echo $info['href'];
	} else {
		echo '';
	}

//  This function builds and sends the request to the Digg API server.
//  $permalink is the link to the actual article that we're checking out
function queryDigg($permalink) {

	ini_set('user_agent', 'WPConditionalDiggBadge/1.0');
	
	$params = array();
	$params['appkey'] = 'http://www.earn-web-cash.com';
	$params['type'] = 'xml';
	$params['count'] = '1';
	$params['link'] = $permalink;
	$params['min_submit_date'] = 0;
	$params['max_submit_date'] = time();
	
	$query = buildQuery($params);
	
	$baseurl = 'http://services.digg.com';
	$endpoint = '/stories';
	$url = $baseurl . $endpoint;
	
	$reqUrl = $url . $query;
	
	$file = file_get_contents($reqUrl);
	$xml = simplexml_load_string($file);
  
  	$info = array();
  	
	//  Get Diggs if story has been dugg, otherwise default to 0
	if ($xml && (int) $xml['count'] > 0) {
		$info['href'] =  (string) $xml->story['href'];
		$info['diggs'] = (int) $xml->story['diggs'];
	} else {
		$info['href'] = '';
		$info['diggs'] = 0;
	}
	
	return $info;
}

//  Takes an array of arguments and returns a query string
//  Each parameter's name is its key in the array
function buildQuery ($args) {
  $query = '?';
  foreach ($args as $key => $val) {
    if ($query != '?') {
      $query .= '&';
    }

    $query .= $key . '=' . urlencode($val);
  }

  return $query;
}
?>