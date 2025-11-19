<?php

namespace Controllers;

use Models\Articles\Article;
use Models\Users\User;
use Exceptions\NotFoundException;

class ArticlesController extends AbstractController
{

    // Отображает страницу просмотра конкретной статьи
    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

         // Если статья не найдена, показывается страница 404
        if ($article === null) {
            throw new NotFoundException();
        }

        // Отображаем шаблон страницы статьи, передавая статью
        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
        ]);
    }

    public function edit(int $articleId): void
    {
        /** @var Article|null $article */

        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        if (!empty($_POST)) {
            $article->setName($_POST['name']);
            $article->setText($_POST['text']);
            $article->save();

            // Перенаправляем на страницу статьи после сохранения
            header('Location: /back_end_development/project/articles/' . $article->getId());
            exit;
        }

        $this->view->renderHtml('articles/edit.php', [
            'article' => $article
        ]);

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
            throw new NotFoundException();
        }
         $article->delete();
    }
}