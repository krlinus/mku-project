<html>
<head>
<title>Vote Your Movie</title>
</head>
<body>
<center>
<?php 
    $lmcode=array_key_exists("mcode",$_GET) ? $_GET["mcode"]:"";
    $lnewmcode=array_key_exists("newmcode",$_GET) ? $_GET["newmcode"]:"";
    $lmname=array_key_exists("mname",$_GET) ? $_GET["mname"]:"";
    $lmpart=array_key_exists("mpart",$_GET) ? $_GET["mpart"]:"";
    $lprsnid=array_key_exists("prsn",$_GET) ? $_GET["prsn"]:"";
    if($lprsnid == "")
      $lprsnid=array_key_exists("prsnid",$_GET) ? $_GET["prsnid"]:"";

    $lpswd=array_key_exists("pswd",$_GET) ? $_GET["pswd"]:"";

    $lhcode=array_key_exists("hcode",$_GET) ? $_GET["hcode"]:"";
    $lactn=array_key_exists("a",$_GET) ? $_GET["a"]:"";
    // Connecting, selecting database
    $link = mysql_connect('localhost', 'jd', '')
            or die('Could not connect: ' . mysql_error());
    echo 'Connected successfully'. '<br>';
    mysql_select_db('sunilr74_uk_db') or die('Could not select database');
    if($lpswd != "")//test for acting on the data
    {
      $lauthQry = "select uname from users where uemail=".
                  "'".$lprsnid."' and upass = '".$lpswd."'";
      echo $lauthQry.'<br>';

      // Performing SQL query
      $resultAuth = mysql_query($lauthQry) 
                    or die('Query failed: ' . mysql_error());
      $rowsAuth = mysql_num_rows($resultAuth);
      if($rowsAuth <= 0)
      {
	 echo 'Please enter your correct email address and password<br>';
      }
      else
      {
  	$lcsupd = "update personvote set ".
  		"moviedate = sysdate(), hcode = '".$lhcode.
  		"', mcode = '".$lnewmcode.
  		"' where personid = '". $lprsnid . "' and ".
  		"mcode = '".$lmcode."'";
	echo $lcsupd.'<br>';
        $result5 = mysql_query($lcsupd) or 
  	      die('Query failed: ' . mysql_error());
        mysql_free_result($result5);
      }

      // Free resultset
      mysql_free_result($resultAuth);
      mysql_free_result($result);

      // Closing connection
    }
?>
<?php
    // Place to collect the data
    $lcs = "SELECT mcode, mname, mpart".
              " FROM movie ".
	      " where mcode = '".$lnewmcode."'";
    echo $lcs. '<br>';
    $result = mysql_query($lcs) 
           or die('Query failed: ' . mysql_error());
    $rows = mysql_num_rows($result);
    $line = mysql_fetch_object($result);
?>
<form name="mvote" action="modvote.php">
 <input type="hidden" name="mcode" value=
<?php echo "'".$lmcode."'"; ?> ></td>
 <input type="hidden" name="newmcode" value=
<?php echo "'".$lnewmcode."'"; ?> ></td>
<table>
<tr>
<td>Your email:</td>
<td><input type="text" name="prsnid"></input></td>
</tr>
<tr>
<td>Password:</td>
<td><input type="text" name="pswd"></input></td>
</tr>
<tr>
<td>Movie name</td>
<td><input type="text" name="mname" value = 
<?php echo "'".$line->mname."'";?> > </input></td>
<tr>
<td>Part (If applicable)</td>
<td><input type="text" name="mpart" value = 
<?php echo '"'.$line->mpart.'"'; ?> > </input></td>
</tr>
<tr><td>Prefferred Cinema hall (if any)</td>
<td>
<?php 
      $qs2 = "select * from chall";

      $result2 = mysql_query($qs2) or die('Query failed: ' . mysql_error());
?>
<Select name="hcode" size="1">
<option value="UNKN">Any</option>
<?php 
      while($line2 = mysql_fetch_object($result2)) 
      { 
?>
<option value="<?php echo $line2->hcode; ?>">
           <?php echo $line2->hname; ?></option>
<?php
      }
      // todo: free the result..
      // Free resultset
      mysql_free_result($result2);

      // Closing connection
      mysql_close($link);
?>
</select>
</td></tr>
<tr>
<td></td><td><input type="Submit" value="Vote"></input></td>
</tr>
</form>
<center>

</body>
</html>

