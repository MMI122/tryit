<?php
include '../../includes/db.php';
require '../../includes/auth.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $bio = $_POST['bio'];

    $image = $_POST['existing_image'] ?? null;

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
        $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        $image = 'profile_' . uniqid() . '.' . $ext;
        $dest = '../../uploads/images/' . $image;
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $dest);

        // Optional: Delete old image
    }

    $stmt = $pdo->prepare("INSERT INTO profile (id, name, title, bio, profile_image) VALUES (1, ?, ?, ?, ?) 
                           ON DUPLICATE KEY UPDATE name=VALUES(name), title=VALUES(title), bio=VALUES(bio), profile_image=VALUES(profile_image)");
    $stmt->execute([$name, $title, $bio, $image]);

    header("Location: ../dashboard.php?msg=Profile updated");
    exit;
}
