<?php
require "config/database.php";
session_start();

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["full_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $studentNo = trim($_POST["student_no"] ?? "");
    $department = trim($_POST["department"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm = $_POST["confirm_password"] ?? "";

    if ($name === "" || $email === "" || $studentNo === "" || $department === "" || $password === "") {
        $error = "Please complete all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid email address.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ? OR student_no = ?");
        $check->execute([$email, $studentNo]);
        if ($check->fetch()) {
            $error = "That email or student number is already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (full_name, email, student_no, department, password, role) VALUES (?, ?, ?, ?, ?, 'student')");
            $stmt->execute([$name, $email, $studentNo, $department, $hash]);
            header("Location: login.php?registered=1");
            exit;
        }
    }
}
include "includes/header.php";
?>
<section class="auth-card">
    <div class="eyebrow">BULACAN POLYTECHNIC COLLEGE</div>
    <h1>Create student account</h1>
    <p class="muted">Register to access the department shirt system.</p>
    <?php if ($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <label>Full name</label>
        <input name="full_name" required value="<?= htmlspecialchars($_POST["full_name"] ?? "") ?>">
        <label>Email address</label>
        <input type="email" name="email" required value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        <label>Student number</label>
        <input name="student_no" required value="<?= htmlspecialchars($_POST["student_no"] ?? "") ?>">
        <label>Department / Course</label>
        <select name="department" required>
            <option value="">Select department</option>
            <?php foreach (["BSIS","ACT","BSHM","BSEd","BEEd","Other"] as $dept): ?>
                <option value="<?= $dept ?>" <?= (($_POST["department"] ?? "") === $dept) ? "selected" : "" ?>><?= $dept ?></option>
            <?php endforeach; ?>
        </select>
        <label>Password</label>
        <input type="password" name="password" minlength="8" required>
        <label>Confirm password</label>
        <input type="password" name="confirm_password" minlength="8" required>
        <button class="btn" type="submit">Create account</button>
    </form>
    <p class="switch">Already registered? <a href="login.php">Login here</a></p>
</section>
<?php include "includes/footer.php"; ?>
