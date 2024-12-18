<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212; /* Dark background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            background: #1e1e1e; /* Dark card */
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            padding: 40px;
            max-width: 450px;
            margin: 60px auto;
            border: 2px solid #ff9800; /* Orange border */
        }
        .register-icon {
            color: #ff9800; /* Orange icon */
            font-size: 28px;
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ff9800; /* Orange border */
            background-color: #ffffff; /* White input */
            color: #000000; /* Black text */
        }
        .form-control:focus {
            background-color: #ffffff; /* White input on focus */
            border-color: #ff9800; /* Orange border on focus */
            box-shadow: 0 0 5px rgba(255, 152, 0, 0.5);
        }
        .input-group-text {
            background-color: #333; /* Dark input group */
            border: 1px solid #ff9800; /* Orange border */
            border-radius: 10px 0 0 10px;
            color: #ffffff; /* White text */
        }
        .btn-primary {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            margin-top: 20px;
            background: #ff9800; /* Orange button */
            border: none;
        }
        .btn-primary:hover {
            background: #fb8c00; /* Lighter orange on hover */
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #ff9800; /* Orange link */
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="text-center">
                <div class="register-icon">👤</div>
                <h3 class="mb-3 text-white">Create Account</h3>
                <p class="text-muted">Join our community today</p>
            </div>
            <form method="POST">
                <?php if (isset($errors['general'])): ?>
                    <div class="alert alert-danger mb-3">
                        <?php echo $errors['general']; ?>
                    </div>
                <?php endif; ?>
                
                <div class="mb-3">
                    <label class="form-label text-white">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text">👤</span>
                        <input type="text" name="username" class="form-control" placeholder="Enter your name" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-white">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text">📧</span>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-white">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">🔒</span>
                        <input type="password" name="password" class="form-control" placeholder="Create a password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
                
                <div class="login-link">
                    <p class="text-white">Already have an account? <a href="index.php?action=login">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
