<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">💬 Добавить комментарий</h5>
                </div>
                <div class="card-body">
                    <form action="/back_end_development/project/articles/<?= $article->getId() ?>/comments" method="post">
                        <div class="mb-3">
                            <label for="text" class="form-label">Текст комментария</label>
                            <textarea class="form-control" id="text" name="text" rows="5" 
                                      placeholder="Напишите ваш комментарий..." required></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Отправить</button>
                            <a href="/back_end_development/project/articles/<?= $article->getId() ?>" 
                               class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>