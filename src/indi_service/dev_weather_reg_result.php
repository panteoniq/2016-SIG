<!DOCTYPE html>
<html>
<head>
<title>서비스 등록 결과</title>
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
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = $_POST['device'].' ';
	fwrite($myfile, $txt);
	$txt = $_POST['servid'].' ';
	fwrite($myfile, $txt);
	$txt = $_POST['operid'].' ';
	fwrite($myfile, $txt);
	$txt = $_POST['des_email'].' ';
	fwrite($myfile, $txt);
	$txt = $_POST['userid'].' ';
	fwrite($myfile, $txt);
	fclose($myfile);
	if (empty($_POST['device']) || empty($_POST['servid']) || empty($_POST['operid']))
	{
		exit('<h1><a href="javascript:history.go(-1)" class="button">입력 폼을 채워주세요</a></h1>');
	}
	

	
	require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	$userid=mysqli_real_escape_string($dbc, trim($_POST['userid']));
	$deviceid=mysqli_real_escape_string($dbc, trim($_POST['device']));
	$servid=mysqli_real_escape_string($dbc, trim($_POST['servid']));
	$operid=mysqli_real_escape_string($dbc, trim($_POST['operid']));
	

	
	//디바이스에 등록된 서비스 번호
	$query="select * from dev_serv where user_id='$userid'";
	$result=mysqli_query($dbc,$query) or die("디바이스에 등록된 서비스를 검색하던 도중 오류가 발생하였습니다");	
	
	if (mysqli_num_rows($result) ==0)
		$dev_serv_num=1;
	else
		$dev_serv_num=mysqli_num_rows($result)+1;


	//기상 서비스 등록
	//ifid은 1
	if ($operid==1)
		$query="insert into dev_serv values($servid,'$userid', '$deviceid', $dev_serv_num, 1, 0, 0, 0, '2016-11-17 11:00:00', 1,  $operid, 'null')";
	else
	{
		$des_email=$_POST['des_email'];
		
		$query="insert into dev_serv values($servid,'$userid', '$deviceid', $dev_serv_num, 1, 0, 0, 0, '2016-11-17 11:00:00', 1,  $operid, '$des_email')";
	}
	$result=mysqli_query($dbc,$query) or die('ss'.$userid.' '.$dev_serv_num);
	
	echo '<pp><h2>'.$deviceid.'에 기상 서비스 등록이 완료되었습니다</h2></pp>';
	
	
	mysqli_close($dbc);
	echo '<a href="../index.php" class="button"> 홈으로 </a>';
?>
</body>
</html>