<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db_connection.php';

$user_id = $_SESSION['user_id'];

$query = "
    SELECT p.pas_seatnum, d.dep_time, f.f_id, a1.air_name as airout, a2.air_name as airin
    FROM passengers p
    JOIN departures d ON p.pas_dep = d.dep_id
    JOIN flights f ON d.dep_flight = f.f_id
    JOIN airports a1 ON f.f_airout = a1.air_id
    JOIN airports a2 ON f.f_airin = a2.air_id
    WHERE p.pas_uid = '$user_id'
";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table>
            <tr>
                <th>Откуда</th>
                <th>Куда</th>
                <th>Дата и время вылета</th>
                <th>Номер места</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['airout'] . "</td>
                <td>" . $row['airin'] . "</td>
                <td>" . $row['dep_time'] . "</td>
                <td>" . $row['pas_seatnum'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "У вас нет заказов.";
}
?>