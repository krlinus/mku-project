<html>
<head>
<title>Find your title</title>
</head>
<body>

<?php 
  $lbVali = 0;
  $lmcode=array_key_exists("mcode",$_GET) ? $_GET["mcode"]:"";
  $lbVali = (($lmcode != "")? 1:0);
  $lmname=array_key_exists("mname",$_GET) ? $_GET["mname"]:"";
  $lbVali |= ($lmname != "")? 1:0;
  $lmpart=array_key_exists("mpart",$_GET) ? $_GET["mpart"]:"";
  $lbVali |= ($lmpart != "")? 1:0;
  $lmtype=array_key_exists("mtyp",$_GET) ? $_GET["mtyp"]:"";
  echo 'lbVali = '.$lbVali.'<br>';
  $lbVali |= ($lmtype != "" && $lmtype != 'UNKN')? 1:0;
  $lmlng=array_key_exists("mlng",$_GET) ? $_GET["mlng"]:"";
  $lbVali |= ($lmlng != "")? 1:0;
  echo 'lbVali = '.$lbVali.'<br>';
  if ($lbVali != 0) // must query
  {
    $lcs = "SELECT * FROM movie";
    echo $lcs."<br>";
    $lw = 0; // where clause
    if ($lmcode != "")
    {
      if($lw == 0)
      {
        $lcs = $lcs . " where ";
        $lw = 1;
      }
      $lcs = $lcs . " mcode = '" . $lmcode . "'";
    }
    if ($lmname != "")
    {
      if($lw == 0)
      {
        $lcs = $lcs . " where ";
        $lw = 1;
      }
      else
      {
        $lcs = $lcs . " or ";
        $lw = 1;
      }
      $lcs = $lcs . " mname like '%" . $lmname . "%'";
    }
    if ($lmpart != "")
    {
      if(!$lw)
      {
        $lcs = $lcs . " where ";
        $lw = 1;
      }
      else
      {
        $lcs = $lcs . " or ";
      }
      $lcs = $lcs . " mpart = '" . $lmpart . "'";
    }
    if ($lmtype != "" && $lmtype != 'UNKN')
    {
      if(!$lw)
      {
        $lcs = $lcs . " where ";
        $lw = 1;
      }
      else
      {
        $lcs = $lcs . " or ";
      }
      $lcs = $lcs . " mtype = '" . $lmtype . "'";
    }
    if ($lmlng != "" && $lmlng != 'UNKN')
    {
      if(!$lw)
      {
        $lcs = $lcs . " where ";
        $lw = 1;
      }
      else
      {
        $lcs = $lcs . " or ";
      }
      $lcs = $lcs . " mlang = '" . $lmlng . "'";
    }
    //     out.println($lcs . "<br>");
    // Connecting, selecting database
    $link = mysql_connect('localhost', 'jd', '')
      or die('Could not connect: ' . mysql_error());
    echo 'Connected successfully';
    mysql_select_db('sunilr74_uk_db') or die('Could not select database');

    // Performing SQL query
    echo "<br>".$lcs."<br>";
    $result = mysql_query($lcs) or die('Query failed: ' . mysql_error());
    $rows = mysql_num_rows($result);

    if($rows <= 0)
    {
	    if($lmname != "")
	    {
	    ?>
    <a href="addmovie.php?mname=<?php echo $lmname;?>&mpart=<?php echo $lmpart; ?>">Suggest this movie</a>
	    <?php
	    }
    }
    else
    {
  
  ?>
      <table border ="1" width = "100%">
      <tr> 
      <td>Movie code </td>
      <td>Movie name </td>
      <td>Movie part (if any) </td>
      <td>Movie type </td>
      <td>Language </td>
      <td>Options </td>
      </tr>
  <?php 
      // Printing results in HTML
      while ($line = mysql_fetch_object($result)) 
      {
  
  ?>
        <tr>
        <td><?php echo $line->mcode; ?>
        </td>
        <td><?php echo $line->mname; ?>
        </td>
        <td><?php echo $line->mpart; ?>
        </td>
        <td><?php echo $line->mtype; ?>
        </td>
        <td><?php echo $line->mlang; ?>
        </td>
	<?php
	$hrefstr="votemovie.php?mcode=$line->mcode".
	"&mname=$line->mname&mpart=$line->mpart";
	?>
<td><a href=<?php echo "'".$hrefstr."'"?> >Vote for this movie</a>
        </td>
  
        </tr>
  <?php 
  	
      } // end of while
  ?>
  </table>
  <?php 
      // Free resultset
      mysql_free_result($result);
  
      // Closing connection
      mysql_close($link);
    }
  }
  else // display normal find form
  {
?>
<center>
<form name="mdet" action="findmovie.php">
<table>
<!--
<tr>
<td>
<p>User name</td><td>
<input type="text" name="uname"></input></td></tr><tr><td>

<p>Password</td><td>
<input type="text" name="pword"></input></td></tr>

-->

<tr><td>


<p>Movie code</td><td>
<input type="text" name="mcode"></input></td></tr><tr><td>

<p>Movie name</td><td>
<input type="text" name="mname" value="<?php echo $lmname; ?>"></input></td></tr><tr><td>
<p>Part (If applicable)</td><td>
<input type="text" name="mpart" value="<?php echo $lmpart;?>"></input></td></tr><tr><td>

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

<p><input type="submit" value="Search"></input>
</form>
<center>

<?php 
  }
?>

</body>
</html>
