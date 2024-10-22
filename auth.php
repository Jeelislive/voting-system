<?php
if(!isset($_SESSION)) {
    header("Location: login.php");
}

session_start();

$conn = new mysqli("localhost", "root", "", "voting_portal");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit']) && $_POST['submit'] == "Login") {
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE mobile = ? AND password = ? AND role = ?");
        $stmt->bind_param("sss", $mobile, $password, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows !== 1) {
            header("Location: login.php?login-error=true");
            exit();
        }

        $_SESSION['mobile'] = $mobile;
        header("Location: dashboard.php");
        exit();
    }

    if(isset($_POST['submit']) && $_POST['submit'] == "Register") {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $address = $_POST['address'];
        $image_link = $_POST['image_link'] ?: 'https://i.pravatar.cc/100';
        $role = $_POST['role'];
        $has_voted = 0;

        $stmt = $conn->prepare("SELECT * FROM users WHERE mobile = ?");
        $stmt->bind_param("s", $mobile);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($password1 !== $password2 || $result->num_rows > 0) {
            header("Location: signup.php?signup-error=true");
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO users (name, mobile, password, address, image_link, role, has_voted) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $name, $mobile, $password1, $address, $image_link, $role, $has_voted);
        $stmt->execute();

        header("Location: login.php?signup-success=true");
        exit();
    }

    if (isset($_POST['submit']) && $_POST['submit'] == "Reset") {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE mobile = ? AND name = ?");
        $stmt->bind_param("ss", $mobile, $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0 || $password1 !== $password2) {
            header("Location: forgotPassword.php?forgot-error=true");
            exit();
        }

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE mobile = ?");
        $stmt->bind_param("ss", $password1, $mobile);
        $stmt->execute();

        header("Location: login.php?password-reset=true");
        exit();
    }

    if (isset($_POST['submit']) && $_POST['submit'] == "Logout") {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>
