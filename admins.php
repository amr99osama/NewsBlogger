<?php require_once("includes/database.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>
<?php $_SESSION["URL"]= $_SERVER["PHP_SELF"]; ?>

<?php loginRequired(); ?>

<?php
   
// getting button of publish
if(isset($_POST["submit"]))
{
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confPassword"];
         $Admin =    $_SESSION["username"];

    // date-time
$CurrentTime = time();
$dateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    
    if(empty($username)|| empty($password) || empty ($confirmPassword))
    {
        $_SESSION["ErrorMessage"] = "All fields must be filled!";
        Redirect_to("admins.php");
    }
////    else if (strlen($password) <= 4)
////    {
////         $_SESSION["ErrorMessage"] = "the Password must be more than 4 characters!";
////                Redirect_to("admins.php");
////    }
//    // the title must be 
////    else if ($password !== $confirmPassword)
////    {
////         $_SESSION["ErrorMessage"] = "The Password and Confirm Password Should Match";
////                Redirect_to("admins.php");
////
////    }
     else if (checkUserInfo($username))
    {
         $_SESSION["ErrorMessage"] = "This Username already exists";
                Redirect_to("admins.php");

    }
    else
    {
        //put quert insert to Admin's database
        $sql = "INSERT INTO admins(datetime,username,password,aname,addedby)";
        $sql .= "VALUES (:datetime,:username,:password,:adminName,:addedByAdmin)";
        $statement = $ConnectingDB->prepare($sql);
        $statement->bindValue(':datetime',$dateTime);
         $statement->bindValue(':username',$username);
         $statement->bindValue(':password',$password);
          $statement->bindValue(':adminName',$fullname);
          $statement->bindValue(':addedByAdmin',$Admin);
        $exec = $statement->execute();
        if($exec)
        {
             $_SESSION["SuccessMessage"] = "New Admin is Added Successfully!";
            Redirect_to("admins.php");
        }
        else
        {
            $_SESSION["ErrorMessage"] = "there's error while inserting data , please try again !";
            Redirect_to("admins.php");
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
                            Create new Admin
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
                        <form method="post" action="admins.php">

                            <div class="card">
                                <div class="card-header">
                                    Add New Admin
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="catTitle">Username</label>
                                        <input type="text" name="username" id="username" class="form-control">
                                    </div>
                                      <div class="form-group">
                                        <label for="catTitle">Full Name</label>
                                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="optionally">
                                    </div>
                                      <div class="form-group">
                                        <label for="catTitle">Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                      <div class="form-group">
                                        <label for="catTitle">Confirm Password</label>
                                        <input type="password" name="confPassword" id="confPassword" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 d-flex button-actions">
                                            <a class="btn-reg mr-2 mb-2" href="dashboard.php">
                                                <i class="fas fa-arrow-left"></i>
                                                back to dashboard
                                            </a>
                                            <button type="submit" class="btn-reg mb-2" name="submit" onclick= "return validateForm()">
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
                            Managing Admins
                        </h1>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                global $ConnectingDB;
                                $sql = "SELECT * from admins";
                                $statement= $ConnectingDB->query($sql);
                                $counter = 0;
                                while ($datarows = $statement->fetch())
                                {
                                    $ID = $datarows["id"];
                                    $datetime= $datarows["datetime"];
                                    $username = $datarows["username"];
                                    $fullname = $datarows["aname"];
                                    $addedBy = $datarows["addedby"];
                                    $counter++;
                                    
                                ?>
                                <tr>
                                    <td><?php echo $counter ?></td>
                                    <td><?php 
                                    echo $datetime;
                                        ?></td>
                                    <td><?php echo $username ?></td>
                                        <td><?php echo $fullname ?></td>
                                    <td><?php echo $addedBy ?></td>
                                       <td>
                                        <a href="deleteadmin.php?id=<?php echo $ID ?>" class="btn btn-danger" title="delete">
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
   <script type="text/javascript" src="js/script.js"></script>
   <script>
        
   function validateForm(){
    var password, confirm_pass;
    password = document.getElementById("password").value;
    confirm_pass = document.getElementById("confPassword").value;   
    
    if((password != confirm_pass) || (password.length <= 4)){
       if (password != confirm_pass){
        alert("Password doesn't match.");
        }
       else{
        alert("Password Must be more than 4 characters");
       }
        return false;
    }
    else{   
        return true;
    }
}
    </script>
   
</body>

</html>
