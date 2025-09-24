<?php
require 'ClassAutoLoad.php';

$msg = "Invalid verification request.";

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $stmt = $pdo->prepare("SELECT id, status FROM users WHERE token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        if ($user['status'] === 'verified') {
            $msg = "Your email is already verified.";
        } else {
            $pdo->prepare("UPDATE users SET status='verified' WHERE token=?")->execute([$token]);
            $msg = "Your email has been successfully verified!";
        }
    } else {
        $msg = "Invalid or expired token.";
    }
}

$ObjLayout->header($conf);
$ObjLayout->nav($conf);
echo "<div class='container'><div class='alert alert-info'>$msg</div></div>";
$ObjLayout->footer($conf);
