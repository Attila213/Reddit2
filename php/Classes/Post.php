<?php
include(__DIR__."/../../config.php");
class Post {
    public $id;
    public $user_id;
    public $title;
    public $content;
    public $created_at;
    public $upvote;
    public $downvote;
    public $conn;


    public function __construct($id, $conn) {
        $this->id = $id;
        $this->conn = $conn;
        $sql = "SELECT `id`, `user_id`, `title`, `content`, `created_at`, `upvote`, `downvote` FROM `posts` WHERE `id` = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->user_id = $row['user_id'];
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->created_at = $row['created_at'];
            $this->upvote = $row['upvote'];
            $this->downvote = $row['downvote'];
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpvote() {
        return $this->upvote;
    }

    public function getDownvote() {
        return $this->downvote;
    }

    public function getImages() {
        $images = array();

        $query = "SELECT `image_link` FROM `images` WHERE `post_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $images[] = $row["image_link"];
        }

        $stmt->close();

        return $images;
    }
    public function drawPost() {
        $images = "";
        $images_arr = array();
        foreach ($this->getImages() as $i) {
            $images .= $i . " ";
            array_push($images_arr,$i);
        }
        echo '<div class="postContainer">
        
            <div class="title"><a href="?page=post&ID='.$this->getID().'"><h1>'.$this->getTitle().'</h1></a></div>
            <div class="textContent">'.$this->getContent().'</div>
        <div class="imagesContainer" count="0" images="'.$images.'">
            <button class="dropdown-item nextImage">Következő kép</button>
            <button class="dropdown-item previousImage">Előző kép</button>
            <div>
                <img src="'.$images_arr[0].'">
            </div>
        </div>
        <div class="postVotes d-flex justify-content-around">
            <input class="postID" type="hidden" value="'.$this->getID().'">
            <button class="vote" typeV="d"><i class="fa-solid fa-arrow-up"></i></button>
            <button class="vote" typeV="u"><i class="fa-solid fa-arrow-down"></i></button>
        </div>
        </div>';

    }
}



?>
