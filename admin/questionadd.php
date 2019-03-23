<?php
session_start();
require("../database.php");
//include("header.php");
error_reporting(1);

if(!isset($_SESSION['que_inserted'])){
	$_SESSION['que_inserted'] = 1;
}


?>
<link href="../quiz.css" rel="stylesheet" type="text/css">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <script  src="javascripts/admin.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="login.php">Quiz</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="login.php">Home</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="signout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>  

<?php
extract($_POST);

echo "<BR>";
if (!isset($_SESSION[alogin]))
{
	echo "<br><h2><div  class=head1>You are not Logged On Please Login to Access this Page</div></h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
}
echo "<BR><h3 class=head1>Add Question </h3>";
if($_POST[submit]=='Save' || strlen($_POST['testid'])>0 )
{
extract($_POST);
$query1 = mysql_query("SELECT total_que FROM mst_test WHERE test_id = ".$testid);
$que_no = mysql_fetch_assoc($query1);

$query2 = mysql_query("SELECT count(test_id) FROM mst_question WHERE test_id = ".$testid);
$total_que = mysql_fetch_assoc($query2);
//echo 'que_no : '.$que_no['total_que'] . 'and total_que : '.$total_que['count(test_id)'];
if( $total_que['count(test_id)'] < $que_no['total_que'])
{
  /*
	if ( $_SESSION['que_inserted'] > $que_no['total_que']){
		header('Location:login.php');
	//echo $_SESSION['que_inserted'] .' and que_no: '.$que_no['total_que'];
		$_SESSION['que_inserted'] = 1;
	}
	else {*/
		if(mysql_query("insert into mst_question(test_id,que_desc,ans1,ans2,ans3,ans4,true_ans) values ('$testid','$addque','$ans1','$ans2','$ans3','$ans4','$anstrue')",$cn))
		{
		?>
			
			<SCRIPT LANGUAGE="JavaScript">
				alert("Question Added Successfully.");
			</SCRIPT>
	<?php
		}
		else
			die(mysql_error());
//echo "<p align=center>Question Added Successfully.</p>";
//echo $_SESSION['que_inserted'];
		$_SESSION['que_inserted'] = $_SESSION['que_inserted'] +1;
		unset($_POST);
	/*	
$query1 = mysql_query("SELECT total_que FROM mst_test WHERE test_id = ".$testid);
$que_no = mysql_fetch_assoc($query1);

$query2 = mysql_query("SELECT count(test_id) FROM mst_question WHERE test_id = ".$testid);
$total_que = mysql_fetch_assoc($query2);

		if ($total_que['count(test_id)'] < $que_no['total_que']) 
		{
	$_SESSION['que_inserted'] = 1;
	//header('Location:login.php');
	?>
	<SCRIPT LANGUAGE="JavaScript">
		alert("Question Added Successfully.");
	</SCRIPT>
	<?php
			*/	
		//}
	//}
}
else {
	$_SESSION['que_inserted'] = 1;
	//header('Location:login.php');
	?>
	<SCRIPT LANGUAGE="JavaScript">
		alert("Maximum number of questions add already...");
		window.location.href ="login.php";
	</SCRIPT>
	<?php
		
	
}
}
?>
<SCRIPT LANGUAGE="JavaScript">
function check() {
mt=document.form1.addque.value;
if (mt.length<1) {
alert("Please Enter Question");
document.form1.addque.focus();
return false;
}
a1=document.form1.ans1.value;
if(a1.length<1) {
alert("Please Enter Answer1");
document.form1.ans1.focus();
return false;
}
a2=document.form1.ans2.value;
if(a1.length<1) {
alert("Please Enter Answer2");
document.form1.ans2.focus();
return false;
}
a3=document.form1.ans3.value;
if(a3.length<1) {
alert("Please Enter Answer3");
document.form1.ans3.focus();
return false;
}
a4=document.form1.ans4.value;
if(a4.length<1) {
alert("Please Enter Answer4");
document.form1.ans4.focus();
return false;
}
at=document.form1.anstrue.value;
if(at.length<1) {
alert("Please Enter True Answer");
document.form1.anstrue.focus();
return false;
}

return true;
}
</script>

<div style="margin:auto;width:90%;height:500px;box-shadow:2px 1px 2px 2px #CCCCCC;text-align:left">
<form name="form1" method="post" onSubmit="return check();">
  <table width="80%"  border="1" align="center">
    <tr>
      <td width="24%" height="32"><div align="left"><strong>Select Test Name </strong></div></td>
      <td width="1%" height="5">  
      <td width="75%" height="32"><select name="testid" id="testid">
<?php
$rs=mysql_query("Select * from mst_test order by test_name",$cn);
	  while($row=mysql_fetch_array($rs))
{
if($row[0]==$testid)
{
echo "<option value='$row[0]' selected>$row[2]</option>";

}
else
{
echo "<option value='$row[0]'>$row[2]</option>";
}
}
?>
      </select>
        
    <tr>
        <td height="26"><div align="left"><strong> Enter Question </strong></div></td>
        <td>&nbsp;</td>
	    <td><textarea class="form-control" name="addque" cols="60" rows="2" id="addque"></textarea></td>
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Enter Answer1 </strong></div></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans1" type="text" id="ans1" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer2 </strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans2" type="text" id="ans2" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer3 </strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans3" type="text" id="ans3" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter Answer4</strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans4" type="text" id="ans4" size="85" maxlength="85"></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter True Answer </strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="anstrue" type="text" id="anstrue" size="50" maxlength="50"></td>
    </tr>
    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" name="submit" value="Add" ></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
</div>
</body>