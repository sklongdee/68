<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .login-title {
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
            color: #343a40;
        }
    </style>
</head>
<body>
    <div class="login-container shadow-sm">
        <h2 class="login-title">Welcome Back</h2>

        <?php if (isset($_GET['registered']) && $_GET['registered'] == 1): ?>
            <div class="alert alert-success" role="alert">
                Registration successful! Please login.
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php 
                    echo htmlspecialchars($_SESSION['error']); 
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <form method="post" action="authenticate.php" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Username</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="username" 
                    name="username" 
                    placeholder="Enter your username" 
                    required
                >
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password" 
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">Login</button>
        </form>

        <p class="text-center mt-4 mb-0">
            Don't have an account? <a href="register.php" class="text-decoration-none">Register here</a>
        </p>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
