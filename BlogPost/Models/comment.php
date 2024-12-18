<?php
class Comment {
    private $conn;
    private $table = "comments";

    public $id;
    public $post_id;
    public $user_id;
    public $content;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                 SET post_id=:post_id, 
                     user_id=:user_id, 
                     content=:content,
                     parent_id=:parent_id";

        $stmt = $this->conn->prepare($query);

        $this->content = htmlspecialchars(strip_tags($this->content));

        $stmt->bindParam(":post_id", $this->post_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":parent_id", $this->parent_id);

        return $stmt->execute();
    }

    public function getCommentsByPostId($post_id) {
        $query = "SELECT c.*, u.username, u.profile_picture,
                         (SELECT COUNT(*) FROM " . $this->table . " WHERE parent_id = c.id) as reply_count
                  FROM " . $this->table . " c
                  JOIN users u ON c.user_id = u.id
                  WHERE c.post_id = ? AND c.parent_id IS NULL
                  ORDER BY c.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$post_id]);
        
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch replies for each comment
        foreach ($comments as &$comment) {
            $comment['replies'] = $this->getRepliesByCommentId($comment['id']);
        }

        return $comments;
    }

    public function delete($id, $user_id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id, $user_id]);
    }

    public function getCommentById($id) {
        $query = "SELECT c.*, u.username, u.profile_picture 
                 FROM " . $this->table . " c
                 JOIN users u ON c.user_id = u.id
                 WHERE c.id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table . " 
                 SET content = :content 
                 WHERE id = :id AND user_id = :user_id";

        $stmt = $this->conn->prepare($query);

        $this->content = htmlspecialchars(strip_tags($this->content));

        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);

        return $stmt->execute();
    }

    public function getRepliesByCommentId($comment_id) {
        $query = "SELECT c.*, u.username, u.profile_picture
                 FROM " . $this->table . " c
                 JOIN users u ON c.user_id = u.id
                 WHERE c.parent_id = ?
                 ORDER BY c.created_at ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$comment_id]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 