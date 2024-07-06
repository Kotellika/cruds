<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connection.php';

$from = $_GET['from'];
$to = $_GET['to'];
$departure = $_GET['departure'];
$return = $_GET['return'];

$query = "
    SELECT f.f_id, a1.air_name as airout, a2.air_name as airin, f.f_duration, f.f_cost
    FROM flights f
    JOIN airports a1 ON f.f_airout = a1.air_id
    JOIN airports a2 ON f.f_airin = a2.air_id
    WHERE a1.air_name='$from' AND a2.air_name='$to' 
";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <h2>Результаты поиска</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>Откуда</th>
                        <th>Куда</th>
                        <th>Длительность</th>
                        <th>Стоимость</th>
                        <th>Действие</th>
                    </tr>";
            while($row = mysqli_fetch_assoc($result)) {
                // Проверка, забронировал ли 
                $flight_id = $row['f_id'];
                $user_id = $_SESSION['user_id'];
                $check_query = "SELECT * FROM passengers WHERE pas_uid='$user_id' AND pas_dep='$flight_id'";
                $check_result = mysqli_query($conn, $check_query);
                $disabled = mysqli_num_rows($check_result) > 0 ? 'disabled' : '';
                
                echo "<tr>
                        <td>" . $row['airout'] . "</td>
                        <td>" . $row['airin'] . "</td>
                        <td>" . $row['f_duration'] . "</td>
                        <td>" . $row['f_cost'] . "</td>
                        <td>
                            <form action='book_flight.php' method='post'>
                                <input type='hidden' name='flight_id' value='" . $flight_id . "'>
                                <button type='submit' $disabled>Сесть</button>
                            </form>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "Нет доступных рейсов по вашему запросу.";
        }
        ?>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>