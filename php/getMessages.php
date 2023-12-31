<?php
    include(__DIR__ . '/../config.php');
    include(__DIR__ . '/../php/Classes/Comment.php');

    if (isset($_POST["fid"]) && $_POST["type"] == "msg") {
        $fID = $_POST["fid"];
        
        //lekérdezni hogy az üzenetek táblában az id1 vagy az id2 küldött-e egymásnak valami és ezt idő szerint növekvő sorrendbein visszadja 
        $query = "SELECT * FROM messages WHERE (sender_id = ".$_SESSION["userID"]." AND receiver_id = ".$fID.") OR (sender_id = ".$fID." AND receiver_id = ".$_SESSION["userID"].") ORDER BY created_at ASC";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            if($row["sender_id"] == $_SESSION["userID"]){
                echo "<p class='alreadyvoted'>". $row['message']."</p>";
            }
            else{
                echo "<p>". $row['message']."</p>";
            }
        }
    }

    if ($_POST["type"] == "cmt" && isset($_POST["postID"])) {
        //lekéri az adott post kommentjeit
        $query = "SELECT * FROM comments where post_id = ".$_POST["postID"]." ORDER BY created_at DESC";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            //aztán meghívja rá a Comment megrajzolómentódusát
            $comment = new Comment($conn, $row["id"]);
            $comment->drawComment();
        }
    }
?>