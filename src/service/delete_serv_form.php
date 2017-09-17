<?php
//Service 삭제 페이지----------------
	session_start();
	ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Service 삭제</title>
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
    padding: 6px 5px;
    width: 200px;
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
   
   $userid=$_SESSION['id'];
	
	require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc,"set names utf8;");
	
	echo '<h1>Service 삭제</h1>';
	
	$query="select * from service";
	$result=mysqli_query($dbc,$query)
	or die('전체 서비스 검색 중 오류가 발생했습니다');
	
	echo '<form method="post" action="delete_service.php">';
    echo '삭제할 Service 선택 : <br>';
	echo '<select name="servid">';
	while($row = mysqli_fetch_assoc($result))
	{
		$serv_id=$row['serv_id'];
		if ($row['type']==1)//weather
		{
			$query="select * from weather_serv where serv_id=$serv_id";
			$serv_result=mysqli_query($dbc,$query);
			$serv_row = mysqli_fetch_assoc($serv_result);
			$city=$serv_row['city'];
			switch ($city)
			{
				case "서울특별시 중구 장충동":
					$city='서울';
					break;
				case "대전광역시 서구 괴정동":
					$city='대전';
					break;
				case "대구광역시 중구 삼덕동":
					$city='대구';
					break;
				case "부산광역시 연제구 거제3동":
					$city='부산';
					break;
				case "경상북도 구미시 양포동":
					$city='구미';
					break;
					
			}
			echo '<option value="'.$serv_id.'">'.$serv_id.' 번 > 만약 '.$city.'에 '.$serv_row['day'].' '.$serv_row['weather'].'(이)라면</option>';
		}
		else if ($row['type']==2)//PIR
		{
			echo '<option value="'.$serv_id.'"> '.$serv_id.'번 > 회원 가입 시 등록한 이메일에 새로운 이메일이 온 경우 </option>';
		}
		else if ($row['type']==3)//Email
		{
			echo '<option value="'.$serv_id.'"> '.$serv_id.'번 > 회원 가입 시 등록한 구글 계정과 연동된 캘린더에 지금 시간 일정이 있을 경우</option>';
		}
	}
	
	echo '</select><br/><br/>';
	echo '<button class="button" style="vertical-align:middle"><span>삭제</span></button>';
    echo '<a href="javascript:history.go(-1)" class="button">뒤로가기</a>';
	echo '</form>';
?>
</body>
</html>