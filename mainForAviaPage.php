<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Перенаправляем на страницу входа, если пользователь не авторизован
    header("Location: login.php");
    exit();
}
include 'db_connection.php';
$airports_query = "SELECT air_name FROM airports";
$airports_result = $conn->query($airports_query);
$classes_query = "SELECT class_name FROM classes";
$classes_result = $conn->query($classes_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
    <div class="search-container">
        <div class="search-box">
            <form action="search_results.php" method="get">
                <div class="row">
                    <label for="from">Откуда:</label>
                    <select id="from" name="from">
                        <?php
                        if ($airports_result->num_rows > 0) {
                            while($row = $airports_result->fetch_assoc()) {
                                echo '<option value="' . $row["air_name"] . '">' . $row["air_name"] . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <label for="to">Куда:</label>
                    <select id="to" name="to">
                        <?php
                        if ($airports_result->num_rows > 0) {
                            $airports_result = $conn->query($airports_query);
                            while($row = $airports_result->fetch_assoc()) {
                                echo '<option value="' . $row["air_name"] . '">' . $row["air_name"] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <label for="departure">Когда:</label>
                    <input type="date" id="departure" name="departure">

                    <label for="return">Обратно:</label>
                    <input type="date" id="return" name="return">

                    <label for="class">Класс самолета:</label>
                    <select id="class" name="class">
                        <?php
                        if ($classes_result->num_rows > 0) {
                            while($row = $classes_result->fetch_assoc()) {
                                echo '<option value="' . $row["class_name"] . '">' . $row["class_name"] . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <button type="submit">Найти билеты</button>
                </div>
            </form>
        </div>
    </div>

    <div class="long-image-container">
        <div class="long-image">
            <img src="stockimages\dlinna.jpg" alt="Описание картинки">
            <div class="image-text">Откройте неизведанные места</div>
        </div>
    </div>

    <div class="collage-container">
        <div class="collage">
            <div class="collage-item">
                <img src="stockimages\yaas.jpg" alt="Описание картинки 1">
                <p class="caption">Долина Йосемити</p>
            </div>
            <div class="collage-item">
                <img src="stockimages\china.jpg" alt="Описание картинки 2">
                <p class="caption">Чжанъе Данксиа</p>
            </div>
            <div class="collage-item">
                <img src="stockimages\jap.jpg" alt="Описание картинки 3">
                <p class="caption">Бамбуковый лес</p>
            </div>
        </div>
    </div>

    <div class="collage-container">
        <div class="collage">
            <div class="collage-item">
                <img src="stockimages\yaas.jpg" alt="Описание картинки 1">
                <p class="caption">Долина Йосемити</p>
            </div>
            <div class="collage-item">
                <img src="stockimages\china.jpg" alt="Описание картинки 2">
                <p class="caption">Чжанъе Данксиа</p>
            </div>
        </div>
    </div>
    </main>
</body>
</html>