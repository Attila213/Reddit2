<div class="friendsContainer row">

    <div class="friends-list col-2 col-md-3">
        <!-- <h1>Your friends</h1> -->

        <?php
            $loggedInUserID = $_SESSION['userID'];

            $query = "SELECT user2_id,users.username FROM `friendships` INNER JOIN users on user2_id = users.id WHERE user1_id =?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $loggedInUserID);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $friendID = $row['user2_id'];
                $friendName = $row['username'];
                echo '<a href="home.php?page=profile&ID='.$row['user2_id'] .'"><div class="friend d-block">' . $friendName . '</div></a>';
            }

            $stmt->close();
            $conn->close();
        ?>
    </div>
    <div class="chatContainer col-10 col-md-9">
        <div class="sentMessages">
            
        </div>
        <div class="chat-input row">
            <?php
                echo "<input type='hidden' class='fid' value='".$_GET["ID"]."'>";
            ?>
            <input type="text" class="col-8 form-control custom-input" placeholder="Type your message...">
            <button class="btn btn-primary col-2">></button>
        </div>
    </div>
</div>
