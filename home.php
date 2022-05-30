<?php
    session_start();

    if($_SESSION['userName'])
    {
        
    }else{
        header("location:index.php");
    }

    include("connection.php");	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="home_style.css">   
        <title>Home Page</title>
    </head>

    <body>
        <!-- Header  -->
        <header>
            <div class="header_left">
                <img src="images/cpe logo.png" alt="">
                <p id="website_name"><u>
                    <?php 
                        echo($_SESSION['userName']); 
                    ?>
                </u><br> Easy Inventory System
                </p>
            </div>
            <form class="header_right" method="get" action="logout.php">
                <button id="logout"> &#9474;&nbsp;<b>Logout</b></button>
            </form>  
        </header>
        <!-- Body -->
        <div class="content">
            
            <!-- Nav1: Home Content-->
            <div id="Home" class="tab_contents">
                <div class="summary">
                    <h3 class="h_categories">Summary</h3>
                    <p>
                        <?php
                            $query = "select * from records order by record_id desc";
                            $result = mysqli_query($con, $query);
                            $counter = 0;

                            while($user_data = mysqli_fetch_assoc($result))  {  
                                if(is_null($user_data['date_received']) || $user_data['date_received'] == '0000-00-00'){
                                    $counter = $counter + 1;
                                }
                                else{
                                    $counter = $counter + 0;  
                                }
                            }

                            if($counter == 0){
                                echo "All items are returned";
                            }else if($counter == 1){
                                echo "There is a student who did not return the item/s";
                            }else{
                                echo "There are ".$counter." students who did not return the item/s";
                            }
                        ?>
                    </p>  
                </div>
                
                <div class="inventory">
                    <div class="h_categories">
                        <div class="inventory_heading"><h3 class="categories">Inventory</h3></div>
                        <div class="inventory_addbutton"><button class="add_button" id="add_button"><a ></a>&#43;</button></div> 
                    </div>
                 
                    <table class="inventory_table">
                        <thead>
                            <tr>
                                <th>Record ID</th>
                                <th>Item Quantity</th>
                                <th>Item Name</th>
                                <th>Date Borrowed</th>
                                <th>Date Received</th>
                                <th>Section</th>
                                <th>Student's Name</th>
                                <th>Penalty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>   
                        <?php 
                            $query = "select * from records order by record_id desc";
                            $result = mysqli_query($con, $query);

                            while( $user_data = mysqli_fetch_assoc($result))  {  
                                echo "<tr>";
                                echo "<td>".$user_data['record_id']."</td>";
                                echo "<td>".$user_data['quantity']."</td>";
                                echo "<td>".$user_data['item_name']."</td>";
                                echo "<td>".$user_data['date_borrowed']."</td>";  
                                echo "<td>".$user_data['date_received']."</td>";
                                echo "<td>".$user_data['student_section']."</td>";
                                echo "<td>".$user_data['student_name']."</td>";
                                echo "<td>".$user_data['student_penalty']."</td>";
                                $id = $user_data['record_id'];
                        ?>
                                <td><a class="update_in_button" href="update.php?id=<?php echo $user_data["record_id"] ?>">Update</a></td>
                        <?php
                                echo "</tr>";  
                            }
                            
                        ?>
                        </tbody>
                    </table>
                </div>
                
            </div>        
        </div>

        <!-- Popup New Inventory -->
        <div class="overlay" id="popup_form">                
            <div class="new_inventory" id="new_inventory">
                <form action="add.php" method="POST">
                    <h3 class="popup_header">New Inventory</h3>
                    <div class="inputs_popup">
                        <div class="left">
                            <!-- Item Quantity -->
                            <label for="item_quantity"><b>Item Quantity:</b></label>
                            <label><input class="popup" id="item_quantity" type="number" name="item_quantity" required></label>
                            <br>
                            <!-- Item Name -->
                            <label for="item_name"><b>Item name:</b></label><br>                            
                            <!-- Sample borrowed lab items: -->
                            <select class="popup" name="item_name" id="item_name">
                                <option value="" disabled selected></option>
                                <option value="Keyboard">Keyboard</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Projector">Projector</option>
                                <option value="Extension Cord">Extension Cord</option>
                            </select>
                            <br>
                        </div>
                        <div class="right">
                            <!-- Section -->
                            <label for="section"><b>Section:</b></label><br>
                            <!-- CPE list of sections -->
                            <label><input class="popup" name="student_section" id="student_section"></label>
                            <br>
                            <!-- Student's Name -->
                            <label for="student_name"><b>Student's Name:</b></label>
                            <label><input class="popup" id="student_name" type="text" name="student_name" required></label>
                        </div>                                              
                    </div>
                    <div class="popup_buttons">
                        <button id="close" class="close"><b>Cancel</b></button>
                        <button id="add" type="submit"><b>Add</b></button>
                    </div> 
                </form>                     
            </div>             
        </div>

        <div class="overlay_2" id="update_container">                
            <div class="update_form">
                <h3 class="popup_header">Update</h3>
                        <div class="to_be_updated">
                            <!-- Penalty -->
                            <label for="penalty"><b>Penalty:</b></label><br>
                            <label><input class="popup" id="student_penalty" type="text" name="student_penalty"></label> <br>
                        </div>
                        <div class="update_form_buttons">
                            <button id="cancel" class="cancel"><b>Cancel</b></button>
                            <button id="update"><b>Update</b></button>
                        </div> 
            </div>
        </div>        
        
        <script>
            // for popup forms in adding a new inventory
            document.getElementById("add_button").addEventListener("click", function(){
                document.querySelector(".overlay").style.display = "flex";
            })

            document.querySelector(".close").addEventListener("click", function(){
                document.querySelector(".overlay").style.display = "none";
            })
        </script>

    </body>
</html>