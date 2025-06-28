<?php

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

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM user WHERE username='".$username."' AND password='".$password."'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);

    if($row["usertype"]=="student"){
        $_SESSION['username']=$username;
        $_SESSION['usertype']="student";
        header("Location: studenthome.php");
    }

    elseif($row["usertype"]=="admin"){
        $_SESSION['username']=$username;
        $_SESSION['usertype']="admin";
        header("Location: adminhome.php");
    }

    else{
        echo "<script>alert('Invalid username or password');</script>";
        echo "<script>window.location.href='login.php';</script>";
    }
}
?>