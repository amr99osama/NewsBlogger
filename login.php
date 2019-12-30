<?php require_once("includes/database.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>
<?php
if(isset($_SESSION["username"]))
{
    Redirect_to("dashboard.php");
}
?>
<?php 
if(isset ($_POST["submit"]))
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    if(empty($username) || empty($password))
    {
        $_SESSION["ErrorMessage"]= "All Fields Must be filled out"; 
          $_SESSION["Redirect"]= "login.php"; 
        Redirect_to($_SESSION["Redirect"]);
    }
    else 
    {   
        $found = loginChecked($username,$password);
        if($found)
        {
            $_SESSION["userid"] = $found["id"];
            $_SESSION["username"] = $found["username"]; 
            $_SESSION["password"] = $found["password"];
            $_SESSION["AdminFullName"] = $found["aname"]; 

            $_SESSION["SuccessMessage"]= "Welcome ".  $_SESSION["AdminFullName"] ."!";
            if(isset($_SESSION["URL"]))
            {
                Redirect_to($_SESSION["URL"]);
            }
            else 
            {
            $_SESSION["Redirect"]= "dashboard.php"; 
        Redirect_to($_SESSION["Redirect"]);
        }
        }
        else 
        {
             $_SESSION["ErrorMessage"]= "Incorrect Username or Password !";
            $_SESSION["Redirect"]= "login.php"; 
        Redirect_to($_SESSION["Redirect"]);
        }    
    }
    
}
?>

<!DOCTYPE HTML>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
    <meta name="title" content="Project">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Project</title>
	</head>
	<body>
   <div class="preloader">
        <div class="inner-preloader">
            <img src="assets/preloader.gif">
        </div>
    </div>
	  <!-- Navbar -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light">
           <div class="container">
                <a class="navbar-brand" href="#">
                NewsBlogger
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
           </div>

        </nav>
    </header>
    <main>
        <section class="main-header">
           <div class="container">
               <div class="row">
                   <div class="col-md-12">
                        <h1 class="header-1 text-center">
               Welcome To NewsBlogger
            </h1>
                   </div>
               </div>
           </div>
        </section>
        <div class="section">
           <div class="container">
              <div class="row">
                  <div class="col-md-6 offset-3">
                        <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                        ?>
                       <form method="post" action="login.php">
                            <div class="card card-login">
                                <div class="card-header text-center">
                                    Sign in
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-5">
                                        <label for="catTitle">Username</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                     <input type="text" name="username" class="form-control">
                                        </div>
                                    </div>
                                     <div class="form-group mb-5">
                                        <label for="catTitle">Password</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                     <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 button-actions ">
                                            <button type="submit" class="btn-reg w-100" name="submit">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                
                                </div>
                            </div>
                        </form>
                  </div>
              </div> 
           </div>
           
        </div>
    </main>

    <!-- Footer -->
    <div class="crights" style="background-color:#1E6C9F; position:absolute; bottom:0;width:100%;
 ">
         <div class="container">
             <div class="row justify-content-center align-items-center text-center" style="margin:0; padding:0;">
                  <p class="text pl-2 " style="color:#fff; font-weight:bold; margin: 4px;">
All Copyrights Reserved &copy; 2019 Team
                    </p>
          </div>
         </div>
      </div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
	</body>
</html> 