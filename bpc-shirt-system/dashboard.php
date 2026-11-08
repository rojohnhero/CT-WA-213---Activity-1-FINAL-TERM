<?php
require "includes/auth.php";
requireLogin();
include "includes/header.php";
?>
<section class="welcome">
    <div class="eyebrow">BPC DEPARTMENT SHIRT SYSTEM</div>
    <h1>Hello, <?= htmlspecialchars($_SESSION["full_name"]) ?>!</h1>
    <p class="muted">You are signed in as <strong><?= htmlspecialchars(ucfirst($_SESSION["role"])) ?></strong>.</p>
</section>

<?php if ($_SESSION["role"] === "admin"): ?>
    <section class="panel">
        <h2>Admin dashboard</h2>
        <p>Welcome to the administrator area. This is the starting point for managing students, shirt designs, orders, and payments.</p>
        <div class="grid">
            <div class="tile"><h3>Student Management</h3><p>Manage registered student accounts.</p></div>
            <div class="tile"><h3>Shirt Designs</h3><p>Add and update department shirt designs.</p></div>
            <div class="tile"><h3>Order Management</h3><p>Review and update student orders.</p></div>
            <div class="tile"><h3>Reports</h3><p>View sales and system activity.</p></div>
        </div>
    </section>
<?php else: ?>
    <section class="panel">
        <h2>Student dashboard</h2>
        <div class="student-info">
            <p><strong>Student number:</strong> <?= htmlspecialchars($_SESSION["email"]) ?></p>
            <p><strong>Department:</strong> <?= htmlspecialchars($_SESSION["department"] ?? "Not set") ?></p>
        </div>
        <p>Your account is ready. The shirt catalog and ordering modules can be connected to this login system next.</p>
    </section>
<?php endif; ?>
<?php include "includes/footer.php"; ?>
