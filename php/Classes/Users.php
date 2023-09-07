<?php
class User {
    private $id;
    private $username;
    private $email;
    private $conn;

    public function __construct($conn, $id) {
        $this->conn = $conn;
        $this->id = $id;
        $this->fetchUserData();
    }

    private function fetchUserData() {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->username = $row['username'];
            $this->email = $row['email'];
        }
        
        $stmt->close();
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function displayUserInfo() {
        echo '<div class="userContainer col-lg-3 col-md-3 col-sm-6 col-12 row">
            <div class="username col-8">' .$this->username . '</div>';
            if($this->boolFriends($_SESSION["userID"],$this->getId())){
                echo '<div class="username col-4" id="'.$this->id.'"><button class="removeF"><i class="fa-solid fa-check"></i></button><button class="addF alreadFriend"><i class="fa-solid fa-plus"></i></button></div></div>';
            }else{

                echo '<div class="username col-4" id="'.$this->id.'"><button class="removeF"><i class="fa-solid fa-check"></i></button><button class="addF"><i class="fa-solid fa-plus"></i></button></div></div>';
            }


    }

    public function boolFriends($userID1,$userID2){
        $query = "SELECT * FROM friendships WHERE (user1_id = ? AND user2_id = ?) OR (user2_id = ? AND user1_id = ?)";
        // $query2 = "SELECT * FROM friendships WHERE (user1_id = ".$userID1." AND user2_id = ".$userID2.") OR (user2_id = ".$userID2." AND user1_id = ".$userID1.")";
        // echo $query2;

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiii", $userID1, $userID2, $userID2, $userID1);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return True;
        } else {
            return False;
        }
    }
}

?>
