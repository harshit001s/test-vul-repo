<div class="body_padded">
	<h1>Help - Server-Side Request Forgery (SSRF)</h1>

	<div id="code">
	<table width='100%' bgcolor='white' style="border:2px #C0C0C0 solid">
	<tr>
	<td><div id="code">
		<h3>About</h3>
		<p>Server-Side Request Forgery (SSRF) occurs when an application fetches a remote resource using a user-supplied URL without validating the destination. An attacker can abuse this to make the server send requests to internal services, cloud metadata endpoints, or other resources that are not directly reachable from the internet.</p>

		<p>Because the request originates from the server, it may bypass firewalls and access control that protect internal networks.</p>

		<br /><hr /><br />

		<h3>Objective</h3>
		<p>Use the URL preview feature to make the server fetch a resource it should not be able to reach, such as a local service or internal endpoint.</p>

		<br /><hr /><br />

		<h3>Low Level</h3>
		<p>The application passes the submitted URL directly to <code>file_get_contents()</code> with no validation.</p>
		<pre>Spoiler: <span class="spoiler">Try fetching http://127.0.0.1/ or a local service port.</span></pre>

		<br />

		<h3>Medium Level</h3>
		<p>A basic blocklist prevents requests to <code>localhost</code> and <code>127.0.0.1</code>, but alternative host representations are still accepted.</p>
		<pre>Spoiler: <span class="spoiler">Try decimal IP notation (2130706433), IPv6 loopback, or DNS names that resolve to 127.0.0.1.</span></pre>

		<br />

		<h3>High Level</h3>
		<p>Additional filters block common loopback addresses and restrict the URL scheme, but the checks are incomplete.</p>
		<pre>Spoiler: <span class="spoiler">Bypass the host block using alternative IP encodings such as octal or shortened forms.</span></pre>

		<br />

		<h3>Impossible Level</h3>
		<p>The application resolves the hostname, validates the resulting IP against private and reserved ranges, and only allows HTTP/HTTPS schemes. Combined with CSRF protection, this prevents straightforward SSRF.</p>
	</div></td>
	</tr>
	</table>

	</div>

	<br />

	<p>Reference: <?php echo dvwaExternalLinkUrlGet( 'https://owasp.org/www-community/attacks/Server_Side_Request_Forgery' ); ?></p>
</div>
