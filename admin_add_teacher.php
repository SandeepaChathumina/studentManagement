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

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $dst = "./images/".$image;
        $dst_db = "images/".$image;

        // Check if image is uploaded
        move_uploaded_file($_FILES['image']['tmp_name'], $dst);
        
        // Insert into database
        $sql = "INSERT INTO teacher (name, description, image) VALUES ('$name', '$description', '$dst_db')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // If the query was successful, redirect to adminhome.php with a success message
            echo "<script>alert('Teacher added successfully');</script>";
            echo "<script>window.location.href='adminhome.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
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
        .div_deg{
            background-color:skyblue;
            width: 500px;
            padding-top: 70px;
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
        <h1>Add Teacher</h1>
        <br><br>

        <div class="div_deg">
            <form action="#" method="post" enctype="multipart/form-data">

            <div>
                <label>Teacher Name</label>
                <input type="text" name="name">
            </div>
            <br>

            <div>
                <label>Description</label>
                <textarea name="description"></textarea>
            </div>
            <br>

            <div>
                <label>Image</label>
                <input type="file" name="image">
            </div>
            <br>

            <div>
                <input type="submit" name="submit" value="Add Teacher" class="btn btn-primary">
            </div>

            </form>
        </div>

    </center>
        
        
    </div>
</body>
</html>