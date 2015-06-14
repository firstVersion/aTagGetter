<?php 

 ini_set( "display_errors", "Off");

 function TagChecker( $source ){

	if( empty($_POST["url"]) ) return;

	$html_source = file_get_contents($source);
	$rip_source = preg_replace("/\n/", ' ', $html_source);
	$pattern = "/<(a|A)(.*)>(.*)<\/(a|A)>/";
	preg_match_all($pattern, $rip_source, $match);
	
	if(count($match[0])!=0)
		foreach($match[0] as $link)echo $link."<br>";
	else 
		echo "aタグを見つけられんかった";

	unlink($source);

 }

?>

<html>
<head>
	<meta charset="utf-8">
	<title>妖怪aタグ拾い</title>
</head>
<p>チェックしたい奴のurlをはるのです</p>
<body>
<form method="POST" action="./aTagChecker.php">
<input type="text" name="url">
<input type="submit" value="お願いする">
</form>
<p>下記が指定urlのリンクをのせるのです</p>
<hr>
<div style="position:relative;"><?php TagChecker($_POST["url"]); ?></div>
</body>
</html>

