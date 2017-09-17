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
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 3px;
  width: 80px;
  cursor: pointer;
  font-size: 15px;
}

</style>
<title>회원 정보 수정</title>
<meta charset="utf-8"/>
</head>
<body>
<?php
	
	if (!isset($_SESSION['id']))
	{ //이미 로그인된 상태라면
		exit('<a href="javascript:history.go(-1)">로그인 상태가 아닙니다</a></body><html>');
	}
	//비밀번호를 두 번 새로 입력받게 함
?>
<form method="post" enctype="multipart/form-data" action="verify.php">
		현재 사용자의 비밀번호:<br/>
		<input type="password" class="input" name="pass" placeholder="비밀번호를 입력하세요.."/><br/>
        <input type="hidden" class="input" name="id" value="<?php echo $_SESSION['id']; ?>"/>
        <input type="submit" class="button" value="입력"/>
        <a href="javascript:history.go(-1)" class="button">뒤로가기</a>
</form>
</body>
</html>