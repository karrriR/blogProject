<?php include __DIR__ . '/../../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p><strong>Автор:</strong> <?= $author ? $author->getNickname() : 'Неизвестный автор' ?></p>
<?php include __DIR__ . '/../../footer.php'; ?>