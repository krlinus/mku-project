
<html>
<head>
<title>Add new cinema halls to list</title>
</head>


<body>
<!--
create table chall (hcode char(4), hname char (30), hloc char (64), hcity
 char(30), hcountry char(30), hpin char (30));
-->
<?php 
  $luname=array_key_exists("uname", $_GET) ? $_GET["uname"]:"";
  $lpword=array_key_exists("pword", $_GET) ? $_GET["pword"]:"";

  $lhcode=array_key_exists("hcode", $_GET) ? $_GET["hcode"]:"";
  $lhname=array_key_exists("hname", $_GET) ? $_GET["hname"]:"";
  $lhloc=array_key_exists("hloc", $_GET) ? $_GET["hloc"]:"";
  $lhcity=array_key_exists("hcity", $_GET) ? $_GET["hcity"]:"";
  $lhcountry=array_key_exists("hcountry", $_GET) ? $_GET["hcountry"]:"";
  $lhpin=array_key_exists("hpin", $_GET) ? $_GET["hpin"]:"";

/*

echo   $luname . "<br>";
echo   $lpword . "<br>";
echo   $lhcode . "<br>";
echo   $lhname . "<br>";
echo   $lhloc . "<br>";
echo   $lhcity . "<br>";
echo   $lhcountry . "<br>";
echo   $lhpin . "<br>";
  */

  if($luname != "")
  {
    $lqs = "insert into chall values ('".$lhcode.
    "','".$lhname."','".$lhloc."','".
    $lhcity."','".$lhcountry."','".$lhpin."')";

    echo $lqs."<br>";


    // Connecting, selecting database
    $link = mysql_connect('localhost', $luname, $lpword)
    or die('Could not connect: ' . mysql_error());
    echo 'Connected successfully';
    mysql_select_db('sunilr74_uk_db') or die('Could not select database');

    // Performing SQL query
  
    $result = mysql_query($lqs) or 
            die('Query failed: ' . mysql_error());

    // Free resultset
    mysql_free_result($result);

    // Closing connection
    mysql_close($link);

  } 
?>
<center>
You need a valid user-id and password to add a theatre<br>
<form name="hdet" action="addhall.php" method="GET">
<table>
<tr>
<td>User ID</td>
<td><input type="text" name="uname"></input></td>
</tr>

<tr>
<td>Password</td>
<td><input type="password" name="pword"></input></td>
</tr>

<tr>
<td>Cinema Hall Code</td>
<td><input type="text" name="hcode"></input></td>
</tr>

<tr>
<td>Name of Hall</td>
<td><input type="text" name="hname"></input></td>
</tr>

<tr>
<td>Street address</td>
<td><input type="text" name="hloc"></input></td>
</tr>
<!-- 
create table chall (hcode char(4), hname char (30), hloc char (64), hcity
 char(30), hcountry char(30), hpin char (30));

-->

<tr>
<td>City</td>
<td><input type="text" name="hcity"></input></td>
</tr>

<tr>
<td>Country</td>
<td><input type="text" name="hcountry"></input></td>
</tr>

<tr>
<td>Pin code</td>
<td><input type="text" name="hpin"></input></td>

</tr>



</table>

<p><input type="submit" value="Submit"></input>
</form>
</center>
</body>
</html>
