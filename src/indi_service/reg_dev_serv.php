<?php
	session_start();
	ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>서비스 등록</title>
	<meta charset="utf-8"/>
</head>
<style> 
a{
	color:black;
	text-decoration:none;
}
a:hover, a:active{
	color:green;
}

body 
{
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
	font-size: 15px;
	color:black;
}

body h1
{
color:black;
}

</style>

<body>
<?php
   if (!isset($_SESSION['id'])) {
      exit('<a href="index.php"> 로그인 상태가 아닙니다</a></body></html>');
   }
   $userid=$_SESSION['id'];
   
	
	require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	
	$query="select * from device where user_id='$userid'";
	$result=mysqli_query($dbc,$query) or die('사용자의 디바이스 개수 검색 중 오류가 발생했습니다');
	
   echo '<div class="sensor"><a href="dev_sensor_reg.php?">센서 서비스 모듈 등록</a></div><br>';
   echo '<div class="weather"><a href="dev_weather_reg.php">기상 서비스 모듈 등록</a></div><br>';
   echo '<div class="email"><a href="dev_email_reg.php">이메일 서비스 모듈 등록</a></div><br>';
   echo '<div class="calandar"><a href="dev_calandar_reg.php">캘린더 서비스 모듈 등록</a></div><br>';
   echo '<a href="javascript:history.go(-1)" class="button">뒤로가기</a>'
?>
</body>
</html>