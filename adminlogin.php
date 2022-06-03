<?php

session_start();
include 'connection.php';


if(isset($_POST['submit'])){


   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
  
   $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE username = '$username' AND password = '$password'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header('location:admin.php');
   }else{
      $message[] = 'Incorrect Username or Password';
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
    </head>
    <!--Jquery-->
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
                       
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!--Login-->
        <header>
            <section class="bg">
          <div class="container">
              <div class="row d-flex justify-content-center">
                  <div class="col-md-4">
                      <div class="form-wrap">
                          <div class="form-heading">
                              <h1>Admin Login</h1>
                              <p>Enter your Administrator Account</p>
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
                          
                                  <input type="submit" name="submit" class="btn btn3 btn-light btn-block" id="submit">
                                  
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      </header>
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
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"> </script>

        

    </body>
</html>
