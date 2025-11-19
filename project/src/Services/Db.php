<?php

namespace Services;

// класс для работы с базой данных
class Db
{
    private static $instance;

    /** @var \PDO */
    private $pdo;

    // Читает настройки БД из файла, подключается к MySQL, устанавливает кодировку UTF-8
    private function __construct()
    {
        $dbOptions = (require dirname(__DIR__) . '/settings.php');
        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

     // Подготавливает SQL запрос, выполняет с параметрами, преобразует результат в объекты указанного класса
    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if (false === $result) {
            return null;
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}