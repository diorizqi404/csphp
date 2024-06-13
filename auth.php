<?php
include 'connect.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    register();
}else {
    login();
}

function login(){
    $conn = getConnection();

    $username = $_GET['username'];
    $password = $_GET['password'];

    $get = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $get->bind_param('s', $username);
    $get->execute();
    $result = $get->get_result();

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit();
        }

        $_SESSION['error'] = "Username or Password is incorrect";
        header('Location: form.php');
        exit();
    }
}

function register(){
    $conn = getConnection();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];

    if($password !== $conf_password){
        $_SESSION['error'] = "Password does not match";
        header('Location: register.php');
        exit();
    }
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $insert->bind_param('ss', $username, $hash);    
    $insert->execute();
    $result = $insert->get_result();

    if($insert->affected_rows > 0){
        $_SESSION['success'] = "Registration successful";
        header('Location: form.php');
        exit();
    }else {
        $_SESSION['error'] = "Error registering user";
        header('Location: register.php');
        exit();
    }
}

?>