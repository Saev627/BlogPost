<?php
class Like {
    private $conn;
    private $table = 'likes';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function toggleLike($userId, $postId) {
        // Check if like exists
        $query = "SELECT id FROM " . $this->table . " WHERE user_id = ? AND post_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$userId, $postId]);

        if ($stmt->rowCount() > 0) {
            // Unlike
            $query = "DELETE FROM " . $this->table . " WHERE user_id = ? AND post_id = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$userId, $postId]);
        } else {
            // Like
            $query = "INSERT INTO " . $this->table . " (user_id, post_id) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$userId, $postId]);
        }
    }

    public function getLikeCount($postId) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table . " WHERE post_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$postId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public function hasUserLiked($userId, $postId) {
        $query = "SELECT id FROM " . $this->table . " WHERE user_id = ? AND post_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$userId, $postId]);
        return $stmt->rowCount() > 0;
    }
} 