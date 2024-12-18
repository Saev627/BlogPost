<?php
require_once 'models/Profile.php';
require_once 'config/Database.php';

class ProfileController {
    private $db;
    private $profile;
    private $errors = [];
    private $uploadDir = 'uploads/profiles/';
    private $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->profile = new Profile($this->db);
        $this->profile->id = $_SESSION['user_id'];

        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function index() {
        $userProfile = $this->profile->getUserProfile($_SESSION['user_id']);
        require_once 'views/profile/index.php';
    }

    public function edit() {
        $userProfile = $this->profile->getUserProfile($_SESSION['user_id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->errors = [];
            
            // Add debugging
            error_log('Form submitted: ' . print_r($_POST, true));
            error_log('Files submitted: ' . print_r($_FILES, true));

            if(empty($_POST['username'])) {
                $this->errors['username'] = "Username is required";
            }

            // Handle profile picture upload
            if(isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $fileType = $_FILES['profile_picture']['type'];
                if(!in_array($fileType, $this->allowedImageTypes)) {
                    $this->errors['profile_picture'] = "Invalid file type. Only JPG, PNG and GIF are allowed.";
                } else {
                    $fileName = uniqid() . '_' . $_FILES['profile_picture']['name'];
                    $filePath = $this->uploadDir . $fileName;

                    if(move_uploaded_file($_FILES['profile_picture']['tmp_name'], $filePath)) {
                        // Delete old profile picture if exists
                        if(!empty($userProfile['profile_picture']) && file_exists($userProfile['profile_picture'])) {
                            unlink($userProfile['profile_picture']);
                        }
                        $this->profile->profile_picture = $filePath;
                    } else {
                        $this->errors['profile_picture'] = "Failed to upload profile picture.";
                    }
                }
            } else {
                $this->profile->profile_picture = $userProfile['profile_picture'];
            }

            if(empty($this->errors)) {
                $this->profile->username = $_POST['username'];
                $this->profile->bio = $_POST['bio'];

                if($this->profile->updateProfile()) {
                    $_SESSION['username'] = $_POST['username'];
                    header("Location: index.php?controller=profile");
                    exit();
                } else {
                    $this->errors['general'] = "Failed to update profile.";
                }
            }
        }

        $errors = $this->errors;
        require_once 'views/profile/edit.php';
    }

    public function changePassword() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->errors = [];

            // Validate inputs
            if(empty($_POST['current_password'])) {
                $this->errors['current_password'] = "Current password is required";
            }

            if(empty($_POST['new_password'])) {
                $this->errors['new_password'] = "New password is required";
            } elseif(strlen($_POST['new_password']) < 6) {
                $this->errors['new_password'] = "Password must be at least 6 characters";
            }

            if(empty($_POST['confirm_password'])) {
                $this->errors['confirm_password'] = "Please confirm your new password";
            } elseif($_POST['new_password'] !== $_POST['confirm_password']) {
                $this->errors['confirm_password'] = "Passwords do not match";
            }

            if(empty($this->errors)) {
                // Verify current password and update
                if(!password_verify($_POST['current_password'], $this->profile->getPasswordHash($_SESSION['user_id']))) {
                    $this->errors['current_password'] = "Current password is incorrect";
                } else {
                    // Hash the new password
                    $hashedPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                    
                    if($this->profile->updatePasswordHash($hashedPassword)) {
                        $_SESSION['success_message'] = "Password updated successfully";
                        header("Location: index.php?controller=profile");
                        exit();
                    } else {
                        $this->errors['general'] = "Failed to update password";
                    }
                }
            }
        }

        $errors = $this->errors;
        require_once 'views/profile/change_password.php';
    }
} 