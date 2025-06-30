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

    if($_GET['teacher_id']){
        $id = $_GET['teacher_id'];
        $sql = "SELECT * FROM teacher WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();
    }
        

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $dst = "./images/".$image;
        $dst_db = "images/".$image;

        // Check if image is uploaded
        move_uploaded_file($_FILES['image']['tmp_name'], $dst);
        
        // Update into database
        if($image){
            $sql = "UPDATE teacher SET name='$name', description='$description', image='$dst_db' WHERE id='$id'";
        } else {
            // If no new image is uploaded, keep the old image
            $sql = "UPDATE teacher SET name='$name', description='$description' WHERE id='$id'";
        }
        
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // If the query was successful, redirect to adminhome.php with a success message
            echo "<script>alert('Teacher updated successfully');</script>";
            echo "<script>window.location.href='admin_view_teacher.php';</script>";
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
        label{
            display: inline-block;
            width: 150px;
            text-align: right;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .form_deg{
            background-color: skyblue;
            width: 600px;
            padding-top:70px;
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
            <form class="form_deg" action="#" method="post" enctype="multipart/form-data">

            <div>
                <label>Teacher Name</label>
                <input type="text" name="name" value="<?php echo "{$row['name']}" ?>">
            </div>
            <br>

            <div>
                <label>About Teacher</label>
                <textarea name="description" rows="4">
                    <?php echo "{$row['description']}" ?>
                </textarea>
            </div>
            <br>

            <div>
                <label>Old Image</label>
                <img width="100px" heigth="100px" src="<?php echo "{$row['image']}" ?>">
            </div>
            <br>

            <div>
                <label>New Image</label>
                <input type="file" name="image">
            </div>
            <br>

            <div>
                <input type="submit" name="submit" value="Update Teacher" class="btn btn-success">
            </div>

            </form>
        </div>

    </center>
        
    </div>
</body>
</html>