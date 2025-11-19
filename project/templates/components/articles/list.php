<div class="py-5">
    <?php foreach ($articles as $article): ?>
    <article class="bg-light rounded-3 p-4 mb-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="h3 fw-bold text-dark mb-2">
                    <a href="/back_end_development/project/articles/<?= $article->getId() ?>" class="text-decoration-none"><?= $article->getName() ?></a>
                </h2>
                <p class="text-muted mb-0">
                    <?= $article->getText() ?>
                </p>
            </div>
            <div class="col-auto">
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    Новое
                </span>
            </div>
        </div>
    </article>
    <?php endforeach; ?>
</div>