<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
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
        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            max-width: 700px;
            margin: 0 auto;
            overflow: hidden;
        }
        .profile-cover {
            height: 200px;
            background: linear-gradient(45deg, #1a73e8, #34a853);
            position: relative;
        }
        .profile-header {
            text-align: center;
            margin-top: -75px;
            padding: 0 30px 30px;
            position: relative;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .profile-picture-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #adb5bd;
            margin: 0 auto 20px;
            border: 5px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .profile-name {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 5px;
        }
        .profile-info {
            padding: 0 30px 30px;
        }
        .info-section {
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #eee;
        }
        .info-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .info-label {
            font-weight: 600;
            color: #666;
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-value {
            color: #1a1a1a;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        .profile-actions {
            padding: 30px;
            background-color: #f8f9fa;
            display: flex;
            gap: 12px;
            justify-content: center;
        }
        .profile-actions a {
            padding: 12px 24px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .profile-actions .btn-submit {
            background-color: #1a73e8;
            color: white;
            border: none;
            box-shadow: 0 2px 4px rgba(26,115,232,0.2);
        }
        .profile-actions .btn-submit:hover {
            background-color: #1557b0;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(26,115,232,0.3);
        }
        .profile-actions .btn-cancel {
            background-color: white;
            color: #5f6368;
            border: 1px solid #dadce0;
        }
        .profile-actions .btn-cancel:hover {
            background-color: #f8f9fa;
            border-color: #5f6368;
            color: #1a1a1a;
        }
        .empty-bio {
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php?controller=dashboard">
                <i class="bi bi-arrow-left"></i>
                Back to Feed
            </a>
        </div>
    </nav>

    <div class="main-content">
        <div class="profile-card">
            <div class="profile-cover"></div>
            <div class="profile-header">
                <?php if(!empty($userProfile['profile_picture'])): ?>
                    <img src="<?php echo htmlspecialchars($userProfile['profile_picture']); ?>" 
                         class="profile-picture" alt="Profile Picture">
                <?php else: ?>
                    <div class="profile-picture-placeholder">
                        <i class="bi bi-person"></i>
                    </div>
                <?php endif; ?>
                <h1 class="profile-name"><?php echo htmlspecialchars($userProfile['username']); ?></h1>
            </div>

            <div class="profile-info">
                <div class="info-section">
                    <div class="info-label">Email Address</div>
                    <div class="info-value"><?php echo htmlspecialchars($userProfile['email']); ?></div>
                </div>

                <div class="info-section">
                    <div class="info-label">About</div>
                    <div class="info-value">
                        <?php if(!empty($userProfile['bio'])): ?>
                            <?php echo nl2br(htmlspecialchars($userProfile['bio'])); ?>
                        <?php else: ?>
                            <span class="empty-bio">No bio added yet.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="profile-actions">
                <a href="index.php?controller=profile&action=edit" class="btn-submit">
                    <i class="bi bi-pencil-square"></i>
                    Edit Profile
                </a>
                <a href="index.php?controller=profile&action=changePassword" class="btn-cancel">
                    <i class="bi bi-shield-lock"></i>
                    Change Password
                </a>
            </div>
        </div>
    </div>
</body>
</html> 