<?php require_once("includes/database.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>
<?php loginRequired(); ?>

<?php
                $searchID = $_GET["id"];
 global $ConnectingDB;
                $sql = "SELECT * from Posts WHERE id = '$searchID' ";
                $statement = $ConnectingDB->query($sql);
                while ($datarows = $statement->fetch())
                {
                    $titleDeleted = $datarows['title'];
                    $CategoryDeleted = $datarows['category'];
                    $imageDeleted = $datarows['image'];
                    $postDeleted = $datarows['post']; 
                }
// getting buttom of publish
if(isset($_POST["submit"]))
{
        //put query to database
         global $ConnectingDB;
$sql = "DELETE FROM posts WHERE id = '$searchID'";
         $exec = $ConnectingDB->query($sql);        
        if($exec)
        {
            $ImageTargetToDelete = getcwd().DIRECTORY_SEPARATOR."assets/$imageDeleted";
            unlink($ImageTargetToDelete);
             $_SESSION["SuccessMessage"] = "Your Post Deleted Successfully !";
            //Redirect_to("posts.php");
               $_SESSION["Redirect"] = "posts.php";
        echo Redirect_to($_SESSION["Redirect"]);
        }
        else
        {
            $_SESSION["ErrorMessage"] = "there's error while Deleting data , please try again !";
//            Redirect_to("posts.php");
             $_SESSION["Redirect"] = "posts.php";
        echo Redirect_to($_SESSION["Redirect"]);
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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
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
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="header-1">
                            Posts
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <div class="main-section">
            <div class="container py-2 mb-4">
                <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
               
                        ?>
                <div class="row">
                    <div class="col-md-12">
                        <!-- enctype used  -->
                        <form method="post" action="deletepost.php?id=<?php echo $searchID;  ?> " enctype="multipart/form-data">

                            <div class="card">
                                <div class="card-header">
                                    Delete Post
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="postTitle">Post Title</label>
                                        <input disabled type="text" name="postTitle" class="form-control" id="postTitle" value="<?php echo $titleDeleted; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="catTitle">categories</label>
                                        <span class="small">The Current one is: </span>
                                        <span class="large"><?php echo $CategoryDeleted; ?></span>
<!--
                                        <select class="form-control" name="catTitle" id="cat">
                                             fetching categories from category table
                                            <?php
                                             global $ConnectingDB;
                                            $sql = "SELECT id , title FROM category";
                                            $statement = $ConnectingDB->query($sql);
                                            // fetch all data from category table
                                            while($datarows = $statement->fetch())
                                            {
                                                $ID = $datarows["id"];
                                                $categoryName = $datarows["title"];
                                            ?>
                                            <option value="<?php echo $categoryName;?>"><?php echo $categoryName;?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
-->
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="image">The Image</label>
                                        <span class="small">The Current one is: </span>
                                        <img src="assets/<?php echo $imageDeleted;?>" width="100" height="100" alt="">
<!--
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image" value="">
                                            <label for="" class="custom-file-label">Select Image</label>
                                        </div>
-->

                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="postDescription">Post Description</label>
                                        <textarea  disabled class="form-control" name="postDescription" id="" cols="30" rows="10">
                                            <?php echo $postDeleted; ?>
                                        </textarea>


                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 d-flex button-actions">
                                            <button class="btn-reg mr-2">
                                                <i class="fas fa-arrow-left"></i>
                                                back to dashboard
                                            </button>
                                            <button type="submit" class="btn-reg" name="submit">
                                                <i class="fas fa-times"></i> Delete
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
    <div class="crights" style="background-color:#1E6C9F;
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
