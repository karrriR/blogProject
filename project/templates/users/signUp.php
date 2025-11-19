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
                    <h2 class="h4 mb-0">Регистрация</h2>
                </div>
                <div class="card-body p-4">
                    <form action="/back_end_development/project/users/register" method="post">
                        <div class="mb-3">
                            <label for="nickname" class="form-label">Никнейм</label>
                            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Введите ваш никнейм" value="<?= $_POST['nickname'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" id="email" name="email" placeholder="example@mail.com" value="<?= $_POST['email'] ?? '' ?>">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Не менее 8 символов" value="<?= $_POST['password'] ?? '' ?>">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            📝 Зарегистрироваться
                        </button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">
                        Уже есть аккаунт? <a href="/back_end_development/project/users/login" class="text-decoration-none">Войти</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>