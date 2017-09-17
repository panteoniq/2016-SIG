<?php
	session_start();
	ob_start();
?>
<!doctype html>
<main>
  <html>
  <head>
  <meta charset="utf-8"/>
  <title>메인 화면</title>
  <link href="newsig/main.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
  /* 각 자리에 대한 css */

body{
   	font-size: 10px;
	overflow:auto;
}

a {
	text-decoration:none;
	color:white;
	background:#f4511e;
}

td a{
	color:black;
	background:none;
}

a:hover, a:active{
	text-decoration:none;
	color:green;
}

b{
	color:blue;
}

li{
	display:inline;
}

table{
	width:100%;
	
}
 /* 공통 패널====================================================================================================*/
.dev_file{
	width:15%;
	border-top-left-radius:2em;
	border-top-right-radius:2em;
	background-color:#ED7D31;
	color:white;
	text-align:center;
}

.invent_file{
	width:15%;
	border-top-left-radius:2em;
	border-top-right-radius:2em;
	background-color:#4472C4;;
	color:white;
	text-align:center;
}	
.modify{
}

.delete{
}

  /* 사용자 패널====================================================================================================*/
.guest{
	width : 100%;
	text-align:center;
	border : 1px dotted red;
	line-height:1.0;
}

.user{
	width:100%;
	text-align:center;
	border : 1px solid blue;
}
  /* 디바이스 패널====================================================================================================*/
.device{
	width : 100%;
	overflow:auto;
	border : 2px solid #ED7D31;
}

/*Indicator List*/
.indi_list{
	
	background-color:#ED7D31;
	color:white;
	float: left;
	width: 43%;
	text-align:center;
	padding:0.28%;
	margin-left:10px;
	margin-right:10px;
	line-height:160%;
	overflow:auto;
}
.user_indi_list{
	background-color:white;
	color:black;
	margin:-1px;
	overflow:auto;
	line-height:250%;
}

.indi_control, .indi_control a{
	background-color:#F8C8AD;	
	margin:-1px;
}

.indicator{
	border-radius:100%;
	padding:1px;
	display:block;
	background:green;
	text-align:center;
	cursor:pointer;
	display:inline;
	color:white;
}


/*Service List*/
.serv_list
{
	background-color:#ED7D31;
	color:white;
	float: right;
	width: 43%;
	text-align:center;
	padding:0.28%;
	margin-left:10px;
	margin-right:10px;
	line-height:160%;
	
}

.user_serv_list{
	background-color:white;
	color:black;
	margin:-1px;
	line-height:250%;
	overflow:auto;
}


.serv_control, .serv_control a{
	background-color:#F8C8AD;
	margin:-1px;
}

.user_serv{
	border-radius:100%;
	padding:1px;
	display:block;
	background:#0070C0;
	text-align:center;
	cursor:pointer;
	display:inline;
	color:white;
}

/*Indicator Information - 공통*/

.indi_show_type{
	background-color:#ED7D31;
	text-align:center;
	font-size:20px;
	color:white;
	margin: 10px 10px 10px 10px;
}

.information{
	width:auto;
	border:1px solid #ED7D31;
	margin:10px 10px 10px 10px;
	padding:5px;
}

.information th{
	background-color:#70AD47;
	width:20%;
	color:white;
}

.information tr{
	background-color:#EBF1E9;
	text-align:center;
}
/*Indicator Information - indicator*/
/*Indicator Information - service*/

  /*인벤토리 패널====================================================================================================*/
.inventory{
	width:100%;
	overflow:auto;
	border : 2px solid #4472C4;
}

/*Thing*/
.thing_box{
	background-color:#4472C4;
	color:white;
	float: left;
	width: 43%;
	text-align:center;
	padding:0.28%;
	margin-left:10px;
	margin-right:10px;
	line-height:160%;
}

.thing_list{
	background-color:white;
	color:black;
	margin:-1px;
	overflow:auto;
	line-height:250%;
}

.thing_control, .thing_control a{
	background-color:#B4C7E7;	
	margin:-1px;
}

.thing{
	border-radius:50%;
	background:green;
    padding:1px;
	text-align:center;
	cursor:pointer;
	display:inline;
	color:white;
}

