<?php
return [
    '~^articles/(\d+)$~' => [\Controllers\ArticlesController::class, 'view'],
    '~^$~' => [\Controllers\MainController::class, 'main'],
    '~^articles/(\d+)/edit$~' => [\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add$~' => [\Controllers\ArticlesController::class, 'add'],
    '~^articles/(\d+)/delete$~' => [\Controllers\ArticlesController::class, 'delete']
];