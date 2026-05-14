<?php
session_start();
require_once 'config/db.php';

if(!isset($_SESSION['admin_id'])){
    exit();
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("
UPDATE students
SET status='suspended'
WHERE id=?
");

$stmt->execute([$id]);

header("Location: admin-dashboard.php");