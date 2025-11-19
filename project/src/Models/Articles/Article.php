<?php

namespace Models\Articles;

use Models\ActiveRecordEntity;
use Models\Users\User;

class Article extends ActiveRecordEntity
{
    protected $name;
    protected $text;
    protected $authorId;
    protected $createdAt;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public function getName(): string
    {
        return $this->name;
    }
    
    public function getCreatedAtFormatted(): string
    {
        return date('d.m.Y H:i', strtotime($this->createdAt));
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthorId(): User
    {
        return User::getById($this->authorId);
    }

    protected static function getTableName(): string
    {
        return 'articles';
    }

    public function canEdit(User $user): bool
    {
        return $user->isAuthorOf($this) || $user->isAdmin();
    }

    public function canDelete(User $user): bool
    {
        return $user->isAuthorOf($this) || $user->isAdmin();
    }
}