<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT u_mail, u_password, u_fname, u_name, u_sname FROM user WHERE u_id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo '<table>';
    foreach ($row as $field => $value) {
        echo '<tr>';
        echo '<th>' . htmlspecialchars($field) . '</th>';
        echo '<td><input type="text" name="' . htmlspecialchars($field) . '" value="' . htmlspecialchars($value) . '"></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<button type="button" onclick="saveDocuments()">Сохранить изменения</button>';
} else {
    echo 'Ошибка при загрузке данных пользователя.';
}
?>