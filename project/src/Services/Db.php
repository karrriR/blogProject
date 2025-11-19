<?php

namespace Services;

use Exceptions\DbException;

// класс обеспечивает единственное соединение с БД
class Db
{
    private static $instance;

    /** @var \PDO */
    private $pdo;

    // Читает настройки БД из файла, создает PDO соединение, устанавливает кодировку UTF-8
    private function __construct()
    {
        $dbOptions = (require dirname(__DIR__) . '/settings.php');

        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');
            
        } catch (\PDOException $e) {
            throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage());
        }
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

    // Метод для глобального доступа через Db::getInstance()
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}