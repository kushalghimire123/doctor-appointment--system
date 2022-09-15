<?php
include "config.php";
$username = $password =  $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";//for error declaration of verialble
if ($_SERVER['REQUEST_METHOD'] == "POST" )
{

   //check for name
  //checking for empty
  if(empty(trim($_POST['username']))){

    $name_err = "username cannot be blank";
  }
  elseif(strlen(trim($_POST['username'])) < 5){
    $name_err = "username cannot be less than 5 charecter";
    }
   else{
    $username = trim($_POST['username']);
  }



  //check for password
  //checking for empty
  if(empty(trim($_POST['password']))){
    $password_err = "password cannot be blank";
  }
   //checking the length of password
 elseif(strlen(trim($_POST['password'])) < 3){
    $password_err = "password cannot be less than 3 charecter";
 }
 else{
      $password = trim($_POST['password']);
 }
  //checking for confirm password although done from javascript.
 if(trim($_POST["password"] != trim($_POST['ConfirmPassword']))){
    $confirm_password_err = "password should be matching";
 }
 //if there are no error and insert into database
 if(empty($username_err) && empty($password_err) && empty ($confirm_password_err)){
    $sql = "INSERT INTO user (username, password) VALUES (?, ?)";//SQL CODE FOR INSERTING VALUES INTO DATABASE
    $stmt = mysqli_prepare($con, $sql);
    if($stmt){
        mysqli_stmt_bind_param($stmt, "ss", $parm_username, $parm_password);
        //set these parameter
        $parm_username = $username;
        $parm_password = password_hash($password, PASSWORD_DEFAULT);//function for storing hash password in database.
        //try to execute querry
        if(mysqli_stmt_execute($stmt)){
            header("location:login.html");

        }
        else{
            echo"something went wrong..cannot Redirect!!!!!";

        }

        
    }
    mysqli_stmt_close($stmt);


    }
 mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>REGISTRATION FORM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="mystyle.css">
</head>
<body>
<div class="container d-flex justify-content-center
     align-items-center" 
        style="min-height: 100vh">
    <form class="border shadow p-3 rounded" 
       action="" onsubmit="return validate()"
       method="post" name="myForm" id="form"
       style="width: 450px" >
       <h3 class="text-center p-3">Sign In Here</h3>
       
          <!-- <div class="mb-3">
       <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" name="username" id=" username" method="post">  
     </div>  -->
     <div class="mb-3">
      <label for="username" class="form-label">username</label>
     <input type="text" class="form-control" name="username" id="name" method="post">
    </div>
      <div class="mb-3">
      <label for="password" class="form-label">Password</label>
       <input type="password" class="form-control" name="password"  
       id="password" method="post">
       </div>
       <div class="mb-3">
        <label for="confirmpassword" class="form-label">Confirm Password</label>
         <input type="password" class="form-control" name="ConfirmPassword"  
         id="confirmpassword" onkeyup="check(this)" ><error class="target" id="alert"></error>
        </div><br>
     <button type="submit" class="btn btn-primary">submit</button>
   </form>
    </div>
</body>
<script type="text/javascript">
  var password = document.getElementById('password');
  var cpassword= document.getElementById('confirmpassword');
   var flag = 1; //1 no error o for error
function check(elem){// value passing for(this)
    if(elem.value.length > 0){
        if(elem.value != password.value){
          document.getElementById('alert').innerText= "*Confirm password does not match";
          flag = 0;//error no submission of form
        }
        else{
            document.getElementById('alert').innerText= "";
           flag = 1;// no error for submission of form
        }
       

    }else{
        document.getElementById('alert').innerText= "*Please Confirm Password";
        flag = 0;

    }
    function validate(){ //method form to submit
      if(flag == 1)  {
        return true;
      }else{
        return false;
      }
    }
}
</script>
</html>