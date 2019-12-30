<?php require_once("includes/database.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>
<?php
// getting buttom of publish
if(isset($_POST["submit"])) 
{
    // category title
    $postTitle = $_POST["postTitle"];
    $Category = $_POST["catTitle"];
    // we cannot post an image file so we use file global variable
    // we cannot take image file immediately and insert it to database but we will take the image name and store it in database
    $Image = $_FILES["image"]["name"];
    // directory images 
    $imageDirectory = getcwd().DIRECTORY_SEPARATOR."assets/".basename($_FILES["image"]["name"]);
    $postDescription = $_POST["postDescription"];
         $Admin =    $_SESSION["username"];
    
    // date-time
$CurrentTime = time();
$dateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    //if input field is empty it will redirect the user to categories page
    if(empty($postTitle))
    {
        $_SESSION["ErrorMessage"] = "the title must be filled!";
        //Redirect_to("addpost.php");
          $_SESSION["Redirect"] = "addpost.php";
        echo Redirect_to( $_SESSION["Redirect"]);
    }
    else if (strlen($postTitle) <= 4)
    {
         $_SESSION["ErrorMessage"] = "the title must be more than 5 characters!";
               // Redirect_to("addpost.php");
         $_SESSION["Redirect"] = "addpost.php";
        echo Redirect_to( $_SESSION["Redirect"]);
    }
    
    else if (empty($Category))
    {
         $_SESSION["ErrorMessage"] = "the Category title must be Selected";
               // Redirect_to("addpost.php");
         $_SESSION["Redirect"] = "addpost.php";
        echo Redirect_to( $_SESSION["Redirect"]);
    }
   
    else if (strlen($postDescription) >= 9999)
    {
         $_SESSION["ErrorMessage"] = "the Description should be less than 10000 characters!";
                //Redirect_to("addpost.php");
         $_SESSION["Redirect"] = "addpost.php";
        echo Redirect_to( $_SESSION["Redirect"]);

    }
    else
    {
        //put query to database
         global $ConnectingDB;
        $sql = "INSERT INTO posts(datetime,title,category,author,image,post)";
        $sql .= "VALUES(:datetime,:title,:category,:author,:image,:post)";
        $statement = $ConnectingDB->prepare($sql);
        // bind value with dummy data to reserve it in database
         $statement->bindValue(':datetime',$dateTime);
         $statement->bindValue(':title',$postTitle);
         $statement->bindValue(':category',$Category);
         $statement->bindValue(':author',$Admin);
        $statement->bindValue(':image',$Image);
        $statement->bindValue(':post',$postDescription);
        $exec = $statement->execute();
        // function used to get downloaded image to our assets file
        move_uploaded_file($_FILES['image']['tmp_name'],$imageDirectory);
        if($exec)
        {
             $_SESSION["SuccessMessage"] = "Your Post with ID : " . $ConnectingDB->lastInsertID()." is Added Successfully !";
            Redirect_to("addpost.php");
        }
        else
        {
            $_SESSION["ErrorMessage"] = "there's error while inserting data , please try again !";
            Redirect_to("addpost.php");
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
                        <form method="post" action="addpost.php" enctype="multipart/form-data">

                            <div class="card">
                                <div class="card-header">
                                    Add New Post
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="postTitle">Post Title</label>
                                        <input type="text" name="postTitle" class="form-control" id="postTitle">
                                    </div>
                                    <div class="form-group">
                                        <label for="catTitle">Choose one of categories</label>
                                        <select class="form-control" name="catTitle" id="cat">
                                            <!-- fetching categories from category table-->
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
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="image">Choose an image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image" value="">
                                            <label for="" class="custom-file-label">Select Image</label>
                                        </div>

                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="postDescription">Post Description</label>
                                        <textarea class="form-control" name="postDescription" id="" cols="30" rows="10"></textarea>


                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 d-flex button-actions">
                                            <button class="btn-reg mr-2">
                                                <i class="fas fa-arrow-left"></i>
                                                back to dashboard
                                            </button>
                                            <button type="submit" class="btn-reg" name="submit">
                                                <i class="fas fa-check"></i> Publish
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
