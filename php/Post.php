<?php
include(__DIR__."/../config.php");
class Post {
    public $id;
    public $user_id;
    public $title;
    public $content;
    public $created_at;
    public $upvote;
    public $downvote;

    public function __construct($id, $conn) {
        $this->id = $id;

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

    public function drawPost() {
        echo '<div class="postContainer">
            <div class="title"><h1>'.$this->getTitle().'</h1></div>
            <div class="textContent">'.$this->getContent().'</div>
            <div class="postVotes">
                <button class="upvote" ><i class="fa-solid fa-arrow-up"></i></button>
                <button class="upvote"><i class="fa-solid fa-arrow-down"></i></button>
            </div>
        </div>';
    }
}



?>
