<?php
require_once 'models/Post.php';
require_once 'config/Database.php';
require_once 'models/Like.php';

class DashboardController {
    private $db;
    private $post;

    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->post = new Post($this->db);
    }

    public function index() {
        // Fetch all posts
        $result = $this->post->getAllPosts();
        $posts = $result->fetchAll(PDO::FETCH_ASSOC);
        
        $likeModel = new Like($this->db);
        
        foreach ($posts as &$post) {
            $post['likeCount'] = $likeModel->getLikeCount($post['id']);
            $post['isLiked'] = $likeModel->hasUserLiked($_SESSION['user_id'], $post['id']);
        }
        
        require_once 'views/dashboard/index.php';
    }

    public function default() {
        $this->index();
    }
} 