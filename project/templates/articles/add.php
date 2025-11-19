<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <?php if (!empty($error)): ?>
                    <div class="alert alert-danger mt-3 alert-dismissible" role="alert">
                        <strong>Ошибка!</strong> <?= $error ?>
                        <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'"></button>
                    </div>
                    <?php endif; ?>
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Добавить новую статью</h5>
                </div>
                <div class="card-body">
                    <form action="/back_end_development/project/articles/add" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Название статьи</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Введите заголовок статьи" maxlength="255" value="<?= $_POST['name'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="text" class="form-label fw-bold">Текст статьи</label>
                            <textarea class="form-control" id="text" name="text" rows="15" placeholder="Напишите содержание статьи..." value="<?= $_POST['text'] ?? '' ?>"></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-check-lg"></i> Опубликовать
                            </button>
                            <a href="/back_end_development/project/articles" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left"></i> Назад
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>