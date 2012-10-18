<?PHP
session_start();
$Color=htmlspecialchars($_GET["color"]);
$_SESSION["UserColor"]=$Color;
echo("Цвет установлен");
?>