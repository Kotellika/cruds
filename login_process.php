<?php
session_start();
include 'db_connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM user WHERE u_fname='$username' AND u_password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $user['u_id'];
    header("Location: profilePage.php");
    exit();
} else {
    echo "Неверный логин или пароль";
}
?>