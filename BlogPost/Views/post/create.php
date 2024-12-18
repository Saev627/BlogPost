<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .post-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 25px;
            margin-top: 20px;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #212529;
            margin-bottom: 20px;
        }
        .btn-submit {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
        }
        .btn-cancel {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            margin-right: 10px;
        }
        .btn-cancel:hover {
            background-color: #5c636a;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="post-card">
            <h2 class="card-title">Create New Post</h2>
            
            <?php if(isset($errors['general'])): ?>
                <div class="alert alert-danger">
                    <?php echo $errors['general']; ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control <?php echo isset($errors['title']) ? 'is-invalid' : ''; ?>" required>
                    <?php if(isset($errors['title'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['title']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control <?php echo isset($errors['content']) ? 'is-invalid' : ''; ?>" rows="6" required></textarea>
                    <?php if(isset($errors['content'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['content']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Media (Optional)</label>
                    <input type="file" name="media" class="form-control <?php echo isset($errors['media']) ? 'is-invalid' : ''; ?>" accept="image/*,video/*">
                    <?php if(isset($errors['media'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['media']; ?>
                        </div>
                    <?php endif; ?>
                    <small class="text-muted">Supported formats: JPG, PNG, GIF, MP4, WebM</small>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="index.php?controller=dashboard" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Create Post</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 