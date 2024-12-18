<?php
require_once 'models/Comment.php';
require_once 'config/Database.php';

class CommentController {
    private $db;
    private $commentModel;
    private $errors = [];

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->commentModel = new Comment($this->db);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=dashboard');
            exit;
        }

        $post_id = $_POST['post_id'] ?? null;
        $content = $_POST['content'] ?? '';
        $parent_id = $_POST['parent_id'] ?? null;

        if (!$post_id || empty(trim($content))) {
            $this->errors['content'] = "Comment content cannot be empty";
            header('Location: index.php?controller=post&action=view&id=' . $post_id);
            exit;
        }

        $this->commentModel->post_id = $post_id;
        $this->commentModel->user_id = $_SESSION['user_id'];
        $this->commentModel->content = $content;
        $this->commentModel->parent_id = $parent_id;

        if ($this->commentModel->create()) {
            header('Location: index.php?controller=post&action=view&id=' . $post_id);
            exit;
        } else {
            $this->errors['general'] = "Something went wrong";
            header('Location: index.php?controller=post&action=view&id=' . $post_id);
            exit;
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=dashboard');
            exit;
        }

        $comment_id = $_POST['comment_id'] ?? null;
        $post_id = $_POST['post_id'] ?? null;

        if ($comment_id && $this->commentModel->delete($comment_id, $_SESSION['user_id'])) {
            header('Location: index.php?controller=post&action=view&id=' . $post_id);
            exit;
        } else {
            $this->errors['general'] = "Unable to delete comment";
            header('Location: index.php?controller=post&action=view&id=' . $post_id);
            exit;
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment_id = $_POST['comment_id'] ?? null;
            $post_id = $_POST['post_id'] ?? null;
            $content = $_POST['content'] ?? '';

            if (!$comment_id || empty(trim($content))) {
                $this->errors['content'] = "Comment content cannot be empty";
                header('Location: index.php?controller=post&action=view&id=' . $post_id);
                exit;
            }

            $comment = $this->commentModel->getCommentById($comment_id);
            
            if (!$comment || $comment['user_id'] != $_SESSION['user_id']) {
                header('Location: index.php?controller=post&action=view&id=' . $post_id);
                exit;
            }

            $this->commentModel->id = $comment_id;
            $this->commentModel->user_id = $_SESSION['user_id'];
            $this->commentModel->content = $content;

            if ($this->commentModel->update()) {
                header('Location: index.php?controller=post&action=view&id=' . $post_id);
                exit;
            } else {
                $this->errors['general'] = "Unable to update comment";
                header('Location: index.php?controller=post&action=view&id=' . $post_id);
                exit;
            }
        }
    }

    public function getReplies() {
        // Turn off error reporting for this method
        error_reporting(0);
        ini_set('display_errors', 0);
        
        // Clear any previous output
        if (ob_get_level()) {
            ob_end_clean();
        }
        
        header('Content-Type: application/json');
        
        if (!isset($_GET['comment_id'])) {
            echo json_encode(['error' => 'Comment ID required']);
            exit;
        }

        try {
            $replies = $this->commentModel->getRepliesByCommentId($_GET['comment_id']);
            
            if (!is_array($replies)) {
                echo json_encode(['error' => 'Invalid reply data']);
                exit;
            }
            
            // Format dates and escape HTML
            foreach ($replies as &$reply) {
                $reply = array_merge($reply, [
                    'content' => htmlspecialchars($reply['content']),
                    'username' => htmlspecialchars($reply['username']),
                    'created_at' => date('M d, Y', strtotime($reply['created_at'])),
                    'profile_picture' => $reply['profile_picture'] ? htmlspecialchars($reply['profile_picture']) : null,
                    'is_owner' => ($reply['user_id'] == $_SESSION['user_id'])
                ]);
            }

            echo json_encode($replies);
            
        } catch (Exception $e) {
            echo json_encode(['error' => 'Failed to load replies']);
        }
        exit;
    }
} 