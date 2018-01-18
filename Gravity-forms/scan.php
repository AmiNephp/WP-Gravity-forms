<html>
<title>./scan</title>
<form method=post>
<center>
<h1><font face=tahoma>Gravity-forms auto scan Coded By Am!Ne</font></h1>
<textarea name="site" placeholder="http://www.target.com/" cols="80" rows="15"></textarea><br><br>
<input type="submit" name="ok" value="Start Scan"><br><br>
<?php
if(isset($_POST['ok'])) {
	$site = explode("\n",$_POST['site']);
	foreach($site as $sites) {
		$sites = trim($sites);
		$ex = $sites."/?gf_page=upload";
		$get = @file_get_contents($ex);
		if(preg_match_all('#{"status" : "error", "error" : {"code": 500, "message": "Failed to upload file."}}#i',$get)) {
			echo "<font color=green face=tahoma><a href='$sites' style='text-decoration:none;' target='_blance'>$sites</a> => Vuln :D</font><br>";
			$open = fopen("SCAN-RESULT.txt","a");
			fwrite($open,"\n\r".$sites."\n\r");
		} else {
			echo "<font color=red face=tahoma>$sites => Not Vuln :(</font><br>";
		}
	}
}
?>
</center>
</html>
