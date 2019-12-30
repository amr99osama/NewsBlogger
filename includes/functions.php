
<?php require_once("includes/database.php");?>
<?php require_once("includes/sessions.php");?>

<?php
// function to redirect
// take php file to redirect user



function checkUserInfo($username)
{
    global $ConnectingDB;
    $sql = "SELECT username FROM admins WHERE username=:username";
    $statement = $ConnectingDB->prepare($sql);
    $statement->bindValue (':username',$username);
    $statement->execute();
    $res = $statement->rowcount();
    if($res == 1)
    {
        return true;
    }
    else 
    {
        return false;
    }
}


function loginChecked ($username,$password)
{
    global $ConnectingDB;
        // LIMIT 1 used to return true when only one record is successfully manipulated
        $sql = "SELECT * FROM admins WHERE username =:un AND password =:ps LIMIT 1";
        $statement = $ConnectingDB->prepare($sql);
        $statement->bindValue(":un",$username);
         $statement->bindValue(":ps",$password);
        $statement->execute();
        $res = $statement->rowcount();
        if ($res == 1)
        {
            return $found = $statement->fetch();
        }
        else 
        {
            return null;
        }
}


function loginRequired()
{
    if(isset($_SESSION["username"]))
    {
        return true;
    }
    else 
    {
        $_SESSION["ErrorMessage"] = "Login Required!";
        Redirect_to("login.php");
    }
}
?>