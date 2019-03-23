<?php
session_start()
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administrative Login - Online Exam</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../quiz.css" rel="stylesheet" type="text/css">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include("../header2.php");
?>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <script  src="javascripts/admin.js"></script>
</head>
<body>


<p class="head1">Adminstrative Login </p>
<div class = "form-group">
<form name="form1" method="post" action="login.php">
<table width="490" border="0">
  <tr>
    <td width="106"><span class="style2"></span></td>
    <td width="132">
	<span class="style2"><span class="head1"><img src="login.jpg" width="131" height="155"></span></span></td>
    <td width="238"><table width="219" border="0" align="center">
  <tr>
    <td width="163" class="style2" >Username </td>
    <td width="149"><input name="loginid" type="text" class = "form-control" id="loginid" placeholder="Username"></td>
  </tr>
  <tr>
    <td class="style2">Password</td>
    <td><input name="pass" type="password" class ="form-control"id="pass" placeholder = "Password"></td>
  </tr>
  <tr>
    <td class="style2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="style2">&nbsp;</td>
    <td><input name="submit" type="submit" id="submit" value="Login" class="btn btn-success"></td>
  </tr>
</table></td>
  </tr>
</table>

</form>
</div>

</body>
</html>
