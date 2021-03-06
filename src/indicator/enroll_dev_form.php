<?php
	session_start();
	ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>디바이스 등록</title>
	<meta charset="utf-8"/>
</head>
<style> 

.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 10px;
  padding: 2px;
  width: 50px;
  cursor: pointer;
  margin: 5px;
}


.button {
  cursor: pointer;
  display: inline-block;
  position: relative;
  color:white;
}
body 
{
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
	font-size: 10px;
}

body h1
{
color:black;
}

input:-webkit-input-placeholder {
    color: #b5b5b5;
}

input-moz-placeholder {
    color: #b5b5b5;
}

.input {
    background: #f5f5f5;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    padding: 3px 2px;
    width: 150px;
    margin-bottom: 10px;
    box-shadow: inset 0 2px 3px rgba( 0, 0, 0, 0.1 );
    clear: both;
	font-size: 10px;
}

.input:focus {
    background: #fff;
    box-shadow: 0 0 0 3px #fff38e, inset 0 2px 3px rgba( 0, 0, 0, 0.2 ), 0px 5px 5px rgba( 0, 0, 0, 0.15 );
    outline: none;
}
a{
	text-decoration:none;
}


</style>

<body>
<?php
   if (!isset($_SESSION['id'])) {
      exit('<a href="index.php"> 로그인 상태가 아닙니다</a></body></html>');
   }
?>
	<h2>사용자 디바이스 등록</h2>
	<form method="post" action="enrolldevice.php">
    	<input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
        디바이스 ID (AABBCCDDEEFF) :<br>
		<input type="text" class="input" name="mac" placeholder="디바이스 ID를 입력하세요(AABBCCDDEEFF)"/><br/>
        IP주소 (123.123.123.123) :  <br>
		<input type="text" class="input" name="ipaddr" placeholder="ip주소를 입력하세요(111.111.111.111)"/><br/>
		<button class="button" style="vertical-align:middle"><span>등록</span></button>
        <a href="javascript:history.go(-1)" class="button">뒤로가기</a>
	</form>
</body>
</html>