<?php

namespace Controllers;

use Models\Articles\Article;
use Models\Users\User;
use Views\View;

class ArticlesController
{
    /** @var View */
    private $view;

    // Инициализирует шаблонизатор
    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)) . '/templates');
    }

    // Отображает страницу просмотра конкретной статьи
    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

         // Если статья не найдена, показывается страница 404
        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        // Отображаем шаблон страницы статьи, передавая статью
        $this->view->renderHtml('components/articles/view.php', [
            'article' => $article,
        ]);
    }

    public function edit(int $articleId): void
    {
        /** @var Article|null $article */

        $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');
        $article->save();

    }

    public function add(): void
    {
        $author = User::getById(1);
        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();

        var_dump($article);
    }

    public function delete(int $articleId): void
    {
         $article = Article::getById($articleId);

        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }
         $article->delete();
    }
}