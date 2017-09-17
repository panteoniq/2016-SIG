<?php
$thingid=$_GET['thingid'];

require_once('../dbcon.php');
	$dbc=mysqli_connect($host,$user,$pass,$dbname)
	or die('Error Connecting to MySQL server.');
	mysqli_query($dbc, 'set names utf8');

//여기서부터 쿼리문 수정하고 결과에 맞게 출력시켜볼 것
	$query="select * from thing where thing_id=$thingid";
	$result=mysqli_query($dbc,$query) or die('Error Querying database.');
	//$row = mysql_fetch_array($result)
	//$row = mysql_fetch_assoc($result)
	//servid 찍어볼 것
while($row = mysqli_fetch_assoc($result))
  {
	  $type=$row['type'];
	  switch($type)
	  {
		  case 1:
			  $type="PIR";
			  break;
	  }
	  echo '<div class="inven_show_type">Info : Thing</div>';
		
		echo '<div class="information">
				 <table>
				  <thead>
					<tr>
					  <th>ID</th>
					  <td>'.$row['thing_mac'].'</td>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th>Type</th>
					  <td>'.$type.'</td>
					</tr>
					<tr>
					  <th>Info</th>
					  <td>'.$row['info'].'</td>
					</tr>
				  </tbody>
				</table>
		</div>';
  }
	mysqli_free_result($result);
	mysqli_close($dbc);
?>
