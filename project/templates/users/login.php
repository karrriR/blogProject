<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <?php if (!empty($error)): ?>
                    <div class="alert alert-danger mt-3 alert-dismissible" role="alert">
                        <strong>Ошибка!</strong> <?= $error ?>
                        <button type="button" class="btn-close" onclick="this.parentElement.style.display='none'"></button>
                    </div>
                    <?php endif; ?>
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2 class="h4 mb-0">Вход в аккаунт</h2>
                </div>
                <div class="card-body p-4">
                    <form action="/back_end_development/project/users/login" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" id="email"  name="email"  value="<?= $_POST['email'] ?? '' ?>" placeholder="example@mail.com">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control"  id="password"  name="password"  placeholder="Введите ваш пароль" value="<?= $_POST['password'] ?? '' ?>">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            🔑 Войти
                        </button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">
                        Нет аккаунта? <a href="/back_end_development/project/users/register" class="text-decoration-none">Зарегистрироваться</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>