<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

$user_id = $_SESSION['user_id'];

// Получаем путь к текущей фотографии пользователя
$query = "SELECT pic_path FROM pictures WHERE pic_id = (SELECT u_image FROM user WHERE u_id = ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_image_path = $row['pic_path'];
} else {
    $current_image_path = "stockimages/yaas.jpg"; // Путь к стандартной аватарке по умолчанию
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <main>
        <div class="profile-container">
            <div class="profile-avatar">
                <img id="profile-image" src="<?php echo $current_image_path; ?>" alt="Аватарка пользователя">
            </div>
            <div class="profile-nav">
                <button class="nav-button" id="documents-button">Мои документы</button>
                <button class="nav-button">Уведомления</button>
                <div class="photo-upload-container">
                    <button class="nav-button" id="change-photo-button">Смена фотографии</button>
                    <input type="file" id="photo-upload" name="photo-upload" style="display:none;">
                </div>
                <button class="nav-button" id="orders-button">Заказы</button>
                <button class="nav-button" id="logout-button">Выход</button>
            </div>
        </div>
        <div id="documents-container" style="display:none;">
            <h2>Мои документы</h2>
            <form id="documents-form"></form>
        </div>
        <div id="orders-container" style="display:none;">
            <h2>Мои заказы</h2>
            <div id="orders-list"></div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#change-photo-button').click(function() {
                $('#photo-upload').click(); 

                $('#photo-upload').change(function() {
                    var formData = new FormData();
                    formData.append('photo', $('#photo-upload')[0].files[0]);

                    $.ajax({
                        url: 'upload_image.php',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#profile-image').attr('src', response); 
                            alert('Фотография успешно изменена!');
                        },
                        error: function() {
                            alert('Ошибка при загрузке фотографии.');
                        }
                    });
                });
            });

            $('#logout-button').click(function() {
                $.ajax({
                    url: 'exit_script.php',
                    method: 'POST',
                    success: function() {
                        window.location.href = 'login.php';
                    },
                    error: function() {
                        alert('Ошибка при выходе из аккаунта.');
                    }
                });
            });

            $('#orders-button').click(function() {
                $.ajax({
                    url: 'get_orders.php',
                    method: 'GET',
                    success: function(data) {
                        $('#orders-list').html(data);
                        $('#orders-container').show();
                        $('#documents-container').hide();
                    },
                    error: function() {
                        alert('Ошибка при загрузке заказов.');
                    }
                });
            });

            $('#documents-button').click(function() {
                $.ajax({
                    url: 'get_documents.php',
                    method: 'GET',
                    success: function(data) {
                        $('#documents-form').html(data);
                        $('#documents-container').show();
                        $('#orders-container').hide();
                    },
                    error: function() {
                        alert('Ошибка при загрузке документов.');
                    }
                });
            });
        });

        function saveDocuments() {
            var formData = $('#documents-form').serialize();
            $.ajax({
                url: 'save_documents.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    alert(response);
                },
                error: function() {
                    alert('Ошибка при сохранении изменений.');
                }
            });
        }
    </script>
</body>
</html>