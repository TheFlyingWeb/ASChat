<?PHP
include("systeminfo.php");
error_reporting("E_ALL");
$ActualVersion=fgets(fopen("http://aspirine-soft.ru/versions/aschat.txt","r"));
if($ActualVersion==false)
	{
		echo("Текущая версия системы: $SystemVersion <br>");
		echo('Не удалось соединиться с сервером...');
		exit();
	};
echo("Текущая версия системы: $SystemVersion <br>");
if($ActualVersion==$SystemVersion)
	{
		echo('Актуальная версия системы: <font color="#009900">'.$ActualVersion.' <br> Обновление не требуется</font>');
	}else
	{
		echo('Актуальная версия системы: <font color="#FF0000">'.$ActualVersion.' <br> Доступна новая версия! Скачать ее можно с <a href="http://aspirine-soft.ru/chat/">официальной страницы чата.</a></font>');
	};
?>