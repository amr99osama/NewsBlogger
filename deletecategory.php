<?php require_once("includes/database.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>
<?php loginRequired(); ?>

<?php

if(isset($_GET["id"]))
{
    $searchID = $_GET["id"];
        //put query to database
         global $ConnectingDB;
$sql = "DELETE FROM category WHERE id = '$searchID'";
         $exec = $ConnectingDB->query($sql);        
        if($exec)
        {
             $_SESSION["SuccessMessage"] = "Category Deleted Successfully !";
            //Redirect_to("posts.php");
               $_SESSION["Redirect"] = "categories.php";
        echo Redirect_to($_SESSION["Redirect"]);
        }
        else
        {
            $_SESSION["ErrorMessage"] = "there's error while Deleting data , please try again !";
//            Redirect_to("posts.php");
             $_SESSION["Redirect"] = "categories.php";
        echo Redirect_to($_SESSION["Redirect"]);
        }
}
?>
