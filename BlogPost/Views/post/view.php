<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($post['title']); ?></title>
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
        .main-content {
            padding-top: 90px;
            min-height: 100vh;
            background-color: #f0f2f5;
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
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #666;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.2s ease;
            margin-bottom: 20px;
        }
        .back-button:hover {
            background-color: #f0f2f5;
            color: #333;
        }
        .single-post {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            padding: 30px;
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
        .comments-section {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #e4e6eb;
        }
        .comments-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1a1a1a;
        }
        .comment-form .input-group {
            gap: 10px;
        }
        .comment-form textarea {
            border-radius: 20px;
            padding: 12px 20px;
            resize: none;
            border-color: #e4e6eb;
        }
        .comment-form .btn {
            border-radius: 20px;
            padding: 8px 20px;
        }
        .comment-item {
            padding: 15px;
            border-radius: 10px;
            background-color: #f8f9fa;
            margin-bottom: 15px;
        }
        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }
        .comment-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .comment-user-picture {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
        .comment-user-placeholder {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #e4e6eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: #65676b;
        }
        .comment-user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .comment-author {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1a1a1a;
        }
        .comment-date {
            font-size: 0.75rem;
            color: #65676b;
        }
        .comment-content {
            color: #1a1a1a;
            font-size: 0.9rem;
            line-height: 1.4;
        }
        .reply-form {
            margin-left: 40px;
            margin-top: 10px;
        }
        .replies-container {
            margin-left: 40px;
            margin-top: 10px;
        }
        .reply-item {
            padding: 10px;
            border-left: 2px solid #e4e6eb;
            margin-bottom: 10px;
        }
        .reply-content {
            margin-left: 40px;
            color: #1a1a1a;
            font-size: 0.9rem;
        }
        .comment-footer {
            margin-top: 8px;
            display: flex;
            gap: 10px;
        }
        .comment-footer .btn-link {
            color: #65676b;
            text-decoration: none;
            padding: 0;
        }
        .comment-footer .btn-link:hover {
            color: #1a1a1a;
        }
        .post-actions {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e1e3e6;
        }
        .btn-like {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: none;
            background: #f0f2f5;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-like:hover {
            background: #e4e6eb;
        }
        .btn-like.liked {
            color: #e41e3f;
            background: #ffebee;
        }
        .btn-like.liked:hover {
            background: #ffe6e9;
        }
        .like-count {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Include the same navbar as dashboard -->
    
    <div class="main-content">
        <div class="container">
            <div class="mb-4">
                <a href="index.php?controller=dashboard" class="back-button">
                    <i class="bi bi-arrow-left"></i>
                    Back to Feed
                </a>
            </div>
            
            <div class="single-post">
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
                
                <h1 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h1>
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

                <div class="comments-section mt-4">
                    <h4 class="comments-title mb-3">Comments</h4>
                    
                    <!-- Comment Form -->
                    <form method="POST" action="index.php?controller=comment&action=create" class="comment-form mb-4">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <div class="input-group">
                            <textarea class="form-control" name="content" rows="2" 
                                      placeholder="Write a comment..." required></textarea>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>

                    <!-- Comments List -->
                    <?php if (!empty($comments)): ?>
                        <div class="comments-list">
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment-item" id="comment-<?php echo $comment['id']; ?>">
                                    <div class="comment-header">
                                        <div class="comment-user">
                                            <?php if(!empty($comment['profile_picture'])): ?>
                                                <img src="<?php echo htmlspecialchars($comment['profile_picture']); ?>" 
                                                     class="comment-user-picture" alt="User Picture">
                                            <?php else: ?>
                                                <div class="comment-user-placeholder">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="comment-user-info">
                                                <span class="comment-author"><?php echo htmlspecialchars($comment['username']); ?></span>
                                                <span class="comment-date">
                                                    <?php echo date('M d, Y', strtotime($comment['created_at'])); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <?php if($comment['user_id'] == $_SESSION['user_id']): ?>
                                            <form method="POST" action="index.php?controller=comment&action=delete" class="d-inline">
                                                <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                <button type="submit" class="btn btn-link text-danger btn-sm" 
                                                        onclick="return confirm('Delete this comment?');">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                    <div class="comment-content" id="comment-content-<?php echo $comment['id']; ?>">
                                        <?php echo nl2br(htmlspecialchars($comment['content'])); ?>
                                    </div>
                                    
                                    <!-- Reply button -->
                                    <div class="comment-footer">
                                        <button class="btn btn-link btn-sm" onclick="toggleReplyForm(<?php echo $comment['id']; ?>)">
                                            <i class="bi bi-reply"></i> Reply
                                        </button>
                                    </div>

                                    <!-- Reply form (hidden by default) -->
                                    <div class="reply-form d-none" id="reply-form-<?php echo $comment['id']; ?>">
                                        <form method="POST" action="index.php?controller=comment&action=create">
                                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                            <input type="hidden" name="parent_id" value="<?php echo $comment['id']; ?>">
                                            <div class="input-group">
                                                <textarea class="form-control" name="content" rows="1" 
                                                          placeholder="Write a reply..." required></textarea>
                                                <button type="submit" class="btn btn-primary">Reply</button>
                                                <button type="button" class="btn btn-secondary" 
                                                        onclick="toggleReplyForm(<?php echo $comment['id']; ?>)">Cancel</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Replies container -->
                                    <div class="replies-container" id="replies-<?php echo $comment['id']; ?>">
                                        <?php foreach ($comment['replies'] as $reply): ?>
                                            <div class="reply-item">
                                                <div class="comment-user">
                                                    <?php if(!empty($reply['profile_picture'])): ?>
                                                        <img src="<?php echo htmlspecialchars($reply['profile_picture']); ?>" 
                                                             class="comment-user-picture" alt="User Picture">
                                                    <?php else: ?>
                                                        <div class="comment-user-placeholder">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="comment-user-info">
                                                        <span class="comment-author"><?php echo htmlspecialchars($reply['username']); ?></span>
                                                        <span class="comment-date">
                                                            <?php echo date('M d, Y', strtotime($reply['created_at'])); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="reply-content">
                                                    <?php echo nl2br(htmlspecialchars($reply['content'])); ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this JavaScript -->
    <script>
    function toggleReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        replyForm.classList.toggle('d-none');
    }
    document.querySelectorAll('.btn-like').forEach(button => {
        button.addEventListener('click', async function() {
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
                    } else {
                        this.classList.remove('liked');
                        icon.classList.replace('bi-heart-fill', 'bi-heart');
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