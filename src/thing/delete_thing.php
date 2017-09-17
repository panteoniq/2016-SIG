<!DOCTYPE html>
<html>
<head>
<title>Thing 삭제 결과</title>
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
  font-size: 15px;
  padding: 5px;
  width: 100px;
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
	if (empty($_POST['userid']) || empty($_POST['mac']))
	{
		exit('<h1><a href="javascript:history.go(-1)" class="button">입력 폼을 채워주세요</a></h1>');
	}
	

	
	require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	$userid=mysqli_real_escape_string($dbc, trim($_POST['userid'])); // trim은 공백 제거, mysqli_real_escape_string은 mysqli의 query에 사용할 수 있는 문자열만 허용하도록 하는 함수
	$thingmac=mysqli_real_escape_string($dbc, trim($_POST['mac']));
	
	//입력한 디바이스가 이미 데이터베이스에 존재할 경우를 대비한 무언가를 해줌
	
	$query="select thing_mac from thing where thing_mac='$thingmac'";
	$result=mysqli_query($dbc,$query)
	or die('중복 Thing 검색 중 오류가 발생했습니다');
	if (mysqli_num_rows($result) ==0)
	{
		mysqli_free_result($result);
		exit('<h3><a href="javascript:history.go(-1)" class="button">없는 Thing에 대해 삭제를 시도했습니다</h3>');
	}
	
	
	
	$query="delete from thing where user_id='$userid' and thing_mac='$thingmac'";
	$result=mysqli_query($dbc,$query)
	or die('Thing 정보 삭제 중 오류가 발생했습니다');
	
	$query="select thingnum from user where user_id='$userid'";
	$result=mysqli_query($dbc,$query)
	or die('사용자의 Thing 개수 검색 중 오류가 발생했습니다');
	$row = mysqli_fetch_assoc($result);
	$thingnum=$row['thingnum']-1;
	
	$query="update user set thingnum=$thingnum where user_id='$userid'";
	$result=mysqli_query($dbc,$query)
		or die('사용자의 Thing 개수 업데이트 중 오류가 발생했습니다');
	
	//삭제 이후 남아잇는 Thing들에 대한 번호 재설정 필요
	$query="select thing_mac from thing where user_id='$userid'";
	$result=mysqli_query($dbc,$query)
	or die('Thing 검색 중 오류가 발생했습니다');
	
	while($row=mysqli_fetch_assoc($result))
	{
		$count=1;
		$thingid=$row['thing_id'];
		$query="update thing set thing_id=$count where thing_id=$thingid";
		$result=mysqli_query($dbc,$query) or die('사용자의 Thing 정보 업데이트 중 오류가 발생했습니다');
		$count++;
		
	}
	
	echo '<pp><h2>'.$thingmac.'의 삭제가 완료되었습니다</h2></pp>';
	
	mysqli_close($dbc);
	echo '<a href="../index.php" class="button"> 홈으로 </a>';
?>
</body>
</html>