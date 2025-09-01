<?php require '../includes/auth.php';
requireAdmin(); ?>
<form action="process/add_project.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Project Title" required />
    <input type="text" name="category" placeholder="Category" />
    <textarea name="description" placeholder="Description"></textarea>
    <input type="url" name="github_link" placeholder="GitHub URL" />
    <input type="url" name="live_link" placeholder="Live Demo URL" />
    <input type="file" name="image" accept="image/*" required />
    <button type="submit">Add Project</button>
</form>