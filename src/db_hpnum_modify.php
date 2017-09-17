<!DOCTYPE html>
<html>
<head>
<title>핸드폰 번호 변경 결과</title>
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
}

body a
{
	color:blue;
}

body pp{
	color:black;
}
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: black;
  text-align: center;
  padding: 5px;
  width: 100px;
  cursor: pointer;
  text-decoration:none;
}

</style>
<body>
<?php
	
	if (empty($_POST['id']) || empty($_POST['hpnum']))
	{
		exit('<h3><a href="javascript:history.go(-1)" class="button">입력 폼을 채워주세요</a></h3>');
	}
	

	
	require_once('/dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	$userid=mysqli_real_escape_string($dbc, trim($_POST['id'])); // trim은 공백 제거, mysqli_real_escape_string은 mysqli의 query에 사용할 수 있는 문자열만 허용하도록 하는 함수
	$hpnum=mysqli_real_escape_string($dbc, trim($_POST['hpnum']));	
	//아이디와 핸드폰 번호, 패스워드의 길이 체크(정상 작동)	
	if (strlen($hpnum)<11)
	{
		exit('<h4><a href="javascript:history.go(-1)" class="button">핸드폰 번호는 11자리여야 합니다<br>("-"문자 없이. ex. 01011112222)</a></h4>');
	}
	//핸드폰 번호 변경을 시킬 거다
	//여기서부터 추가할 것
	$query="update user set hpnum='$hpnum' where id='$userid'";
	
	$result=mysqli_query($dbc,$query)
		or die('Error Querying database.');
	
	echo "<pp><h3>'$userid'". '의 핸드폰 번호 변경이 완료되었습니다</h3></pp>';
	
	mysqli_close($dbc);
	echo '<a href="index.php" class="button"> 홈으로 </a>';
?>
</body>
</html>