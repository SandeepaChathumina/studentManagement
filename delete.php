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

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Prepare and execute the SQL query
    $sql = "DELETE FROM user WHERE id='$student_id' AND usertype='student'";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Student deleted successfully');</script>";
        echo "<script>window.location.href='view_student.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('No student ID provided');</script>";
}

?>