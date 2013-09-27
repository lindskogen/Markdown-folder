<?php
$_file = $_GET["file"];
$file = "../$_file";

function go404() {
	header("HTTP/1.0 404 Not Found");
	die();
}
function format_title($input) {
	$input = substr($input, 0, -3);
	$input = str_replace(array("-", "_")," ", $input);
	return ucwords($input);
}

if (!isset($_file) || !file_exists($file)) {
	go404();
}

$source = file_get_contents($file);

require "php-markdown/Michelf/Markdown.php";

header("Content-Type: text/html; charset=utf-8");
use \Michelf\Markdown;
if (isset($_GET["source"])) {
	header("Content-Type: text/plain; charset=utf-8");
	die($source);
}

$md = Markdown::defaultTransform($source);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=format_title($_file)?></title>
	<link rel="stylesheet" type="text/css" href="src/digIT.css" />
	<style type="text/css">
	a[href="?source"] {
		position: absolute;
		top: 5px;
		right: 5px;
	}
	</style>
</head>
<body>
	<a href="?source">Visa källa</a>
	<?=$md?>
</body>
</html>
