<?php
// Препроцессор шаблонов

namespace Views;

class View
{
    private $templatesPath;
    private $extraVars = [];

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    // Добавляет глобальные переменные, которые будут доступны во всех шаблонах
    public function setVar(string $name, $value): void
    {
        $this->extraVars[$name] = $value;
    }

    // Метод рендоринга страницы HTML, принимает в качестве параметров (Имя файла шаблона, массив с данными для шаблона, статус HTTP)
    public function renderHtml(string $templateName, array $vars = [], int $code = 200)
    {
        // http_response_code - устанавливает HTTP-код
        http_response_code($code);
        extract($this->extraVars);

        // extract() - превращает ключи массива в переменные
        extract($vars);

        // ob_start() - включение "сборщика вывода" -> весь вывод идет не в браузер, а в специальную память
        // Шаблон генерирует HTML
        // В переменную записывается собранный HTML
        // ob_end_clean() - очищение "сборщика вывода"
        ob_start();
        include $this->templatesPath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }
}