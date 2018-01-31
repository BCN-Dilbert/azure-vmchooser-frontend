<?php 
ob_start();
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="' . $csvfile . '"');
defined('BASEPATH') OR exit('No direct script access allowed');
// https://stackoverflow.com/questions/3933668/convert-array-into-csv
function arrayToCsv( array &$fields, $delimiter = ',', $enclosure = '"', $encloseAll = false, $nullToMysqlNull = false ) {
    $delimiter_esc = preg_quote($delimiter, '/');
    $enclosure_esc = preg_quote($enclosure, '/');

    $output = array();
    foreach ( $fields as $field ) {
        if ($field === null && $nullToMysqlNull) {
            $output[] = 'NULL';
            continue;
        }

        // Enclose fields containing $delimiter, $enclosure or whitespace
        if ( $encloseAll || preg_match( "/(?:${delimiter_esc}|${enclosure_esc}|\s)/", $field ) ) {
            $output[] = $enclosure . str_replace($enclosure, $enclosure . $enclosure, $field) . $enclosure;
        }
        else {
            $output[] = $field;
        }
    }

    return implode( $delimiter, $output );
}

if (isset($results)) { 

	$header = array();
	foreach($results[0] as $key => $value) {
		$header[] = $key;
	}
    echo "test";
	print_r(arrayToCsv($header));
	echo PHP_EOL;
	foreach($results as $row) {
		print_r(arrayToCsv($row));
		echo PHP_EOL;
	}

}
ob_end_clean();
?>