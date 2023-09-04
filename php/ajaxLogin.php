<?php

include(__DIR__ . '/../config.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = hash("sha256", $_POST["password"]); // Hash the provided password

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND username = ? AND password = ?");
    $stmt->bind_param("sss", $email, $username, $password);
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($id);

    
    if ($stmt->num_rows > 0) {
        echo "Van";

        while ($stmt->fetch()) {
            $_SESSION["userID"]="$id";
        }
    } else {
        echo "Nincs";
    }

    
    $stmt->close();
    $conn->close();
}
?>
