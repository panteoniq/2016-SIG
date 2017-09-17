<!DOCTYPE html>
<html>
<head>
<title>회원 가입 신청</title>
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

body a
{
	color:white;
}

body pp{
	color:black;
}
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: white;
  text-align: center;
  font-size: 15px;
  padding: 5px;
  cursor: pointer;
  text-decoration:none;
}

</style>
<body>
<?php
	
	if (empty($_POST['userid']) || empty($_POST['hpnumber']) || empty($_POST['pass']) || empty($_POST['passcon']) || empty($_POST['email']) || empty($_POST['pop']) || empty($_POST['email_pass']) || empty($_POST['email_passcon']))
	{
		exit('<h2><a href="javascript:history.go(-1)" style="width:150px;" class="button">입력 폼을 채워주세요</a></h2>');
	}
	

	
	require_once('dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	$userid=mysqli_real_escape_string($dbc, trim($_POST['userid'])); // trim은 공백 제거, mysqli_real_escape_string은 mysqli의 query에 사용할 수 있는 문자열만 허용하도록 하는 함수
	$hpnumber=mysqli_real_escape_string($dbc, trim($_POST['hpnumber']));
	$pass=mysqli_real_escape_string($dbc, trim($_POST['pass']));
	$passcon=mysqli_real_escape_string($dbc, trim($_POST['passcon']));
	$email=mysqli_real_escape_string($dbc, trim($_POST['email']));
	$email_pass=mysqli_real_escape_string($dbc, trim($_POST['email_pass']));
	$email_passcon=mysqli_real_escape_string($dbc, trim($_POST['email_passcon']));
	$port=995;
	$pop="pop.gmail.com";
	
	//아이디와 핸드폰 번호, 패스워드의 길이 체크(정상 작동)
	if (strlen($userid)>15)
	{
		exit('<h4><a href="javascript:history.go(-1)" class="button">아이디는 최대 15자까지 입력 가능합니다</a></h4>');	
	}
	else if (strlen($userid)<4)
	{
		exit('<h4><a href="javascript:history.go(-1)" class="button">아이디는 적어도 4자 이상 입력해야 합니다</a></h4>');
	}
	
	if (strlen($hpnumber)>11)
	{
		exit('<h4><a href="javascript:history.go(-1)" class="button">핸드폰 번호는 "-" 문자 없이 11자로 입력해야 합니다(01012341234)</a></h4>');	
	}
	
	
	if (strlen($pass)>20)
	{
		exit('<h4><a href="javascript:history.go(-1)" class="button">비밀번호는 최대 20자까지 입력 가능합니다</a></h4>');
	}
	else if (strlen($pass)<4)
	{
		exit('<h1><a href="javascript:history.go(-1)" class="button">비밀번호는 적어도 4자 이상 입력해야 합니다</a></h4>');
	}
	//패스워드를 두 번 다 정확히 입력하였는지 체크(정상 작동)
	if ($pass!=$passcon)
	{
		exit('<h4><a href="javascript:history.go(-1)" class="button">비밀번호와 비밀번호 확인이 서로 다릅니다</a></h4>');
	}
	
	if ($email_pass!=$email_passcon)
	{
		exit('<h4><a href="javascript:history.go(-1)" class="button">이메일 비밀번호와 이메일 비밀번호 확인이 서로 다릅니다</a></h4>');
	}
	
	//입력한 이메일이 이미 데이터베이스에 존재할 경우를 대비한 무언가를 해줌
	
	
	$query="select user_id from user where user_id='$userid'";
	$result=mysqli_query($dbc,$query)
	or die('Error Querying database.');
	if (mysqli_num_rows($result) !=0)
	{
		mysqli_free_result($result);
		exit('<h3><a href="javascript:history.go(-1)" class="button"> 이미 등록된 아아디입니다</h3>');
	}
	
	
	mysqli_free_result($result);
	$query="insert into user values('$userid', SHA('$pass'), '$hpnumber', '$email',SHA('$email_pass'),'$pop', $port,0,0, NOW(), 0)";//SHA : 암호화 함수. check할 때에는 다시 sha를 통해 복호화하도록 함
	
	$result=mysqli_query($dbc,$query)
		or die('Error Querying database.');
	
	echo "<pp><h3>'$userid'". '의 회원가입이 완료되었습니다</h3></pp>';
	
	mysqli_close($dbc);
	echo '<a href="index.php" class="button"> 홈으로 </a>';
?>
</body>
</html>