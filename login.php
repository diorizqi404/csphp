<?php

session_start();

require 'auth.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = login($username, $password);

    if($user){
        $_SESSION['user'] = $user;
        header('Location: index.html');
    }else {
        $_SESSION['error'] = "Username or Password is incorrect";
        header('Location: form.php');
    }
}

?>