<nav class="navbar">
    <div class="container">
        <div class="navbar-content">
            <div class="nav-left">
                <a class="navbar-brand" href="index.php?controller=dashboard">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Feed</span>
                </a>
            </div>
            
            <div class="search-container">
                <form class="search-form" action="index.php" method="GET">
                    <input type="hidden" name="controller" value="search">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="search-input" name="q" 
                           placeholder="Search users or posts..." 
                           value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>"
                           autocomplete="off" data-search>
                    <div class="search-results"></div>
                </form>
            </div>
            
            <div class="nav-right">
                <a href="index.php?controller=post&action=create" class="btn-create">
                    <i class="bi bi-plus-lg"></i>
                    <span>Create Post</span>
                </a>
                
                <a href="index.php?controller=profile" class="user-profile">
                    <?php if(!empty($_SESSION['profile_picture'])): ?>
                        <img src="<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" 
                             class="profile-picture" alt="Profile Picture">
                    <?php else: ?>
                        <div class="profile-picture-placeholder">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    <?php endif; ?>
                    <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                </a>

                <form method="POST" action="index.php?controller=auth&action=logout" style="margin: 0;">
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    z-index: 1000;
    padding: 12px 0;
}

.navbar-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 1.2rem;
    font-weight: 600;
    color: #1a73e8;
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.navbar-brand:hover {
    background: #f0f7ff;
    color: #1557b0;
}

.navbar-brand i {
    font-size: 1.3rem;
}

.search-container {
    flex: 1;
    max-width: 600px;
    position: relative;
}

.search-form {
    position: relative;
}

.search-input {
    width: 100%;
    padding: 12px 40px;
    border: 2px solid #e1e3e6;
    border-radius: 24px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background: #f8f9fa;
}

.search-input:focus {
    outline: none;
    border-color: #1a73e8;
    background: white;
    box-shadow: 0 0 0 4px rgba(26,115,232,0.1);
}

.search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #5f6368;
    font-size: 1rem;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.btn-create {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: #1a73e8;
    color: white;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-create:hover {
    background: #1557b0;
    color: white;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: #3c4043;
    padding: 6px 12px;
    border-radius: 20px;
    transition: all 0.2s ease;
}

.user-profile:hover {
    background: #f8f9fa;
}

.profile-picture,
.profile-picture-placeholder {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
}

.profile-picture-placeholder {
    background: #e1e3e6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #5f6368;
}

.username {
    font-weight: 500;
    font-size: 0.95rem;
}

.btn-logout {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: #f8f9fa;
    border: none;
    border-radius: 20px;
    color: #5f6368;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-logout:hover {
    background: #e1e3e6;
    color: #3c4043;
}

.search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    margin-top: 8px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    display: none;
}
</style> 