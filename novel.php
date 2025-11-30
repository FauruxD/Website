<?php
$id = $_GET['id'] ?? 1; // Default ID 1 jika tidak ada
$jsonData = file_get_contents('data.json');
$novels = json_decode($jsonData, true);

// Cari novel berdasarkan ID
$novelData = null;
foreach ($novels as $n) {
    if ($n['id'] == $id) {
        $novelData = $n;
        break;
    }
}
if (!$novelData) die("Novel tidak ditemukan.");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $novelData['title'] ?> - Cosmic Reads</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php" class="logo">Cosmic Reads</a>
    <div class="nav-links"><a href="index.php">Back to Library</a></div>
</nav>

<div class="container">
    <div class="detail-header">
        <img src="<?= $novelData['image'] ?>" alt="Cover" class="novel-cover-lg">
        
        <div class="novel-info">
            <h1><?= $novelData['title'] ?></h1>
            <p class="meta">by <?= $novelData['author'] ?> &bull; <span style="color:var(--accent); border:1px solid var(--accent); padding:2px 8px; border-radius:10px; font-size:12px;"><?= $novelData['genre'] ?></span></p>
            
            <h3>Synopsis</h3>
            <p class="synopsis"><?= $novelData['description'] ?></p>
            
            <div class="actions">
                <?php if(count($novelData['chapters']) > 0): ?>
                    <a href="read.php?id=<?= $novelData['id'] ?>&idx=0" class="btn btn-primary">Start Reading</a>
                <?php else: ?>
                    <button class="btn btn-primary" disabled style="opacity:0.5">No Chapters</button>
                <?php endif; ?>
                <button class="btn btn-outline">Add to Favorites</button>
            </div>
        </div>
    </div>

    <h3 style="margin-top: 50px;">Latest Chapters</h3>
    <div class="chapter-list">
        <?php 
        // Loop chapters, tampilkan terbalik (terbaru di atas) atau biasa
        $chapters = $novelData['chapters'];
        $total = count($chapters);
        foreach (array_reverse($chapters, true) as $index => $chapter): 
        ?>
            <a href="read.php?id=<?= $novelData['id'] ?>&idx=<?= $index ?>" class="chapter-item">
                <span><?= $chapter['title'] ?></span>
                <span style="color: #666;">2 hours ago</span>
            </a>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>