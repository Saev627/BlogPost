<?php
class Profile {
    private $conn;
    private $table = "users";

    public $id;
    public $username;
    public $email;
    public $password;
    public $profile_picture;
    public $bio;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUserProfile($id) {
        $query = "SELECT id, username, email, profile_picture, bio FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile() {
        $query = "UPDATE " . $this->table . " 
                 SET username = :username, 
                     bio = :bio, 
                     profile_picture = :profile_picture 
                 WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":bio", $this->bio);
        $stmt->bindParam(":profile_picture", $this->profile_picture);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function updatePassword($new_password) {
        $query = "UPDATE " . $this->table . " SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function verifyCurrentPassword($current_password) {
        $query = "SELECT password FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return password_verify($current_password, $user['password']);
    }

    public function getPasswordHash($userId) {
        $query = "SELECT password FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['password'] : null;
    }

    public function updatePasswordHash($newPasswordHash) {
        $query = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$newPasswordHash, $this->id]);
    }
} 