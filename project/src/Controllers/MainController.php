<?php

namespace Controllers;

use Models\Articles\Article;
use Services\Db;
use Views\View;

class MainController
{
    private $view;
    private $db;

    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)) . '/templates');
        $this->db = new Db();
    }

    public function main()
    {
        $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);

        $this->view->renderHtml('main/main.php', [
            'articles' => $articles
        ]);
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
}