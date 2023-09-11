<?php
include(__DIR__ . '/../config.php');

if (isset($_POST["postID"]) && isset($_POST["content"])) {

    $postID = $_POST["postID"];
    $content = $_POST["content"];
    $parentCommentID = null;
    //beinzertálja a kommenteket attól függően hogy valamire válasz-e vagy nem
    if ($parentCommentID === null) {
        $insertQuery = $conn->prepare("INSERT INTO `comments`(`id`, `user_id`, `post_id`, `parent_comment_id`, `content`, `created_at`) VALUES (NULL,?,?,NULL,?, NOW())");
        $insertQuery->bind_param("iss", $_SESSION["userID"], $postID, $content);
    } else {
        $insertQuery = $conn->prepare("INSERT INTO `comments`(`id`, `user_id`, `post_id`, `parent_comment_id`, `content`, `created_at`) VALUES (NULL,?,?,?,?, NOW())");
        $insertQuery->bind_param("iiis", $_SESSION["userID"], $postID, $parentCommentID, $content);
    }
    
    $insertQuery->execute();
    $insertQuery->close();
    
    $conn->close();
}
?>
