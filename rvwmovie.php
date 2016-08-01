
<html>
<head>
<title>sample</title>
</head>


<body>
<?php 
    $lqs = "Select * from tmpmovie";

    echo $lqs."<br>";


    // Connecting, selecting database
    $link = mysql_connect('localhost', 'jd', '')
               or die('Could not connect: ' . mysql_error());
    echo 'Connected successfully';
    mysql_select_db('sunilr74_uk_db') or die('Could not select database');

    // Performing SQL query

    $result = mysql_query($lqs) or die('Query failed: ' . mysql_error());
    echo "<table border='1' width='100%'>\n";
    while ($line = mysql_fetch_object($result)) 
    {
	echo "<tr><td>\n";

	echo 'Movie name: '.$line->mname;
	if($line->mpart !="")
	{
	  echo "(part: ". $line->mpart. ")";
	}

	echo "\n<BR><blockquote>";
	echo "Name is similar to:<p>\n";
	$lqs2 = "select mname,mpart from movie where mname like ".
	                           "'%".$line->mname."%'";
        //echo $lqs2;
	$result2 = mysql_query($lqs2) 
	             or die('Query failed: ' . mysql_error());
        while ($line2 = mysql_fetch_object($result2)) 
	{
	  echo $line2->mname." part ".$line2->mpart;
	  if($line2->mpart == "" )
	    echo "(none)";
	  //echo "<br>\n";
        }
	mysql_free_result($result2);

	echo '</blockquote>';
?>
          Click <a href=
  "addmoviep.php?mname=<?php echo $line->mname?>&mpart=<?php echo $line->mpart; ?>&a=add">
              here</a>, if you want to include this movie <br>
          Click <a href=
  "addmoviep.php?mname=<?php echo $line->mname?>&mpart=<?php echo $line->mpart; ?>&a=del">
              here</a>, if you want to reject this movie <br>
<?
	echo "</td></tr>\n";
    }
    echo "</table>";
    // Free resultset
    mysql_free_result($result);

    // Closing connection
    mysql_close($link);

?>
<p>Click <a href="index.html">here</a> to go back to home page.<br>
</body>
</html>
