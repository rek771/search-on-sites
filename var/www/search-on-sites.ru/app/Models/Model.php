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

    public function execute(string $sql): void
    {
        $this->connector->query($sql)->execute();
    }

    public function insert(string $columns,string $params): void
    {
        var_dump("INSERT INTO {$this->table} ({$columns}) VALUES ({$params})");
        $conn = $this->connector->prepare("INSERT INTO {$this->table} ({$columns}) VALUES (?)");
//        $conn->bind_param("s", $params);
        $conn->execute([$params]);
    }

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