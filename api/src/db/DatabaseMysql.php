<?php

namespace VOXApi\Db;

class DatabaseMysql
{
    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $dbname;
    private ?\PDO $connection;

    public function __construct()
    {
        try {
            if (!($config = \parse_ini_file(__DIR__ . "/../config/config.ini", true))) {
                throw new \Exception("Unable to load config file.");
            }

            $this->host = $config["database"]["host"];
            $this->port = $config["database"]["port"];
            $this->username = $config["database"]["username"];
            $this->password = $config["database"]["password"];
            $this->dbname = $config["database"]["dbname"];
        } catch (\Exception $ex) {
            $this->log($ex->getMessage());
        }
    }

    private function log(string $message): void
    {
        \error_log(\date("c") . " - " . $message . "\n", 3, __DIR__ . "/../logs/" . \date("Ymd") . "_db_errors.log");
    }

    public function connect(): bool
    {
        if ($this->connection === null) {
            try {
                $this->connection = new \PDO(
                    "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}",
                    $this->username,
                    $this->password,
                    [
                        \PDO::ATTR_DEFAULT_FECTH_MODE => \PDO::FETCH_OBJ,
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                    ]
                );
            } catch (\Exception $ex) {
                $this->log(\implode(" - ", [
                    "Code: {$ex->getCode()}",
                    "Line: {$ex->getLine()}",
                    "Message: {$ex->getMessage()}"
                ]));
                return false;
            }
        }

        return true;
    }
}
