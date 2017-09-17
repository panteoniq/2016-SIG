<?php
$number=$_GET['number'];

require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc, 'set names utf8');

//여기서부터 쿼리문 수정하고 결과에 맞게 출력시켜볼 것
	$query="select * from device where number='$number'";
	$result=mysqli_query($dbc,$query) or die('Error Querying database.');
	//$row = mysql_fetch_array($result)
	//$row = mysql_fetch_assoc($result)
	//servid 찍어볼 것
	$row = mysqli_fetch_assoc($result);

	echo '<div class="indi_show_type">Info : Indicator</div>';
	echo '<div class="information">
		 <table>
		  <thead>
			<tr>
			  <th>ID</th>
			  <td>'.$row['number'].'</td>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <th>Owner</th>
			  <td>'.$row['user_id'].'</td>
			</tr>
			<tr>
			  <th>MAC</th>
			  <td>'.$row['device_id'].'</td>
			</tr>
			<tr>
			  <th>IP</th>
			  <td>'.$row['ip_addr'].'</td>
			</tr>
		  </tbody>
		</table>
	</div>';
	mysqli_free_result($result);
?>
