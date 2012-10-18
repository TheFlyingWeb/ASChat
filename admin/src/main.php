<?PHP
include("src/systeminfo.php");
function loadHTML($Filename)
	{
		$File=file($Filename);
		$HTML="";
		for($i=0;$i<count($File);$i++)
			{
				$HTML.=$File[$i];
			};
		return($HTML);
	};
$mod=htmlspecialchars($_GET["mod"]);
if($mod==null)
	{
		$mod="index";
	};
if($mod=="index")
	{
		$modTitle="Главная страница";
		$UsersOnline=0;
		$dir = opendir ("../data/online");
  while ( $file = readdir ($dir))
  {
    if (( $file != ".") && ($file != ".."))
    {
      $Time=fgets(fopen("../data/online/$file","r"));
	  $CurrentTime=time();
	  $TimeRaznica=$CurrentTime-$Time;
	  if($TimeRaznica>120)
	  	{
			unlink("../data/online/$file");
			
		}else
		{
			$UsersOnline=$UsersOnline+1;
		};
    }
  }
  closedir ($dir);
		$modContent='<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" width="33%"><a href="?mod=templ" class="linkblock"><img src="images/icons/template.png" width="70" height="70" border="noborder"><br>
          Выбор шаблона</a></td>
        <td align="center"><a href="?mod=settings" class="linkblock"><img src="images/icons/settings.png" width="70" height="70" border="noborder"><br>
          Настройки</a></td>
        <td align="center"><a href="?mod=iplist" class="linkblock"><img src="images/icons/iplist.png" width="70" height="70" border="noborder"><br>
          Блокировка IP</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF" style="padding:7px">Это главная страница контрольной панели. Отсюда начинается управление Вашим чатом.<br><br> Уважаемые вэб-мастеры! <br> Так как скрипт чата ASChat II находится в стадии открытого тестирования, убедительно Вас просим сообщать об ошибках, глюках, недочетах на официальную страницу. Также будем рады услышать Ваши пожелания. Заранее спасибо.</td>
  </tr>
  <tr>
    <td width="50%" valign="top" bgcolor="#FFFFFF" style="padding:7px">Сейчас онлайн: <strong>'.$UsersOnline.'</strong>
    </td>
    <td width="50%" valign="top" bgcolor="#FFFFFF" style="padding:7px">Проверка обновлений:<br>
    <div id="checkversion"><em>Идет проверка...</em></div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF" style="padding:7px"><a href="../index.php" target="_blank" class="linkblock">Перейти в чат</a><a href="logout.php" class="linkblock">Выйти из админ-панели</a><br><a href="?mod=about" class="linkblock">О системе</a><a href="?mod=help" class="linkblock">Справка</a></td>
  </tr>
</table>
';

	};
if($mod=="settings")
	{
		
		$modTitle="Настройки сайта";
		$SaveFlag=htmlspecialchars($_POST["hidden"]);
		if($SaveFlag=="save")
			{
				$ChatTitle=htmlspecialchars($_POST["chattitle"]);
				fwrite(fopen("../data/chattitle.ip","w"),$ChatTitle);
				
			};
		$ChatTitle=fgets(fopen("../data/chattitle.ip","r"));
		$modContent='<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF" valign="middle"><a href="index.php" class="linkblock"><img src="images/icons/back.png" border="noborder" width="16" height="16">На главную</a></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="padding:7px"><form name="form1" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="34%" align="right">Название чата: </td>
          <td width="66%"><input name="chattitle" type="text" id="chattitle" style="width:100%;" value="'.$ChatTitle.'"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Сохранить">
            <input name="hidden" type="hidden" id="hidden" value="save"></td>
          </tr>
      </table>
    </form></td>
  </tr>
</table>';
	};
