<?php
session_start();
require("../database.php");
include("header.php");
error_reporting(1);
?>
<link href="../quiz.css" rel="stylesheet" type="text/css">
<?php

extract($_POST);

echo "<BR>";
if (!isset($_SESSION['alogin']))
{
	echo "<br><h2><div  class=head1>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
}
echo "<BR><h3 class=head1>Delete Test</h3>";

echo "<table width=100%>";
echo "<tr><td align=center></table>";
if($submit=='submit' || strlen($subname)>0 )
{
$rs=mysql_query("select * from mst_subject where sub_name='$subname'");
if (mysql_num_rows($rs)>0)
{
	echo "<br><br><br><div class=head1>Subject is Already Exists</div>";
	exit;
}
mysql_query("insert into mst_subject(sub_name) values ('$subname')",$cn) or die(mysql_error());
//echo "<p align=center>Subject  <b> \"$subname \"</b> Added Successfully.</p>";
$submit="";
}
?>

<div style="margin:auto;width:90%;height:500px;box-shadow:2px 1px 2px 2px #CCCCCC;text-align:left">
<title>Delete Test</title>
<form name="form1" method="post" onSubmit="return check();">
<!--
  <table width="41%"  border="0" align="center">
    <tr>
      <td width="45%" height="32"><div align="center"><strong> </strong></div></td>
      <td width="2%" height="5">  
      <td width="53%" height="32">
    <tr>
        <td height="26"> </td>
        <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Delete" ></td>
    </tr>
  </table>
  -->
<?php
	if ($cn->connect_error)
	{
		die("cannot connect");
	}
	else 
	{
	if(isset($_POST['submit'])){
		if(!empty($_POST['check_list'])){
			foreach($_POST['check_list'] as $selected){
				deleteQuestion($cn,$selected);
			}
			$_POST['check_list'] = '';
		}
	}
	}

?>

<div class = "container">
<form action = "testdelete.php" method = "post">


<h2>Questions :</h2>

<?php 
	

		display($cn,true);

	
	
?>
<button type="submit" name="submit" class="btn btn-success">Submit</button>
</form>
</div>
  
</form>
<p>&nbsp; </p>
</div>

<?php
function deleteQuestion($dataBase,$question) {
		
			$query='DELETE FROM questionanswer WHERE questions =  "'. $question .'"';
			mysqli_query($dataBase,$query);
}

function display($dataBase,$delete)
	{	
		
			$count=1;
			$_query="select * from mst_question";
				
			if($isqr=mysqli_query($dataBase,$_query)){
				if($delete)
					$giveSpace = '<th></th>';
				else
					$giveSpace = '';
				echo '<table class="table">';
				echo '<tr>'.$giveSpace.'<th>Sr no</th><th>Question</th><th>Option 1</th><th>Option 2</th><th>Option 3</th><th>Option 4</th><th>Answer</th></tr>';
				while ($qexe=mysqli_fetch_assoc($isqr)) {
				$checkBox = '<tr ><td><input type = "checkbox" name = "check_list[]" value = "'.$qexe["que_id"].'"/></td>';
			
					if($delete)
						echo $checkBox;
					echo '<td>'.$count.'</td><td>'.$qexe["que_desc"].'</td><td>'.$qexe["ans_1"].'</td><td>'.$qexe["ans_2"].'</td><td>'.$qexe["ans_3"].'</td><td>'.$qexe["ans_4"].'</td><td>'.$qexe["true_ans"].'</td></tr>';
					$count++;

					# code...
				}
				echo "</table>";
			}
		

	}
?>