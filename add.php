<?php
    session_start();

    if($_SESSION['userName'])
    {
        
    }else{
        header("location:index.php");
    }

    include("connection.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$itemQuantity = $_POST['item_quantity'];
		$itemName = $_POST['item_name'];
		$studentSection = $_POST['student_section'];
		$studentName = $_POST['student_name'];  

        if(!empty($itemQuantity) && !empty($itemName) && !empty($studentName) && !empty($studentSection))
		{
			$query = "insert into records (quantity, item_name, student_section, student_name, date_borrowed) 
            values ('$itemQuantity','$itemName', '$studentSection', '$studentName', NOW())";

			mysqli_query($con, $query);

			header("Location: home.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
		
    }
		
?>