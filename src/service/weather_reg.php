<?php
//기상 서비스 모듈을 등록하는 페이지. 
	session_start();
	ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>기상 서비스 등록</title>
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
  font-size: 15px;
  padding: 4px;
  width: 70px;
  cursor: pointer;
  margin: 2px;
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
	font-size: 15px;
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
	font-size: 15px;
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
?>
	<h1>기상 서비스 등록</h1>
	<form method="post" action="weather_reg_result.php">
    IF<br><br>
        <select class="city" name="city">
        	<option value="Seoul">서울</option>
            <option value="Busan">부산</option>
            <option value="Daegu">대구</option>
            <option value="Daejeon">대전</option>
            <option value="Gumi">구미</option>
        </select>에
        <br/>
        <br/>
        <select class="day" name="day">
        	<option value="지금">지금</option>
            <option value="오늘">오늘</option>
            <option value="내일">내일</option>
            <option value="모레">모레</option>
        </select>
        <br/>
        <br/>
        <select class="weather" name="weather">
        	<option value="비">비</option>
            <option value="눈">눈</option>
            <option value="소나기">소나기</option>
            <option value="맑음">맑음</option>
            <option value="구름조금">구름조금</option>
            <option value="구름많음">구름많음</option>
            <option value="흐림">흐림</option>
        </select>(이)라면 설정에 따라 지정된 기능 실행
        <br/>
        <br/>
		<button class="button">등록</button>
        <a href="javascript:history.go(-1)" class="button">뒤로가기</a>
	</form>
</body>
</html>