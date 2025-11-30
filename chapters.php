<?php
$novel = $_GET['novel'];
$chapters = [1,2,3]; // daftar chapter, file berada di folder /chapters // daftar chapter
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pilih Chapter - Nebula Chronicles</title>
<style>
body { font-family: Arial; background:#0b0f1a; color:white; text-align:center; }
a { color:white; display:block; padding:10px; margin:10px auto; background:#141b2d; width:200px; border-radius:8px; text-decoration:none; }
a:hover { background:#1e2940; }
</style>
</head>
<body>
<h1>Pilih Chapter</h1>
<?php foreach($chapters as $c): ?>
<a href="read.php?novel=<?=$novel?>&chapter=<?=$c?>">Chapter <?=$c?></a>
<?php endforeach; ?>
</body>
</html>