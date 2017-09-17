<?php
   require_once("../session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>디바이스 수정</title>
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
  font-size: 15px;
  padding: 4px;
  width: 70px;
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
	font-size: 15px;
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
    padding: 6px 5px;
    width: 200px;
    margin-bottom: 10px;
    box-shadow: inset 0 2px 3px rgba( 0, 0, 0, 0.1 );
    clear: both;
	font-size: 15px;
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
	<h1>사용자 디바이스 수정</h1>
    <?php
	$userid=$_SESSION['id'];
	
	require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	
	$query="select * from device where user_id='$userid'";
	$result=mysqli_query($dbc,$query)
	or die('사용자의 디바이스 개수 검색 중 오류가 발생했습니다');
	echo '<form method="post" action="modifydevice.php">';
    echo '<input type="hidden" name="userid" value="'.$_SESSION['id'].'">';
    echo '수정할 디바이스 선택 : <br>';
	echo '<select name="mac">';
	while($row = mysqli_fetch_assoc($result))
	{
		echo '<option value="'.$row['device_id'].'">'.$row['device_id'].'</option>';	
	}
	echo '</select><br/><br/>';
	echo '수정할 디바이스 ID (AABBCCDDEEFF) :<br>';
	echo '<input type="text" class="input" name="newmac" placeholder="변경할 디바이스 ID를 입력하세요(AABBCCDDEEFF)"/><br/>';
    echo '수정할 IP주소 (123.123.123.123) :  <br>';
	echo '<input type="text" class="input" name="ipaddr" placeholder="수정할 ip주소를 입력하세요(111.111.111.111)"/><br/>';
    echo '수정할 LED 색깔 (1 : 빨강 / 2 : 초록 / 3 : 파랑) : <br>';
    echo '<input type="text" class="input" name="color" placeholder="수정할 LED 색깔"/><br/>';
    echo '부저 ON/OFF 설정(기본값 OFF) : <br>';
    echo '<select name="buzzer">';
    echo '	<option value="OFF">OFF</option>';
    echo '	<option value="ON">ON</option>';
    echo '</select><br/><br/>';
	echo '<button class="button" style="vertical-align:middle"><span>수정</span></button>';
    echo '<a href="javascript:history.go(-1)" class="button">뒤로가기</a>';
	echo '</form>';
	?>
</body>
</html>