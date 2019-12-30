<?php require_once("includes/database.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>
<?php $_SESSION["URL"]= $_SERVER["PHP_SELF"];
?>
<?php 
loginRequired();
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

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                      
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="posts.php">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admins.php">Admins</a>
                        </li>
        
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php?page=1">Blog</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-user"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
    </header>
    <main>
        <section class="main-header">
            <div class="container">
                 <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                        ?>
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="header-1">
                            Dashboard
                        </h1>
                
                        <div class="control-panel">
                            <h4 class="header-4">
                                Control Panel
                            </h4>
                            <div class="row mb-5">
                                <div class="col-md-4 mb-5">
                                    <a href="addpost.php" class="btn-reg d-block">
                                        <i class="fas fa-pen"></i> Create New Post
                                    </a>
                                </div>
                                <div class="col-md-4 mb-5">
                                    <a href="categories.php" class="btn-reg d-block">
                                        <i class="fas fa-edit"></i> Create New Category
                                    </a>
                                </div>
                                <div class="col-md-4 mb-5">
                                    <a href="admins.php" class="btn-reg  d-block">
                                        <i class="fas fa-user"></i> Create New Admin
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section>
          
            <div class="container py-2">
                <div class="row">
                       
                      
                        <div class="col-lg-4">
                           <div class="card card-dash text-center mb-2">
                               <div class="card-body text-white">
                                   <h1 class="header-2">
                                       Posts
                                   </h1>
                                   <h4 class="display-3">
                                       <i class="fas fa-pen">
                                           <?php 
                                           global $ConnectingDB;
                                           $sql = "SELECT COUNT(*) FROM posts";
                                           $Statement = $ConnectingDB->query($sql);
                                           // fetch return in array we want to convert it to strings
                                           $totalRecords = $Statement->fetch();
                                           $totalPosts =  array_shift($totalRecords);
                                           echo $totalPosts;
                                           
                                           ?>
                                       </i>
                                   </h4>
                               </div>
                           </div>
                       </div>
                        <div class="col-lg-4">
                           <div class="card card-dash  text-center mb-2">
                               <div class="card-body text-white">
                                   <h1 class="header-2">
                                       Categories
                                   </h1>
                                   <h4 class="display-3">
                                       <i class="fas fa-book">
                                            <?php 
                                           global $ConnectingDB;
                                           $sql = "SELECT COUNT(*) FROM category";
                                           $Statement = $ConnectingDB->query($sql);
                                           // fetch return in array we want to convert it to strings
                                           $totalRecords = $Statement->fetch();
                                           $totalCat =  array_shift($totalRecords);
                                           echo $totalCat;
                                           ?>
                                       </i>
                                   </h4>
                               </div>
                           </div>
                       </div>
                        <div class="col-lg-4">
                           <div class="card card-dash text-center mb-2">
                               <div class="card-body text-white">
                                   <h1 class="header-2">
                                       Admins
                                   </h1>
                                   <h4 class="display-3">
                                       <i class="fas fa-users">
                                          <?php 
                                           global $ConnectingDB;
                                           $sql = "SELECT COUNT(*) FROM admins";
                                           $Statement = $ConnectingDB->query($sql);
                                           // fetch return in array we want to convert it to strings
                                           $totalRecords = $Statement->fetch();
                                           $totalCat =  array_shift($totalRecords);
                                           echo $totalCat;
                                           ?>
                                       </i>
                                   </h4>
                               </div>
                           </div>
                       </div>
                    </div>
                    
                </div>
        </section>
    </main>

    <!-- Footer -->
   <div class="crights" style="background-color:#1E6C9F; position:absolute; bottom:0;width:100%; ">
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
