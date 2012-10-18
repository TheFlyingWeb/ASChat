<?PHP
session_start();
//include("../config.php");
$AdminPassword=fgets(fopen("../data/adminpassword.ip","r"));
$Password=md5(htmlspecialchars($_POST["admin_password"]));
if($Password==$AdminPassword)
	{
		$_SESSION["auth"]=true;
		$Message = 'Пароль верен. Сейчас произойдет переход в контрольную панель. <br>Если этого не произошло, то <a href="index.php">пройдите по этой ссылке для входа в контрольную панель</a>.  <META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php">
';
	}else
	{
		$_SESSION["auth"]=false;
		$Message='Пароль не верен. <a href="index.php">Вернитесь и введите пароль заново</a>.';
	};

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Проверка пароля</title>
<style type="text/css">
.headtitle {
	color: #FFF;
	font-weight: bold;
}
a:link {
	color: #F00;
}
a:visited {
	color: #F00;
}
body,td,th {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 12px;
}
</style>
</head>

<body  style="padding-top:200px">
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="3" height="26" background="images/head_left.png">&nbsp;</td>
    <td background="images/head.png" class="headtitle" >Авторизация</td>
    <td background="images/head_right.png" width="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><fieldset>
      <legend>Проверка пароля...    </legend><?PHP echo($Message); ?></fieldset></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><font size="-1"><br />
    Powered by <a href="http://aspirine-soft.ru/">ASChat II</a></font></td>
  </tr>
</table>
</body>
</html>