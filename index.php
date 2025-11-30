<?php
// Ambil data dari JSON
$jsonData = file_get_contents('data.json');
$novels = json_decode($jsonData, true);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cosmic Reads</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php" class="logo">Cosmic Reads</a>
    <div class="search-bar"><input type="text" placeholder="Search novels..."></div>
    <div class="nav-links"><a href="#">Library</a><a href="#">Profile</a></div>
</nav>

<div class="container">
    <h2 class="section-title">Featured Novels</h2>
    <span class="sub-text">Explore the cosmos through captivating stories</span>

    <div class="novel-grid">
        <?php foreach ($novels as $novel): ?>
            <a href="novel.php?id=<?= $novel['id'] ?>" class="novel-card" style="background-image: url('<?= $novel['image'] ?>');">
                <div class="card-content">
                    <h3><?= $novel['title'] ?></h3>
                    <p style="font-size: 14px; color: #aaa;"><?= $novel['author'] ?></p>
                    <span class="card-genre"><?= $novel['genre'] ?> &bull; <?= count($novel['chapters']) ?> Chapters</span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>