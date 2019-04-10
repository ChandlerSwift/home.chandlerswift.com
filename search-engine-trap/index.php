<!DOCTPYE html>
<html>
  <head>
    <title>Trapped!</title>
  </head>
  <body>
<?php $rand = md5(pathinfo($_SERVER['REQUEST_URI'])['filename']) ?>
<a href="<?= $rand ?>"><?= $rand ?></a>
</body>
</html>
