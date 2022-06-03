<?php

include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile1'])){

   $update_firstname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
   $update_lastname = mysqli_real_escape_string($conn, $_POST['update_lastname']);
   $update_username = mysqli_real_escape_string($conn, $_POST['update_username']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
   $update_contact = mysqli_real_escape_string($conn, $_POST['update_contact']);
  

   mysqli_query($conn, "UPDATE `users` SET firstname = '$update_firstname', lastname = '$update_lastname' , username = '$update_username', email = '$update_email', contact = '$update_contact' WHERE id = '$user_id'") or die('query failed');

   $old_password = $_POST['old_password'];
   $update_password = mysqli_real_escape_string($conn, md5($_POST['update_password']));
   $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));
   

   if(!empty($update_password) || !empty($new_password)){
      if($update_password != $old_password){
         $message[] = 'Old password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `users` SET password = '$new_password' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'Password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `users` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'Image updated succssfully!';
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
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="adminhome.php">
                    <img src="materials/logo2.png" width="60" height="35" alt="logo">
                  BENEDICTS</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="home.php">Home</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="admin.php">Maintenance</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <header>
        <div class="update-profile">

        <?php
        $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
        <?php
            if($fetch['image'] == ''){
                echo '<img src="images/default-avatar.png">';
            }else{
                echo '<img src="uploaded_img/'.$fetch['image'].'">';
            }
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                }
            }
        ?>
        <div class="flex">
            <div class="inputBox">
                <span>Firstname :</span>
                <input type="text" name="update_firstname" value="<?php echo $fetch['firstname']; ?>" class="box">
                <span>Lastname :</span>
                <input type="text" name="update_lastname" value="<?php echo $fetch['lastname']; ?>" class="box">
                <span>Username :</span>
                <input type="text" name="update_username" value="<?php echo $fetch['username']; ?>" class="box">
                <span>Email:</span>
                <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
                <span>Contact :</span>
                <input type="text" name="update_contact" value="<?php echo $fetch['contact']; ?>" class="box">
               
                <span>Update your pic :</span>
                
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
                <input type="hidden" name="old_password" value="<?php echo $fetch['password']; ?>">
                <span>Old password :</span>
                <input type="password" name="update_password" placeholder="enter previous password" class="box">
                <span>New password :</span>
                <input type="password" name="new_password" placeholder="enter new password" class="box">
               
            </div>
        </div>
        <input type="submit" value="Update profile" name="update_profile1" class="btnup">
        <a href="adminhome.php" class="delete-btn">Cancel</a>
        </form>

        </div>

        </header>

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
