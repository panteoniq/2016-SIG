<?php
	session_start();
	ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<style>
body
{
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
   	font-size: 15px;
}

a:link, a:visited {
    background-color: #f4511e;
    padding: 4px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
	color:white;
}
</style>
<title>로그아웃 결과</title>
<meta charset="utf-8"/>
</head>
<body>
<?php
	
	if (!isset($_SESSION['id']))
	{ //이미 로그인된 상태라면
		exit('<a href="index.php">로그인 상태가 아닙니다</a></body><html>');
	}
	$_SESSION = array();//세션 초기화(삭제)
	if (isset($_COOKIE[session_name()]))
	{
		setcookie(session_name(),'',time()-(60*60));//현재시간보다 1시간 빠르다 : 유효하지 않게 한다
	}
	
	session_destroy();
	
	setcookie('userid', '', time()-(60*60));
	
	echo '<body><h2>로그아웃하였습니다.</h2><br/></br><a href="index.php">홈으로</a></body>';
?>
</body>
</html>