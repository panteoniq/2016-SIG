<?php
	session_start();
	ob_start();
	//서버에 세션이 없으면
	if(!isset($_SESSION['id'])){
		//클라이언트에 있는지 확인, 클라이언트에 쿠키가 남아있으면 서버의 세션을 세팅한다. 로그인상태에서 종료 후 새로 킬 경우 로그인되어있게.
		if (isset($_COOKIE['id']))
		{
				$userid=$_COOKIE['id'];
				$_SESSION['id']=$userid;
		}	
	}
?>