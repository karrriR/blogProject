<?php
return [
    '~^articles/(\d+)$~' => [\Controllers\ArticlesController::class, 'view'],
    '~^$~' => [\Controllers\MainController::class, 'main'],
    '~^articles/(\d+)/edit$~' => [\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add$~' => [\Controllers\ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete$~' => [\Controllers\ArticlesController::class, 'delete'],
    '~^users/register$~' => [\Controllers\UsersController::class, 'signUp'],
    '~^users/login$~' => [\Controllers\UsersController::class, 'login'],
    '~^users/logout$~' => [\Controllers\UsersController::class, 'logout'],
    '~^articles/(\d+)/comments$~' => [\Controllers\CommentsController::class, 'add'],
    '~^articles/(\d+)/comments/add$~' => [\Controllers\CommentsController::class, 'addForm'],
    '~^comments/(\d+)/edit$~' => [\Controllers\CommentsController::class, 'edit'],
    '~^comments/(\d+)/delete$~' => [\Controllers\CommentsController::class, 'delete'],
];