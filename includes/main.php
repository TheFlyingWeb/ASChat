<?PHP
$TemplateHTML=file("templates/$TemplateID/chat.html");
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
$symb = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
$operam = strpos($_SERVER['HTTP_USER_AGENT'],"Opera M");
$htc = strpos($_SERVER['HTTP_USER_AGENT'],"HTC_");
$fennec = strpos($_SERVER['HTTP_USER_AGENT'],"Fennec/");
$winphone = strpos($_SERVER['HTTP_USER_AGENT'],"WindowsPhone");
$wp7 = strpos($_SERVER['HTTP_USER_AGENT'],"WP7");
$wp8 = strpos($_SERVER['HTTP_USER_AGENT'],"WP8");
if ($ipad || $iphone || $android || $palmpre || $ipod || $berry || $mobile || $symb || $operam || $htc || $fennec || $winphone || $wp7 || $wp8 === true) {
   $TemplateHTML=file("templates/mobile/chat.html"); 
}
$InHeadHTML="<script type='text/javascript' src='jquery.js'></script>

<script type='text/javascript'>
 
$(document).ready(function () {
    $('#talkform').submit(Send); 
    $('#talktext').focus(); 
    setInterval('Load();', 2000);
	setInterval('WhoOnline();', 5000);
	$('#color_red').click(function() {
  					$('#colorselector').load('ajax/color.php?color=red');
					 $('#talktext').focus();
			});
	$('#color_darkred').click(function() {
  					$('#colorselector').load('ajax/color.php?color=darkred');
					 $('#talktext').focus();
			});
	$('#color_darkgreen').click(function() {
  					$('#colorselector').load('ajax/color.php?color=darkgreen');
					 $('#talktext').focus();
			});
	$('#color_darkblue').click(function() {
  					$('#colorselector').load('ajax/color.php?color=darkblue');
					 $('#talktext').focus();
			});
	$('#color_blue').click(function() {
  					$('#colorselector').load('ajax/color.php?color=blue');
					 $('#talktext').focus();
			});
	$('#color_black').click(function() {
  					$('#colorselector').load('ajax/color.php?color=black');
					 $('#talktext').focus();
			});
	$('#smile1').click(function() {
					talktext.value += ':-)';
					$('#talktext').focus();
			});
	$('#smile2').click(function() {
					talktext.value += ':-(';
					$('#talktext').focus();
			});
	$('#smile3').click(function() {
					talktext.value += ';-)';
					$('#talktext').focus();
			});
	$('#smile4').click(function() {
					talktext.value += ':-D';
					$('#talktext').focus();
			});
	$('#smile5').click(function() {
					talktext.value += ':|';
					$('#talktext').focus();
			});
	$('#smile6').click(function() {
					talktext.value += ':_(';
					$('#talktext').focus();
			});
	$('#smile7').click(function() {
					talktext.value += '>(';
					$('#talktext').focus();
			});
});

function WhoOnline()
	{
		$('#whoisonline').load('ajax/whoisonline.php');	
	}
 
function Send() {
    
    $.post('ajax/chatcore.php', 
        {
        act: 'send',  
        text: $('#talktext').val() 
    },
     Load ); 
 
    $('#talktext').val(''); 
    $('#talktext').focus(); 
 
    return false; 
}
 
var load_in_process = false; 
 

function Load() {
   
   
            $.post('ajax/chatcore.php',
            {
                  act: 'load'
            },
               function (result) { 
                    eval(result);
                    $('#mainchatscreen').scrollTop($('#mainchatscreen').get(0).scrollHeight); 
                    load_in_process = false; 
            });
   
}
</script>";
$CopyRights = 'Чат под управлением "ASCHAT II Альфа". Версия '.$SystemVersion;
$ColorSelector= '<img src="imgs/colors/red.png" id="color_red"><img src="imgs/colors/darkred.png" id="color_darkred"><img src="imgs/colors/darkgreen.png" id="color_darkgreen"><img src="imgs/colors/darkblue.png" id="color_darkblue"><img src="imgs/colors/blue.png" id="color_blue"><img src="imgs/colors/black.png" id="color_black"><div id="colorselector"></div>';
$TalkFormHTML='<form id="talkform"><input type=text id="talktext" style="width:95%;"></form>';
$SmilePanel='<img src="smiles/1.gif" id="smile1"> <img src="smiles/2.gif" id="smile2"> <img src="smiles/3.gif" id="smile3"> <img src="smiles/4.gif" id="smile4"> <img src="smiles/5.gif" id="smile5"> <img src="smiles/6.gif" id="smile6"> <img src="smiles/7.gif" id="smile7">';
$ChatTitle=fgets(fopen("data/chattitle.ip","r"));
for($i=0;$i<count($TemplateHTML);$i++)
	{
		$String=$TemplateHTML[$i];
		$String=str_replace("@TemplateDir@",$TemplateDir,$String);
		$String=str_replace("@INHEAD@",$InHeadHTML,$String);
		$String=str_replace("@TALKFORM@",$TalkFormHTML,$String);
		$String=str_replace("@USERNICKNAME@",$UserName,$String);
		$String=str_replace("@COPYRIGHTS@",$CopyRights,$String);
		$String=str_replace("@COLORSELECTOR@",$ColorSelector,$String);
		$String=str_replace("@ChatTitle@",$ChatTitle,$String);
		$String=str_replace("@SMILEPANEL@",$SmilePanel,$String);
		$String=str_replace("@LOGOUTLINK@","exit.php",$String);

		
		echo($String);
	};
?>