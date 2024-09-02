<?php
session_start();

if (!isset($_SESSION['current_index'])) {
    $_SESSION['current_index'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['direction'])) {
        if ($_POST['direction'] === 'right') {
            $_SESSION['current_index'] += 1;
        } elseif ($_POST['direction'] === 'left') {
            $_SESSION['current_index'] -= 1;
        }
    }
}


$startIndex = $_SESSION['current_index'];
$numbers = range($startIndex, $startIndex + 9);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тестовое задание 1</title>
</head>
<body>
<h1>Тестовое задание 1</h1>
<div class="container">
    <div class="number-container">
        <?php foreach ($numbers as $number): ?>
            <div class="number"><?php echo $number; ?></div>
        <?php endforeach; ?>
    </div>
    <form method="POST" class="button-container">
        <button type="submit" name="direction" value="left">Left</button>
        <button type="submit" name="direction" value="right">Right</button>
    </form>
</div>
</body>
</html>

<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-family: Arial, sans-serif;
    }
    .container {
        width: 80%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .number-container {
        display: flex;
        overflow-x: auto;
        gap: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 20px 0;
        white-space: nowrap;
    }
    .number {
        font-size: 24px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .button-container {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .button-container button {
        padding: 10px 20px;
        font-size: 16px;
    }
</style>
