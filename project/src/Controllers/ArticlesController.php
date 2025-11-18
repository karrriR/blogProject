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

    // Инициализирует шаблонизатор и подключение к базе данных
    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)) . '/templates');
        $this->db = new Db();
    }

    // Отображает страницу просмотра конкретной статьи
    public function view(int $articleId)
    {
        // Получаем статью из базы данных по её ID
        $result = $this->db->query(
            'SELECT * FROM `articles` WHERE id = :id;',
            [':id' => $articleId],
            Article::class
        );

         // Если статья не найдена, показывается страница 404
        if ($result === []) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

         // Извлекаем статью из результата запроса
        $article = $result[0];

        // Получаем автора статьи по его ID из таблицы пользователей
        $authorResult = $this->db->query(
            'SELECT u.* FROM `users` u WHERE u.id = :author_id;',
            [':author_id' => $article->getAuthorId()],
            User::class
        );

        $author = !empty($authorResult) ? $authorResult[0] : null;

        // Отображаем шаблон страницы статьи, передавая статью и данные автора
        $this->view->renderHtml('components/articles/view.php', [
            'article' => $article,
            'author' => $author
        ]);
    }
}