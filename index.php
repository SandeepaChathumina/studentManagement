<?php

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

$sql = "SELECT * FROM teacher";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
    <!--<h1>This is the first tutorial</h1>-->
    <nav>
        <label class="logo">Smart School</label>
        <ul>
            <li><a href="sample.php">Home</a></li>
            <li><a href="student.php">Contact</a></li>
            <li><a href="teacher.php">Admission</a></li>
            <li><a href="login.php" class="btn btn-success">Login</a></li>
    </nav>

    <div class="section1">
        <label class="image_text">We Teach Students With Care</label>
        <img class="main_img" src="images/school.png" alt="">
    </div>

    <div class="container">

        <div class="row">

            <div class="col-md-4">
                <img class="welcome_img" src="images/playground.jpg" alt="">
        

            </div>

            <div class="col-md-8">
                <h1>Welcome to Smart School</h1>

                <p>Welcome to Smart School - the intelligent way to manage your educational institution! Our comprehensive school management system empowers administrators, teachers, students, and parents with powerful tools for attendance tracking, grade management, communication, and resource planning, all through an intuitive digital platform designed to save time, reduce paperwork, and enhance the learning experience for everyone in your school community.</p>
        

            </div>
        

        </div>
        

    </div>

    <center>
        <h1>Our Teachers</h1>
    </center>

    <div class="container">

        <div class="row">

        <?php
        
        while($row = $result->fetch_assoc()) {
            
        
        ?>

            <div class="col-md-4">
                <img class="teacher" src="<?php echo "{$row['image']}" ?>">
                <h3><?php echo "{$row['name']}" ?></h3>
                <h5><?php echo "{$row['description']}" ?></h5>
                
            </div>

            

        <?php
            
        }
            
        ?>
        
        </div>

    </div>

    <center>
        <h1>Our Courses</h1>
    </center>

    <div class="container">

        <div class="row">

            <div class="col-md-4">
                <img class="teacher" src="images/web_development.png" alt="">
                <h3>Web Developer</h3>

            </div>

            <div class="col-md-4">
                <img class="teacher" src="images/graphic_design.png" alt="">
                <h3>Graphic Designer</h3>

            </div>

            <div class="col-md-4">
                <img class="teacher" src="images/digital_marketing.png" alt="">
                <h3>Marketing</h3>


            </div>
        
        </div>

    </div>

    <center>
        <h1 class="adm">Admission Form</h1>
    </center>

    <div align="center" class="admission_form">

    <form action="data_check.php" method="post">
        <div class="adm_int">
            <label class="label_text">Name</label>
            <input class="input_deg" type="text" name="name">
        </div>    

        <div class="adm_int">
            <label class="label_text">Email</label>
            <input class="input_deg" type="text" name="email">
        </div>    

        <div class="adm_int">
            <label class="label_text">Phone</label>
            <input class="input_deg" type="text" name="phone">
        </div>    

        <div class="adm_int">
            <label class="label_text">Message</label>
            <textarea class="input_txt" name="message"></textarea>
        </div>    

        <div>
            <input class="btn btn-primary" id="submit" name="apply" type="submit">
        </div>
    </form>

    </div>

    <footer>
        <h3 class="footer_text">All @copyright reserved by smartschool</h3>
    </footer>

    

</body>
</html>