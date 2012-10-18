<?PHP
// Скрипт, генерирующий страницу входа в чат
$TemplateHTML=file("templates/$TemplateID/logon.html");

$InHeadHTML='<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript"> 
$(document).ready(function () {
    $("#nick_form").submit(Send); 
    $("#nick_text").focus();
	$("#letschat").submit(LetsChat);
});   
function Send() {
    $("#nick_setstatus").load("ajax/applynickname.php?act=setnick&nick="+$("#nick_text").val());
 
    return false; 
}
var load_in_process = false;

function LetsChat(){
	location.reload();
	return false;	
}

';

$LogonForm='<div id="nick_setstatus"><form action="" method="post" name="nick_form" id="nick_form">
  Введите никнейм
  <label for="nick_text"></label>
  <input type="text" name="nick_text" id="nick_text">
  <input type="submit" name="button" id="button" value="Войти">
</form></div>
';
$UserOldNickName=$_COOKIE["UserNickNameOld"];
if($UserOldNickName<>null)
	{
		$LogonForm.='<div> В прошлый раз Вы заходили под ником '.$UserOldNickName.'. <a href="" id="oldloginenter">Если Вы хотите зайти под ним снова, то нажмите эту ссылку.</a> </div>';
		$InHeadHTML.='$("#oldloginenter").click(function() {
  					$("#nick_setstatus").load("ajax/applynickname.php?act=setnick&nick='.$UserOldNickName.');
			});';
	};

$InHeadHTML.='</script>';
$CopyRights = 'Чат под управлением "ASCHAT II Альфа". Версия '.$SystemVersion;
$ChatTitle=fgets(fopen("data/chattitle.ip","r"));
for($i=0;$i<count($TemplateHTML);$i++)
	{
		$String=$TemplateHTML[$i];
		$String=str_replace("@TemplateDir@",$TemplateDir,$String);
		$String=str_replace("@INHEAD@",$InHeadHTML,$String);
		$String=str_replace("@LOGONFORM@",$LogonForm,$String);
		$String=str_replace("@COPYRIGHTS@",$CopyRights,$String);
		$String=str_replace("@ChatTitle@",$ChatTitle,$String);
		echo($String);
	};
?>