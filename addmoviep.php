<html>
<head>
<title>sample</title>
</head>


<body>
<?php
  $luname="";
  $lpword="";
  $lmcode="";
  $lmname="";
  $loldmname="";
  $loldmpart="";
  $lmpart="";
  $lmtype="";
  $lmlang="";
  $lactn="";
  if (array_key_exists("uname",$_GET))
  	$luname=$_GET["uname"];
  if (array_key_exists("pword",$_GET))
  	$lpword=$_GET["pword"];
  if (array_key_exists("mcode",$_GET))
  	$lmcode=$_GET["mcode"];
  if (array_key_exists("mname",$_GET))
  	$lmname=$_GET["mname"];
  if (array_key_exists("oldmname",$_GET))
  	$loldmname=$_GET["oldmname"];
  if (array_key_exists("oldmpart",$_GET))
  	$loldmpart=$_GET["oldmpart"];
  if (array_key_exists("mpart",$_GET))
  	$lmpart=$_GET["mpart"];
  if (array_key_exists("mtyp",$_GET))
  	$lmtype=$_GET["mtyp"];
  if (array_key_exists("mlng",$_GET))
  	$lmlang=$_GET["mlng"];
  if (array_key_exists("a",$_GET))
  	$lactn=$_GET["a"];
  
  if($luname != "" )
  {
    $cs = "";
    $result = "";

    echo 'inside if...';
    // Connecting, selecting database
    $link = mysql_connect('localhost', $luname, $lpword)
    or die('Could not connect: ' . mysql_error());
    echo 'Connected successfully';
    mysql_select_db('sunilr74_uk_db') or die('Could not select database');

    // Performing SQL query


    if($lactn == "add")
    { 
      $lcs="insert into movie values ('".$lmcode."','".$lmname."','"
            .$lmpart."','".$lmtype."','".$lmlang."')";
      echo $lcs;
      $result = mysql_query($lcs) or die('Query failed: ' . mysql_error());
    }  
    $lcs = "delete from tmpmovie where mname='".$loldmname."'".
             " and mpart='".$loldmpart."'";

    echo $lcs."<br>";

    $result = mysql_query($lcs) or die('Query failed: ' . mysql_error());

      // Free resultset
    mysql_free_result($result);

      // Closing connection
    mysql_close($link);
  }
  else 
  {
?>

<center>
<form name="mdet" action="addmoviep.php" method="get">
      <input type="HIDDEN" name="a" value="<?php echo $lactn; ?>"></input>
      <input type="HIDDEN" name="oldmname" value="<?php echo $lmname; ?>"></input>
      <input type="HIDDEN" name="oldmpart" value="<?php echo $lmpart; ?>"></input>

<table><tr><td>
<p>User name</td><td>
<input type="text" name="uname"></input></td></tr><tr><td>

<p>Password</td><td>
<input type="text" name="pword"></input></td></tr><tr><td>


<p>Movie code</td><td>
<input type="text" name="mcode"></input></td></tr><tr><td>

<p>Movie name</td><td>
<input type="text" name="mname" value="<?php echo $lmname; ?>"></input></td></tr><tr><td>
<p>Part (If applicable)</td><td>
<input type="text" name="mpart" value="<?php echo $lmpart; ?>"></input></td></tr><tr><td>

<p>Movie Type</td><td>
<Select name="mtyp" size="1">
<option value="UNKN">Unknown</option>
<option value="ACTN">Action</option>
<option value="CLSC">Classic</option>
<option value="SCIF">Science Flick</option>
<option value="ADVN">Adventure</option>
<option value="DGGY">Doggy movie</option>
<option value="CMDY">Comedy</option>
</select></td></tr>
<tr><td>
<p>Language</td><td>
<Select name="mlng" size="1">
<option value="UNKN">Unknown</option>
<option value="ENGL">English</option>
<option value="HNDI">Hindi</option>
<option value="TMIL">Tamil</option>
<option value="KANN">Kannada</option>
<option value="TELG">Telugu</option>
<option value="ORIY">Oriya</option>
</select></td></tr></table>

<p><input type="submit" value="<?php echo $lactn;?> movie"></input>
</form>
<center>
<?php 
  }
?>
</body>
</html>
