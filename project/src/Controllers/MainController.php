<?php

namespace Controllers;

use Models\Articles\Article;
use Services\Db;
use Views\View;

class MainController
{
    private $view;
    private $db;

    // Инициализирует шаблонизатор и подключение к базе данных
    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)) . '/templates');
        $this->db = Db::getInstance();
    }

    // Обрабатывает главную страницу сайта
    // Получает все статьи из базы данных и передает их в шаблон
    public function main()
    {
        $articles = Article::findAll();
        
        // Отображаем шаблон главной страницы, передавая массив статей
        $this->view->renderHtml('main/main.php', [
            'articles' => $articles
        ]);
    }

}

// public function sayHello(string $name)
    // {
    //     $this->view->renderHtml('main/hello.php', [
    //         'name' => $name,
    //         'title' => 'Страница приветствия'
    //     ]);
    // }
    // public function sayBye(string $name)
    // {
    //     $this->view->renderHtml('main/bye.php', [
    //         'name' => $name,
    //         'title' => 'Страница прощания'
    //     ]);
    // }