<?php require_once("includes/database.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>

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
                            <a class="nav-link" href="blog.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.php">About Us</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control -x mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" name="searchingButton">Search</button>
                        </form>
                    </ul>
                </div>
            </div>

        </nav>
    </header>
    <main>
       <div class="intro">
           <div class="container">
               <div class="row">
                   <div class="col-md-12">
                       <div class="banner-2">
                           <div class="overlay-2">
                                  <div class="d-flex">
                 <h2 class="header-2">
                     All Blogs Now will be with you
                 </h2>
                 <p class="text">
                 Check Out our Latest Blogs
                 </p>

             </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
        <section class="main-blog">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <h2 class="header-2">
                            Newsfeeds
                        </h2>
                        <?php
                        echo ErrorMessage();
                         echo SuccessMessage();
                        ?>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12" >

                                    <?php 
                        global $ConnectingDB;
                        if(isset($_GET["searchingButton"]))
                        {
                            $search = $_GET["search"];
                            $sql="SELECT * FROM posts WHERE 
                            datetime LIKE :search or title LIKE :search or category LIKE :search or author LIKE :search
                            ";
                         $statement= $ConnectingDB->prepare($sql);
                            $statement->bindValue(':search','%'.$search.'%');
                            $statement->execute();

                        }
                                else
                                {
                                $sql = "SELECT * from posts ORDER BY id DESC";
                               $statement= $ConnectingDB->query($sql);
                                }
                           while($datarows = $statement->fetch())
                           {
                                $ID = $datarows["id"];
                                    $datetime= $datarows["datetime"];
                                    $postTitle = $datarows["title"];
                                    $category = $datarows["category"];
                                     $admin = $datarows["author"];
                                       $image = $datarows["image"];
                                     $postDesc = $datarows["post"];
                           
                           ?>

                                    <div class="card mb-5 mx-auto" style="width: auto;" >
                                        <img class="card-img-top img-fluid" src="assets/<?php echo $image ?>" alt="Card image cap">
                                        <div class="card-body">
                                            <h3 class="card-title" style="font-weight:bold"><?php echo $postTitle ?></h3>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Written By <?php echo $admin;?> in <?php echo $datetime?></small>
                                                <a class="btn btn-dark" href="">
                                                    <i class="far fa-comments"></i>
                                                    20 Comments</a>
                                            </div>
                                            <hr>
                                            <p class="card-text"><?php 
                                      if(strlen($postDesc)> 100)
                                    {
                                        $postDesc = substr($postDesc,0,50)."..";
                                    }
                                    echo $postDesc ?>

                                            </p>
                                            <hr>
                                            <a href="fullpost.php?id=<?php echo $ID  ?>" class="btn-reg" style="float:right">Read More</a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4 ad-section">
                      
                        <div class="card card-category bg-white">
                           <div class="card-header">
                           <h4>
                               Our Categories
                           </h4>
                           </div>
                           <div class="card-body">
                               <div class="list-group">
                               <?php 
                                global $ConnectingDB;
                                $sql = "SELECT * FROM category ORDER BY id DESC";
                                $statement= $ConnectingDB->query($sql);
                                   while ($datarows= $statement->fetch())
                                   {
                                       $categoryid = $datarows["id"];
                                       $categoryName = $datarows["title"];
                                ?>
  <li class="list-group-item list-group-item-action">
  <?php echo $categoryName ;?>
  <?php } ?>
                                   </li>
</div>
                           </div>
                            </div>
                              <div class="card" style="background-color:#1E6C9F">
                            <h5 class="header-5">
                                Ads
                            </h5>
                            <div class="img-wrapper">
                                <img src="assets/ad-1.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="img-wrapper">
                                <img src="assets/ad-2.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="img-wrapper">
                                <img src="assets/ad-3.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="img-wrapper">
                                <img src="assets/ad-4.jpg" alt="" class="img-fluid">
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <div class="crights" style="background-color:#1E6C9F; ">
        <div class="container">
            <div class="row justify-content-center align-items-center text-center" style="margin:0; padding:0;">
                <p class="text pl-2 " style="color:#fff; font-weight:bold; margin: 4px;">
                    All Copyrights Reserved &copy; 2019 Team
                </p>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    
</body>

</html>
