<?
$CI =& get_instance();

print_r($results;)

if (isset($results)) {

	$header = array();
	foreach($results[0] as $key => $value) {
		$header[] = $key;
	}
	
	print_r($header);
}

?>
