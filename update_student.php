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

    $id  = $_GET['student_id'];
    $sql = "SELECT * FROM user WHERE id='$id' AND usertype='student'";
    $result = mysqli_query($conn, $sql);

    $row = $result->fetch_assoc();


    if(isset($_POST['update'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // Validate input
        $check_username = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND id != '$id'");
        if (mysqli_num_rows($check_username) > 0) {
            echo "<script>alert('Username already exists');</script>";
            exit;
        }   

        // Prepare and execute the SQL query
        $sql = "UPDATE user SET username='$username', email='$email', phone='$phone', password='$password' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Student updated successfully');</script>";
            echo "<script>window.location.href='view_student.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
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
        label{
            display:inline-block;
            width: 100px;
            text-align:right;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg{
            background-color: skyblue;
            padding-top: 70px;
            width: 400px;
            padding-bottom: 70px;
        }
    </style>

</head>
<body>
    
    <?php
    include 'admin_sidebar.php';
    ?>

    <div class="content">
        <center>
        <h1>Update Student</h1>

        <div class="div_deg">
            <form action="#" method="post">
                <div>
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo "{$row['username']}"?>" required>
                </div>
                <div>
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo "{$row['email']}"?>" required>
                </div>
                <div>
                    <label>Phone</label>
                    <input type="number" name="phone" value="<?php echo "{$row['phone']}"?>" required>
                </div>
                <div>
                    <label>Password</label>
                    <input type="text" name="password" value="<?php echo "{$row['password']}"?>" required>
                </div>
                <div>
                    <input class="btn btn-success" type="submit" name="update" value="Update" required>
                </div>
            </form>
        </div>
    </center>
        
    </div>
</body>
</html>