.inven_show_type{
	background-color:#4472C4;
	text-align:center;
	font-size:20px;
	color:white;
	margin: 10px 10px 10px 10px;
}
/*All Service*/


.inven_serv{
	background-color:#4472C4;
	color:white;
	float: right;
	width: 43%;
	text-align:center;
	padding:0.28%;
	margin-left:10px;
	margin-right:10px;
	line-height:160%;
}

.inven_serv_list{
	background-color:white;
	color:black;
	margin:-1px;
	overflow:auto;
	line-height:250%;
}

.service{
	border-radius:50%;
	background:#0070C0;
	padding:1px;
	text-align:center;
	cursor:pointer;
	display:inline;
	color:white;
}

.inven_serv_control, .inven_serv_control a{
	background-color:#B4C7E7;	
	margin:-1px;
}

  </style>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script>

function invenViewChange()
{
	if (xmlhttp.readyState==4)
	  {
		  document.getElementsByClassName("inven_view")[0].innerHTML=xmlhttp.responseText;
	  }
}

function infoVIewChange()
{
	if (xmlhttp.readyState==4)
	  {
		  document.getElementsByClassName("info_view")[0].innerHTML=xmlhttp.responseText;
	  }
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}

//indicator part의 indicator 누를 경우
function indi_view()
{
	var num=event.target.innerHTML;
	
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  }
	var url="indicator/deviceview.php";
	url=url+"?number="+num;
	
	var infoview=document.getElementsByClassName("info_view")[0];
	infoview.innerHTML="";
	xmlhttp.onreadystatechange=infoVIewChange;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}

//indicator part의 service 누를 경우
function indi_serv_view()
{
	var devservid=event.target.innerHTML;
	
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  }
	var url="indi_service/devservview.php";
	url=url+"?devservid="+devservid;
	
	var thingview=document.getElementsByClassName("info_view")[0];
	thingview.innerHTML="";
	xmlhttp.onreadystatechange=infoVIewChange;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}

//inventory part의 thing 누를 경우
function thing_view()
{
	var thingid=event.target.innerHTML;
	
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  }
	var url="thing/thingview.php";
	url=url+"?thingid="+thingid;
	
	var thingview=document.getElementsByClassName("inven_view")[0];
	thingview.innerHTML="";
	xmlhttp.onreadystatechange=invenViewChange;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}

//inventory part의 service 누를 경우
function serv_view()
{
	var servid=event.target.innerHTML;
	
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  }
	var url="service/servview.php";
	url=url+"?servid="+servid;
	
	var thingview=document.getElementsByClassName("inven_view")[0];
	thingview.innerHTML="";
	xmlhttp.onreadystatechange=invenViewChange;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}

