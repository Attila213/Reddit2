<?php
include(__DIR__ . '/../config.php');

if (isset($_POST["text"]) && isset($_POST["fid"])) {
    $text = $_POST["text"];
    $fID = $_POST["fid"];
    
    $insertQuery = $conn->prepare("INSERT INTO `messages`(`id`, `sender_id`, `receiver_id`, `message`, `created_at`) VALUES (NULL,?,?,?, NOW())");
    $insertQuery->bind_param("iis", $_SESSION["userID"], $fID, $text);
    $insertQuery->execute();
    $insertQuery->close();
    
    $conn->close();
}
?>
