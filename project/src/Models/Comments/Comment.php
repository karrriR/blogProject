<?php

namespace Models\Comments;

use Models\ActiveRecordEntity;
use Models\Users\User;
use Models\Articles\Article;

class Comment extends ActiveRecordEntity
{
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    public function getAuthorId(): User
    {
        return User::getById($this->authorId);
    }

    public function getArticleId(): Article
    {
        return Article::getById($this->articleId);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public function setArticle(Article $article): void
    {
        $this->articleId = $article->getId();
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    protected static function getTableName(): string
    {
        return 'comments';
    }
    public function canDelete(User $user): bool
    {
        return $user->getId() === $this->getAuthorId()->getId() || $user->isAdmin();
    }
}