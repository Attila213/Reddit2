<?php
include(__DIR__ . '/../config.php');

if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = hash("sha256", $_POST["password"]);
    
    $checkQuery = $conn->prepare("SELECT username, email FROM users WHERE username = ? OR email = ?");
    $checkQuery->bind_param("ss", $username, $email);
    $checkQuery->execute();
    $result = $checkQuery->get_result();
    
    if ($result->num_rows > 0) {
        echo "0";
    } else {
        $insertQuery = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $insertQuery->bind_param("sss", $username, $email, $password);
        $insertQuery->execute();
        $insertQuery->close();

        echo "1";
    }
    
    $checkQuery->close();
    $conn->close();
}
?>
