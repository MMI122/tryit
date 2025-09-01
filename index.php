<?php
require_once 'config/db.php';
$stmt = $pdo->prepare("SELECT * FROM projects ORDER BY created_at DESC");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>My Projects</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <header>
        <h1>🚀 My Portfolio</h1>
        <a href="admin/login.php" class="admin-link">Admin</a>
    </header>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="🔍 Search projects..." />
    </div>

    <main class="projects-grid" id="projectsContainer">
        <?php if (empty($projects)): ?>
            <p>No projects yet.</p>
        <?php else: ?>
            <?php foreach ($projects as $project): ?>
                <div class="project-card">
                    <img src="<?php echo htmlspecialchars($project['image_url']); ?>"
                        alt="<?php echo htmlspecialchars($project['title']); ?>" />
                    <span class="tag"><?php echo htmlspecialchars($project['category']); ?></span>
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <div class="project-description">
                        <?php
                        $desc = htmlspecialchars($project['description']);
                        $paragraphs = array_filter(array_map('trim', explode("\n", $desc)));
                        foreach ($paragraphs as $p) {
                            echo "<p>$p</p>";
                        }
                        ?>
                    </div>
                    <a href="<?php echo htmlspecialchars($project['github_url']); ?>"
                        target="_blank" class="github-link">📁 View on GitHub</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> My Portfolio. Made with PHP & ❤️</p>
    </footer>

    <button id="darkModeToggle">🌙 Dark Mode</button>

    <script>
        // Dark Mode
        const toggle = document.getElementById('darkModeToggle');
        const body = document.body;
        if (getCookie('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            toggle.textContent = '☀️ Light Mode';
        }
        toggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                document.cookie = 'darkMode=enabled; path=/; max-age=31536000';
                toggle.textContent = '☀️ Light Mode';
            } else {
                document.cookie = 'darkMode=disabled; path=/; max-age=31536000';
                toggle.textContent = '🌙 Dark Mode';
            }
        });

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            return parts.length === 2 ? parts.pop().split(';').shift() : null;
        }

        // Search
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const cards = document.getElementsByClassName('project-card');
            for (let card of cards) {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const desc = card.querySelector('.project-description').textContent.toLowerCase();
                const tag = card.querySelector('.tag')?.textContent.toLowerCase() || '';
                if (title.includes(filter) || desc.includes(filter) || tag.includes(filter)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    </script>
</body>

</html>