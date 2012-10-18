<?PHP
session_start();
include("../config.php");
$_SESSION["auth"]=false;
$Message="Сеанс работы завершен.<br><a href='index.php'>Войти заново</a>";

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Завершение сеанса</title>
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
      <legend>Выход из системы.</legend>
      <?PHP echo($Message); ?></fieldset></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><font size="-1"><br />
    Powered by <a href="http://aspirine-soft.ru/">Aspirine Files II</a></font></td>
  </tr>
</table>
</body>
</html>