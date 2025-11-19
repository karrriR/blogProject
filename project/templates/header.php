<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
     <title>Веселый Блог</title>
</head>
<body class="d-flex flex-column min-vh-100 container">
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-4 mb-md-0">
        <a href="/back_end_development/project/www" class="d-inline-flex text-decoration-none">
            <span class="fs-2 fw-bold text-primary">
                ВеселыйБлог.ru
            </span>
        </a>
    </div>

  <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
    <li><a href="#" class="nav-link px-2 link-secondary">Статьи</a></li>
    <li><a href="#" class="nav-link px-2">О блоге</a></li>
    <li><a href="#" class="nav-link px-2">FAQ</a></li>
  </ul>

  <div class="col-md-3 text-end">
     <?php if (isset($user) && $user !== null): ?>
        <div class="d-flex align-items-center justify-content-end">
            <span class="me-3 text-dark fw-semibold">
                <i class="bi bi-person-circle me-1"></i> <?= $user->getNickname() ?>
            </span>
            <a href="/back_end_development/project/users/logout" class="btn btn-outline-secondary btn-sm">Выйти</a>
        </div>
        <?php else: ?>
        <div class="d-flex gap-2 justify-content-end">
            <a href="/back_end_development/project/users/login" class="btn btn-outline-primary">Войти</a>
            <a href="/back_end_development/project/users/register" class="btn btn-primary">Регистрация</a>
        </div>
        <?php endif; ?>
</div>
</header>
<main class="container">