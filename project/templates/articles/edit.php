<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование статьи</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title h4 mb-0">Редактирование статьи</h1>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Название статьи</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="name" 
                                       name="name" 
                                       value="<?= $article->getName() ?>" 
                                       required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="text" class="form-label">Текст статьи</label>
                                <textarea class="form-control" 
                                          id="text" 
                                          name="text" 
                                          rows="10" 
                                          required><?= $article->getText() ?></textarea>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    💾 Сохранить изменения
                                </button>
                                <a href="/back_end_development/project/articles/<?= $article->getId() ?>" class="btn btn-outline-secondary">
                                    ← Назад к статье
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>