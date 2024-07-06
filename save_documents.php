<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];

$fields = ['u_mail', 'u_password', 'u_image', 'u_fname', 'u_name', 'u_sname', 'u_passport'];
$update_data = [];

foreach ($fields as $field) {
    if (isset($_POST[$field])) {
        $update_data[] = "$field = '" . mysqli_real_escape_string($conn, $_POST[$field]) . "'";
    }
}

if (!empty($update_data)) {
    $update_query = "UPDATE user SET " . implode(', ', $update_data) . " WHERE u_id = '$user_id'";
    if (mysqli_query($conn, $update_query)) {
        echo 'Изменения успешно сохранены.';
    } else {
        echo 'Ошибка при сохранении изменений: ' . mysqli_error($conn);
    }
} else {
    echo 'Нет данных для обновления.';
}
?>