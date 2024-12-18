<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
            padding: 15px 0;
            margin-bottom: 30px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 1.25rem;
            font-weight: 500;
            color: #333;
            text-decoration: none;
        }
        .navbar-brand i {
            margin-right: 8px;
        }
        .post-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            padding: 30px;
            margin-top: 20px;
            max-width: 800px;
            margin: 30px auto;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }
        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13,110,253,.1);
        }
        .current-media {
            margin: 10px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .current-media img,
        .current-media video {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,.05);
        }
        .btn-submit {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-submit:hover {
            background-color: #0b5ed7;
            transform: translateY(-1px);
        }
        .btn-cancel {
            background-color: transparent;
            color: #6c757d;
            border: 1px solid #6c757d;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            margin-right: 10px;
            transition: all 0.2s;
        }
        .btn-cancel:hover {
            background-color: #6c757d;
            color: white;
        }
        .text-muted {
            font-size: 0.875rem;
            margin-top: 6px;
        }
        .alert {
            border: none;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
        }
        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 6px;
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

    <div class="container">
        <div class="post-card">
            <h2 class="card-title">Edit Post</h2>
            
            <?php if(isset($errors['general'])): ?>
                <div class="alert alert-danger">
                    <?php echo $errors['general']; ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control <?php echo isset($errors['title']) ? 'is-invalid' : ''; ?>" 
                           value="<?php echo htmlspecialchars($post['title']); ?>" required>
                    <?php if(isset($errors['title'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['title']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control <?php echo isset($errors['content']) ? 'is-invalid' : ''; ?>" 
                              rows="6" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                    <?php if(isset($errors['content'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['content']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if(!empty($post['media_url'])): ?>
                    <div class="mb-4">
                        <label class="form-label">Current Media</label>
                        <div class="current-media">
                            <?php if($post['media_type'] === 'image'): ?>
                                <img src="<?php echo htmlspecialchars($post['media_url']); ?>" style="max-width: 200px;">
                            <?php elseif($post['media_type'] === 'video'): ?>
                                <video style="max-width: 200px;" controls>
                                    <source src="<?php echo htmlspecialchars($post['media_url']); ?>" type="video/mp4">
                                </video>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="mb-4">
                    <label class="form-label">New Media (Optional)</label>
                    <input type="file" name="media" class="form-control" accept="image/*,video/*">
                    <small class="text-muted">Supported formats: JPG, PNG, GIF, MP4, WebM</small>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <a href="index.php?controller=dashboard" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Update Post</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 