<?php

session_start();
error_reporting(0);

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

    if($_GET['teacher_id']){
        $id = $_GET['teacher_id'];

        $sql_delete = "DELETE FROM teacher WHERE id='$id'";
        $result_delete = mysqli_query($conn, $sql_delete);

        if ($result_delete) {
            echo "<script>alert('Teacher deleted successfully');</script>";
            echo "<script>window.location.href='admin_view_teacher.php';</script>";
        } else {
            echo "Error deleting teacher: " . mysqli_error($conn);
        }
    }


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
                <th class="table_th">Delete</th>
                <th class="table_th">Update</th>
            </tr>

            <?php

            while($row=$result->fetch_assoc()){
                ?>
                <tr>
                    <td class="table_td"><?php echo "{$row['name']}" ?></td>
                    <td class="table_td"><?php echo "{$row['description']}" ?></td>
                    <td class="table_td"><img src="<?php echo "{$row['image']}" ?>" style="width: 100px; height: 100px;"></td>
                    <td class="table_td">
                    <?php
                    echo "<a onClick=\"javaxcript:return confirm('Are you sure to Delete this');\"href='admin_view_teacher.php?teacher_id={$row['id']}' class='btn btn-danger'>Delete</a>"
                    ?>
                    </td>
                    <td class="table_td">
                    <?php
                    echo "<a href='admin_update_teacher.php?teacher_id={$row['id']}'class='btn btn-primary'>Update</a>"
                    ?>
                    </td>
                </tr>
                <?php
            }
            
            
            ?>
            
        </table>
        </center>
        
    </div>
</body>
</html>