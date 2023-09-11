<?php
include(__DIR__ . '/../config.php');


//beinzertál egy baráti kapcsolatot oda-vissza
if (isset($_POST["id"]) && $_POST["type"] =="add") {

    $insertQuery = "INSERT INTO friendships (user1_id, user2_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ii", $_POST["id"], $_SESSION["userID"]);
    $stmt->execute();

    $insertQuery = "INSERT INTO friendships (user1_id, user2_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("ii", $_SESSION["userID"], $_POST["id"]);
    $stmt->execute();

    echo $_POST["id"]. "is your friend now";
}

//kitörli a baráti kapcsolatokat két ember közt
if (isset($_POST["id"]) && $_POST["type"] == "remove") {

    if (isset($_POST["id"]) && $_POST["type"]="remove") {
        $deleteQuery1 = "DELETE FROM friendships WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?)";
        $stmt1 = $conn->prepare($deleteQuery1);
        $stmt1->bind_param("iiii", $_POST["id"], $_SESSION["userID"], $_SESSION["userID"], $_POST["id"]);
        $stmt1->execute();
    }

    echo "mostmár ".$_POST["id"]." not your friend anymore";

    
}
?>
