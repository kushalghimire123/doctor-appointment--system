<?php
//this script handles login authuntication.
session_start();
// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "config.php";
$username = $password = "";
 $err = "";
 //if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST" ){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])) ){
        $err = "please enter username + password";
    }
        //set into veriable if there is no error and post
        else{
            $username = trim($_POST['username']);
            $password =  trim($_POST['password']);
        }


    }
    if(empty($err)){
        $sql = "SELECT username, password FROM user WHERE username = ?"; //prepared stament of mysql 
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;
       
        //trying to excecute the statement 
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result ($stmt, $username, $hashed_password);//binding querry with veriable
                if(mysqli_stmt_fetch($stmt){
                    if(password_verify($password, $hashed_password)){
                        //this executes the password is corect,
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["loogedin"] = true;
                        //redirect user to viewportal page
                        header("location: viewportal.php");
                    }
                }
            }

        }


    }



?>