<?php

include(__DIR__ . '/../config.php');

if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = hash("sha256", $_POST["password"]); 

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND username = ? AND password = ?");
    $stmt->bind_param("sss", $email, $username, $password);
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($id);

    
    if ($stmt->num_rows > 0) {
        echo "1";

        while ($stmt->fetch()) {
            $_SESSION["userID"]=$id;
            $_SESSION["username"]=$username;

        }
    } else {
        echo "0";
    }

    
    $stmt->close();
    $conn->close();
}
?>
