<!DOCTYPE html> 
<html> 
<head> 
  <title>Unblock</title> 
</head> 
<body style="background-color:black;font-size:34pt;color:white;"> 
<center>
<form method="post" style="padding-top:10%;"> 
  <input type="text" name="URL" id="URL" style="height:80px;font-size:34pt;"><br><br>
  <button type="submit" name="Unblock" style="height:80px;font-size:34pt;">Unblock</button> 
</form> 
<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
if(isset($_POST['Unblock'])) { 
	$url = $_POST['URL'];
	$file = 'domains.txt';
	$parsed = parse_url($url, PHP_URL_HOST) ?: $url;
	$current = file_get_contents($file);
	if (str_contains($current, $parsed)) {
		echo $parsed.' is already unblocked';
	} else {
		file_put_contents($file, PHP_EOL.$parsed, FILE_APPEND | LOCK_EX);
		echo 'Unblocked '.$parsed;
	}
} 
?> 
</center>
 
</body> 
</html> 