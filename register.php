<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Регистрация</title>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <div class="register-container">
        <h2>Регистрация</h2>
        <form action="register_process.php" method="post">
            <label for="username">Логин:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Зарегистрироваться</button>
        </form>
        <p>Уже есть аккаунт? <a href="login.php">Авторизация</a></p>
    </div>
</main>
<?php include 'footer.php'; ?>
</body>
<script src="script.js"></script>
</html>