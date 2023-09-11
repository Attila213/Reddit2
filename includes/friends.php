<div class="container">
    <div class="row negative-margin">
        <?php
        //minden embernak aki nem te vagy csinál egy rublikát akit barátnak jelölhetsz vagy pont hogy tötlheteed mint barát
        //majd lesz egy rész ahol nem egyből barát lesz hanem csak kérelem mert ez így elég veszélyes lenne 

        $query = "SELECT * FROM `users` WHERE id != ".$_SESSION["userID"];
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user = new User($conn,$row["id"]);
                $user->displayUserInfo();
            }
        }
        ?>
    </div>
</div>

