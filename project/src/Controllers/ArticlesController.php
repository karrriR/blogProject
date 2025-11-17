<?php

namespace Controllers;
use Models\Articles\Article;
use Services\Db;
use Views\View;

class ArticlesController
{
    /** @var View */
    private $view;

    /** @var Db */
    private $db;

    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)) . '/templates');
        $this->db = new Db();
    }

    public function view(int $articleId)
    {
        $result = $this->db->query(
            'SELECT * FROM `articles` WHERE id = :id;',
            [':id' => $articleId],
            Article::class
        );
        
        if ($result === []) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
        $this->view->renderHtml('components/articles/view.php', [
            'article' => $result[0]
        ]);
    }
}