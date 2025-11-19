<?php

try {

    //Функция автозагрузки классов 
    //первым аргументом в функцию будет передаваться полное имя класса (вместе с неймспейсом)

    spl_autoload_register(function (string $className) {
        require_once dirname(__DIR__). '/src/' . $className . '.php';
    });


    // Получение маршрута пользователя, подключение файла с маршрутами и переадресации
    $route = $_GET['route'] ?? '';
    $routes = require_once dirname(__DIR__). '/src/routes.php';
    $isRouteFound = false;


    // Цикл перебора маршрутов из src/routes.php. 
    // Функция preg_match ищет совпадения паттерна с тем саршрутом, куда перешел пользователь, результат записывает в массив $matches
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \Exceptions\NotFoundException();
    }

    // unset($matches[0]) удаляет элемент с ключом 0. То есть паттерн, оставляя только параметр после /
    unset($matches[0]);

    //Получение имени контроллера и метода из файла с маршрутами
    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    //Создание объекта контроллера и вызов метода с параметрами
    //...$matches распаковывает массив в аргументы
    $controller = new $controllerName();
    $controller->$actionName(...$matches);

} catch (\Exceptions\DbException $e) {
    $view = new \Views\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);

} catch (\Exceptions\NotFoundException $e) {

    $view = new \Views\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
}