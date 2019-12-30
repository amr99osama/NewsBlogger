<?php require_once("includes/functions.php");?>
<?php require_once("includes/sessions.php");?>
<?php 
           $_SESSION["username"] = $found["username"]; 
            $_SESSION["password"] = $found["password"];
             $_SESSION["AdminFullName"] = $found["aname"]; 
session_destroy();
Redirect_to("login.php");

?>