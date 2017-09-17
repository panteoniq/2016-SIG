<?php
$db=mysqli_connect("localhost","root","apmsetup","mysql");
if($db)
{
	echo "connect";
}
else
{
	echo "disconnect";
}
?>