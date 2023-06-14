<?php
ob_start("minifier");
function minifier($code) {
	$search = array(
		
		// Remove whitespaces after tags
		'/\>[^\S ]+/s',
		
		// Remove whitespaces before tags
		'/[^\S ]+\</s',
		
		// Remove multiple whitespace sequences
		'/(\s)+/s',
		
		// Removes comments
		'/<!--(.|\s)*?-->/'
	);
	$replace = array('>', '<', '\\1');
	$code = preg_replace($search, $replace, $code);
	return $code;
}
?>
<!DOCTYPE html>
<html>

<head>

<!-- title of page -->

<title>Demo for minifier</title>

</head>

<body>

<!-- body of page -->

<h1>Hello World</h1>

</body>

</html>

<?php
ob_end_flush();
?>
