<?php

session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }

    elseif($_SESSION['usertype']=='admin'){
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

$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $sql); 

$row = mysqli_fetch_assoc($result);
    

if(isset($_POST['update'])){
    
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $update_sql = "UPDATE user SET email='$email', phone='$phone', password='$password' WHERE username='$username'";
    $result2 = mysqli_query($conn, $update_sql);
    if ($result2) {
        echo "<script>alert('Profile updated successfully');</script>";
        echo "<script>window.location.href='student_profile.php';</script>";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
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
    include 'student_css.php';
    ?>

    <style>
        label{
            display: inline-block;
            width: 100px;
            text-align: right;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg{
            background-color: skyblue;
            width: 500px;
            padding-top:70px;
            padding-bottom: 70px;
        }
    </style>

</head>
<body>
    
    <?php
        include 'student_sidebar.php';
    ?>

    <div class="content">

    <center>

    <h1>Update Profile</h1>
        <br><br>
    
    <form action="#" method="post">

    <div class="div_deg">

        

        <div>
            <label >Email</label>
            <input type="email" name="email" value="<?php echo "{$row['email']}" ?>" >
        </div>

        <div>
            <label>Phone</label>
            <input type="number" name="phone" value="<?php echo "{$row['phone']}" ?>" >
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" value="<?php echo "{$row['password']}" ?>" >
        </div>

        <div>
            <input type="submit" name="update" value="Update" class="btn btn-primary">
        </div>

    </div>    

    </form>
    </center>

        
    </div>
</body>
</html>