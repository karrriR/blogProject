<?php 
/*            Задание - Инкапсуляция          */
/*Дополните метод sayHello(), чтобы кошки после того, как назвали своё имя, говорили о том, какого они цвета.
Сделайте свойство color приватным и добавьте в конструктор ещё один аргумент, через который при создании кошки будет задаваться её цвет.
Сделайте геттер, который будет позволять получить свойство color.*/

class Cat
{
    private $name;
    private $color;
    public $weight;

    public function __construct(string $name, string $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function sayHello()
    {
        echo 'Привет! Меня зовут ' . $this->name . '. Моя шерсть ' . $this->color . ' цвета.';
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor():string {
        return $this->color;
    }
}

$cat1 = new Cat('Черныш', 'рыжего');
echo $cat1->sayHello();

?>