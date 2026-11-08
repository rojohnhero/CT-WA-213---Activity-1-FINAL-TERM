<?php
require "config/database.php";
session_start();

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $stmt = $pdo->prepare("SELECT id, full_name, email, password, role, department FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        session_regenerate_id(true);
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["full_name"] = $user["full_name"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["department"] = $user["department"];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Incorrect email or password.";
    }
}
include "includes/header.php";
?>
<section class="auth-card">
    <div class="eyebrow">BULACAN POLYTECHNIC COLLEGE</div>
    <h1>Welcome back</h1>
    <p class="muted">Sign in to continue to the department shirt system.</p>
    <?php if (isset($_GET["registered"])): ?><div class="success">Account created. You can now log in.</div><?php endif; ?>
    <?php if ($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <label>Email address</label>
        <input type="email" name="email" required autocomplete="username">
        <label>Password</label>
        <input type="password" name="password" required autocomplete="current-password">
        <button class="btn" type="submit">Login</button>
    </form>
    <p class="switch">Don't have an account? <a href="register.php">Register here</a></p>
</section>
<?php include "includes/footer.php"; ?>
