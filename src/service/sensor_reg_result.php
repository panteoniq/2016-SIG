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
  width: 100px;
  cursor: pointer;
  margin: 5px;
  text-decoration:none;
}

</style>
<body>
<?php
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = $_POST['motion'];
	fwrite($myfile, $txt);
	fclose($myfile);
	if (empty($_POST['motion']))
	{
		exit('<h1><a href="javascript:history.go(-1)" class="button">입력 폼을 채워주세요</a></h1>');
	}
	

	
	require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	$motion=mysqli_real_escape_string($dbc, trim($_POST['motion']));
	
	switch($motion)
	{
		case 'nomove':
			$motion=0;
			break;
		case 'move':
			$motion=1;
			break;
	}
	
	
	//서비스 등록
	$query="insert into service values(null,2)";
	$result=mysqli_query($dbc,$query) or die('서비스 정보 저장 중 오류가 발생하였습니다');
	
	$query="last_insert_id()";
	if ($result)
		$servid = mysqli_insert_id($dbc);
	
	//기상 서비스 등록
	$query="insert into sensor_serv values($servid, $motion)";
	$result=mysqli_query($dbc,$query) or die('센서 서비스 저장 중 오류가 발생하였습니다');
	
	echo "<pp><h3>센서 서비스 등록이 완료되었습니다</h3></pp>";
	
	
	mysqli_close($dbc);
	echo '<a href="../index.php" class="button"> 홈으로 </a>';
?>
</body>
</html>