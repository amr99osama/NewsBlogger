<?php

session_start();
// define Error Message
// 
function ErrorMessage()
{
    if(isset($_SESSION["ErrorMessage"]))
    {
        $output = "<div class=\"alert alert-danger\">";
        $output .= htmlentities($_SESSION['ErrorMessage']);
        $output .= "</div>";
        // define Null while no error message will be resulted (after refresh the page)
        $_SESSION["ErrorMessage"] = null;
        return $output;
    }
}

// define Success Message
function SuccessMessage()
{
    if(isset($_SESSION["SuccessMessage"]))
    {
        $output = "<div class=\"alert alert-success\">";
        $output .= htmlentities($_SESSION['SuccessMessage']);
        $output .= "</div>";
        // define Null while no error message will be resulted
        $_SESSION["SuccessMessage"] = null;
        return $output;
    }
}

function Redirect_to($new_location)
{
     if(isset($_SESSION["Redirect"]))
     {
    header("Location:".$new_location);
    exit;
}
    else 
    {
         header("Location:".$new_location);
    exit;
    }
}
?>
