<?php
session_start();
	ob_start();
$servid=$_GET['devservid'];

require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc, 'set names utf8');

//여기서부터 쿼리문 수정하고 결과에 맞게 출력시켜볼 것
	$query="select * from service where serv_id=$servid";
	$result=mysqli_query($dbc,$query) or die('Error Querying database.');
	//$row = mysql_fetch_array($result)
	//$row = mysql_fetch_assoc($result)
	//servid 찍어볼 것
$row = mysqli_fetch_assoc($result);
	  $type=$row['type'];
	  
	  $weather_result=NULL;
	  $weather_row=NULL;
	  $city=NULL;
	  
	  $pir_result=NULL;
	  $pir_row=NULL;
	  
	  $facebook_result=NULL;
	  $facebook_row=NULL;
	  
	  switch($type)
	  {
		//weather service
		case 1:
			$query="select * from weather_serv where serv_id=$servid";
			$weather_result=mysqli_query($dbc,$query) or die('Error Querying database.');
			$weather_row = mysqli_fetch_assoc($weather_result);
			$type="Weather Service";
			$city=$weather_row['city'];
			switch($city)
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
			}
			echo '<div class="indi_show_type">Info : Service</div>';
			
			
			$query="select * from dev_serv where serv_id=$servid";
			$devserv_result=mysqli_query($dbc,$query) or die('Error Querying database.');
			$devserv_row = mysqli_fetch_assoc($devserv_result);
			
			if ($devserv_row['des_email']=='null')
				$then='LED 점멸';
			else
				$then=$devserv_row['des_email'].'로 이메일 전송';
			
			echo '<div class="information">
				 <table>
				  <thead>
					<tr>
					  <th>ID</th>
					  <td>'.$weather_row['serv_id'].'</td>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th>Type</th>
					  <td>'.$type.'</td>
					</tr>
					<tr>
					  <th>IF</th>
					  <td>'.$city.'에 '.$weather_row['day'].' '.$weather_row['weather'].'(이)라면</td>
					</tr>
					<tr>
					  <th>THEN</th>
					  <td>'.$then.'</td>
					</tr>
				  </tbody>
				</table>
			</div>';
			break;
		
		//sensor(pri) service - 추후 수정
		case 2:
			$query='select * from user where user_id="'.$_SESSION['id'].'"';
			$user_result=mysqli_query($dbc,$query) or die('Error Querying database.');
			$user_row = mysqli_fetch_assoc($user_result);
			$type="Email Service";
			$query="select * from dev_serv where serv_id=$servid";
			$devserv_result=mysqli_query($dbc,$query) or die('Error Querying database.');
			$devserv_row = mysqli_fetch_assoc($devserv_result);
			
			if ($devserv_row['des_email']=='null')
				$then='LED 점멸';
			else
				$then=$devserv_row['des_email'].'로 이메일 전송';
			echo '<div class="indi_show_type">Info : Service</div>';
			echo '<div class="information">
				 <table>
				  <thead>
					<tr>
					  <th>ID</th>
					  <td>'.$devserv_row['serv_id'].'</td>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th>Type</th>
					  <td>'.$type.'</td>
					</tr>
					<tr>
					  <th>IF</th>
					  <td> 만약 '.$user_row['email_id'].'@gmail.com에 새로운 메일이 도착한다면</td>
					</tr>
					<tr>
					  <th>THEN</th>
					  <td>'.$then.'</td>
					</tr>
				  </tbody>
				</table>
			</div>';
			break;
		
		//Email service - 추후 수정
		case 3:
			$query="select * from email_serv where thing_id=$thingid";
			$email_result=mysqli_query($dbc,$query) or die('Error Querying database.');
			$pir_row = mysqli_fetch_assoc($pir_result);
			$type="Facebook Service";
			echo '<div class="information">
				 <table>
				  <thead>
					<tr>
					  <th>ID</th>
					  <td>'.$weather_row['serv_id'].'</td>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th>Type</th>
					  <td>'.$type.'</td>
					</tr>
					<tr>
					  <th>IF</th>
					  <td>'.$city.'에 '.$weather_row['day'].' '.$weather_row['weather'].'(이)라면</td>
					</tr>
					<tr>
					  <th>THEN</th>
					  <td>설정된 기능 수헹</td>
					</tr>
				  </tbody>
				</table>
			</div>';
			break;	  
	  }
	mysqli_free_result($result);
?>
