<?php
require 'ClassAutoLoad.php';

$stmt = $pdo->query("SELECT name, email, status FROM users ORDER BY id ASC");
$users = $stmt->fetchAll();

$ObjLayout->header($conf);
$ObjLayout->nav($conf);

echo "<div class='container'><h2>Registered Users</h2><ol>";
foreach ($users as $u) {
    echo "<li>{$u['name']} ({$u['email']}) - <b>{$u['status']}</b></li>";
}
echo "</ol></div>";

$ObjLayout->footer($conf);
