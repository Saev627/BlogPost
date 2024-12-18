<?php
class Post {
    private $conn;
    private $table = "posts";

    public $id;
    public $user_id;
    public $title;
    public $content;
    public $media_type;
    public $media_url;
    public $created_at;
    public $username;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                 SET user_id=:user_id, 
                     title=:title, 
                     content=:content, 
                     media_type=:media_type, 
                     media_url=:media_url";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->media_type = htmlspecialchars(strip_tags($this->media_type));
        $this->media_url = htmlspecialchars(strip_tags($this->media_url));

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":media_type", $this->media_type);
        $stmt->bindParam(":media_url", $this->media_url);

        return $stmt->execute();
    }

    public function getAllPosts() {
        $query = "SELECT p.*, u.username, u.profile_picture 
                 FROM " . $this->table . " p
                 JOIN users u ON p.user_id = u.id
                 ORDER BY p.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    public function getPostById($id) {
        $query = "SELECT p.*, u.username, u.profile_picture 
                 FROM " . $this->table . " p
                 JOIN users u ON p.user_id = u.id
                 WHERE p.id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table . " 
                 SET title=:title, content=:content, media_type=:media_type, media_url=:media_url 
                 WHERE id=:id AND user_id=:user_id";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->media_type = htmlspecialchars(strip_tags($this->media_type));
        $this->media_url = htmlspecialchars(strip_tags($this->media_url));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":media_type", $this->media_type);
        $stmt->bindParam(":media_url", $this->media_url);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);

        return $stmt->execute();
    }

    public function delete($id, $user_id) {
        // First get the media info to delete the file
        $query = "SELECT media_url FROM " . $this->table . " WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id, $user_id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        // Delete the media file if it exists
        if ($post && !empty($post['media_url']) && file_exists($post['media_url'])) {
            unlink($post['media_url']);
        }

        // Delete the post from database
        $query = "DELETE FROM " . $this->table . " WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([$id, $user_id]);
    }
    
} 