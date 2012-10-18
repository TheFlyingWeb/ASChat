<?PHP
session_start();
//error_reporting("E_ALL");
$LogonForm='<div id="nick_setstatus"><form action="" method="post" name="nick_form" id="nick_form">
  Введите никнейм
  <label for="nick_text"></label>
  <input type="text" name="nick_text" id="nick_text">
  <input type="submit" name="button" id="button" value="Войти">
</form></div>
';
$Act=htmlspecialchars($_GET["act"]);
if($Act=="setnick")
	{
		$Nick=htmlspecialchars($_GET["nick"]);
		$_SESSION["UserName"]=$Nick;
		$_SESSION["lastmessage"]=fgets(fopen("../data/messages.ip","r"))-1;
		function WhoIsOnline ()
			{
				$UserName=$_SESSION["UserName"];
				fwrite(fopen("../data/online/$UserName","w"),time());
			};
		if($_SESSION["UserName"]==null)
			{
				echo("<font color='#FF0000'>Ошибка авторизации. Не удалось начать сессию. Возможно, что Вы не ввели никнейм.Попробуйте еще раз.</font><form id='letschat'><center><input type='submit' value='Еще разок'></center></form>");
			}else
			{
				setcookie("UserNickNameOld",$Nick);
				echo("<font color='#009900'><strong>".$Nick."</strong>, Добро пожаловать в чат! Нажмите Вход для входа :)</font><form id='letschat'><center><input type='submit' value='Вход'></center></form>");
				$MessageID=fgets(fopen("../data/messages.ip","r"));
				$MessageID=$MessageID+1;
				mkdir("../data/messages/$MessageID",0777);
				fwrite(fopen("../data/messages/$MessageID/username.ip","w"),'System');
				fwrite(fopen("../data/messages/$MessageID/date.ip","w"),time());
				fwrite(fopen("../data/messages/$MessageID/text.ip","w"),'<b><font color="red">Нас почтил(а) своим присутствием '.$Nick.'. Встречаем дружно!</font></b>');
				fwrite(fopen("../data/messages.ip","w"),$MessageID);
				WhoIsOnline();
				
			};
	};
?>