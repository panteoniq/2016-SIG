<!DOCTYPE html>
<html>
<head>
<title>사용자 검증</title>
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

body pp{
	color:black;
}
a{
	text-decoration:none;
}

.input {
    background: #f5f5f5;
    font-size: 15px;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    border: none;
    padding: 10px 7px;
    width: 200px;
    margin-bottom: 15px;
    box-shadow: inset 0 2px 3px rgba( 0, 0, 0, 0.1 );
    clear: both;
}

.input:focus {
    background: #fff;
    box-shadow: 0 0 0 3px #fff38e, inset 0 2px 3px rgba( 0, 0, 0, 0.2 ), 0px 5px 5px rgba( 0, 0, 0, 0.15 );
    outline: none;
}

.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: white;
  text-align: center;
  padding: 5px;
  width: 100px;
  cursor: pointer;
  text-decoration:none;
    font-size: 15px;
}

</style>
<body>
<?php
	if (empty($_POST['pass']) || empty($_POST['id']))
	{
		exit('<h3><a href="javascript:history.go(-1)" class="button">입력 폼을 채워주세요</a></h3>');
	}

	
	require_once('dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	$userid=mysqli_real_escape_string($dbc, trim($_POST['id'])); // trim은 공백 제거, mysqli_real_escape_string은 mysqli의 query에 사용할 수 있는 문자열만 허용하도록 하는 함수
	$pass=mysqli_real_escape_string($dbc, trim($_POST['pass']));
	
	$query="select id, password from user where id='$userid' and password=SHA('$pass')";
	$result=mysqli_query($dbc,$query)
	or die('Error Querying database.');
	
	
	if (mysqli_num_rows($result) ==0)
	{
		exit('<a href="index.php">비밀번호가 맞지 않습니다</a></body><html>');	
	}
?>
<form method="post" enctype="multipart/form-data" action="db_hpnum_modify.php">
		새로운 사용자의 핸드폰 번호(01012125656):<br/>
		<input type="text" class="input" name="hpnum" placeholder="새로운 핸드폰 번호를 입력하세요.."/><br/>
        <input type="hidden" class="input" name="id" value="<?php echo $_POST['id']; ?>"/>
        <input type="submit" class="button" value="수정"/>
        <a href="javascript:history.go(-1)" class="button">뒤로가기</a>
        <br><br>
<form method="post" enctype="multipart/form-data" action="db_pass_modify.php">
		새로운 사용자의 비밀번호:<br/>
		<input type="password" class="input" name="pass" placeholder="새로운 비밀번호를 입력하세요.."/><br/>
        비밀번호 확인:<br/>
		<input type="password", class="input" name="passcon" placeholder="비밀번호를 다시 입력하세요..."/><br/>
        <input type="hidden" class="input" name="id" value="<?php echo $_POST['id']; ?>"/>
        <input type="submit" class="button" value="수정"/>
        <a href="javascript:history.go(-1)" class="button">뒤로가기</a>
</body>
</html>