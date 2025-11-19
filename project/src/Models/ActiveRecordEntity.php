<?php

namespace Models;

use Services\Db;

abstract class ActiveRecordEntity

{
    /**
     * @return static|null
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    // Для поиска в таблице по ID
    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    // Автоматически вызывается когда пытаются установить свойство, которого нет
    // Преобразует имя из snake_case в camelCase с помощью метода underscoreToCamelCase()
    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    // ucwords() - делает заглавными буквы после _
    // str_replace() - убирает все _
    // lcfirst() - первую букву делает маленькой
    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    // Преобразует строку из camelCase в snake_case
    // preg_replace() - выполняет поиск и замену по регулярному выражению
    //  strtolower() - приводит всю строку к нижнему регистру
    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    // Получить все записи таблицы
    public static function findAll(): array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    // Автоматически преобразует свойства объекта в массив для работы с базой данных
    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }

        return $mappedProperties;
    }

    abstract protected static function getTableName(): string;


    // Сохранение данных / либо метод добавления либо изменение
    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
        $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }


    // Изменение в таблице
    private function update(array $mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        var_dump($mappedProperties);
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index; // :param1
            $columns2params[] = $column . ' = ' . $param; // column1 = :param1
            $params2values[$param] = $value; // [:param1 => value1]
            $index++;
        }

        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }


    // Добавление в таблицу
    private function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);
        $columns = [];
        $paramsNames = [];
        $params2values = [];

        foreach ($filteredProperties as $columnName => $value) {
            $columns[] = '`' . $columnName. '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    // Удаление по id 
    public function delete(): void
    {
        $db = Db::getInstance();
        $db->query(
            'DELETE FROM `' . static::getTableName() . '` WHERE id = :id',
            [':id' => $this->id]
        );
        $this->id = null;
    }

    // Найти по произвольному столбцу
    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
            [':value' => $value],
            static::class
        );
        if ($result === []) {
            return null;
        }
        return $result[0];

    }
}