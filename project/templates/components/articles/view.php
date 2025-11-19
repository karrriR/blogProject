<?php include __DIR__ . '/../../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p><strong>Автор:</strong> <?= $article->getAuthorId()->getNickname() ?> </p>
<?php include __DIR__ . '/../../footer.php'; ?>