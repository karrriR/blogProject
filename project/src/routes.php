<?php
return [
    '~^hello/(.*)$~' => [\Controllers\MainController::class, 'sayHello'],
    '~^bye/(.*)$~' => [\Controllers\MainController::class, 'sayBye'],
    '~^articles/(\d+)$~' => [\Controllers\ArticlesController::class, 'view'],
    '~^$~' => [\Controllers\MainController::class, 'main'],
];