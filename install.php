<?PHP
$Step=htmlspecialchars($_GET["step"]);
if($Step==null)
	{
		$Step=1;	
	};
if($Step==1)
	{
		$ViewStep=1;
		$StepContent='<p>Добро пожаловать в программу установки ASChat II!</p>
<p>Для продолжения нажмите &quot;Далее&quot;</p><form name="form1" method="post" action="?step=2" style="text-align:right">
  <input type="submit" name="button" id="button" value="Далее">
</form>&nbsp;</p>
';
		
	};
if($Step==2)
	{
		$ViewStep=2;
		$StepContent='<div style="width:100%; height:350px; overflow:scroll;"><p>Пользовательское Соглашение между Пользователем и Разработчиком:</p>
<ol>
  <li>Введение
    <ul type="square">
      <li>1.1. Данное соглашение регулирует отношения между Пользователем и Разработчиком продукта;</li>
      <li>1.2. Данное соглашение является обязательным для исполнения обеими сторонами соглашения;</li>
      <li>1.3. Соглашение может быть изменено Разработчиком в одностороннем порядке;</li>
    </ul>
  </li>
  <li>Использование ASChat
    <ul type="square">
      <li>2.1. Пользователь имеет право использовать чат как в личных, так и в коммерческих целях;</li>
      <li>2.2. Пользователь имеет право вносить изменения в исходный код скрипта;</li>
      <li>2.3. Пользователь не имеет права распространять скрипт чата от своего имени или с изменениями;</li>
      <li>2.4. Запрещается убирать ссылки на сайт Разработчика, за исключением случаев, согласованных и разрешенных Разработчиком.  </li>
    </ul>
  </li>
</ol></div><form name="form1" method="post" action="?step=3" style="text-align:right">
  <input type="submit" name="button" id="button" value="Согласен">
</form>

';
	};
if($Step==3)
	{
		$ViewStep=3;
		$StepContent='
		<form name="form1" method="post" action="?step=4">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>Название чата:</td>
      <td><input type="text" name="chattitle" id="chattitle"></td>
    </tr>
    <tr>
      <td>Пароль администратора:</td>
      <td><input type="text" name="password" id="password"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Начать установку"></td>
    </tr>
  </table>
</form>

';
	};
if($Step==4)
	{
		$ViewStep=4;
		$ChatTitle=htmlspecialchars($_POST["chattitle"]);
		$AdminPassword=htmlspecialchars($_POST["password"]);
		mkdir("data",0777);
		mkdir("data/messages",0777);
		mkdir("data/online",0777);
		fwrite(fopen("data/adminpassword.ip","w"),md5($AdminPassword));
		fwrite(fopen("data/chattitle.ip","w"),$ChatTitle);
		fwrite(fopen("data/ip_blocked.ip","w"),"");
		fwrite(fopen("data/messages.ip","w"),0);
		fwrite(fopen("data/template.ip","w"),"simpleGray");
		$StepContent='<div style="width:100%; height:350px; overflow:scroll;">Папки созданы.<br>Настройки сохранены.<br>Параметры по-умолчанию установлены.<br>Нажмите "Далее" для завершения установки.</div><form name="form1" method="post" action="?step=5" style="text-align:right">
  <input type="submit" name="button" id="button" value="Далее">
</form>

';
	};
if($Step==5)
	{
		$ViewStep=5;
		
		$StepContent='
		Установка завершена. Удалите файл install.php.
		<form name="form1" method="post" action="index.php" style="text-align:right">
  <input type="submit" name="button" id="button" value="Далее">
</form>

';
	};

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Программа установки ASChat II</title>
<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
}
</style>
</head>

<body>
<table width="600" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td colspan="5" style="padding:3px;"><strong>Программа установки ASChat II</strong></td>
  </tr>
  <tr>
    <td width="20%" bgcolor="#FFFFFF" style="padding:2px;"><?PHP if($ViewStep==1){echo('<font color="#000000"><strong>');}else{echo('<font color="#CCCCCC">');}; ?>1. Приветствие<?PHP if($ViewStep==1){echo('</strong></font>');}else{echo('</font>');}; ?></td>
    <td width="20%" bgcolor="#FFFFFF" style="padding:2px;"><?PHP if($ViewStep==2){echo('<font color="#000000"><strong>');}else{echo('<font color="#CCCCCC">');}; ?>2. Соглашение<?PHP if($ViewStep==2){echo('</strong></font>');}else{echo('</font>');}; ?></td>
    <td width="20%" bgcolor="#FFFFFF" style="padding:2px;"><?PHP if($ViewStep==3){echo('<font color="#000000"><strong>');}else{echo('<font color="#CCCCCC">');}; ?>3. Параметры<?PHP if($ViewStep==3){echo('</strong></font>');}else{echo('</font>');}; ?></td>
    <td width="20%" bgcolor="#FFFFFF" style="padding:2px;"><?PHP if($ViewStep==4){echo('<font color="#000000"><strong>');}else{echo('<font color="#CCCCCC">');}; ?>4. Установка<?PHP if($ViewStep==4){echo('</strong></font>');}else{echo('</font>');}; ?></td>
    <td width="20%" bgcolor="#FFFFFF" style="padding:2px;"><?PHP if($ViewStep==5){echo('<font color="#000000"><strong>');}else{echo('<font color="#CCCCCC">');}; ?>5. Завершение<?PHP if($ViewStep==5){echo('</strong></font>');}else{echo('</font>');}; ?></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#FFFFFF" style="padding:7px;"><?PHP echo($StepContent); ?></td>
  </tr>
</table>
</body>
</html>