<?php require_once("includes/database.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>
<?php $_SESSION["URL"]= $_SERVER["PHP_SELF"]; ?>

<?php echo loginRequired(); ?>
<?php

// getting buttom of publish
if(isset($_POST["submit"]))
{
    // category title
    $category = $_POST["catTitle"];
    $Admin =    $_SESSION["username"];
    
    // date-time
$CurrentTime = time();
$dateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    //if input field is empty it will redirect the user to categories page
    if(empty($category))
    {
        $_SESSION["ErrorMessage"] = "the field must be filled!";
     //   Redirect_to("categories.php");
         $_SESSION["Redirect"] = "categories.php";
        echo Redirect_to($_SESSION["Redirect"]);
    }
    else if (strlen($category) <= 2)
    {
         $_SESSION["ErrorMessage"] = "the type must be more than 2 characters!";
               // Redirect_to("categories.php");
        $_SESSION["Redirect"] = "categories.php";
        echo Redirect_to($_SESSION["Redirect"]);

    }
    // the title must be 
    else if (strlen($category) >= 49)
    {
         $_SESSION["ErrorMessage"] = "the type exceed the limited length!";
              //  Redirect_to("categories.php");
        $_SESSION["Redirect"] = "categories.php";
        echo Redirect_to($_SESSION["Redirect"]);

    }
    
    else
    {
        //put quert to database
        $sql = "INSERT INTO category(title,author,datetime)";
        $sql .= "VALUES (:categoryName,:adminName ,:datetime)";
        $statement = $ConnectingDB->prepare($sql);
        
        $statement->bindValue(':categoryName',$category);
         $statement->bindValue(':adminName',$Admin);
         $statement->bindValue(':datetime',$dateTime);
        $exec = $statement->execute();
        if($exec)
        {
             $_SESSION["SuccessMessage"] = "Your Category with ID : ".$ConnectingDB->lastInsertID(). " is Added Successfully !";
           // Redirect_to("categories.php");
            $_SESSION["Redirect"] = "categories.php";
        echo Redirect_to($_SESSION["Redirect"]);
        }
        else
        {
            $_SESSION["ErrorMessage"] = "there's error while inserting data , please try again !";
           // Redirect_to("categories.php");
            $_SESSION["Redirect"] = "categories.php";
        echo Redirect_to($_SESSION["Redirect"]);
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
                            Categories
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
                        <form method="post" action="categories.php">

                            <div class="card">
                                <div class="card-header">
                                    Add New Category
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="catTitle">Category Type</label>
                                        <input type="text" name="catTitle" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 d-flex button-actions">
                                            <button type="submit" class="btn-reg mr-2">
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
           <div class="container py-2">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        echo ErrorMessage();
                        echo SuccessMessage();
                        ?>
                        <h1 class="header-1">
                            Managing Categories
                        </h1>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Title</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                global $ConnectingDB;
                                $sql = "SELECT * from category";
                                $statement= $ConnectingDB->query($sql);
                                $counter = 0;
                                while ($datarows = $statement->fetch())
                                {
                                    $ID = $datarows["id"];
                                    $categoryTitle= $datarows["title"];
                                    $Author = $datarows["author"];
                                    $counter++;
                                    
                                ?>
                                <tr>
                                    <td><?php echo $counter ?></td>
                                    <td><?php 
                                    echo $categoryTitle;
                                        ?></td>
                                        <td><?php echo $Author; ?></td>
                                       <td>
                                        <a href="deletecategory.php?id=<?php echo $ID ?>" class="btn btn-danger text-center" title="delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    <?php
                                }
                                ?>
                                </tr>
                            </tbody>
                        </table>
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
