<?php 
	$errors = array('errors'=>'');

	session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$userName = $_POST['userName'];
		$password = $_POST['password'];

		if(!empty($userName) && !empty($password) && !is_numeric($userName))
		{

			//read from database
			$query = "select * from users where userName = '$userName' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['userName'] = $user_data['userName'];
						header("Location: home.php");
						die;
					}
				}
			}
			$errors['errors'] = "Wrong username or password!";
		}else
		{
			$errors['errors'] = "Wrong username or password!";
		}
	}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="index_style.css">  

        <title>Login page</title>
    </head>

    <body>
        <form method="POST">    
            <div class="container">
                <div class="left">
                    <img src="images/cpe logo.png" alt="PUP CPE Logo">
                </div>
                
                <div class="right">
                    <form>
                        <div id="login" class="r_login">
                            <h1>Log In</h1>
                        </div>         
                        <div class="inputs">
                            <label for="userName"><b>Username</b></label>
                            <label><input id="userName" type="text" name="userName" placeholder="Enter Username" required></label> <br>
                            <label for="password"><b>Password</b></label>
                            <label><input id="password" type="password" name="password" placeholder="Enter Password" required></label> <br>
							<label name="errors"class="red">
								<div>
									<?php 
										echo $errors['errors']; 
									?>
								</div>
							</label>
                        </div>
                        <br><br>
                        <div class="button">
                            <button type="submit" id="log_in">Login</button>
                        </div>
                        <div class="no_account">
                            <span>Don't have an account yet? <a href="signup.php">Sign up here</a></span>
                        </div>      
                    </form> 
                </div>
            </div>
          </form>
    </body>
</html>