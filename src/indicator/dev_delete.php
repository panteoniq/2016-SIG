<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DB 업데이트</title>
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
if (!empty($_POST['device']) && !empty($_POST['userid']))
{
	//디바이스마다 등록된 서비스 삭제
	require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc, 'set names utf8');
	
	$devid=mysqli_real_escape_string($dbc, trim($_POST['device']));	
	$userid=mysqli_real_escape_string($dbc, trim($_POST['userid']));	
	//들어온 데이터들을 갖고 DB에서 알맞은 서비스 삭제
	$query="DELETE FROM device WHERE device_id='$devid'";
	$result=mysqli_query($dbc,$query) or die('Errorsss Querying database.');
	
	$query="DELETE FROM dev_serv WHERE device_id='$devid'";
	$result=mysqli_query($dbc,$query) or die('Error asasQuerying database.');
	
	$query="select devnum from user where user_id='$userid'";
	$result=mysqli_query($dbc,$query)
	or die('Error Querying database.');
	$row = mysqli_fetch_assoc($result);
	$devnum=$row['devnum']-1;
	
	$query="update user set devnum=$devnum where user_id='$userid'";
	$result=mysqli_query($dbc,$query)
		or die('Error Querying database.');
		
	$query="select number from device where user_id='$userid'";
	$result=mysqli_query($dbc,$query)
	or die('디바이스 검색 중 오류가 발생했습니다');
	
	while($row=mysqli_fetch_assoc($result))
	{
		$count=1;
		$number=$row['number'];
		$query="update device set number=$count where number=$number";
		$result=mysqli_query($dbc,$query) or die('사용자의 디바이스 정보 업데이트 중 오류가 발생했습니다');
		$count++;
		
	}
	echo '<pp><h3>디바이스 '.$devid.'의 삭제가 완료되었습니다</h3></pp>';
	
	mysqli_close($dbc);
	echo '<a href="../index.php" class="button"> 홈으로 </a>';
}
?>

</body>
</html>
