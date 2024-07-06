<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Авторизация/Регистрация</title>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <div class="login-container">
        <h2>Авторизация</h2>
        <form action="login_process.php" method="post">
            <label for="username">Логин:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Войти</button>
        </form>
        <p>Нет аккаунта? <a href="register.php">Регистрация</a></p>
    </div>
</main>
<?php include 'footer.php'; ?>
</body>
<script src="script.js"></script>
</html>