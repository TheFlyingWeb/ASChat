<?PHP
error_reporting("E_ALL");
echo('<b>Сейчас в чате:</b><br>');
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
			echo("$file <br>");
		};
    }
  }
  closedir ($dir);
?>