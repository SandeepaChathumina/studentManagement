<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "schoolproject";

// Create connection
$conn = mysqli_connect($host, $user, $password, $database); 

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 if(isset($_POST['apply'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
 }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO admission (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Admission form submitted successfully');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

?>