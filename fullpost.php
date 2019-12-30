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
        <section class="main-blog">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <h2 class="header-2">
                            Newsfeeds
                        </h2>

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">

                                    <?php 
                        global $ConnectingDB;
                        if(isset($_GET["searchingButton"]))
                        {
                            $search = $_GET["search"];
                            $sql="SELECT * FROM posts WHERE 
                            datetime LIKE :search or title LIKE :search or category LIKE :search
                            ";
                         $statement= $ConnectingDB->prepare($sql);
                            $statement->bindValue(':search','%'.$search.'%');
                            $statement->execute();

                        }
                                else
                                {
                                    $IDfromURL = $_GET["id"];
                                    if(!isset($IDfromURL))
                                    {
                                        $_SESSION["ErrorMessage"] = "Bad Request!";
                                        redirect_to("blog.php");
                                    }
                                    
                                $sql = "SELECT * from posts WHERE id = '$IDfromURL' ";
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
                                   

                                    <div class="card mb-5 mx-auto" style="width: auto;">
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
                                    echo $postDesc ?>
                                            </p>
                                            <hr>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 offset-1" style="background-color:#1E6C9F; height 10px;"></div>
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
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script>
    </script>
</body>

</html>
