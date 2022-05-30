<?php
	$errors = array('errors'=>'');

	session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$cPassword = $_POST['confirm_password'];
		$_SESSION['userName'] = $_POST['userName'];
		

		if(!empty($firstName) && !empty($lastName) && !empty($userName) && !empty($password) && !is_numeric($userName) && !empty($cPassword))
		{
			$query = mysqli_query($con, "SELECT * FROM users where userName = '$userName' ");
			if(mysqli_num_rows($query) > 0)
			{
				$errors['errors'] = "username already exist";
			}else{
				if($password==$cPassword)
				{
				//save to database
				$user_id = random_num(20);
				$query = "insert into users (user_id, firstName, lastName, userName, password) 
				values ('$user_id','$firstName', '$lastName','$userName','$password')";
				$insert = "insert into record (userName) values ('$userName')";
				mysqli_query($con, $query);
				
				header("Location: home.php");
				die;
				}else
				{
					$errors['errors'] = "Password don't match";
				}
			}
		}else
		{
			$errors['errors'] = "User Name should be alphanumerical";
		}
	}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="signup_style.css">  

        <title>Signup Page</title>
    </head>

    <body>
        <form method="POST">    
            <div class="container">
                <div class="left">
                    <form method="POST">
                        <div id="signup" class="r_signup">
                            <h1>Sign Up</h1>
							
                        </div>
                        <div class="userInfo">
                            <label><input id="firstName" type="text" name="firstName" placeholder="FirstName" required></label> <br>
                            <label><input id="lastName" type="text" name="lastName" placeholder="LastName" required></label> <br>
                            <label><input id="userName" type="text" name="userName" placeholder="UserName" required></label> <br>
                            <label><input id="password" type="password" name="password" placeholder="Password" required></label> <br>
                            <label><input id="confirm_password" type="password" name="confirm_password" placeholder="ConfirmPassword" required></label> <br>
							<label name="errors"class="red">
								<div>
									<?php 
										echo $errors['errors']; 
									?>
								</div>
							</label>
                        </div>
                        <div class="button">
                            <button type="submit" id="sign_up">Sign Up</button>
                        </div>
                        <div id="has_account" class="r_has_account">
                            <span>Have an account already? <a href="index.php">Login here</a></span>
                        </div>   
                    </form>        
                </div>
                
                <div class="right">
                    <img src="images/cpe logo.png" alt="PUP CPE Logo">
                </div>
            </div>
          </form>
    </body>
</html>