<?php
namespace App\Models;

use App\Core\MysqlConnector;
use PDO;

class Model
{
    protected string $table = '';
    private MysqlConnector $connector;

    public function __construct(MysqlConnector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * Выполняет SQL запрос напрямую
     * @param string $sql
     */
    public function execute(string $sql): void
    {
        $this->connector->query($sql)->execute();
    }

    /**
     * Вставляет значения из $params в соотв. колонки $columns
     * @param string $columns
     * @param string $params
     */
    public function insert(string $columns,string $params): void
    {
        $conn = $this->connector->prepare("INSERT INTO {$this->table} ({$columns}) VALUES (?)");
        $conn->execute([$params]);
    }

    /**
     * Выполняет select операцию из базы по переданному sql запросу
     * @param string $sql
     * @return array
     */
    public function select(string $sql): array
    {
        $result = [];

        $pdo = $this->connector->query($sql);
        $pdo->setFetchMode(PDO::FETCH_ASSOC);

        while ($row = $pdo->fetch()) {
            $result[] = $row;
        }

        return $result;
    }
}