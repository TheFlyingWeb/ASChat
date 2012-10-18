<?PHP
session_start();
Header("Cache-Control: no-cache, must-revalidate");
Header("Pragma: no-cache");
 
//Header("Content-Type: text/javascript; charset=utf-8"); 	
function link_it($text)
{
    $text= preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\" >$3</a>", $text);
    $text= preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\" >$3</a>", $text);
    $text= preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a href=\"mailto:$2@$3\">$2@$3</a>", $text);
    return($text);
}
function WhoIsOnline ()
	{
		$UserName=$_SESSION["UserName"];
		fwrite(fopen("../data/online/$UserName","w"),time());
	};
$Act=$_POST["act"];
if($Act=='send')
{
$Text=htmlspecialchars($_POST["text"]);
$UserName=$_SESSION["UserName"];
if($Text<>null)
	{
		$Messages=fgets(fopen("../data/messages.ip","r"));
		$Messages=$Messages+1;
		mkdir("../data/messages/$Messages",0777);
		$UserColor=$_SESSION["UserColor"];
		fwrite(fopen("../data/messages/$Messages/username.ip","w"),$UserName);
		fwrite(fopen("../data/messages/$Messages/date.ip","w"),time());
		fwrite(fopen("../data/messages/$Messages/text.ip","w"),'<font color="'.$UserColor.'">'.$Text.' </font>');
		fwrite(fopen("../data/messages.ip","w"),$Messages);
		WhoIsOnline();
		//$_SESSION["lastmessage"]=$Messages;
	};
};

if($Act=='load')
	{
		 
		 $js = "$('#mainchatscreen').append('');";
		 $LastMessageID=$_SESSION["lastmessage"];
		 $AllMessages=fgets(fopen("../data/messages.ip","r"));
		 $Counter=0;
		 WhoIsOnline();
		 if($AllMessages>$LastMessageID)
			{
				for($i=$LastMessageID+1;$i<=$AllMessages;$i++)
					{
				
						$Writer=fgets(fopen("../data/messages/$i/username.ip","r"));
						$Date=date("H:i:s",fgets(fopen("../data/messages/$i/date.ip","r")));
						$Text=fgets(fopen("../data/messages/$i/text.ip","r"));
						$Text=str_replace(":-)",'<img src="smiles/1.gif">',$Text);
						$Text=str_replace(":-(",'<img src="smiles/2.gif">',$Text);
						$Text=str_replace(";-)",'<img src="smiles/3.gif">',$Text);
						$Text=str_replace(":-D",'<img src="smiles/4.gif">',$Text);
						$Text=str_replace(":|",'<img src="smiles/5.gif">',$Text);
						$Text=str_replace(":_(",'<img src="smiles/6.gif">',$Text);
						$Text=str_replace(">(",'<img src="smiles/7.gif">',$Text);
						//$Text=link_it($Text);
						$Text=preg_replace("#(https?|ftp)://\S+[^\s.,> )\];'\"!?]#",'<a href="\\0" target="_blank">\\0</a>',$Text);
						
						$js .= "$('#mainchatscreen').append('$Writer ($Date): $Text <br>');";
						$Counter=$Counter+1;
					};
				$_SESSION["lastmessage"]=$AllMessages;
				fwrite(fopen("../data/check.ip","w"),$Counter);
				
				echo($js);
				echo("$('#mainchatscreen').append('<audio autoplay src=audio/msg.wav></audio>');");
			};
		
		
 
	};

?>