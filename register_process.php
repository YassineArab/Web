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

    if ($action == 'Sign-In') {
        header('Location: index.php');
        exit();
    } elseif ($action == 'Create') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];

        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $is_username_exists = $stmt->num_rows > 0;
        $stmt->close();

        if ($is_username_exists) {
            echo "Sorry, this username already exists. Please, choose another one.";
        } elseif ($password !== $confirm_password) {
            echo "Sorry, you entered 2 different passwords.";
        } elseif (empty($first_name) || is_numeric($first_name[0])) {
            echo "Sorry, your first name cannot be empty or start with a digit or number.";
        } elseif (empty($last_name) || is_numeric($last_name[0])) {
            echo "Sorry, your last name cannot be empty or start with a digit or number.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $
            $hashed_password, $first_name, $last_name);
            $stmt->execute();
            $stmt->close();

            echo "Account created successfully!";
            echo "<br>";
            echo "<a href='index.php'>Click here to Sign In</a>";
        }
    }
}

$conn->close();
?>
