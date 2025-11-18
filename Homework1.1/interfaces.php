<?php
/*            Задание - Интерфейсы в PHP          */
/*
- Познакомьтесь самостоятельно с функцией get_class().
- Дополните информацию об объекте, для которого считается площадь – пишите что это объект такого-то класса.
- Для объектов, которые не реализуют интерфейс CalculateSquare пишите:
    Объект класса ТУТ_НАЗВАНИЕ_КЛАССА не реализует интерфейс CalculateSquare.
*/

interface CalculateSquare
{
    public function calculateSquare(): float;
}

class Circle implements CalculateSquare
{
    const PI = 3.1416;
    private $r;

    public function __construct(float $r)
    {
        $this->r = $r;
    }

    public function calculateSquare(): float
    {
        return self::PI * ($this->r ** 2);
    }
}

class Rectangle
{
    private $x;
    private $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function calculateSquare(): float
    {
        return $this->x * $this->y;
    }
}

class Square implements CalculateSquare
{
    private $x;
 
    public function __construct(float $x)
    {
        $this->x = $x;
    }

    public function calculateSquare(): float
    {
        return $this->x ** 2;
    }

}

$objects = [
    new Square(5),
    new Rectangle(2, 4),
    new Circle(5)
];

foreach ($objects as $object) {
    if ($object instanceof CalculateSquare) {
        echo 'Объект реализует интерфейс CalculateSquare. <br>
        Объект является экземпляром класса - <b>' . get_class($object) . 
        '</b>. <br> Площадь: ' . $object->calculateSquare();
        echo '<br><br>';
    } else {
        echo 'Объект класса - <b>' . get_class($object) . '</b> не реализует интерфейс CalculateSquare.';
        echo '<br><br>';
    }
}