<?php

namespace Controllers;

use Models\Articles\Article;
use Models\Users\User;
use Exceptions\NotFoundException;
use Models\Comments\Comment;

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

        $comments = Comment::findAllByColumn('article_id', $articleId);

        // Отображаем шаблон страницы статьи, передавая статью
        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'comments' => $comments
        ]);
    }


    // Изменение статьи 
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

    // Добавление статьи
    public function add(): void
    {
        if ($this->user === null) {
        header('Location: /back_end_development/project/users/login');
        exit;
        }

        if ($_POST) {
            $name = trim($_POST['name'] ?? '');
            $text = trim($_POST['text'] ?? '');

            if (empty($name) || empty($text)) {
                $this->view->renderHtml('articles/add.php', [
                    'error' => 'Все поля обязательны для заполнения'
                ]);
                return;
            }
            
            // Создаем статью с текущим пользователем как автором
            $article = new Article();
            $article->setAuthor($this->user); 
            $article->setName($name);
            $article->setText($text);
            $article->save();
            
            header('Location: /back_end_development/project/www');
            exit;
        }
        
        $this->view->renderHtml('articles/add.php');
    }

    // Удаление статьи
    public function delete(int $articleId): void
    {
        /** @var \Models\Articles\Article|null $article */
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }
        if ($this->user === null || !$article->canDelete($this->user)) {
            throw new NotFoundException();
        }

        $article->delete();
        header('Location: /back_end_development/project/www');
        exit;
    }
}