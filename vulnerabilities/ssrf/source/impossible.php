<?php

if( isset( $_POST[ 'Submit' ] ) ) {
	checkToken( $_REQUEST[ 'user_token' ], $_SESSION[ 'session_token' ], 'index.php' );

	$url = $_REQUEST[ 'url' ];
	$parsed = parse_url( $url );

	if( !isset( $parsed[ 'scheme' ] ) || !in_array( strtolower( $parsed[ 'scheme' ] ), array( 'http', 'https' ) ) ) {
		$html .= '<pre>Blocked: only HTTP and HTTPS URLs are allowed.</pre>';
	}
	elseif( !isset( $parsed[ 'host' ] ) ) {
		$html .= '<pre>Blocked: invalid URL.</pre>';
	}
	else {
		$host = strtolower( $parsed[ 'host' ] );
		$ip = gethostbyname( $host );

		if( $ip === $host && !filter_var( $host, FILTER_VALIDATE_IP ) ) {
			$html .= '<pre>Blocked: could not resolve hostname.</pre>';
		}
		elseif( !filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) ) {
			$html .= '<pre>Blocked: access to private or reserved addresses is not allowed.</pre>';
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
}

generateSessionToken();

?>
