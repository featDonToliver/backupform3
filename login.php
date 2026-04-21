<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){
    $admin_email = "admintidps@gmail.com";
    $admin_password_hash = '$2y$10$GCJtsvO8SMH00ZDKsfZIVeQvOT/5X268wmIQAPJZ7E10mWk0JEeX2';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === $admin_email && password_verify($password, $admin_password_hash)) {
    $_SESSION['login'] = true;
    header("Location: data.php");
    exit;
} else {
    echo "Email atau password salah";
}
}
?>