<?php
    include(__DIR__ . '/../config.php');

    if (isset($_POST["fid"])) {
        $fID = $_POST["fid"];
        
        $query = "SELECT * FROM messages WHERE (sender_id = ".$_SESSION["userID"]." AND receiver_id = ".$fID.") OR (sender_id = ".$fID." AND receiver_id = ".$_SESSION["userID"].") ORDER BY created_at ASC";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>". $row['message']."</p>";
        }
    }
?>