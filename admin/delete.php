<?php
	session_start();
	require_once('included_functions.php');
	require_once('databaseAccess.php');
	require_once('../database.php');
?>
<?php
$host="localhost";
 	$hostname = 'root';
	$host_pass = '';
	$dbName = 'quiz_new';
	$test_id = 1;
	//if(!$db = @mysql_connect($host,$hostname,$host_pass))
	$conn = new mysqli($host,$hostname,$host_pass,$dbName);

	if ($conn->connect_error)
	{
		die("cannot connect");
	}
	else 
	{
	

		
	if(isset($_POST['delete_que'])){
		if(!empty($_POST['check_list'])){
			foreach($_POST['check_list'] as $selected){
				deleteQuestion($selected);
			}
			$_POST['check_list'] = '';
		}
	}
	}
	mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >

	<title>Admin panel</title>
	
	

	<meta charset="utf-8">
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

<div class = "container">
<!--<form action = "delete.php" method = "post"> -->


<h2>Questions :</h2>
	
<?php
/*		
$sub_que=mysql_query("Select * from mst_subject order by sub_name",$cn);


echo "<form action='delete.php' method='post'>";
echo "<select name='sub_list'>";
	  while($row=mysql_fetch_array($sub_que))
	{
		if($row[0]==$subid)
		{
			echo "<option value='$row[0]' selected>$row[1]</option>";
		}
		else
		{
			echo "<option value='$row[0]'>$row[1]</option>";
		}
	}
echo "</select>";

echo '<input type="submit" name="retrive_sub" value="Retrive" ></td>';
echo '</form>';
*/
//if(isset($_POST['retrive_sub']) )//|| isset($_SESSION['sub_list']))
//{
	/*
	if(isset($_POST['retrive_sub'])){
		$sub_id = $_POST['sub_list'];
		$_SESSION['sub_list'] = $_POST['sub_list'];
	} else {
		$sub_id = $_SESSION['sub_list'];
	}

	$rs=mysql_query("Select * from mst_test ",$cn );//where sub_id = '$sub_id' order by  test_name",$cn);

	echo "<form action='delete.php' method='post'>";
	echo "<select name='option_list'>";
	
	while($row=mysql_fetch_array($rs))
	{
		if($row[0]==$subid)
		{
			echo "<option value='$row[0]' selected>$row[2]</option>";
		}
		else
		{
			echo "<option value='$row[0]'>$row[2]</option>";
		}
	}
	
	echo "</select>";

	echo '<input type="submit" name="retrive" value="Retrive" ></td>';
	echo '</form>';

	if(isset($_POST['retrive'])){
		if(isset($_POST['retrive'])){
			$_SESSION['retriver_list'] = $_POST['retrive'];
		}

		if(!empty($_POST['option_list'])){
			display(true,$_POST['option_list']);
		}
	}
		

//}

*/?>

<?php

$sub_que=mysql_query("Select * from mst_subject order by sub_name",$cn);
echo "<form action='delete.php' method='post'>";
echo "<p>Subject List:	<select name='sub_list'></p>";

	  while($row=mysql_fetch_array($sub_que))
	{
		if($row[0]==$subid)
		{
			echo "<option value='$row[0]' selected>$row[1]</option>";
		}
		else
		{
			echo "<option value='$row[0]'>$row[1]</option>";
		}
	}
echo "</select>";

echo '<input type="submit" class="btn btn-success" name="retrive_sub" value="Retrive Subject" >';
echo '</form>';

if(isset($_POST['retrive_sub'])){
$_SESSION['sub_list'] = '';
$quer = "Select * from mst_test where sub_id = ".$_POST['sub_list'];
$test_que=mysql_query($quer,$cn);
echo "<form action='delete.php' method='post'>";
echo "<p>Test List: <select name='test_list'></p>";
	  while($row=mysql_fetch_array($test_que))
	{
		if($row[0]==$subid)
		{
			echo "<option value='$row[0]' selected>$row[2]</option>";
		}
		else
		{
			echo "<option value='$row[0]'>$row[2]</option>";
		}
	}
echo "</select>";

echo '<input type="submit" class="btn btn-success" name="retrive_test" value="Retrive Test" >';
echo '</form>';
}
if(isset($_POST['retrive_test'])){
	
		$test_id = $_POST['test_list'];
echo '<form action = "delete.php" method = "post">';
	display(true,$test_id);
}

?>

<button type="submit" name="delete_que" class="btn btn-success">Submit</button>
</form>

</div>
</body>
</html>