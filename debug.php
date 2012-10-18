<?PHP
session_start();
echo("Monitoring:<br><br>");
echo('Session_ UserName = '.$_SESSION["UserName"]);
echo('<br>Session _LastMessage = '.$_SESSION["lastmessage"]);
echo('<br>Messages = '.fgets(fopen("data/messages.ip","r")));
echo('<br>Check = '.fgets(fopen("data/check.ip","r")));
?>