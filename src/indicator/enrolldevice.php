<!DOCTYPE html>
<html>
<head>
<title>디바이스 등록 결과</title>
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
  color: white;
  text-align: center;
  font-size: 10px;
  padding: 5px;
  width: 70px;
  cursor: pointer;
  margin: 5px;
  text-decoration:none;
}

</style>
<body>
<?php
/*	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = $_POST['userid'];
	fwrite($myfile, $txt);
	$txt = "\n";
	$txt = $_POST['mac'];
	fwrite($myfile, $txt);
	$txt = "\n";
	$txt = $_POST['ipaddr'];
	fwrite($myfile, $txt);
	$txt = "\n";
	$txt = $_POST['color'];
	fwrite($myfile, $txt);
	$txt = "\n";
	$txt = $_POST['buzzer'];
	fwrite($myfile, $txt);
	$txt = "\n";
	fclose($myfile);*/
	if (empty($_POST['userid']) || empty($_POST['mac']) || empty($_POST['ipaddr']))
	{
		exit('<h1><a href="javascript:history.go(-1)" class="button">입력 폼을 채워주세요</a></h1>');
	}
	

	
	require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	$userid=mysqli_real_escape_string($dbc, trim($_POST['userid'])); // trim은 공백 제거, mysqli_real_escape_string은 mysqli의 query에 사용할 수 있는 문자열만 허용하도록 하는 함수
	$deviceid=mysqli_real_escape_string($dbc, trim($_POST['mac']));
	$ipaddr=mysqli_real_escape_string($dbc, trim($_POST['ipaddr']));
	
	//디바이스 주소(맥 주소)와 아이피 주소를 양식에 맞게 입력하였나 확인(길이만)
	if (strlen($deviceid)!=12)
	{
		exit('<h4><a href="javascript:history.go(-1)" class="button">디바이스 주소를 제대로 입력해 주세요(ex. AABBCCDDEEFF)</a></h4>');	
	}

	
	if (strlen($ipaddr)>15)
	{
		exit('<h4><a href="javascript:history.go(-1)" class="button">IP 주소를 제대로 입력해 주세요(ex.121.121.121.121)</a></h4>');
	}
	
	//입력한 디바이스가 이미 데이터베이스에 존재할 경우를 대비한 무언가를 해줌
	
	$query="select device_id from device where device_id='$deviceid'";
	$result=mysqli_query($dbc,$query)
	or die('중복 디바이스 검색 중 오류가 발생했습니다');
	if (mysqli_num_rows($result) !=0)
	{
		mysqli_free_result($result);
		exit('<h1><a href="javascript:history.go(-1)" class="button">이미 등록된 디바이스입니다</h1>');
	}
	
	$query="select devnum from user where user_id='$userid'";
	$result=mysqli_query($dbc,$query)
	or die('사용자의 디바이스 개수 검색 중 오류가 발생했습니다');
	$row = mysqli_fetch_assoc($result);
	$devnum=$row['devnum']+1;


	$query="insert into device values('$userid',$devnum, '$deviceid','$ipaddr',0, 1);";
	$result=mysqli_query($dbc,$query)
		or die('디바이스 정보 저장 중 오류가 발생했습니다');
		
	$query="update user set devnum=$devnum where user_id='$userid'";
	$result=mysqli_query($dbc,$query)
		or die('사용자의 디바이스 개수 업데이트 중 오류가 발생했습니다');
	
	echo "<pp><h3>'$deviceid'". '의 디바이스 등록이 완료되었습니다</h3></pp>';
	
	mysqli_close($dbc);
	echo '<a href="../index.php" class="button"> 홈으로 </a>';
?>
</body>
</html>