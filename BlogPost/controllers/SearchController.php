<?php
require_once 'models/Search.php';
require_once 'config/Database.php';

class SearchController {
    private $db;
    private $search;

    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->search = new Search($this->db);
    }

    public function index() {
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';
        
        if(!empty($query)) {
            $results = $this->search->search($query);
            require_once 'views/search/results.php';
        } else {
            header("Location: index.php?controller=dashboard");
            exit();
        }
    }

    public function ajax() {
        header('Content-Type: application/json');
        $query = isset($_GET['q']) ? trim($_GET['q']) : '';
        
        if(!empty($query)) {
            $results = $this->search->search($query);
            echo json_encode($results);
        } else {
            echo json_encode([]);
        }
        exit();
    }
} 