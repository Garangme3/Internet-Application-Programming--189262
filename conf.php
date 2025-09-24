<?php
// Site Info
$conf['site_name'] = 'ICS C Community';
$conf['site_url']  = 'http://localhost/glone';
$conf['admin_email'] = 'admin@icsccommunity.com';

// Database
$conf['db_host'] = 'localhost';
$conf['db_user'] = 'root';
$conf['db_pass'] = '';
$conf['db_name'] = 'glone';

// Email
$conf['smtp_host'] = 'smtp.gmail.com';
$conf['smtp_user'] = 'your_email@gmail.com';  // change
$conf['smtp_pass'] = 'your_password';         // change
$conf['smtp_port'] = 465;
$conf['smtp_secure'] = 'ssl';

// PDO Connection
try {
    $pdo = new PDO("mysql:host={$conf['db_host']};dbname={$conf['db_name']};charset=utf8mb4", 
                   $conf['db_user'], $conf['db_pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
