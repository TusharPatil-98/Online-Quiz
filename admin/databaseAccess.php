<?php
	function dataBase($databaseName,$username,$conn) {
		//if(@mysql_select_db($databaseName))
		//	{
				

				$_query="select * from login where username = '" . $username."'";
				//$_result = mysql_query($_query);
				//$_qexe = mysqli_fetch_array($_result);
				$_result = mysqli_query($conn,$_query);
				$_qexe = mysqli_fetch_assoc($_result);
			
		 		return $_qexe;	
				
		//}
		//else{
		//	echo $databaseName;
		//	echo 'DataBase not connected';
		//	return null;
		//}

	}

	
	function display($delete,$test_id)
	{	
		$count = 1;
		
		$cn=mysql_connect("localhost","root","") or die("Could not Connect My Sql");
	mysql_select_db("quiz_new",$cn)  or die("Could connect to Database");
	
		$isqr = mysql_query("select * from mst_question where test_id = '$test_id'",$cn);
		//$res = mysql_fetch_array($rq);
			//$_query="select * from questionanswer";
				
				if($delete)
					$giveSpace = '<th></th>';
				else
					$giveSpace = '';
				echo '<table class="table">';
				echo '<tr>'.$giveSpace.'<th>Sr no</th><th>Question</th><th>Option 1</th><th>Option 2</th><th>Option 3</th><th>Option 4</th><th>Answer</th></tr>';
				while ($qexe=mysql_fetch_assoc($isqr)) {
				$checkBox = '<tr ><td><input type = "checkbox" name = "check_list[]" value = "'.$qexe["que_id"].'"/></td>';
			
					if($delete)
						echo $checkBox;
					echo '<td>'.$count.'</td><td>'.$qexe["que_desc"].'</td><td>'.$qexe["ans1"].'</td><td>'.$qexe["ans2"].'</td><td>'.$qexe["ans3"].'</td><td>'.$qexe["ans4"].'</td><td>'.$qexe["true_ans"].'</td></tr>';
					$count++;

					# code...
				}
				echo "</table>";
			
			

	}
	function createQuestion($conn,$question,$op1,$op2,$op3,$op4,$ans) {
		
		//if(@mysql_select_db($data))
		//{
			$query='insert into questionanswer (questions,option1,option2,option3,option4,answer) values ("'.$question.'","'.$op1.'","'.$op2.'","'.$op3.'","'.$op4.'","'.$ans.'")';
			mysqli_query($conn,$query);
		//}

	}
	
		function deleteQuestion($question) {
			
			$con = new mysqli("localhost","root","","quiz_new");
			
			if($con) {
			
			//$res = mysql_query('select * from mst_question where que_id = "'.$question.'"',$cn);
			// $row=mysql_fetch_array($res);
			//echo  "insert into backup (que_id, test_id, que_desc, ans1, ans2, ans3, ans4, true_ans) values (".$row['que_id'].",".$row['test_id'].",'".$row['que_desc']."','".$row['ans1']."','".$row['ans2']."','".$row['ans3']."','".$row['ans4']."','".$row['true_ans']."')";
			//mysql_query("insert into backup values (".$row['que_id'].",".$row['test_id'].",'".$row['que_desc']."','".$row['ans1']."','".$row['ans2']."','".$row['ans3']."','".$row['ans4']."','".$row['true_ans']."')",$cn);

			//$query='DELETE FROM questionanswer WHERE questions =  "'. $question .'"';
			//mysql_query('DELETE FROM mst_question WHERE que_id =  "'. $question .'"',$cn);

			$sql = "CALL deleteQuestion('$question');";
			$con -> query($sql);
			}
			else{
				die("Couldnot connect to Database...");
			}
	}

?>