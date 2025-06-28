<?php

session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }

    elseif($_SESSION['usertype']=='student'){
        header("location:login.php");
    }

    $host = "localhost";
    $username = "root";     
    $password = "";
    $database = "schoolproject";

    // Create connection
    $conn = mysqli_connect($host, $username, $password, $database); 

    // Check connection 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM admission";
    $result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <?php
    include 'admin_css.php';
    ?>

</head>
<body>

    <?php
    include 'admin_sidebar.php';
    ?>

    <div class="content">

    <center>
        <h1>Applied For Admission</h1>
    
        <br><br>

        <table border="1px">
            <tr>
                <th style="padding:20px; font-size:15px">Name</th>
                <th style="padding:20px; font-size:15px">Email</th>
                <th style="padding:20px; font-size:15px">Phone</th>
                <th style="padding:20px; font-size:15px">Message</th>
            </tr>

            <?php
            while($row=$result->fetch_assoc()) {
                echo "<tr>
                        <td style='padding:20px'>{$row['name']}</td>
                        <td style='padding:20px'>{$row['email']}</td>
                        <td style='padding:20px'>{$row['phone']}</td>
                        <td style='padding:20px'>{$row['message']}</td>
                      </tr>";
            }
            ?>

        
        </table>
    
    </center>    
        
    </div>
</body>
</html>