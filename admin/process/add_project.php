<?php
include '../../includes/db.php';
require '../../includes/auth.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $github_link = $_POST['github_link'];
    $live_link = $_POST['live_link'];

    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = uniqid('proj_') . '.' . $ext;
        $dest = '../../uploads/images/' . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $dest);
    }

    $stmt = $pdo->prepare("INSERT INTO projects (title, category, image, description, github_link, live_link) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $category, $image, $description, $github_link, $live_link]);

    header("Location: ../dashboard.php?msg=Project added successfully");
    exit;
}
