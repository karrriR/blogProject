<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница не найдена</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="text-center">
            <h1 class="display-1 fw-bold text-secondary">500</h1>
            <h2 class="h3 text-dark mb-4">Хьюстон, у нас проблема!</h2>
            <p class="text-muted mb-4">
                <?= $error ?>
            </p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="/back_end_development/project/www" class="btn btn-primary">
                    На главную
                </a>
            </div>
        </div>
    </div>
</body>
</html>