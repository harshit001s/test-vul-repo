<?php

if( isset( $_POST[ 'Submit' ] ) ) {
	$url = $_REQUEST[ 'url' ];

	$response = @file_get_contents( $url );

	if( $response === false ) {
		$html .= '<pre>Failed to fetch URL.</pre>';
	}
	else {
		$html .= '<pre>' . htmlspecialchars( substr( $response, 0, 2000 ) ) . '</pre>';
	}
}

?>
