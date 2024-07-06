<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

include 'db_connection.php';

$user_id = $_SESSION['user_id'];

// Получение пути к изображению из базы данных
$query = "SELECT pic_path FROM pictures WHERE pic_id = (SELECT u_image FROM user WHERE u_id = ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($user_image_path);
$stmt->fetch();
$stmt->close();

$upload_success = false;

if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
    $file_name = $_FILES['photo']['name'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $extensions = array("jpeg", "jpg", "png");

    if (!in_array($file_ext, $extensions)) {
        echo "Только JPEG или PNG изображения могут быть загружены.";
        exit();
    }

    $new_file_name = 'profile_' . $user_id . '.' . $file_ext;
    $upload_path = 'profile_images/' . $new_file_name;

    // Создаем директорию, если ее не существует
    if (!file_exists('profile_images')) {
        mkdir('profile_images', 0777, true);
    }

    if (move_uploaded_file($file_tmp, $upload_path)) {

        $check_query = "SELECT pic_id FROM pictures WHERE pic_id = (SELECT u_image FROM user WHERE u_id = ?)";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Обновляем существующую запись
            $update_query = "UPDATE pictures SET pic_path = ? WHERE pic_id = (SELECT u_image FROM user WHERE u_id = ?)";
            $stmt_update = $conn->prepare($update_query);
            $stmt_update->bind_param('si', $upload_path, $user_id);
            if ($stmt_update->execute()) {
                echo "Фото обновлено: " . $upload_path . "<br>";
                $upload_success = true;
            } else {
                echo "Ошибка при обновлении фотографии в базе данных.<br>";
            }
            $stmt_update->close();
        } else {
            // Создаем новую запись и обновляем пользователя
            $insert_query = "INSERT INTO pictures (pic_path) VALUES (?)";
            $stmt_insert = $conn->prepare($insert_query);
            $stmt_insert->bind_param('s', $upload_path);
            if ($stmt_insert->execute()) {
                $new_pic_id = $stmt_insert->insert_id;
                $update_user_query = "UPDATE user SET u_image = ? WHERE u_id = ?";
                $stmt_update_user = $conn->prepare($update_user_query);
                $stmt_update_user->bind_param('ii', $new_pic_id, $user_id);
                if ($stmt_update_user->execute()) {
                    echo "Новая запись создана: " . $upload_path . "<br>";
                    $upload_success = true;
                } else {
                    echo "Ошибка при обновлении пользователя.<br>";
                }
                $stmt_update_user->close();
            } else {
                echo "Ошибка при создании новой записи в базе данных.<br>";
            }
            $stmt_insert->close();
        }
        $stmt->close();
    } else {
        echo "Ошибка при загрузке фотографии.<br>";
    }
} else {
    echo "Файл не был загружен или произошла ошибка при загрузке.<br>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль пользователя</title>
    <?php if ($upload_success) { ?>
        <script>
            window.onload = function() {
                location.reload();
            }
        </script>
    <?php } ?>
</head>
<body>
    <h1>Профиль пользователя</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="photo">Загрузить фото:</label>
        <input type="file" name="photo" id="photo">
        <button type="submit">Загрузить</button>
    </form>

    <!-- Отображение изображения пользователя -->
    <img src="<?php echo htmlspecialchars($user_image_path) . '?t=' . time(); ?>" alt="User Image">
</body>
</html>