<?PHP
session_start();
error_reporting("E_ALL");
//include("../2ddata3.php");
$Auth=$_SESSION["auth"];
if($Auth<>true)
	{
		include("src/loginform.php");
		exit();
	};
if($Auth==true)
	{
		include("src/main.php");
	};
?>