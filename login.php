<?php
session_start();


$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'your_password';
$db_name = 'your_database';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'Sign-Up') {
        header('Location: register.php');
        exit();
    } elseif ($action == 'Connect') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        $stmt->close();

        if ($hashed_password && password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            header('Location: game.php'); 
            exit();
        } else {
            echo "Sorry, you entered a wrong username or password!";
            echo "<br>";
            echo "<a href='change_password.php'>Forgotten? Please, change your password.</a>";
        }
    }
}

$conn->close();
?>
