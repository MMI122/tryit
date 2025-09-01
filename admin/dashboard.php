<?php
require '../includes/auth.php';
requireAdmin();
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body class="admin-body">
    <div class="admin-container">
        <aside class="sidebar">
            <h3>Admin Panel</h3>
            <ul>
                <li><a href="dashboard.php#profile">Edit Profile</a></li>
                <li><a href="dashboard.php#education">Education</a></li>
                <li><a href="dashboard.php#projects">Projects</a></li>
                <li><a href="dashboard.php#contact">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <!-- Profile Section -->
            <section id="profile">
                <h2>Edit Profile</h2>
                <form action="process/update_profile.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="name" placeholder="Your Name" value="<?php echo htmlspecialchars($profile['name'] ?? ''); ?>" />
                    <input type="text" name="title" placeholder="Title" value="<?php echo htmlspecialchars($profile['title'] ?? ''); ?>" />
                    <textarea name="bio" placeholder="Bio"><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea>
                    <input type="file" name="profile_image" accept="image/*" />
                    <?php if (!empty($profile['profile_image'])): ?>
                        <img src="../uploads/images/<?php echo $profile['profile_image']; ?>" width="100" alt="Current" />
                    <?php endif; ?>
                    <button type="submit">Update Profile</button>
                </form>
            </section>

            <!-- Education -->
            <section id="education">
                <h2>Education</h2>
                <a href="add_education.php" class="btn">Add New</a>
                <table>
                    <tr>
                        <th>Degree</th>
                        <th>Institution</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM education ORDER BY id DESC");
                    while ($row = $stmt->fetch()) {
                        echo "<tr>
                            <td>{$row['degree']}</td>
                            <td>{$row['institution']}</td>
                            <td>{$row['year']}</td>
                            <td>
                                <a href='edit_education.php?id={$row['id']}'>Edit</a> |
                                <a href='process/delete_education.php?id={$row['id']}' onclick='return confirm(\"Delete?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </table>
            </section>

            <!-- Projects -->
            <section id="projects">
                <h2>Projects</h2>
                <a href="add_project.php" class="btn">Add Project</a>
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
                    while ($row = $stmt->fetch()) {
                        $img = $row['image'] ? "../uploads/images/{$row['image']}" : "No Image";
                        echo "<tr>
                            <td>{$row['title']}</td>
                            <td><img src='$img' width='60' /></td>
                            <td>" . substr($row['description'], 0, 50) . "...</td>
                            <td>
                                <a href='edit_project.php?id={$row['id']}'>Edit</a> |
                                <a href='process/delete_project.php?id={$row['id']}' onclick='return confirm(\"Delete?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </table>
            </section>
        </main>
    </div>
</body>

</html>