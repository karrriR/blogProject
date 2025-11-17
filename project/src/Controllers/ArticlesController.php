<?php

namespace Controllers;
use Models\Articles\Article;
use Models\Users\User;
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
        //Получаем статью
        $result = $this->db->query(
            'SELECT * FROM `articles` WHERE id = :id;',
            [':id' => $articleId],
            Article::class
        );
        
        if ($result === []) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $article = $result[0];

        // Получаем автора статьи
        $authorResult = $this->db->query(
            'SELECT u.* FROM `users` u WHERE u.id = :author_id;',
            [':author_id' => $article->getAuthorId()],
            User::class
        );

        $author = !empty($authorResult) ? $authorResult[0] : null;

        $this->view->renderHtml('components/articles/view.php', [
            'article' => $article,
            'author' => $author
        ]);
    }
}