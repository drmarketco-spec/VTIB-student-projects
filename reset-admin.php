<?php
require_once 'config/db.php';

$new_password = 'admin123';
$hash = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE email = 'admin@vtib.cm'");
$stmt->execute([$hash]);

echo "Admin password reset successfully!<br>";
echo "New Hash: " . $hash;
?>