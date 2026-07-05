<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: Server-Side Request Forgery (SSRF)' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'ssrf';
$page[ 'help_button' ]   = 'ssrf';
$page[ 'source_button' ] = 'ssrf';

$vulnerabilityFile = '';
switch( dvwaSecurityLevelGet() ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;
	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;
	case 'high':
		$vulnerabilityFile = 'high.php';
		break;
	default:
		$vulnerabilityFile = 'impossible.php';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/ssrf/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Vulnerability: Server-Side Request Forgery (SSRF)</h1>

	<div class=\"vulnerable_code_area\">
		<h2>URL Preview</h2>
		<p>Enter a URL to fetch and preview its contents from the server.</p>

		<form name=\"fetch\" action=\"#\" method=\"post\">
			<p>
				URL:
				<input type=\"text\" name=\"url\" size=\"50\" placeholder=\"http://example.com\">
				<input type=\"submit\" name=\"Submit\" value=\"Fetch\">
			</p>\n";

if( $vulnerabilityFile == 'impossible.php' )
	$page[ 'body' ] .= "			" . tokenField();

$page[ 'body' ] .= "
		</form>
		{$html}
	</div>

	<h2>More Information</h2>
	<ul>
		<li>" . dvwaExternalLinkUrlGet( 'https://owasp.org/www-community/attacks/Server_Side_Request_Forgery', 'OWASP - Server Side Request Forgery' ) . "</li>
		<li>" . dvwaExternalLinkUrlGet( 'https://owasp.org/www-project-web-security-testing-guide/latest/4-Web_Application_Security_Testing/07-Input_Validation_Testing/19-Testing_for_Server-Side_Request_Forgery', 'WSTG - Testing for Server-Side Request Forgery' ) . "</li>
		<li>" . dvwaExternalLinkUrlGet( 'https://cwe.mitre.org/data/definitions/918.html', 'CWE-918: Server-Side Request Forgery (SSRF)' ) . "</li>
	</ul>
</div>\n";

dvwaHtmlEcho( $page );

?>
