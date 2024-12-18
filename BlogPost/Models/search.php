<?php
class Search {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function search($query) {
        $results = [];
        
        // Search users
        $userQuery = "SELECT id, username, profile_picture, 'user' as type 
                     FROM users 
                     WHERE username LIKE :query 
                     LIMIT 5";
        
        $stmt = $this->conn->prepare($userQuery);
        $searchTerm = "%{$query}%";
        $stmt->bindParam(":query", $searchTerm);
        $stmt->execute();
        $results['users'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Search posts
        $postQuery = "SELECT p.id, p.title, p.content, u.username, u.profile_picture, 'post' as type 
                     FROM posts p 
                     JOIN users u ON p.user_id = u.id 
                     WHERE p.title LIKE :query OR p.content LIKE :query 
                     LIMIT 5";
        
        $stmt = $this->conn->prepare($postQuery);
        $stmt->bindParam(":query", $searchTerm);
        $stmt->execute();
        $results['posts'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
} 