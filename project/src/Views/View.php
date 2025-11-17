<?php

namespace Views;

class View
{
    private $templatesPath;

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    public function renderHtml(string $templateName, array $vars = [])
    {
        $title = $vars['title'] ?? 'Мой блог';
        extract($vars);
        include $this->templatesPath . '/' . $templateName;
    }
}