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

    // Fetch all teacher data
    $sql = "SELECT * FROM teacher";
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

    <style>
        .table_th{
            padding: 20px;
            font-size: 20px;
            
        }

        .table_td{
            padding: 20px;
            background-color: skyblue;
            
        }
    </style>
</head>
<body>
    
    <?php
    include 'admin_sidebar.php';
    ?>

    <div class="content">
        <center>
        <h1>View All Teacher Data</h1>

        <table border="1px">
            <tr>
                <th class="table_th">Teacher Name</th>
                <th class="table_th">About Teacher</th>
                <th class="table_th">Image</th>
            </tr>

            <?php

            while($row=$result->fetch_assoc()){
                ?>
                <tr>
                    <td class="table_td"><?php echo "{$row['name']}" ?></td>
                    <td class="table_td"><?php echo "{$row['description']}" ?></td>
                    <td class="table_td"><img src="<?php echo "{$row['image']}" ?>" style="width: 100px; height: 100px;"></td>
                </tr>
                <?php
            }
            
            
            ?>
            
        </table>
        </center>
        
    </div>
</body>
</html>