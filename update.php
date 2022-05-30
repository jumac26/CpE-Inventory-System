<?php
    session_start();
    include("connection.php");

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $Penalty = $_POST['penalty'];

        $query = "UPDATE records SET student_penalty ='$Penalty' ,date_received = NOW() WHERE record_id = $id";
        mysqli_query($con, $query);

        header("location:home.php");
    }
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
	{

		$id = $_GET['id'];
		$result = mysqli_query($con,"SELECT * FROM records WHERE record_id=".$_GET['id']);

		$row = mysqli_fetch_array($result);

	if($row)
	{
		$id = $row['record_id'];
		$dateReceived = $row['date_received'];
	}
	else
	{
		header("location:home.php");
	}
	}

    if (isset($_POST['cancel'])){
        header("location:home.php");
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Penalty</title>
        <link rel="stylesheet" type="text/css" href="update_style.css"> 
    </head>
    <body>
    <div class="update_container">
            <h3>Update</h3>
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <label for="penalty"><b>Penalty:</b></label>
                <select class="popup" name="penalty" id="student_penalty">
                    <!-- Level of penalty -->
                    <option value="" disabled selected></option>
                    <option value="None">None</option>
                    <option value="Major">Major</option>
                    <option value="Minor">Minor</option>                             
                </select>
                <div>
                <input class="cancel" type="submit" name="cancel" value="Cancel" action="home.php">
                <input class="update" type="submit" name="submit" value="Update">
                </div>
            </form>
        </div>
    </body>
</html>