//indicator part의 service on/off 변경
function indi_serv_onoff()
{
	alert("ddd5");
}
 </script>

  </head>
  <body>
  <?php
  	if(!isset($_SESSION['id']))
	{
			echo '<div class="guest">';
			echo '<p>로그인하세요</p>
			<ui><li><a href="loginform.html">로그인&nbsp;&nbsp;</a></li>
			<li><a href="signupform2.html">회원가입&nbsp;&nbsp;</a></li>
			<li><a href="adminloginform.php">관리자화면</a></li></ui>
			</div>';
	}
	else
	{
		require_once('dbcon.php');
		$dbc=mysqli_connect($host,$user,$pass,$dbname)
		or die('Error Connecting to MySQL server.');
		mysqli_query($dbc, 'set names utf8');
			
		//여기서 사용자 ID를 추출해냄
		$userid=$_SESSION['id'];
		
		//추출한 ID를 바탕으로 사용자 정보를 검색
		$query = "select * from user where user_id='$userid'"; 
		$result = mysqli_query($dbc, $query) or die('Error Querying database.'); 
		
		$userrow = mysqli_fetch_assoc($result);	
		$devnum=$userrow['devnum'];
		$hpnum=$userrow['hpnum'];
		
		//사용자 패널===============================================================================================
		echo '<div class="user">';
		echo '<ui><li><a href="req_modify.php">정보수정</a></li>
		<li><a href="logout.php">로그아웃</a></li></ui><br><br>';
		echo '<b>'.$userid.'</b>님 환영합니다!<br><br>';
		echo '핸드폰 번호 : '.$hpnum.'<br>';
		echo '등록된 디바이스 수 : '.$devnum.'<br>';
		echo '</div>';
		
		echo '<br><br><br>';
		
			
		
		//디바이스 패널===============================================================================================
		echo '<div class="dev_file">IoT Indicator</div>';
		echo '<div class="device"><br>';
//		echo '<table style="text-align:center;"><tr style="width: 100%;">';
//		echo '<td style="width: 20%;">1번 데이타 셀</td>';
//		echo '<td style="width: 60%;">2번 데이타 셀</td>';
//		echo '<td style="width: 20%;">3번 데이타 셀</td></tr></table>';
		
		$query = "select * from device where user_id='$userid'"; 
		$indi_result = mysqli_query($dbc, $query) or die('Error Querying database.'); 
		
		// 디바이스 목록---------------------------------
		echo '<div class="indi_list">Indicator';
		echo '<div class="user_indi_list"><ui>';
		//디바이스 목록 조회
		if (mysqli_num_rows($indi_result)==0)
		{
			echo '디바이스를 추가하세요!</div>';
		}
		else
		{
			while($indi_row=mysqli_fetch_assoc($indi_result))
			{
				//number 뽑아내기
				$indi_id=$indi_row['number'];
				echo '<li class="indicator" onclick="indi_view()">'.$indi_id.'</li>';
				echo '&nbsp;&nbsp;&nbsp;';
			}
			
			echo '</ui></div>';
		}
		echo '<div class="indi_control">
				<ui>
					<li><a href="indicator/enroll_dev_form.php"><img src="add.png" width="10" height="10"/></a></li>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<li><a href="indicator/modify_dev_form.php"><img src="modify.png" width="10" height="10"/></a></li>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<li><a href="indicator/delete_dev_form.php"><img src="delete.png" width="10" height="10"/></a></li>
				</ui></div>';
		echo '</div>';
		
		
		//서비스 목록----------------------------------------
		$query = "select * from dev_serv where user_id='test'"; 
		$indi_serv_result = mysqli_query($dbc, $query) or die('Error Querying database.'); 
		echo '<div class="serv_list">Service
				<div class="user_serv_list"><ui>';
		if (mysqli_num_rows($indi_serv_result)==0)
		{
			echo '디바이스나 서비스를 추가하세요!</div>';
		}
		else
		{
			while($indi_serv_row=mysqli_fetch_assoc($indi_serv_result))
			{
				//number 뽑아내기
				$indi_serv_id=$indi_serv_row['number'];
				echo '<li class="user_serv" onclick="indi_serv_view()">'.$indi_serv_id.'</li>';
				echo '&nbsp;&nbsp;&nbsp;';
			}
			
			echo '</ui></div>';
		}
				echo '<div class="serv_control">
					<ui>
						<li><a href="indi_service/reg_dev_serv.php"><img src="add.png" width="10" height="10"/></a></li>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<li><a href="indi_service/del_dev_serv_form.php"><img src="delete.png" width="10" height="10"/></a></li>
					</ui>
				</div>
		</div>';
		echo '<br><br><br><br><br>';
		echo '<div class="info_view">';
		echo '<div class="indi_show_type">Info : </div>';
		
		echo '<div class="information">
				 <table>
				  <thead>
					<tr>
					  <th>ID</th>
					  <td></td>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th>Type</th>
					  <td></td>
					</tr>
					<tr>
					  <th>IF</th>
					  <td></td>
					</tr>
					<tr>
					  <th>THEN</th>
					  <td></td>
					</tr>
				  </tbody>
				</table>
		</div>
		</div>';
		
		
		echo '</div>';
		echo '<br><br><br>';

		//인벤토리 패널===============================================================================================
		$query = "select * from thing where user_id='$userid'"; 
		$thing_result = mysqli_query($dbc, $query) or die('Error Querying database.'); 
		
		echo '<div class="invent_file">Inventory</div>';
		echo '<div class="inventory"><br>';		
		echo '<div class="thing_box">Thing';
		
		echo '<div class="thing_list"><ui>';
		//Thing 검색
		if (mysqli_num_rows($thing_result)==0)
		{
			echo 'Thing을 추가하세요!</div>';
		}
		else
		{
			while($thing_row=mysqli_fetch_assoc($thing_result))
			{
				$num=$thing_row['thing_id'];
				echo '<li class="thing" onclick="thing_view()">'.$num.'</li>';
				echo '&nbsp;&nbsp;&nbsp;';
			}
			echo '</ui></div>';
		}
		echo '<div class="thing_control">
				<ui>
					<li><a href="thing/enroll_thing_form.php"><img src="add.png" width="10" height="10"/></a></li>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<li><a href="thing/modify_thing_form.php"><img src="modify.png" width="10" height="10"/></a></li>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<li><a href="thing/delete_thing_form.php"><img src="delete.png" width="10" height="10"/></a></li>
				</ui></div>';
		echo '</div>';
		
		//전체 서비스 패널
		$query = "select * from service"; 
		$serv_result = mysqli_query($dbc, $query) or die('Error Querying database.');
		
		echo '<div class="inven_serv">Service
				<div class="inven_serv_list"><ui>';
		if (mysqli_num_rows($serv_result)==0)
		{
			echo '서비스를 추가하세요!</div>';
		}
		else
		{
			while($serv_row=mysqli_fetch_assoc($serv_result))
			{
				$num=$serv_row['serv_id'];
				echo '<li class="service" onclick="serv_view()">'.$num.'</li>';
				echo '&nbsp;&nbsp;&nbsp;';
			}
			echo '</ui></div>';
		}
				
		echo '<div class="inven_serv_control">
					<ui>
						<li><a href="service/reg_serv.php"><img src="add.png" width="10" height="10"/></a></li>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
						//<li><a href="service/modify_serv_form.php"><img src="modify.png" width="10" height="10"/></a></li>
						//&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						.'<li><a href="service/delete_serv_form.php"><img src="delete.png" width="10" height="10"/></a></li>
					</ui>
				</div>
		</div><br><br><br><br><br><br>';
		
		echo '<div class="inven_view">';
		echo '<div class="inven_show_type">Info : </div>';
		
		echo '<div class="information">
				 <table>
				  <thead>
					<tr>
					  <th>ID</th>
					  <td></td>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th>Type</th>
					  <td></td>
					</tr>
					<tr>
					  <th>IF</th>
					  <td></td>
					</tr>
					<tr>
					  <th>THEN</th>
					  <td></td>
					</tr>
				  </tbody>
				</table>
		</div>
		</div>';
		
		
		echo '</div>';
		
//		echo '<table><tr><th>ID</th><th>Service ID<th>Service Type</th><th>Service Contents</th><th>Delete</th></tr>';
//		
//		$query="select * from service where user_id='$userid'";
//		$serv_result = mysqli_query($dbc, $query) or die('서비스 로딩 도중 오류 발생');
//		while ($serv_row = mysqli_fetch_assoc($serv_result)) {//모든 디바이스 목록 조회
//			$type=$serv_row['type'];
//			$servid=$serv_row['serv_id'];
//			//기상 서비스일 경우
//			if ($type==1)
//			{
//				$query="select * from weather_serv where serv_id='$servid'";
//				$weather_result = mysqli_query($dbc, $query) or die('기상 서비스 로딩 도중 오류 발생');
//				$weather_row = mysqli_fetch_assoc($weather_result);
//				
//				$city=$weather_row['city'];
//				switch($city)
//				{
//					case "Seoul":
//						$city="서울";
//						break;
//					case "Daegu":
//						$city="대구";
//						break;
//				}
//				$day=$weather_row['day'];
//				$weather=$weather_row['weather'];
//				echo '<td class="userid">'.$userid.'</td>';
//				echo '<td class="servid">'.$servid.'</td>';
//				echo '<td class="type">'.$type.'</td>';
//				echo '<td class="content">'.$city.'에 '.$day.' '.$weather.'일 경우 동작 실행</td>';
//			}
//		}//while ($servrow = mysqli_fetch_assoc($result)) end
//		echo '</table></div>';
	}
  ?>
  </body>
  </html>
</main>
