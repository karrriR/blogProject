<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p><strong>Автор:</strong> <?= $article->getAuthorId()->getNickname() ?> </p>
    <?php if (isset($user) && $user !== null): ?>
        <div class="my-4">
            <?php if ($article->canEdit($user)): ?>
                <a href="/back_end_development/project/articles/<?= $article->getId() ?>/edit" 
                class="btn btn-success btn-sm">
                    ✏️ Редактировать статью
                </a>
            <?php endif; ?>
            
            <?php if ($article->canDelete($user)): ?>
                <a href="/back_end_development/project/articles/<?= $article->getId() ?>/delete" 
                class="btn btn-danger btn-sm"
                onclick="return confirm('Вы уверены что хотите удалить статью?')">
                    🗑️ Удалить статью
                </a>
            <?php endif; ?>
            <a href="/back_end_development/project/www" class="btn btn-outline-secondary btn-sm">
                 ← Назад
            </a>
        </div>
    <?php endif; ?>
    <div class="mt-5">
    <h5>Комментарии (<?= count($comments) ?>)</h5>

    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="card mb-3" id="comment-<?= $comment->getId() ?>">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="card-title mb-1">
                                <?= $comment->getAuthorId()->getNickname() ?>
                            </h6>
                            <p class="card-text mb-2"><?= nl2br(htmlspecialchars($comment->getText())) ?></p>
                            <small class="text-muted"><?= $comment->getCreatedAt() ?></small>
                        </div>
                        
                        <div class="d-flex gap-1">
                            <?php if (isset($user) && $user !== null && $user->getId() === $comment->getAuthorId()->getId()): ?>
                                <a href="/back_end_development/project/comments/<?= $comment->getId() ?>/edit" 
                                   class="btn btn-outline-secondary btn-sm">
                                    ✏️
                                </a>
                            <?php endif; ?>
                            
                            <?php if (isset($user) && $user !== null && $comment->canDelete($user)): ?>
                                <a href="/back_end_development/project/comments/<?= $comment->getId() ?>/delete" 
                                   class="btn btn-outline-danger btn-sm"
                                   onclick="return confirm('Удалить комментарий?')">
                                    🗑️
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">Пока нет комментариев.</p>
    <?php endif; ?>

    <?php if (isset($user) && $user !== null): ?>
        <div class="mt-4">
            <a href="/back_end_development/project/articles/<?= $article->getId() ?>/comments/add" 
               class="btn btn-primary">
                💬 Добавить комментарий
            </a>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-4">
            <a href="/back_end_development/project/login" class="alert-link">Войдите</a>, чтобы оставить комментарий
        </div>
    <?php endif; ?>
</div>
<?php include __DIR__ . '/../footer.php'; ?>