<?php
$novelId = $_GET['id'];
$chapterIndex = (int)$_GET['idx'];

// 1. Ambil Data JSON
$jsonData = file_get_contents('data.json');
$novels = json_decode($jsonData, true);

// 2. Cari Novel
$novel = null;
foreach ($novels as $n) {
    if ($n['id'] == $novelId) { $novel = $n; break; }
}

// 3. Validasi
if (!$novel || !isset($novel['chapters'][$chapterIndex])) {
    die("Chapter data tidak ditemukan.");
}

$currentChapterMetadata = $novel['chapters'][$chapterIndex];
$totalChapters = count($novel['chapters']);

// 4. Ambil isi cerita dari file .txt
$filePath = 'stories/' . $novelId . '/' . $currentChapterMetadata['filename'];

if (file_exists($filePath)) {
    $chapterContent = file_get_contents($filePath);
} else {
    $chapterContent = "Maaf, file cerita belum tersedia atau hilang.";
}

// Navigasi Logic
$prevIndex = $chapterIndex - 1;
$nextIndex = $chapterIndex + 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $currentChapterMetadata['title'] ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="novel.php?id=<?= $novelId ?>" class="logo">&larr; <?= $novel['title'] ?></a>
</nav>

<div class="read-container">
    <h1 style="color: var(--accent); text-align: center; margin-bottom: 20px;">
        <?= $currentChapterMetadata['title'] ?>
    </h1>

    <div class="nav-buttons" style="margin-top: 0; margin-bottom: 30px; border-bottom: 1px solid #222; padding-bottom: 20px;">
        <?php if ($prevIndex >= 0): ?>
            <a href="read.php?id=<?= $novelId ?>&idx=<?= $prevIndex ?>" class="btn btn-outline">&laquo; Prev</a>
        <?php else: ?>
            <a href="#" class="btn btn-outline" style="visibility:hidden">Prev</a>
        <?php endif; ?>

        <?php if ($nextIndex < $totalChapters): ?>
            <a href="read.php?id=<?= $novelId ?>&idx=<?= $nextIndex ?>" class="btn btn-primary">Next &raquo;</a>
        <?php else: ?>
             <a href="novel.php?id=<?= $novelId ?>" class="btn btn-primary">Finish</a>
        <?php endif; ?>
    </div>
    <div class="read-content">
        <?= nl2br(htmlspecialchars($chapterContent)) ?>
    </div>


    <div class="nav-buttons">
        <?php if ($prevIndex >= 0): ?>
            <a href="read.php?id=<?= $novelId ?>&idx=<?= $prevIndex ?>" class="btn btn-outline">&laquo; Prev Chapter</a>
        <?php else: ?>
            <a href="#" class="btn btn-outline" style="visibility:hidden">Prev</a>
        <?php endif; ?>

        <?php if ($nextIndex < $totalChapters): ?>
            <a href="read.php?id=<?= $novelId ?>&idx=<?= $nextIndex ?>" class="btn btn-primary">Next Chapter &raquo;</a>
        <?php else: ?>
             <a href="novel.php?id=<?= $novelId ?>" class="btn btn-primary">Finish</a>
        <?php endif; ?>
    </div>
    </div>

</body>
</html>