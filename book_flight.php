<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connection.php';

$user_id = $_SESSION['user_id'];
$flight_id = $_POST['flight_id'];


$check_query = "SELECT * FROM passengers WHERE pas_uid='$user_id' AND pas_dep='$flight_id'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) == 0) {
    $seat_num = rand(1, 100); 
    $insert_query = "INSERT INTO passengers (pas_uid, pas_dep, pas_seatnum) VALUES ('$user_id', '$flight_id', '$seat_num')";
    mysqli_query($conn, $insert_query);
    header("Location: profilePage.php"); 
    exit();
} else {
    echo "Вы уже забронировали место на этот рейс.";
}
?>