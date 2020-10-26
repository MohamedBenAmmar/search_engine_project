<?php
use Core\UserCore;

if (!isset($_SESSION['user'])){
    if (isset($_POST['login']) && isset($_POST['password'])){
        UserCore::login($_POST['login'],$_POST['password']);
        header('Location: index.php?controller=');
    }
    else {
        require 'views/LoginView.php';
    }
}
