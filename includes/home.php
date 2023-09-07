<?php

echo '<div class="container">';

if(isset($_SESSION["userID"])){
    createPost();
}
$query = "SELECT * FROM `posts`";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $postObject = new Post($row["id"], $conn);
        $postObject->drawPost();
        echo '</div>';
    }
} else {
    echo "Nincsenek bejegyzések.";
}
?>