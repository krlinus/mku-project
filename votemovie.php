<html>
<head>
<title>Vote Your Movie</title>
</head>
<body>
<center>
<?php 
    $lmcode=array_key_exists("mcode",$_GET) ? $_GET["mcode"]:"";
    $lmname=array_key_exists("mname",$_GET) ? $_GET["mname"]:"";
    $lmpart=array_key_exists("mpart",$_GET) ? $_GET["mpart"]:"";
    $lprsnid=array_key_exists("prsnid",$_GET) ? $_GET["prsnid"]:"";
    $lpswd=array_key_exists("pswd",$_GET) ? $_GET["pswd"]:"";
    $lhcode=array_key_exists("hcode",$_GET) ? $_GET["hcode"]:"";
    if($lmcode != "" && $lhcode != "" && $lprsnid != "")
    {
      $lauthQry = "select uname from users where uemail=".
                  "'".$lprsnid."' and upass = '".$lpswd."'";
      $lcs = "SELECT movie.mcode, mname, mpart, personid".
              " FROM movie,personvote ".
	      "where personid = '" . $lprsnid . "'".
	      " and personvote.mcode = movie.mcode";
      echo $lcs. '<br>';
      // Connecting, selecting database
      $link = mysql_connect('localhost', 'jd', '')
              or die('Could not connect: ' . mysql_error());
      echo 'Connected successfully'. '<br>';
      mysql_select_db('sunilr74_uk_db') or die('Could not select database');

      // Performing SQL query
      $resultAuth = mysql_query($lauthQry) 
                    or die('Query failed: ' . mysql_error());
      $rowsAuth = mysql_num_rows($resultAuth);
      $result = mysql_query($lcs) or die('Query failed: ' . mysql_error());
      $rows = mysql_num_rows($result);
      echo 'Total votes by person'.$rows.'<br>';
      if($resultAuth <= 0)
      {
	 echo 'Please enter your correct email address and password<br>';
      }
      else
      {
        if($rows >= 5)
        {
  	  // person's votes exceeded quota
  	  // he will have to review and modify his votes
  	  echo 'Please review your current votes ';
  	  echo 'as you have reached your limit ';
          echo '<table border="1" width="100%">';
  	  echo '<td>Movie name</td><td>Part (if any)</td><td>options</td>';
          while($line = mysql_fetch_object($result)) 
          { 
  	    echo '<tr>';
  	    echo "<td>$line->mname</td><td>$line->mpart</td>";
  ?>
    <td><a href="modvote.php?prsn=<?php echo $line->personid;?>&mcode=<?php echo $line->mcode;?>&newmcode=<?php echo $lmcode?>">Modify</a></td>
  <?php 
            echo '</tr>';	
          }
  	  echo '</table>';
        }
        else 
        {
	  // Shot in dark attempt to update a record..
  
  	  $lcsckdup = "select * from personvote ".
  		" where personid = '". $lprsnid . "' and ".
  		"mcode = '".$lmcode."'";

  	  echo 'lcsckdup= '.$lcsckdup."<br>";
  
  
          $result3 = mysql_query($lcsckdup) or
  	     die('Query failed: ' . mysql_error());
  	  $rows2 = mysql_num_rows($result3);
	  echo 'select query retnd with '.$rows2.'<br>';
  	  if($rows2 <= 0) // Oops! there was no such record
  	  {
            //insert a fresh one
  	    $lcsins = "insert into personvote values('" . $lprsnid . 
  	       "','" . $lmcode . "',sysdate(),'".$lhcode."')";
            echo $lcsins;
            $result4 = mysql_query($lcsins) or 
  	      die('Query failed: ' . mysql_error());
            mysql_free_result($result4);
          }
	  else
	  {
  	    $lcsupd = "update personvote set ".
  		"moviedate = sysdate(), hcode = '".$lhcode.
  		"' where personid = '". $lprsnid . "' and ".
  		"mcode = '".$lmcode."'";
            $result5 = mysql_query($lcsupd) or 
  	      die('Query failed: ' . mysql_error());
            mysql_free_result($result5);
	  }

  
  
          mysql_free_result($result3);
  
  
        }
      }

      // Free resultset
      mysql_free_result($result);

      // Closing connection
      mysql_close($link);
    }
?>
<form name="mvote" action="votemovie.php">
 <input type="hidden" name="mcode" value=
<?php echo "'".$lmcode."'"; ?> ></td>
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
<?php echo "'".$lmname."'";?> > </input></td>
<tr>
<td>Part (If applicable)</td>
<td><input type="text" name="mpart" value = 
<?php echo '"'.$lmpart.'"'; ?> > </input></td>
</tr>
<tr><td>Prefferred Cinema hall (if any)</td>
<td>
<?php 
      $link2 = mysql_connect('localhost', 'sunilr74_uk', '')
              or die('Could not connect: ' . mysql_error());
      //echo 'Connected successfully';
      mysql_select_db('sunilr74_uk_db') or die('Could not select database');
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
      mysql_close($link2);
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

