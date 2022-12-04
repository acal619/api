<?php

include 'config.php';
$email =$_POST['email_address'];
$password = $_POST['password'];
$message = '';
$error = false;
$array;
try {
      $SelectQuery = "SELECT * FROM users Where email_address = '$email' AND password = '$password'  ";
        $Check = mysqli_query($kon, $SelectQuery);
        if(mysqli_num_rows($Check)>0){
            $array = mysqli_fetch_assoc($Check);
            if($array['password'] != $password){
                $message = "You insert a wrong password";
                $error = true;
                $array = null;
            }
        } else {
            $message = "No account yet";
            $error = true;
            $array = null;
        }
        mysqli_close($kon);
} catch(Exception $e){
    $message = $e->getMessage();
    die();
}

$result = ['message' => $message, 'result' =>  $array ,'error' => $error];
echo  json_encode($result);
