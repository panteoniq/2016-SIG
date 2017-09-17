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
	echo '</select><br/><br/>';
   echo '<div class="sensor">센서 서비스 등록</a></div><br>';
   echo '<div class="weather"><a href="weather_reg.php">기상 서비스 등록</a></div><br>';
   echo '<div class="email">메일 서비스 등록</a></div><br>';
   echo '<a href="javascript:history.go(-1)" class="button">뒤로가기</a>'
?>
</body>
</html>