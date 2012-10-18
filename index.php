<?PHP
session_start();
error_reporting("E_ALL");
$UserIP=$_SERVER['REMOTE_ADDR'];
$BlockedIPs=file("data/ip_blocked.ip");
$IPFlag=1;
for($o=0;$o<count($BlockedIPs);$o++)
	{
		$BlockedIP=trim($BlockedIPs[$o]);
		$Includes=substr_count($UserIP,$BlockedIP);
		if($Includes>0)
			{
				$IPFlag=0;
				
			};
	};
if($IPFlag==0)
	{
		echo("Вам заблокирован доступ к чату.");
		exit();
	};
$SystemVersion='2.0.2 альфа';

$UserName=$_SESSION["UserName"];
$TemplateID=fgets(fopen("data/template.ip","r"));
$TemplateDir='templates/'.$TemplateID;
if($UserName==null)
	{
		include("includes/logon.php");
	}else
	{
		include("includes/main.php");
	};
?>