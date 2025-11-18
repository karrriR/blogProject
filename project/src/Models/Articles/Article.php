<?php

namespace Models\Articles;
class Article
{
    private $id;
    private $name;
    private $text;
    private $authorId;
    private $createdAt;


    // Автоматически вызывается когда пытаются установить свойство, которого нет
    // Преобразует имя из snake_case в camelCase с помощью метода underscoreToCamelCase()
    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

     public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    // ucwords() - делает заглавными буквы после _
    // str_replace() - убирает все _
    // lcfirst() - первую букву делает маленькой
    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }
}