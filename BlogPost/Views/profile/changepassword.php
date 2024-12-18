<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
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
        .password-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            max-width: 700px;
            margin: 0 auto;
            overflow: hidden;
        }
        .password-header {
            padding: 30px;
            border-bottom: 1px solid #eee;
        }
        .password-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0;
        }
        .password-body {
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
        .password-actions {
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
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .btn-submit, .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .btn-submit {
            background-color: #1a73e8;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #1557b0;
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
        .password-form {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d0d5dd;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37,99,235,0.1);
        }
        .form-control.is-invalid {
            border-color: #dc2626;
        }
        .invalid-feedback {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            font-weight: 500;
        }
        .alert-danger {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
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
        <div class="password-card">
            <div class="password-header">
                <h2 class="password-title">Change Password</h2>
            </div>
            
            <div class="password-body">
                <div class="password-actions">
                    <form method="POST" action="index.php?controller=profile&action=changePassword" class="password-form">
                        <?php if(isset($errors['general'])): ?>
                            <div class="alert alert-danger"><?php echo $errors['general']; ?></div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" 
                                   class="form-control <?php echo isset($errors['current_password']) ? 'is-invalid' : ''; ?>" 
                                   id="current_password" 
                                   name="current_password">
                            <?php if(isset($errors['current_password'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['current_password']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" 
                                   class="form-control <?php echo isset($errors['new_password']) ? 'is-invalid' : ''; ?>" 
                                   id="new_password" 
                                   name="new_password">
                            <?php if(isset($errors['new_password'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['new_password']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" 
                                   class="form-control <?php echo isset($errors['confirm_password']) ? 'is-invalid' : ''; ?>" 
                                   id="confirm_password" 
                                   name="confirm_password">
                            <?php if(isset($errors['confirm_password'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['confirm_password']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="button-group">
                            <a href="index.php?controller=profile" class="btn-cancel">
                                <i class="bi bi-x-lg"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-check-lg"></i>
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 