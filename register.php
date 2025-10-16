<?php
session_start();

// ตั้งค่าการเชื่อมต่อ PDO
include_once "admin/conn.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Please fill all fields.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            $error = "Username is already taken.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $success = $stmt->execute([$username, $hashed_password]);

            if ($success) {
                header("Location: login.php?registered=1");
                exit();
            } else {
                $error = "Failed to register. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f8f9fa;
        }
        .register-container {
            max-width: 420px;
            margin: 60px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .register-title {
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
            color: #343a40;
        }
    </style>
</head>
<body>
    <div class="register-container shadow-sm">
        <h2 class="register-title">Create Your Account</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="register.php" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Username</label>
                <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Enter username"
                    required
                    value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>"
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>
                <input
                    type="password"
                    class="form-control"
                    id="confirm_password"
                    name="confirm_password"
                    placeholder="Confirm password"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">
                Register
            </button>
        </form>

        <p class="text-center mt-4 mb-0">
            Already have an account? <a href="login.php" class="text-decoration-none">Login here</a>
        </p>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
