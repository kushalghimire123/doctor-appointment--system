 /* //CHECK IF USERNAME IS EMPTY
    if(empty(trim($_POST['username']))){
        $username_err = "username cannot be blank"; 
  
    }
    else{
        $sql = "SELECT Uid FROM User WHERE  username = ?";
        $stmt = mysqli_prepare($con, $sql); //binding veriable to sql
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s", $parm_username);
            //Set the value of parm username
            $parm_username = trim($_POST['username']);
            //try to execute the statement
           if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
            }
  
            else{
                $username = trim($_POST['username']);
               }

        }
        else{
            echo"something went wrong";
        }
    }
    
    
    mysqli_stmt_close($stmt);//FUNCTION TO CLOSE QUERRY of username*/