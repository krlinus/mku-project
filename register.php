<html>
<head>
<title>Register</title>
</head>


<body>
<center>
<!--
create table users (uname char (30), uage int, usex char(1), 
ucity char(20), ucountry char (20), uemail char(50), upass char(50));
-->
<?php 
	
	echo 'hello....';
  $luname="";
  if(array_key_exists("uname", $_GET))
     $luname = $_GET["uname"];
  $luage=array_key_exists("uage", $_GET) ? $_GET["uage"]:"";
  $lusex=array_key_exists("usex", $_GET) ? $_GET["usex"]:"";
  $lucity=array_key_exists("ucity", $_GET) ? $_GET["ucity"]:"";
  $lucountry=array_key_exists("ucountry", $_GET) ? $_GET["ucountry"]:"";
  $luemail=array_key_exists("uemail", $_GET) ? $_GET["uemail"]:"";
  $lupass=array_key_exists("upass", $_GET) ? $_GET["upass"]:"";
  if($luemail != "")
  {
    $lcs = "insert into users values ('".$luname.
            "','".$luage."','".$lusex."','".
            $lucity."','".$lucountry."','".
            $luemail."','".$lupass."')";
    echo $lcs."<br>";


    // Connecting, selecting database
    $link = mysql_connect('localhost', 'jd', '')
               or die('Could not connect: ' . mysql_error());
    echo 'Connected successfully';
    mysql_select_db('sunilr74_uk_db') or die('Could not select database');

    // Performing SQL query
    $result = mysql_query($lcs) or die('Query failed: ' . mysql_error());

    // Free resultset
    mysql_free_result($result);

    // Closing connection
    mysql_close($link);

  }
?>

<p>Really simple to register

<form name="udet" action="register.php">
<table>
<tr>
<td>Name</td>
<td><input type="text" name="uname"></input></td>
</tr>

<tr>
<td>Age</td>
<td><input type="text" name="uage"></input></td>
</tr>

<tr>
<td>Sex</td>
<td>
	<Select name="usex" size="1">
		<option value="M">Male</option>
		<option value="F">Female</option>
	</select>
</td>
</tr>

<tr>
<td>City</td>
<td><input type="text" name="ucity"></input></td>
</tr>

<tr>
<td>Country</td>
<td><input type="text" name="ucountry"></input></td>
</tr>

<tr>
<td>Email</td>
<td><input type="text" name="uemail"></input></td>
</tr>

<tr>
<td>Password</td>
<td><input type="password" name="upass"></input></td>
</tr>

</table>

<p><input type="submit" value="Submit"></input>
</form>
<center>

</body>
</html>
