<?php
require_once 'models/Post.php';
require_once 'config/Database.php';
require_once 'models/Comment.php';
require_once 'models/Like.php';

class PostController {
    private $db;
    private $post;
    private $errors = [];
    private $uploadDir = 'uploads/';
    private $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
    private $allowedVideoTypes = ['video/mp4', 'video/webm'];

    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->post = new Post($this->db);

        // Create uploads directory if it doesn't exist
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    private function handleFileUpload() {
        if (isset($_FILES['media']) && $_FILES['media']['error'] === UPLOAD_ERR_OK) {
            $fileType = $_FILES['media']['type'];
            $fileName = uniqid() . '_' . $_FILES['media']['name'];
            $filePath = $this->uploadDir . $fileName;

            if (in_array($fileType, $this->allowedImageTypes)) {
                $this->post->media_type = 'image';
            } elseif (in_array($fileType, $this->allowedVideoTypes)) {
                $this->post->media_type = 'video';
            } else {
                $this->errors['media'] = "Invalid file type. Only images (JPG, PNG, GIF) and videos (MP4, WebM) are allowed.";
                return false;
            }

            if (move_uploaded_file($_FILES['media']['tmp_name'], $filePath)) {
                $this->post->media_url = $filePath;
                return true;
            }

            $this->errors['media'] = "Failed to upload file.";
            return false;
        }
        return true; // No file uploaded is also valid
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->errors = [];
            
            if(empty($_POST['title'])) {
                $this->errors['title'] = "Title is required";
            }
            
            if(empty($_POST['content'])) {
                $this->errors['content'] = "Content is required";
            }

            if(empty($this->errors) && $this->handleFileUpload()) {
                $this->post->user_id = $_SESSION['user_id'];
                $this->post->title = $_POST['title'];
                $this->post->content = $_POST['content'];

                if($this->post->create()) {
                    header("Location: index.php?controller=dashboard");
                    exit();
                } else {
                    $this->errors['general'] = "Failed to create post. Please try again.";
                }
            }
        }
        
        $errors = $this->errors;
        require_once 'views/post/create.php';
    }

    public function edit($id = null) {
        if (!$id) {
            $id = $_GET['id'] ?? null;
        }

        if (!$id) {
            header("Location: index.php?controller=dashboard");
            exit();
        }

        $post = $this->post->getPostById($id);

        // Check if post exists and belongs to current user
        if (!$post || $post['user_id'] != $_SESSION['user_id']) {
            header("Location: index.php?controller=dashboard");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->errors = [];
            
            if (empty($_POST['title'])) {
                $this->errors['title'] = "Title is required";
            }
            
            if (empty($_POST['content'])) {
                $this->errors['content'] = "Content is required";
            }

            if (empty($this->errors)) {
                $this->post->id = $id;
                $this->post->user_id = $_SESSION['user_id'];
                $this->post->title = $_POST['title'];
                $this->post->content = $_POST['content'];
                
                // Handle new media upload
                if (isset($_FILES['media']) && $_FILES['media']['error'] === UPLOAD_ERR_OK) {
                    // Delete old media if exists
                    if (!empty($post['media_url']) && file_exists($post['media_url'])) {
                        unlink($post['media_url']);
                    }
                    $this->handleFileUpload();
                } else {
                    // Keep existing media
                    $this->post->media_type = $post['media_type'];
                    $this->post->media_url = $post['media_url'];
                }

                if ($this->post->update()) {
                    header("Location: index.php?controller=dashboard");
                    exit();
                } else {
                    $this->errors['general'] = "Failed to update post. Please try again.";
                }
            }
        }

        $errors = $this->errors;
        require_once 'views/post/edit.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
            $post_id = $_POST['post_id'];
            
            if ($this->post->delete($post_id, $_SESSION['user_id'])) {
                header("Location: index.php?controller=dashboard");
                exit();
            }
        }
        header("Location: index.php?controller=dashboard");
        exit();
    }

    public function view() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=dashboard');
            exit;
        }
        
        $postId = $_GET['id'];
        $post = $this->post->getPostById($postId);
        
        if (!$post) {
            header('Location: index.php?controller=dashboard');
            exit;
        }
        
        // Get comments for this post
        $commentModel = new Comment($this->db);
        $comments = $commentModel->getCommentsByPostId($postId);
        
        require_once 'models/Like.php';
        $likeModel = new Like($this->db);
        $post['likeCount'] = $likeModel->getLikeCount($postId);
        $post['isLiked'] = $likeModel->hasUserLiked($_SESSION['user_id'], $postId);
        
        require 'views/post/view.php';
    }

    public function like() {
        if (!isset($_POST['post_id']) || !isset($_SESSION['user_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required parameters']);
            return;
        }

        require_once 'models/Like.php';
        $like = new Like($this->db);
        
        $success = $like->toggleLike($_SESSION['user_id'], $_POST['post_id']);
        $newLikeCount = $like->getLikeCount($_POST['post_id']);
        $isLiked = $like->hasUserLiked($_SESSION['user_id'], $_POST['post_id']);
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $success,
            'likeCount' => $newLikeCount,
            'isLiked' => $isLiked
        ]);
    }
} 