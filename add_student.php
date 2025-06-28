<?php

session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }

    elseif($_SESSION['usertype']=='student'){
        header("location:login.php");
    }

    $host="localhost";
    $username="root";       
    $password="";
    $database="schoolproject";

    // Create connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $usertype = "student";

        // Validate input
        $check_username = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
        if (mysqli_num_rows($check_username) > 0) {
            echo "<script>alert('Username already exists');</script>";
            exit;
        }

        else{

        // Prepare and execute the SQL query
        $sql = "INSERT INTO user (username, email, phone, usertype, password) VALUES ('$username', '$email', '$phone', '$usertype', '$password')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Student added successfully');</script>";
            echo "<script>window.location.href='adminhome.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
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
        <h1>Add Student</h1>

        <div class="div_deg">
            <form action="#" method="post">
                <div>
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div>
                    <label>Phone</label>
                    <input type="number" name="phone" required>
                </div>

                <div>
                    <label>Password</label>
                    <input type="text" name="password" required>
                </div>

                <div>
                    <input type="submit" name="submit" value="Add Student" class="btn btn-primary">
                </div>

            </form>
        </div>
        
    </center>    
    </div>
    
</body>
</html>