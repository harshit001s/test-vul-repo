<?php

if( isset( $_POST[ 'Submit' ] ) ) {
	$url = $_REQUEST[ 'url' ];
	$parsed = parse_url( $url );
	$host = isset( $parsed[ 'host' ] ) ? strtolower( $parsed[ 'host' ] ) : '';

	if( $host == 'localhost' || $host == '127.0.0.1' ) {
		$html .= '<pre>Blocked: access to local resources is not allowed.</pre>';
	}
	else {
		$response = @file_get_contents( $url );

		if( $response === false ) {
			$html .= '<pre>Failed to fetch URL.</pre>';
		}
		else {
			$html .= '<pre>' . htmlspecialchars( substr( $response, 0, 2000 ) ) . '</pre>';
		}
	}
}

?>
