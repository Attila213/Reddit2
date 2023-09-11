<?php
include(__DIR__ . '/../config.php');

if (isset($_POST["postId"]) && isset($_POST["voteType"])) {
    $postId = $_POST["postId"];
    $voteType = $_POST["voteType"];
    $userId = $_SESSION["userID"]; 

    //lekéri hogy van-e szavazat rajta
    $getVoteQuery = "SELECT vote_type FROM post_votes WHERE post_id = ? AND user_id = ?";
    $stmt = $conn->prepare($getVoteQuery);
    $stmt->bind_param("ii", $postId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    //ha van akkor frissíti azt
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $previousVoteType = $row["vote_type"];
        
        if ($previousVoteType !== $voteType) {
            $updateQuery = "UPDATE post_votes SET vote_type = ? WHERE post_id = ? AND user_id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("sii", $voteType, $postId, $userId);
            $stmt->execute();
            $stmt->close();

            
            echo "Vote updated successfully.";
        } else {
            echo "User's vote is already the same type.";
        }
    } else {
        //ha nincs akkor inzertál egyet a kapott szavazat típusa alapján

        $insertQuery = "INSERT INTO post_votes (post_id, user_id, vote_type) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iis", $postId, $userId, $voteType);
        $stmt->execute();
        $stmt->close();

        echo "Vote inserted successfully.";
    }
} else {
    echo "Invalid data.";
}

$conn->close();
?>
