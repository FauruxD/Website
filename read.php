<?php
$novel = $_GET['novel'];
$chapter = intval($_GET['chapter']);

// Membaca file chapter dari folder /chapters
$filepath = __DIR__ . "/chapters/chapter$chapter.txt";
$content = file_exists($filepath) ? file_get_contents($filepath) : "Chapter tidak ditemukan.";

// Total chapter (ubah sesuai jumlah file)
$total_chapters = 3;

$prev = ($chapter > 1) ? $chapter - 1 : null;
$next = ($chapter < $total_chapters) ? $chapter + 1 : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nebula Chronicles - Chapter <?=$chapter?></title>
    <style>
        body { font-family: Arial; background:#0b0f1a; color:white; padding:20px; }
        .nav { margin-top:20px; }
        a { color:white; background:#141b2d; padding:10px 20px; border-radius:8px; text-decoration:none; margin:5px; }
        a:hover { background:#1e2940; }
    </style>
</head>
<body>
<h1>Nebula Chronicles - Chapter <?=$chapter?></h1>
<p><?=$content?></p>

<div class="nav">
    <?php if($prev): ?>
        <a href="read.php?novel=<?=$novel?>&chapter=<?=$prev?>">Prev</a>
    <?php endif; ?>

    <?php if($next): ?>
        <a href="read.php?novel=<?=$novel?>&chapter=<?=$next?>">Next</a>
    <?php endif; ?>
</div>

</body>
</html>