if($mod=="templ")
	{
		$modTitle="Выбор внешнего стиля сайта";
		$Step=htmlspecialchars($_GET["step"]);
		if(($Step==null)or($Step==1))
			{
				$dir = opendir ("../templates");
				$TemplatesListHTML='';
  				while ( $file = readdir ($dir))
 					 {
 					   if (( $file != ".") && ($file != "..") && ($file != "mobile"))
   					 {
   						   $TemplateID=$file;
						   include("../templates/$TemplateID/config.php");
						   $TemplatesListHTML.='<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:5px">
  <tr>
    <td width="10" height="10" background="images/ugol_top_left.png"></td>
    <td bgcolor="#F4F4F4"></td>
    <td width="10" background="images/ugol_top_right.png"></td>
  </tr>
  <tr>
    <td bgcolor="#F4F4F4"></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td rowspan="4" width="150"><img width="150" src="../templates/'.$TemplateID.'/'.$Template_Photo.'"></td>
        <td><strong>'.$Template_Name.'</strong></td>
        <td rowspan="4"><a href="?mod=templ&step=2&id='.$TemplateID.'" class="linkblock">Установить</a></td>
      </tr>
      <tr>
        <td><a href="'.$Template_Autor_URL.'" class="linkblock">'.$Template_Autor.'</a></td>
        </tr>
      <tr>
        <td>Версия: '.$Template_Version.'</td>
        </tr>
      <tr>
        <td><em>'.$Template_Description.'</em></td>
      </tr>
    </table></td>
    <td bgcolor="#F4F4F4"></td>
  </tr>
  <tr>
    <td height="10" background="images/ugol_bottom_left.png"></td>
    <td bgcolor="#F4F4F4"></td>
    <td  background="images/ugol_bottom_right.png"></td>
  </tr>
</table>';
   					 }
					 }
				closedir ($dir);

				$modContent='<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF" valign="middle"><a href="index.php" class="linkblock"><img src="images/icons/back.png" border="noborder" width="16" height="16">На главную</a></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="padding:7px">'.$TemplatesListHTML.'</td>
  </tr>
</table>';
			};
		if($Step==2)
			{
				$id=$_GET["id"];
				fwrite(fopen("../data/template.ip","w"),$id);
				$modContent='<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF" valign="middle"><a href="index.php" class="linkblock"><img src="images/icons/back.png" border="noborder" width="16" height="16">На главную</a></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="padding:7px">Шаблон успешно установлен.</td>
  </tr>
</table>';
			};
	};
if($mod=="about")
	{
		$modTitle="О системе";
		
				$modContent='<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF" valign="middle"><a href="index.php" class="linkblock"><img src="images/icons/back.png" border="noborder" width="16" height="16">На главную</a></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="padding:7px"><center><p>ASChat II <br>
  Version '.$SystemVersion.'</p>
<p>Разработчик и дизайнер: Четвертков Сергей</p>
<p><a href="http://aspirine-soft.ru/" class="linkblock" target="_blank">Вебсайт разработчиков</a></p>
</center></td>
  </tr>
</table>';
			
	};
if($mod=="iplist")
	{
		$modTitle="Блокировка IP адресов";
		
		$ListPost=$_POST["iplist"];
		if($ListPost<>null)
			{
				fwrite(fopen("../data/ip_blocked.ip","w"),$ListPost);
			};
		
		$IPList=loadHTML("../data/ip_blocked.ip");
		
		$modContent='<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF" valign="middle"><a href="index.php" class="linkblock"><img src="images/icons/back.png" border="noborder" width="16" height="16">На главную</a></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="padding:7px"><form name="form1" method="post" action="">
  <fieldset>
    <legend>Список IP адресов</legend>
    
    <textarea name="iplist" id="iplist" cols="45" rows="5" style="width:100%">'.$IPList.'</textarea><input type="submit" value="Сохранить">
   
  </fieldset>
  <fieldset>
  	<legend>Помощь</legend>
	- Каждый IP должен быть введен на новой строке<br>
	- Можно указывать не только полные адреса, но и подсети
	<br>- Запрет IP блокирует полностью доступ к чату. Пользователь лишь увидит сообщение о том, что его IP заблокирован.
  </fieldset>  
  </form></td>
  </tr>
</table>';
	};
if($mod=="help")
	{
		$modTitle="Справочная информация";
		$modContent='<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF" valign="middle"><a href="index.php" class="linkblock"><img src="images/icons/back.png" border="noborder" width="16" height="16">На главную</a></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="padding:7px">
	<iframe src="help/index.html" width="100%" height="400"></iframe>
	
	</td>
  </tr>
</table>';
	};	


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Контрольная панель ASChat II</title>
<style>
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
.linkblock {
	display:block;
	width:100%;
	
}
.linkblock:hover{
	background-color:#EEE;
	
};
</style>
<script type='text/javascript' src='../jquery.js'></script>

<script type='text/javascript'>
$(document).ready(function () {
	$('#checkversion').load('src/checkversion.php');	
	});

</script>

</head>

<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="4" height="26" background="images/head_left.png">&nbsp;</td>
    <td background="images/head.png" class="headtitle">Контрольная панель ASChat II</td>
    <td width="4" background="images/head_right.png">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><fieldset>
      <legend><?PHP echo($modTitle); ?></legend>
      <?PHP
	  echo($modContent);
	  ?>
    </fieldset></td>
  </tr>
</table>
<br /><center>
Powered by ASChat II
</center>
</body>
</html>