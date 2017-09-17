<?php
	session_start();
	ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>로그인 결과</title>
<meta charset="utf-8"/>
</head>
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


a:hover, a:active {
    background-color: #f4511e;
}
</style>
<body>
<?php
	
	if (isset($_SESSION['id']))
	{ //이미 로그인된 상태라면
		exit('<a href="index.php">세션을 통해 로그인 정보를 확인했습니다</a></body><html>');
	}
	
	if (empty($_POST['userid']) || empty($_POST['pass']))
	{
		exit('<a href="javascript:history.go(-1)">로그인 폼을 채워주세요</a></body><html>');
	}
	
	
	require_once('dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	
	$userid=mysqli_real_escape_string($dbc, trim($_POST['userid'])); // trim은 공백 제거, mysqli_real_escape_string은 mysqli의 query에 사용할 수 있는 문자열만 허용하도록 하는 함수
	$pass=mysqli_real_escape_string($dbc, trim($_POST['pass']));
	

	
	$query="select user_id, password from user where user_id='$userid' and password=SHA('$pass')";
	$result=mysqli_query($dbc,$query)
	or die('Error Querying database.');
	
	//입력한 아이디가 존재하는지 확인
	if (mysqli_num_rows($result) ==1)
	{
		$row=mysqli_fetch_assoc($result);
		
		//마지막 로그인 시간 수정
		$query="update user set last_login = NOW() where user_id='$userid'";
		mysqli_query($dbc,$query)
		or die('Error Querying database.');
		
		$userid=$row['user_id'];
		$_SESSION['id']=$userid;//이렇게 나눠서 해줘야 에러가 없음
		setcookie('userid', $row['user_id'],time()+(60*60*24));
		echo "<body><h3>'$userid'". "의 로그인에 성공했습니다</h3><br/><br/><a href='index.php'>홈으로</a></body>";
	}
	else
	{
		echo "<body>로그인에 실패했습니다<br/><br/>
		<a href='index.php'>홈으로</a></body>";
	}
//	$jsonTempData['id'] = $userid;
//    $jsonTempData['pw'] = $pass;
//    $jsonData[] = $jsonTempData;
//    $outputArr['Android'] = $jsonData; 
//    print_r( json_encode($outputArr));
	
	
	  
	mysqli_free_result($result);
	

	
	mysqli_close($dbc);
?>
</body>
</html>