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
  padding: 2px;
  width: 70px;
  cursor: pointer;
  margin: 5px;
  text-decoration:none;
}

</style>
<body>
<?php
//	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//	$txt = $_POST['servid'];
//	fwrite($myfile, $txt);
//	$txt = $_POST['city'];
//	fwrite($myfile, $txt);
//	$txt = $_POST['day'];
//	fwrite($myfile, $txt);
//	$txt = $_POST['weather'];
//	fwrite($myfile, $txt);
//	fclose($myfile);
	if (empty($_POST['city']) || empty($_POST['day']) || empty($_POST['weather']))
	{
		exit('<h1><a href="javascript:history.go(-1)" class="button">입력 폼을 채워주세요</a></h1>');
	}
	

	
	require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	$city=mysqli_real_escape_string($dbc, trim($_POST['city']));
	$weather=mysqli_real_escape_string($dbc, trim($_POST['weather']));
	
	switch($city)
	{
		case "Seoul" :
			$city="서울특별시 중구 장충동";
			break;
		case "Daejeon":
			$city="대전광역시 서구 괴정동";
			break;
		case "Daegu":
			$city="대구광역시 중구 삼덕동";
			break;
		case "Busan":
			$city="부산광역시 연제구 거제3동";
			break;
		case "Gumi":
			$city="경상북도 구미시 양포동";
			break;
	}
	
	
	//서비스 등록
	$query="select * from service";
	$result=mysqli_query($dbc,$query) or die('서비스 개수 확인 중 오류가 발생하였습니다');
	
	$num=mysqli_num_rows($result);
	$num=$num+1;
	
	$query="insert into service values($num,1)";                  
	$result=mysqli_query($dbc,$query) or die('서비스 정보 저장 중 오류가 발생하였습니다');
	
	$query="last_insert_id()";
	if ($result)
		$servid = mysqli_insert_id($dbc);
	
	//기상 서비스 등록
	$query="insert into weather_serv values($num, '$city', '오늘', '$weather')";
	$result=mysqli_query($dbc,$query) or die('ss'.$servid);
	
	echo "<pp><h3>기상 서비스 등록이 완료되었습니다</h3></pp>";
	
	
	mysqli_close($dbc);
	echo '<a href="../index.php" class="button"> 홈으로 </a>';
?>
</body>
</html>