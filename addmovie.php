
<html>
<head>
<title>sample</title>
</head>


<body>
<?php


  $lmname = "";
  $impart = "";
  if(array_key_exists("mname",$_GET))
	$lmname = $_GET['mname'];
  if(array_key_exists("mpart",$_GET))
	$lmpart = $_GET['mpart'];
  echo "name = ".$lmname."<br>";
  echo "part = ".$lmpart."<br>";


  if($lmname != "")
  {
    echo 'inside if...';
    // Connecting, selecting database
    $link = mysql_connect('localhost', 'jd', '')
      or die('Could not connect: ' . mysql_error());
    echo 'Connected successfully';
    mysql_select_db('sunilr74_uk_db') or die('Could not select database');

      // Performing SQL query
    $query = "insert into tmpmovie values ('".$lmname."','".$lmpart."')"; 
    echo $query."<br>";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    // Free resultset
    mysql_free_result($result);

    // Closing connection
    mysql_close($link);
    echo "Thank you for your suggestion.<br>";
  }

?>


<center>
<form name="mdet" action="addmovie.php" method="GET">
<table><tr><td>
<p>Movie name</td><td>
<input type="text" name="mname"></input></td></tr><tr><td>
<p>Part (If applicable)</td><td>
<input type="text" name="mpart"></input></td></tr><tr><td>
<!--
<p>Movie Type</td><td>
<Select name="mtyp" size="1">
<option value="UNKN">Unknown</option>
<option value="ACTN">Action</option>
<option value="CLSC">Classic</option>
<option value="SCIF">Science Flick</option>
<option value="ADVN">Adventure</option>
<option value="DGGY">Doggy movie</option>
<option value="CMDY">Comedy</option>
</select></td></tr></table>
-->
<p><input type="submit" value="Add movie"></input>
</form>
<center>
</body>
</html>
