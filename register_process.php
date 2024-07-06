<?php
include 'db_connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

// ID дефолт
$default_avatar_id = 1;

$query = "INSERT INTO user (u_fname, u_password, u_image) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssi", $username, $password, $default_avatar_id);

if ($stmt->execute()) {
    $user_id = $stmt->insert_id;
    
    $default_image_path = "stockimages/yaas.jpg"; 
    $insert_pic_query = "INSERT INTO pictures (pic_path) VALUES (?)";
    $stmt_pic = $conn->prepare($insert_pic_query);
    $stmt_pic->bind_param("s", $default_image_path);
    
    if ($stmt_pic->execute()) {
        $new_pic_id = $stmt_pic->insert_id;
        $update_user_query = "UPDATE user SET u_image = ? WHERE u_id = ?";
        $stmt_update_user = $conn->prepare($update_user_query);
        $stmt_update_user->bind_param("ii", $new_pic_id, $user_id);
        $stmt_update_user->execute();
        $stmt_update_user->close();
    }
    $stmt_pic->close();
    
    header("Location: profilePage.php");
    exit();
} else {
    echo "Ошибка при регистрации";
}

$stmt->close();
$conn->close();
?>