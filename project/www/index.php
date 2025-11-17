<?php

spl_autoload_register(function (string $className) {
    require_once dirname(__DIR__). '/src/' . $className . '.php';
});

$route = $_GET['route'] ?? '';
$routes = require_once dirname(__DIR__). '/src/routes.php';
$isRouteFound = false;

foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches);
    if (!empty($matches)) {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound) {
    echo 'Страница не найдена!';
    return;
}

unset($matches[0]);

$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];
$controller = new $controllerName();
$controller->$actionName(...$matches);

// $author = new \Models\Users\User('Иван');
// $article = new \Models\Articles\Article('Заголовок', 'Текст', $author);
// var_dump($article);
 