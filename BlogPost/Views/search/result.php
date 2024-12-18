<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .main-content {
            padding-top: 100px;
            padding-bottom: 60px;
        }
        .results-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .search-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e9ecef;
        }
        .search-header h1 {
            font-size: 1.8rem;
            color: #212529;
            font-weight: 700;
        }
        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #495057;
            margin: 35px 0 20px;
            padding-left: 10px;
            border-left: 4px solid #0d6efd;
        }
        .result-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .result-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px);
            border-color: #dee2e6;
        }
        .user-result {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
            color: inherit;
        }
        .user-picture {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e9ecef;
        }
        .user-placeholder {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: #6c757d;
        }
        .user-info {
            flex: 1;
        }
        .user-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #212529;
            margin-bottom: 4px;
        }
        .post-result {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .post-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #212529;
            margin-bottom: 8px;
        }
        .post-author {
            color: #6c757d;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .post-author i {
            font-size: 0.9rem;
        }
        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
        .no-results i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #adb5bd;
        }
        .no-results h3 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .no-results p {
            color: #868e96;
        }
    </style>
</head>
<body>
    <?php require_once 'views/shared/navbar.php'; ?>

    <div class="main-content">
        <div class="results-container">
            <div class="search-header">
                <h1>Search Results for "<?php echo htmlspecialchars($_GET['q']); ?>"</h1>
            </div>

            <?php if(empty($results['users']) && empty($results['posts'])): ?>
                <div class="no-results">
                    <i class="bi bi-search"></i>
                    <h3>No results found</h3>
                    <p>Try different keywords or check your spelling</p>
                </div>
            <?php else: ?>
                <?php if(!empty($results['users'])): ?>
                    <h2 class="section-title">Users</h2>
                    <?php foreach($results['users'] as $user): ?>
                        <a href="index.php?controller=profile&action=view&id=<?php echo $user['id']; ?>" class="result-card user-result">
                            <?php if(!empty($user['profile_picture'])): ?>
                                <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" 
                                     class="user-picture" alt="<?php echo htmlspecialchars($user['username']); ?>">
                            <?php else: ?>
                                <div class="user-placeholder">
                                    <i class="bi bi-person"></i>
                                </div>
                            <?php endif; ?>
                            <div class="user-info">
                                <div class="user-name"><?php echo htmlspecialchars($user['username']); ?></div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if(!empty($results['posts'])): ?>
                    <h2 class="section-title">Posts</h2>
                    <?php foreach($results['posts'] as $post): ?>
                        <a href="index.php?controller=post&action=view&id=<?php echo $post['id']; ?>" class="result-card post-result">
                            <div class="post-title"><?php echo htmlspecialchars($post['title']); ?></div>
                            <div class="post-author">
                                <i class="bi bi-person-circle"></i>
                                <?php echo htmlspecialchars($post['username']); ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html> 