<?php
require 'ClassAutoLoad.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass  = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='alert alert-danger'>Invalid email address</div>";
    } else {
        $token = bin2hex(random_bytes(16));

        // Save user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, token, status) VALUES (?, ?, ?, ?, 'pending')");
        $stmt->execute([$name, $email, password_hash($pass, PASSWORD_DEFAULT), $token]);

        // Send verification email
        $verifyLink = $conf['site_url'] . "/verify.php?token=" . $token;
        $mailCnt = [
            'name_from'  => $conf['site_name'],
            'email_from' => $conf['smtp_user'],
            'name_to'    => $name,
            'email_to'   => $email,
            'subject'    => 'Verify Your Email - ' . $conf['site_name'],
            'body'       => "Hello <b>$name</b>,<br><br>
                             Please verify your email by clicking this link:<br>
                             <a href='$verifyLink'>$verifyLink</a>"
        ];
        $ObjSendMail->Send_Mail($conf, $mailCnt);

        echo "<div class='alert alert-success'>Signup successful! Check your email to verify.</div>";
    }
}

$ObjLayout->header($conf);
$ObjLayout->nav($conf);
$ObjLayout->banner($conf);
$ObjLayout->form_content($conf, $ObjForm);
$ObjLayout->footer($conf);
