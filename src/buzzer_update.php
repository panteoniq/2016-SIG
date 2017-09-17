<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DB 업데이트</title>
</head>

<body>
<?php
if (!empty($_POST['device_id']) && !empty($_POST['state']))
{
	//DB접속
	require_once('dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc, 'set names utf8');
	
	$devid=mysqli_real_escape_string($dbc, trim($_POST['device_id']));
	$buzstate=mysqli_real_escape_string($dbc, trim($_POST['state']));
	
	//DB변경
	if ($buzstate=="ON")
	{
		$query="update device set buzzer=0 where device_id='$devid'";
		$result=mysqli_query($dbc,$query)
		or die('Error Querying database.');
	}
	else
	{
		$query="update device set buzzer=1 where device_id='$devid'";
		$result=mysqli_query($dbc,$query)
		or die('Error Querying database.');
	}
	
}
?>

</body>
</html>
