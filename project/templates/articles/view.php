<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p><strong>Автор:</strong> <?= $article->getAuthorId()->getNickname() ?> </p>
    <div class="my-4">
        <a href="/back_end_development/project/articles/<?= $article->getId() ?>/edit" 
        class="btn btn-success btn-sm">
            ✏️ Редактировать статью
        </a>
    </div>
<?php include __DIR__ . '/../footer.php'; ?>