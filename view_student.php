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
    if (!$conn){
        die("Connection failed:".mysqli_connect_error());
    }

    $sql = "select * from user where usertype='student'";
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
            font-size: 15px;
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
        <h1>All Students</h1>

        <br><br>

        <table border="1px">
            <tr>
                <th class="table_th">Username</th>
                <th class="table_th">Email</th>
                <th class="table_th">Phone</th>
                <th class="table_th">Password</th>
                <th class="table_th">Delete</th>
                <th class="table_th">Update</th>
                
            </tr>

            <?php
            
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td class='table_td'>{$row['username']}</td>
                        <td class='table_td'>{$row['email']}</td>
                        <td class='table_td'>{$row['phone']}</td>
                        <td class='table_td'>{$row['password']}</td>
                        <td class='table_td'><a class='btn btn-danger'onClick=\"javascript:return confirm('Are you sure to delete this')\" href='delete.php?student_id={$row['id']}'>Delete</a></td>
                        <td class='table_td'><a class='btn btn-primary'href='update_student.php?student_id={$row['id']}'>Update</a></td>
                      </tr>";
            }
            
            ?>

        </table>
        </center>
        
    </div>
</body>
</html>