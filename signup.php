<?php

include 'connection.php';

if(isset($_POST['submit'])){

   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $contact = mysqli_real_escape_string($conn, $_POST['contact']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE username = '$username' AND password = '$password'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'User already exist'; 
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `users`(firstname,lastname,username, password, email, contact, image) VALUES('$firstname','$lastname','$username','$password','$email',$contact, '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'Registeration failed!';
         }
      }
   }

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
    </head> <!--Jquery-->
    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

   
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="landing.php">
                    <img src="materials/logo2.png" width="60" height="35" alt="logo">
                  BENEDICTS</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                   
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="landing.php">Home</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#about">About</a></li>
                      
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!--Signup-->
        <header>
            <section class="bg">
          <div class="container">
              <div class="row d-flex justify-content-center">
                  <div class="col-md-4">
                      <div class="form-wrap">
                          <div class="form-heading">
                              <h1>Create new account</h1>
                              <p>Enter your Personal Data</p>
                          </div>
                          <form method= "post" action="" name="regForm" enctype="multipart/form-data" id="regForm">
                          <?php
                                if(isset($message)){
                                    foreach($message as $message){
                                        echo '<div class="message">'.$message.'</div>';
                                    }
                                }
                            ?>
                            <div class="form-group">
                                <label>First Name: </label>
                                <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter your Name">
                                <p id="p1"></p>
                            </div>
                            <div class="form-group">
                                <label>Last Name: </label>
                                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter your Name">
                                <p id="p2"></p>
                            </div>
                            <div class="form-group">
                                  <label>Username: </label>
                                  <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                                  <p id="p3"></p>
                              </div>
                              <div class="form-group">
                                  <label>Password: </label>
                                  <input type="password" name="password"class="form-control" id="password" placeholder="Password">
                                  <p id="p4"></p>
                              </div>
                            <div class="form-group">
                                <label>Email: </label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email Address">
                                <p id="p5"></p>
                            </div>

                              <div class="form-group">
                                <label>Contact: </label>
                                <input type="text" name="contact"class="form-control" id="contact"  placeholder="Phone Number">
                                <p id="p6"></p>
                            </div>

                            <div class="form-group">
                                <label>Upload profile: </label>
                                <input type="file" name="image"class="box" id="image"  accept ="image/jpg,image/jpeg,image/png">
                                <p id="p6"></p>
                            </div>
                        
                              <div class="form-group">
                          
                                  <input type="submit" name="submit" value="Sign up" class="btn btn3 btn-primary btn-block" id="submit">
                                  
                              </div>
                              <div class="signup_link">
                                Already have an account? <a href="login.php">Login</a>
                              </div>
                              
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>
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
                    <!-- <div class="col-lg-4">
                        
                    </div> -->
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; BENEDICTS AUTO REPAIR SHOP</small></div>
        </div>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">

        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        

    </body>
</html>
