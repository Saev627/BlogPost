<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
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
        .navbar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
        }
        .nav-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
            font-weight: 500;
            color: #0d6efd;
            text-decoration: none;
        }
        .navbar-brand:hover {
            color: #0b5ed7;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 20px;
            text-decoration: none;
            background-color: #f0f2f5;
            transition: all 0.2s ease;
        }
        .user-profile:hover {
            background-color: #e4e6eb;
        }
        .profile-picture {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-picture-placeholder {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #e4e6eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #65676b;
        }
        .username {
            font-size: 0.9rem;
            font-weight: 500;
            color: #050505;
        }
        .btn-create {
            background-color: #0d6efd;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .btn-create:hover {
            background-color: #0b5ed7;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
        }
        .btn-profile {
            background-color: white;
            color: #444;
            border: 1px solid #e0e0e0;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-profile:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-logout {
            background: none;
            border: none;
            color: #dc3545;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        .btn-logout:hover {
            background-color: #fff5f5;
        }
        .posts-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px 15px;
        }
        .post-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            padding: 25px;
            margin-bottom: 24px;
            border: none;
            transition: box-shadow 0.2s ease;
        }
        .post-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,.1);
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .post-user {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }
        .post-user-picture {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .post-user-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #adb5bd;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .post-user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .post-author {
            font-weight: 600;
            color: #1a1a1a;
            font-size: 0.95rem;
            margin: 0;
        }
        .post-date {
            color: #65676b;
            font-size: 0.8rem;
            margin: 0;
        }
        .post-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        .post-content {
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .post-media {
            margin: 15px 0;
            border-radius: 10px;
            overflow: hidden;
        }
        .post-media img, 
        .post-media video {
            width: 100%;
            border-radius: 10px;
        }
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
        }
        .empty-state h3 {
            color: #333;
            margin-bottom: 10px;
        }
        .empty-state p {
            color: #6c757d;
        }
        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .post-actions {
            display: flex;
            gap: 10px;
        }
        .post-actions form {
            margin: 0;
        }
        .post-actions .btn {
            padding: 6px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }
        .post-actions .btn i {
            font-size: 14px;
        }
        .post-actions .btn-outline-primary {
            border-color: #e0e0e0;
            color: #0d6efd;
        }
        .post-actions .btn-outline-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }
        .post-actions .btn-outline-danger {
            border-color: #e0e0e0;
            color: #dc3545;
        }
        .post-actions .btn-outline-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .main-content {
            padding-top: 90px;
            min-height: 100vh;
            background-color: #f0f2f5;
        }
        .search-container {
            flex: 1;
            max-width: 600px;
            margin: 0 20px;
        }
        
        .search-form {
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 8px 16px 8px 40px;
            border-radius: 20px;
            border: none;
            background-color: #f0f2f5;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        
        .search-input:focus {
            outline: none;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #65676b;
            font-size: 1rem;
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            margin-top: 8px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
        }

        .search-results.active {
            display: block;
        }

        .post-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .post-link:hover {
            color: inherit;
        }
        
        .post-actions {
            position: relative;
            z-index: 2;
        }

        .post-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid #e1e3e6;
        }

        .btn-like {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border: 1px solid #e1e3e6;
            background: white;
            border-radius: 20px;
            cursor: pointer;
            color: #5f6368;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .btn-like:hover {
            background: #f8f9fa;
            border-color: #dadce0;
        }

        .btn-like.liked {
            color: #e41e3f;
            background: #fff1f2;
            border-color: #ffd7dc;
        }

        .btn-like.liked:hover {
            background: #ffe6e9;
            border-color: #ffccd3;
        }

        .btn-like i {
            font-size: 1.1rem;
        }

        .like-count {
            font-weight: 500;
            min-width: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-content">
                <div class="nav-left">
                    <a class="navbar-brand" href="index.php?controller=dashboard">
                        <i class="bi bi-house-door-fill"></i>
                        Feed
                    </a>
                </div>
                
                <div class="search-container">
                    <form class="search-form" action="index.php" method="GET">
                        <input type="hidden" name="controller" value="search">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" class="search-input" name="q" 
                               placeholder="Search users or posts..." 
                               autocomplete="off" data-search>
                        <div class="search-results"></div>
                    </form>
                </div>
                
                <div class="nav-right">
                    <a href="index.php?controller=post&action=create" class="btn-create">
                        <i class="bi bi-plus-lg"></i>
                        Create Post
                    </a>
                    
                    <a href="index.php?controller=profile" class="user-profile">
                        <?php if(!empty($_SESSION['profile_picture'])): ?>
                            <img src="<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" 
                                 class="profile-picture" alt="Profile Picture">
                        <?php else: ?>
                            <div class="profile-picture-placeholder">
                                <i class="bi bi-person"></i>
                            </div>
                        <?php endif; ?>
                        <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </a>

                    <form method="POST" action="index.php?controller=auth&action=logout" style="margin: 0;">
                        <button type="submit" class="btn-logout">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="posts-container">
            <?php if(isset($posts) && !empty($posts)): ?>
                <?php foreach($posts as $post): ?>
                    <div class="post-card">
                        <a href="index.php?controller=post&action=view&id=<?php echo $post['id']; ?>" class="post-link">
                            <div class="post-header">
                                <div class="post-user">
                                    <?php if(!empty($post['profile_picture'])): ?>
                                        <img src="<?php echo htmlspecialchars($post['profile_picture']); ?>" 
                                             class="post-user-picture" alt="User Picture">
                                    <?php else: ?>
                                        <div class="post-user-placeholder">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-user-info">
                                        <span class="post-author"><?php echo htmlspecialchars($post['username']); ?></span>
                                        <span class="post-date"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                                    </div>
                                </div>
                                
                                <?php if($post['user_id'] == $_SESSION['user_id']): ?>
                                    <div class="post-actions">
                                        <a href="index.php?controller=post&action=edit&id=<?php echo $post['id']; ?>" 
                                           class="btn btn-outline-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                            Edit
                                        </a>
                                        <form method="POST" action="index.php?controller=post&action=delete" class="d-inline">
                                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                            <button type="submit" class="btn btn-outline-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this post?');">
                                                <i class="bi bi-trash-fill"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <h3 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                            <p class="post-content"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                            
                            <?php if(!empty($post['media_url'])): ?>
                                <div class="post-media">
                                    <?php if($post['media_type'] === 'image'): ?>
                                        <img src="<?php echo htmlspecialchars($post['media_url']); ?>" alt="Post image">
                                    <?php elseif($post['media_type'] === 'video'): ?>
                                        <video controls>
                                            <source src="<?php echo htmlspecialchars($post['media_url']); ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </a>

                        <div class="post-actions">
                            <button class="btn-like <?php echo $post['isLiked'] ? 'liked' : ''; ?>" 
                                    data-post-id="<?php echo $post['id']; ?>">
                                <i class="bi <?php echo $post['isLiked'] ? 'bi-heart-fill' : 'bi-heart'; ?>"></i>
                                <span class="like-count"><?php echo $post['likeCount']; ?></span>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <h3>No posts yet</h3>
                    <p>Be the first to create a post!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('[data-search]');
        const searchResults = document.querySelector('.search-results');
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if(query.length < 2) {
                searchResults.classList.remove('active');
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`index.php?controller=search&action=ajax&q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';
                        
                        if(data.users.length === 0 && data.posts.length === 0) {
                            searchResults.innerHTML = '<div class="p-3 text-muted">No results found</div>';
                        } else {
                            // Add users
                            if(data.users.length > 0) {
                                searchResults.innerHTML += '<div class="p-2 text-muted small">Users</div>';
                                data.users.forEach(user => {
                                    searchResults.innerHTML += `
                                        <a href="index.php?controller=profile&action=view&id=${user.id}" class="search-result-item">
                                            ${user.profile_picture ? 
                                                `<img src="${user.profile_picture}" class="search-result-image" alt="${user.username}">` :
                                                `<div class="search-result-image d-flex align-items-center justify-content-center bg-light">
                                                    <i class="bi bi-person"></i>
                                                </div>`
                                            }
                                            <div class="search-result-info">
                                                <div class="search-result-name">${user.username}</div>
                                                <div class="search-result-type">User</div>
                                            </div>
                                        </a>
                                    `;
                                });
                            }

                            // Add posts
                            if(data.posts.length > 0) {
                                searchResults.innerHTML += '<div class="p-2 text-muted small">Posts</div>';
                                data.posts.forEach(post => {
                                    searchResults.innerHTML += `
                                        <a href="index.php?controller=post&action=view&id=${post.id}" class="search-result-item">
                                            <div class="search-result-info">
                                                <div class="search-result-name">${post.title}</div>
                                                <div class="search-result-type">by ${post.username}</div>
                                            </div>
                                        </a>
                                    `;
                                });
                            }
                        }
                        searchResults.classList.add('active');
                    });
            }, 300);
        });

        // Close search results when clicking outside
        document.addEventListener('click', function(e) {
            if(!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.classList.remove('active');
            }
        });
    });
    </script>

    <script>
    document.querySelectorAll('.btn-like').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            const postId = this.dataset.postId;
            
            try {
                const response = await fetch('index.php?controller=post&action=like', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `post_id=${postId}`
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Update like count
                    this.querySelector('.like-count').textContent = data.likeCount;
                    
                    // Toggle like button appearance
                    const icon = this.querySelector('i');
                    if (data.isLiked) {
                        this.classList.add('liked');
                        icon.classList.replace('bi-heart', 'bi-heart-fill');
                        if (this.querySelector('.like-text')) {
                            this.querySelector('.like-text').textContent = 'Liked';
                        }
                    } else {
                        this.classList.remove('liked');
                        icon.classList.replace('bi-heart-fill', 'bi-heart');
                        if (this.querySelector('.like-text')) {
                            this.querySelector('.like-text').textContent = 'Like';
                        }
                    }
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });
    </script>
</body>
</html> 