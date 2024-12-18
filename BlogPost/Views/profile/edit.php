<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f0f2f5;
            min-height: 100vh;
        }
        .navbar {
            background-color: white;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            padding: 1rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 1.1rem;
            font-weight: 500;
            color: #1a73e8;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .navbar-brand:hover {
            color: #1557b0;
        }
        .navbar-brand i {
            margin-right: 8px;
            font-size: 1.2rem;
        }
        .main-content {
            margin-top: 100px;
            padding: 0 20px;
        }
        .edit-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            max-width: 700px;
            margin: 0 auto;
            overflow: hidden;
        }
        .edit-header {
            padding: 30px;
            border-bottom: 1px solid #eee;
        }
        .edit-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0;
        }
        .edit-body {
            padding: 30px;
        }
        .form-label {
            font-weight: 600;
            color: #666;
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-control {
            border: 1px solid #dadce0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 0 4px rgba(26,115,232,0.1);
        }
        .text-muted {
            font-size: 0.875rem;
            color: #5f6368 !important;
        }
        .current-profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .edit-actions {
            padding: 30px;
            background-color: #f8f9fa;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid #eee;
        }
        .btn-submit, .btn-cancel {
            padding: 12px 24px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-submit {
            background-color: #1a73e8;
            color: white;
            border: none;
            box-shadow: 0 2px 4px rgba(26,115,232,0.2);
        }
        .btn-submit:hover {
            background-color: #1557b0;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(26,115,232,0.3);
        }
        .btn-cancel {
            background-color: white;
            color: #5f6368;
            border: 1px solid #dadce0;
        }
        .btn-cancel:hover {
            background-color: #f8f9fa;
            border-color: #5f6368;
            color: #1a1a1a;
        }
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }
        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 6px;
            color: #d93025;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php?controller=profile">
                <i class="bi bi-arrow-left"></i>
                Back to Profile
            </a>
        </div>
    </nav>

    <div class="main-content">
        <div class="edit-card">
            <div class="edit-header">
                <h2 class="edit-title">Edit Profile</h2>
            </div>
            
            <div class="edit-body">
                <?php if(isset($errors['general'])): ?>
                    <div class="alert alert-danger">
                        <?php echo $errors['general']; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" id="editProfileForm" 
                      action="index.php?controller=profile&action=edit">
                    <div class="mb-4">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" 
                               class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" 
                               value="<?php echo htmlspecialchars($userProfile['username']); ?>" required>
                        <?php if(isset($errors['username'])): ?>
                            <div class="invalid-feedback">
                                <?php echo $errors['username']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control" rows="4" 
                                  placeholder="Tell us about yourself..."><?php echo htmlspecialchars($userProfile['bio'] ?? ''); ?></textarea>
                        <small class="text-muted">Share a little about yourself (optional)</small>
                    </div>

                    <?php if(!empty($userProfile['profile_picture'])): ?>
                        <div class="mb-4">
                            <label class="form-label">Current Profile Picture</label>
                            <div>
                                <img src="<?php echo htmlspecialchars($userProfile['profile_picture']); ?>" 
                                     class="current-profile-picture" alt="Current Profile Picture">
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control" accept="image/*">
                        <small class="text-muted">Upload a new profile picture (optional)</small>
                        <?php if(isset($errors['profile_picture'])): ?>
                            <div class="invalid-feedback d-block">
                                <?php echo $errors['profile_picture']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="edit-actions">
                        <a href="index.php?controller=profile" class="btn-cancel">
                            <i class="bi bi-x-lg"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-check-lg"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 