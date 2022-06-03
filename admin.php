<?php

include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:home.php');
};

if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:landing.php');
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>BENEDICTS AUTO REPAIR SHOP</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="materials/logo.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- CSS -->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="home.php">
                    <img src="materials/logo2.png" width="60" height="35" alt="logo">
                BENEDICTS</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="adminhome.php">Home</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="admin.php">User Maintenance</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="home.php">User Panel</a></li>
            <!--        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="services.php">File Maintenance</a></li>   -->
                        
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Users Table Section-->
        <header>
        
            <div class="container1 mb-0">
                
                    <div class="col-lg-12">
                        <table class="table table-bordered"> 
                            <thead> 
                                <tr> 
                                    <th>Id</th>
                                    <th>Firstname</th> 
                                    <th>Lastname</th>
                                    <th>Username</th>
                                    <th>Password</th> 
                                    <th>Email</th> 
                                    <th>Contact</th> 
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr> 
                            </thead> 
                            <tbody> 
                                <?php 
                                $res=mysqli_query($conn,"select * from users"); 
                                while($row=mysqli_fetch_array($res)) 
                                { 
                                echo "<tr>"; 
                                echo "<td>"; echo $row["id"]; echo "</td>"; 
                                echo "<td>"; echo $row["firstname"]; echo "</td>"; 
                                echo "<td>"; echo $row["lastname"]; echo "</td>";
                                echo "<td>"; echo $row["username"]; echo "</td>";
                                echo "<td>"; echo $row["password"]; echo "</td>"; 
                                echo "<td>"; echo $row["email"]; echo "</td>"; 
                                echo "<td>"; echo $row["contact"]; echo "</td>";
                                echo "<td>"; ?> <a href="edit.php?id=<?php echo $row["id"]; ?>" <button type="button"  class="btn-success">Edit</button></a> <?php echo "</td>"; 
                                echo "<td>"; ?> <a href="delete.php?id=<?php echo $row["id"]; ?>" <button type="button" class="btn-danger">Delete</button></a> <?php echo "</td>";
                                echo "</tr>"; 
                                } 
                                ?> 
                            </tbody> 
                        </table>
                    </div>
                
            </div>
        </header>



        <!-- About Section-->
        <section class="page-section bg-primary text-white mb-0" id="about">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">About</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div class="col-lg-4 ms-auto"><p class="lead"> The <strong> Benedicts Auto Repair Shop </strong> is a car under chassis repair shop that serves replace and maintain the good condition of the cars. The company has a wheel alignment for free checkup, and on call service for the car owners that have emergency.Operation hours are 7:00am to 5:00pm (Monday-Sunday), except holidays.</p></div>
                    <div class="col-lg-4 me-auto">The company<strong> MISSION </strong>  is “To provide quality service at affordable price. To invent and improve devices that can be used for motor repair and maintenance. To cooperate with the government and the private sector in environment-friendly projects within the line of motor service.” <b> The <strong>VISION</strong> is “To be one of the top Philippine companies in the field of motor service. To export Filipino inventions those are practical, innovative and reasonably priced for all motorists.”</b><p class="lead"></p></div>
                    
                </div>
            </div>
        </section>
        
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Location</h4>
                        <p class="lead mb-0">
                            N. Ponce, Aurora , Dona Aurora
                            <br />
                            1113 Quezon City , Metro Manila
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Around the Web</h4>
                        <a class="btn btn-outline-light btn-social mx-1" target="_blank" href="https://www.facebook.com/Benedicts31/"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" target="_blank" href="https://www.google.com.ph/maps/place/Benedict's+Auto+Repair+Shop/@14.6182991,121.0067599,17z/data=!3m1!4b1!4m5!3m4!1s0x3397b61795d40057:0x4aea313f12b2eb0c!8m2!3d14.6182879!4d121.0089487"><i class="fas fa-map-marker-alt"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        
                    </div> 
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">

        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        <!-- Core theme JS-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

        

    </body>

    <?php
if(isset($_POST["insert"]))
{
    mysqli_query($link,"insert into table1 values(NULL,'$_POST[firstname]','$_POST[lastname]','$_POST[email]','$_POST[contact]')");
}

if(isset($_POST["delete"]))
{
    mysqli_query($link, "delete from table1 where firstname='$_POST[firstname]'") or die(mysqli_error($link));
}

if(isset($_POST["update"]))
{
    mysqli_query($link, "update table1 set firstname='$_POST[lastname]' where firstname='$_POST[firstname]'") or die(mysqlii_error($link));
        ?>
            <script type="text/javascript">
            window.location.href=window.location.href;
            </script>
        <?php
}

?>
</html>