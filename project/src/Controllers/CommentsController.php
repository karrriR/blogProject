<?php

namespace Controllers;

use Models\Comments\Comment;
use Models\Articles\Article;
use Exceptions\InvalidArgumentException;
use Exceptions\NotFoundException;

class CommentsController extends AbstractController
{
    // Показ формы добавления комментария
    public function addForm(int $articleId): void
    {
        $article = Article::getById($articleId);
        
        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            header('Location: /back_end_development/project/users/login');
            exit;
        }

        $this->view->renderHtml('comments/add.php', [
            'article' => $article
        ]);
    }

    // Добавление комментария
    public function add(int $articleId): void
    {
        $article = Article::getById($articleId);
        
        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            header('Location: /back_end_development/project/users/login');
            exit;
        }

        if (!empty($_POST)) {
            $text = trim($_POST['text'] ?? '');
            
            if (empty($text)) {
                header("Location: /back_end_development/project/articles/{$articleId}#comment-form");
                exit;
            }

            $comment = new Comment();
            $comment->setAuthor($this->user);
            $comment->setArticle($article);
            $comment->setText($text);
            $comment->save();

            header("Location: /back_end_development/project/articles/{$articleId}#comment-{$comment->getId()}");
            exit;
        }

        header("Location: /back_end_development/project/articles/{$articleId}");
        exit;
    }

    // Форма редактирования комментария
    public function edit(int $commentId): void
    {
        /** @var \Models\Comments\Comment|null $comment */
        $comment = Comment::getById($commentId);
        
        if ($comment === null) {
            throw new NotFoundException();
        }

        if ($this->user === null || $comment->getAuthorId()->getId() !== $this->user->getId()) {
            throw new NotFoundException();
        }

        if (!empty($_POST)) {
            $text = trim($_POST['text'] ?? '');
            
            if (!empty($text)) {
                $comment->setText($text);
                $comment->save();
                
                header("Location: /back_end_development/project/articles/{$comment->getArticleId()->getId()}#comment-{$commentId}");
                exit;
            }
        }

        $this->view->renderHtml('comments/edit.php', [
            'comment' => $comment
        ]);
    }
    public function delete(int $commentId): void
    {
        /** @var \Models\Comments\Comment|null $comment */
        $comment = Comment::getById($commentId);
        
        if ($comment === null) {
            throw new NotFoundException();
        }

        // Проверяем права: автор комментария ИЛИ админ
        if ($this->user === null || 
            ($comment->getAuthorId()->getId() !== $this->user->getId() && !$this->user->isAdmin())) {
            throw new NotFoundException();
        }

        $articleId = $comment->getArticleId()->getId();
        $comment->delete();

        header("Location: /back_end_development/project/articles/{$articleId}");
        exit;
    }
}