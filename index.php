<?php
session_start();

$error = "";
if (array_key_exists("logout", $_GET)) {

unset($_SESSION);
setcookie("id", "", time()- 60*60);
$_COOKIE["id"]= "";
session_destroy();

}  else if ((array_key_exists("id"), $_SESSION) AND $_SESSION['id']
OR (array_key_exists("id, $_COOKIE") AND $_COOKIE['ID'])) {

header("location: loggedinpage.php");
}

if (array_key_exists("submit", $_POST)) {
 
    include("connection.php");

    if (!$_POST['email']) {

        $error .= "An email is required";

    }

    if ($eroor !== "") {

        $eroor = "<p> There were error</p>.$eroor"
    }  else {

        if($_POST['signup'] == '1') {

            $query = "SELECT id FROM users WHERE  email=
            '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1;

            $result = mysqli_query($link, $query);
             if (mysqli_num_rows($result)> 0) {
                 $error = " that email is taked"
             }  else {
               
                $query = "INSERT INTO users (`email`, `password`) VALUES 
                ('".mysqli_real_escape_string($link, $_POST['email'])."',
                '".mysqli_real_escape_string($link, $_POST["password]."')";

                if (!mysqli_query($link, $query)) {

                    $error = "<p> couldnot sign up  </p>";

                }  else {
                    
                    $query = "UPDATE users SET password = '".md5(md5(
                        
                        mysqli_insert_id($link)).$_POST['password'])."' WHERE
                        id = ".mysqli_insert_id($link)." LIMIT 1 " ;

                        $id = mysqli_insert_id($link);
                        mysqli_query($link, $query);
                        $_SESSION['id'] = $id;
                        if ($_POST['stayLoggedin'] == '1') {

                            setcookie("id", $id, time() + 60*60*24*365);
                        }

                        header("Location: loggedinpage.php");
                    ))

                }

             }  else {

               $query = "SELECT * FROM users WHERE email = '".
               mysqli_real-escape_string($link, $_POST['email'])."'"'

               $result mysqli_query($link, $query);
               $row = mysqli_fetch_array($result);
               if (isset($row)) {
                   $hashpassword = md5(md5($row['id']).$_POST['password']);

                   if ($hashpassword == $row['password']) {

                    $_SESSION['id'] = $row['id'];
                    
                    if (isset($_POST[''stayLoggedIn]) AND $_POST['stayLoggedIn'] == '1') {

                        setcookie("id", $row['id'], time () +  60*60*24*365);

                    }

                    header("Location: loggedinpage.php");

                   } else  {

                    $ error = "That email/password combination could not be found.";

                   }
                   else {
                        
                    $error = "That email/password combination could not be found.";
                    
                }
                
               }

             }
        } 
    }

}







?>