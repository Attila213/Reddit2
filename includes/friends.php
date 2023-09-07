<div class="container">
    <div class="row negative-margin">
        <?php
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

